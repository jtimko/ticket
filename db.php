<?php

class DataBase {
  public $db;
  private $host = "localhost";
  private $dbname; //update these variables with correct info
  private $user;
  private $pass;

  public function __construct() {
    $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->user", "$this->pass");
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }

  // This inserts input from index.php
  public function insertData($name, $company = "none", $email, $phone, $priority, $message, $ticketNum) {
    try {
      $q = "INSERT INTO Tickets(t_name, t_company, t_email, t_phone, t_priority, t_message, t_ticketNum, t_date, t_solved)
      VALUES(:name, :company, :email, :phone, :priority, :message, :ticketNum, NOW(), :solved);";

      $query = $this->db->prepare($q);

      $results = $query->execute(array(
        ":name" => $name,
        ":company" => $company,
        ":email" => $email,
        ":phone" => (int)$phone,
        ":priority" => (int) $priority,
        ":message" => $message,
        ":ticketNum" => $ticketNum,
        ":solved" => 0
      ));
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

  // This list queries on the view.php
  public function listQueries($solved) {
    try {
      $q = "SELECT * FROM Tickets WHERE t_solved = $solved";
      $stmt = $this->db->prepare($q);
      $stmt->execute();

      $results = $stmt->fetchAll(PDO::FETCH_OBJ);

      foreach($results as $r) {
        echo "<tr><td><a href='viewpage.php?id=$r->t_ticketNum'>$r->t_ticketNum</a></td>
        <td>$r->t_name</td>
        <td>$r->t_company</td>
        <td>$r->t_priority</td>
        <td>$r->t_date</td></tr>";
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // This is for the viewpage.php. getUnSolvedData() displays the content
  // with a note input.
  public function getUnSolvedData($id) {
    try {
      $q = "SELECT * FROM Tickets WHERE t_ticketNum = $id;";
      $stmt = $this->db->prepare($q);
      $stmt->execute();

      $results = $stmt->fetchAll(PDO::FETCH_OBJ);

      foreach($results as $r) {
        echo "<b>Name:</b> $r->t_name </br>";
        echo "<b>Company:</b> $r->t_company </br>";
        echo "<b>Email:</b> $r->t_email </br>";
        echo "<b>Phone:</b> $r->t_phone </br>";
        echo "<b>Priority:</b> $r->t_priority </br>";
        echo "<b>Message:</b> $r->t_message </br>";
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // This is for the viewpage.php. getSolvedData() displays the content with
  // the actual notes.
  public function getSolvedData($id) {
    try {
      $q = "SELECT * FROM Tickets, ticketSolved
      WHERE Tickets.t_ticketNum = $id
      AND ticketSolved.s_ticketId = $id;";
      $stmt = $this->db->prepare($q);
      $stmt->execute();

      $results = $stmt->fetchAll(PDO::FETCH_OBJ);

      foreach($results as $r) {
        echo "<b>Name:</b> $r->t_name </br>";
        echo "<b>Company:</b> $r->t_company </br>";
        echo "<b>Email:</b> $r->t_email </br>";
        echo "<b>Phone:</b> $r->t_phone </br>";
        echo "<b>Priority:</b> $r->t_priority </br>";
        echo "<b>Message:</b> $r->t_message </br>";
        echo "<b>Notes:</b> $r->s_notes <br />";
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // This stores the data given when solving the query. It stores the the ticket
  // in Tickets database, and save the notes in ticketSolved.
  public function problemSolved($id, $notes = "-") {
    try {
      $q = "UPDATE Tickets SET t_solved = 1 WHERE t_ticketNum = :id;";
      $stmt = $this->db->prepare($q);
      $stmt->execute(array(":id" => $id));

      $q = "INSERT INTO ticketSolved(s_ticketId, s_notes) VALUES(:id, :notes)";
      $stmt = $this->db->prepare($q);
      $stmt->execute(array(":id" => $id, ":notes" => $notes));

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // This is used for viewpage.php. It helps decide to either use getUnSolvedData()
  // or getSolvedData() to properly display.
  public function checkStatus($id) {
    try {
      $q = "SELECT t_solved FROM Tickets WHERE t_ticketNum = $id;";
      $stmt = $this->db->prepare($q);
      $stmt->execute();
      $results = $stmt->fetch();

      return $results['t_solved'];

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
$data = new DataBase();

 ?>
