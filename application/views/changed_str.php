<!DOCTYPE html>
<html>
<head>
  <title>String Replace</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
</head>
<body>

<p style="margin: 50px;"></p>
<div class="container">
  <h2>String Result</h2>
  <a class="pull-right" href="<?php echo base_url('welcome/compare_str')?>">Compare Again</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>String 1</th>
                <th>String 2</th>
                <th>Output 1</th>
                <th>Output 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td><?php echo $str1 ?></td>
              <td><?php echo $str2 ?></td>
              <td><?php echo $strnew1 ?></td>
              <td><?php echo $strnew2 ?></td>
            </tr>            
        </tbody>
    </table>
</div>
</body>
</html>