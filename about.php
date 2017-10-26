<?php
$dbcon = new MySQLi("localhost","root","","waylonsnotes.com");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dynamic Dropdown Menu using PHP and MySQLi</title>
<script type="text/javascript" src="jquery.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
<div class="wrap">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" id="nav">
<?php
$res=$dbcon->query("SELECT * FROM main_menu");
while($row=$res->fetch_array())
{
 ?>
 <li class="nav-item"><a class="nav-link" href="<?php echo $row['m_menu_link']; ?>"><?php echo $row['m_menu_name']; ?></a>
 <?php
 $res_pro=$dbcon->query("SELECT * FROM sub_menu WHERE m_menu_id=".$row['m_menu_id']);
 ?>
        <ul>    
  <?php  
  while($pro_row=$res_pro->fetch_array())
  {
   ?><li class="nav-item"><a class="nav-link" href="<?php echo $pro_row['s_menu_link']; ?>"><?php echo $pro_row['s_menu_name']; ?></a></li><?php
  }
  ?>
 </ul>
 </li> 
 
    <?php
}
?>
</ul> 
</div>

<script type="text/javascript">
$(document).ready(function() 
{
 $('#nav li').hover(function() 
 {
  $('ul', this).slideDown('fast');
 }, function() 
 {
  $('ul', this).slideUp('fast');
 });
});
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>