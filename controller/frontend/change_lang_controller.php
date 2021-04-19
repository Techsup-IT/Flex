<?php

if(isset($_POST['site_lang']) && $_POST['site_lang'] != ''){
	$_SESSION['site_lang'] = $_POST['site_lang'];
	die();
}

?>