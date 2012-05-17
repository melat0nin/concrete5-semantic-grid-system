<?php

	defined('C5_EXECUTE') or die("Access Denied."); 

	// Variables
	$c = Page::getCurrentPage();

?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php Loader::element('header_required'); ?>

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo $this->getThemePath();?>/css/styles.php" media="screen" />
	<!-- / CSS -->

</head>
<body>

<div class="site">

	<!-- Header -->
	<header id="top">
		<h1>Header</h1>
	</header>