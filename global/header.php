<?php
	session_start(); 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/session.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php print session::csrf_token(); ?>"/>
    <title>Médiathèque</title>
    <!-- Bootstrap core CSS -->
    <link href="/media/public/bootstrap-3.3.6/css/bootstrap.css" rel="stylesheet">
    <link href="/media/public/font-awesome-4.5.0/css/font-awesome.css" rel="stylesheet">
    <link href="/media/public/DataTables-1.10.11/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/media/public/DataTables-1.10.11/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/media/public/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="/media/public/css/media.css" rel="stylesheet">
	<link href="/media/public/file-input/css/fileinput.css" rel="stylesheet">

		<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="/media/public/js/jquery-2.1.4.js"></script>
	<script src="/media/public/bootstrap-3.3.6/js/bootstrap.js"></script>
	<script src="/media/public/DataTables-1.10.11/media/js/jquery.dataTables.js"></script>
	<script src="/media/public/DataTables-1.10.11/media/js/dataTables.bootstrap.js"></script>
	<script src="/media/public/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/media/public/canvas-to-blob/js/canvas-to-blob.min.js" type="text/javascript"></script>
	<script src="/media/public/file-input/js/fileinput.js"></script>

	  <!-- Add fancyBox -->
	  <link rel="stylesheet" href="/media/public/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	  <script type="text/javascript" src="/media/public/fancybox/jquery.fancybox.pack.js"></script>

	  <!-- Optionally add helpers - button, thumbnail and/or media -->
	  <link rel="stylesheet" href="/media/public/fancybox/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
	  <script type="text/javascript" src="/media/public/fancybox/helpers/jquery.fancybox-buttons.js"></script>
	  <script type="text/javascript" src="/media/public/fancybox/helpers/jquery.fancybox-media.js"></script>

	  <link rel="stylesheet" href="/media/public/fancybox/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
	  <script type="text/javascript" src="/media/public/fancybox/helpers/jquery.fancybox-thumbs.js"></script>

    <script src="/media/public/js/media.js"></script>


  </head>
  <body role="document" style="background: #f2f2f2 none repeat scroll 0 0;">
	<nav class="navbar navbar-inverse" style="margin-bottom: 0px;border-radius: 0px;">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/media/index.php">Médiathèque</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/media/model/disk/view/disk.php"><i class="fa fa-hdd-o"></i> Disque dur</a></li>
					<li><a href="/media/model/actor/view/actor.php"><i class="fa fa-user"></i> Acteur</a></li>
					<li><a href="/media/model/content/view/content.php"><i class="fa fa-film"></i> Média</a></li>
					<li>
						<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"> Options<span class="caret"></span></a>
						<ul class="dropdown-menu">
								<li><a href="/media/model/contentType/view/contentType.php"><i class="fa fa-file-video-o"></i> Type de média</a></li>
								<li><a href="/media/model/quality/view/quality.php"><i class="fa fa-desktop"></i> Qualité</a></li>
								<li><a href="/media/model/category/view/category.php"><i class="fa fa-tags"></i> Catégorie</a></li>
								<li><a href="/media/model/language/view/language.php"><i class="fa fa-microphone"></i> Language</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right"></ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid" style="margin-left: 15px; margin-right: 15px;">
	<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/formBuilder.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/modal.php';
	?>
