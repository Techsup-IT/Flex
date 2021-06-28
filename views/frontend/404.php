
<!DOCTYPE html>
<html>
<head>
<title></title>

<link href="<?php echo SITE_URL.'/assets/frontend/css/bootstrap.min.css';?>" rel="stylesheet">
<link href="<?php echo SITE_URL.'/assets/frontend/css/style.css';?>" rel="stylesheet">


<meta
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
	name="viewport">
	<style>
body.fourofour {
  background:url('assets/frontend/img/404.gif') no-repeat center;
  padding: 0;
  position: relative; }
  body.fourofour .fourofour-container {

    text-align: center;
    color: #34495e;
   }
body.fourofour .fourofour-container h2 {
      font-size: 32px;
      font-weight: 100;
      margin-bottom: 40px; }
    body.fourofour .fourofour-container a.btn {
      border-color: white;
      color: #34495e; }
      body.fourofour .fourofour-container a.btn:hover {
        color: #34495e;
        background-color: white; }
</style>
</head>
<body class="fourofour"  >
	<!-- Login Screen -->

	<div class="fourofour-container">

		<h2><?php echo $lang['you_are_lost']; ?></h2>
		<a class="btn btn-lg " style="background:#34495e;color:white;" href="<?php echo $link->link('home',frontend);?>"> <?php echo $lang['go_to_homepage']; ?></a>
	</div>
	<!-- End Login Screen -->
</body>
</html>