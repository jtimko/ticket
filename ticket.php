<?php
  require('db.php');

  function clearInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }
  // Need to do better input checking
  if (isset($_POST["submit"])) {
    if (isset($_POST["name"])) {
      $name = clearInput($_POST["name"]);
    }
    if (isset($_POST["company"])) {
      $company = clearInput($_POST["company"]);
    }
    if (isset($_POST["priority"])) {
      $priority = clearInput($_POST["priority"]);
    }
    if (isset($_POST["email"])) {
      $email = clearInput($_POST["email"]);
    }
    if (isset($_POST["phone"])) {
      $phone = clearInput($_POST["phone"]);
    }
    if (isset($_POST["message"])) {
      $message = clearInput($_POST["message"]);
    }
  }

  $ticketNum = rand(100000, 999999);
  if ($name && $email && $phone && $priority && $message && $ticketNum) {
    $data->insertData($name, $company, $email, $phone, $priority, $message, $ticketNum);
    //mail("justin@whisperfront.com", "ticket", $message);
    echo "Your ticket has been submitted";
  }
?>
