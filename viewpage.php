<?php
  require("db.php");

  // If checkboxed is check, move to solved.
  if (isset($_POST["submit"])) {
      if (isset($_POST["checkSolved"])) {
        $data->problemSolved($_POST["checkSolved"], $_POST["notesSolved"]);
        header("location: view.php");
      }
  }

  // Display the page. Layout currently comes from db.php
  if (isset($_GET['id'])) {
    $t_id = $_GET['id'];

    if ($data->checkStatus($t_id) == 0) {
      $data->getUnSolvedData($t_id);

?>


 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <textarea name="notesSolved" placeholder="How did you solve.."></textarea><br />
   <input type="checkbox" name="checkSolved" value="<?php echo $t_id; ?>" />
   Issue has been solved<br />
   <input type="submit" name="submit" value="submit" />
</form>

<?php
  } elseif ($data->checkStatus($t_id) == 1) {
    $data->getSolvedData($t_id);
  }
}

 ?>
