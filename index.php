<!DOCTYPE html>

<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
</head>

<body>
<div class="container-fluid">
  <div class="col-md-4 col-md-offset-5">
    <form action="ticket.php" method="POST">
      <div class="form-group">
        <label for="name">Name</label><br />
        <input type="text" placeholder="name" name="name" /><br />
      </div><!--end of form-group-->
      <div class="form-group">
        <label for="company">Company</label><br />
        <input type="text" placeholder="company" name="company"/><br />
      </div><!--end of form-group-->
      <div class="form-group">
        <label for="email">Email</label><br />
        <input type="email" placeholder="email" name="email"/><br />
      </div><!--end of form-group-->
      <div class="form-group">
        <label for="phone">Phone</label><br />
        <input type="text" placeholder="phone" name="phone"/><br />
      </div><!--end of form-group-->
      <div class="form-group">
        <label for="priority">Priority</label><br />
        <select name="priority"><br />
        <option value="" selected="selected">Priority</option>
        <option value="1">Low</option>
        <option value="2">Medium</option>
        <option value="3">Emergency</option>
        </select><br/>
      </div><!-- end of form-group-->
      <div class="form-group">
        <label for="message">Message</label><br />
        <textarea name="message" placeholder="Explain the issue..."></textarea></br>
      </div><!--end of form-group-->
      <input type="submit" value="submit" name="submit" />
    </form>
  </div><!--end of col-md-6-->
</div><!--End of container-fluid-->
</body>
</html>
