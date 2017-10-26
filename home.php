<?php
    require_once('auth.php');
    require_once('connection.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
<title>Untitled Document</title>
<style type="text/css">

.style1 {
	font-size: 36px;
	font-weight: bold;
}

</style>
</head>
 
<body>
<header>
<div class="wrap">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
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
   ?><li class="dropdown-menu"><a class="dropdown-item" href="<?php echo $pro_row['s_menu_link']; ?>"><?php echo $pro_row['s_menu_name']; ?></a></li><?php
  }
  ?>
 </ul>
 </li> 
 
    <?php
}
?>
</ul> 
</div>
</header>
    <center>
    <p align="center" class="style1">Login successfully </p>
<p align="center">
    <?php include('SimpleCMS/display.php') ?>
    hear is the link to the <a href="add_menu.php">menu</a>

    <?php
 
require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
switch ( $action ) {
  case 'archive':
    archive();
    break;
  case 'viewArticle':
    viewArticle();
    break;
  default:
    homepage();
}
 
 
function archive() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Article Archive | Widget News";
  require( TEMPLATE_PATH . "/archive.php" );
}
 
function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    homepage();
    return;
  }
 
  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  $results['pageTitle'] = $results['article']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}
 
function homepage() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homepage.php" );
}
 
?>

</p>

    </center>
<p align="center"><a href="index.php">logout</a></p>
<div>Next <a href="javascript:window.location.reload()">refresh</a> in <b id="countdown"></b> seconds</div>
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
</html>