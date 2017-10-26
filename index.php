<?php
    require_once('connection.php');
	//Start session
	session_start();	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
    <title></title>
</head>
<body>
<header>
<div class="wrap">
<nav class="navbar navbar-expand-lg navbar-light justify-content-between bg-primary ">
  <a class="navbar-brand" href="#">Navbar</a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" id="nav">
    
<?php
$res=$bd->query("SELECT * FROM main_menu");
while($row=$res->fetch_array())
{
 ?>
 <li class="nav-item"><a class="nav-link" href="<?php echo $row['m_menu_link']; ?>"><?php echo $row['m_menu_name']; ?></a>
 <?php
 $res_pro=$bd->query("SELECT * FROM sub_menu WHERE m_menu_id=".$row['m_menu_id']);
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
<form class="form-inline" name="loginform" action="login_exec.php" method="post">
    <input class="form-control mr-sm-2" name="username" type="text" placeholder="Username" aria-label="">
    <input class="form-control mr-sm-2" name="password" type="password" placeholder="Password" aria-label="">
    <!--the code bellow is used to display the message of the input validation-->
		 <?php
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>'; 
				}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			}
		?>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="login">Login</button>
  </form> 
</div>
</header>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
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
  <script>
                
                /***********************************************
                * Refresh page Script- (c) Dynamic Drive (http://www.dynamicdrive.com)
                * Please keep this notice intact
                * Visit http://www.dynamicdrive.com/ for this script and 100s more.
                ***********************************************/
                
                function refreshpage(interval, countdownel, totalel){
                    var countdownel = document.getElementById(countdownel)
                    var totalel = document.getElementById(totalel)
                    var timeleft = interval+1
                    var countdowntimer
                
                    function countdown(){
                        timeleft--
                        countdownel.innerHTML = timeleft
                        if (timeleft == 0){
                            clearTimeout(countdowntimer)
                            window.location.reload()
                        }
                        countdowntimer = setTimeout(function(){
                            countdown()
                        }, 1000)
                    }
                
                    countdown()
                }
                
                window.onload = function(){
                    refreshpage(120, "countdown") // refreshpage(duration_in_seconds, id_of_element_to_show_result)
                }
                
                </script>
                
</body>
<footer>
    <div>Next <a href="javascript:window.location.reload()">refresh</a> in <b id="countdown"></b> seconds</div>
</footer>
</html>