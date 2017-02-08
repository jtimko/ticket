<?php require('db.php'); ?>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>

<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div id="unsolved">
          <h2>Unsolved</h2>
          <table class="table table-hover">
            <tr>
              <th>Ticket</th>
              <th>Name</th>
              <th>Company</th>
              <th>Priorty</th>
              <th>Date</th>
            </tr>
              <?php $data->listQueries(0); ?>
          </table>
        </div>
        <div id="solved">
          <h2>Solved</h2>
          <table class="table table-hover">
            <tr>
              <th>Ticket</th>
              <th>Name</th>
              <th>Company</th>
              <th>Priorty</th>
              <th>Date</th>
            </tr>
              <?php $data->listQueries(1); ?>
            </table>
        </div>
      </div><!--end of col-md-8-->
    </div><!--end of row-->
</div><!--end of container-fluid-->
</body>
</html>
