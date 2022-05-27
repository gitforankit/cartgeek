<!DOCTYPE html>
<html>
<head>
  <title>String Replace</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
</head>
<body>

<p style="margin: 50px;"></p>
<div class="container">
  <h2>Compare String</h2>
<form method="get" action="<?php echo base_url('welcome/changed_str')?>">
  <div class="form-group">
    <label for="exampleInputEmail1">String 1</label>
    <input type="text" class="form-control" name="str1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">String 2</label>
    <input type="text" class="form-control" name="str2">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>