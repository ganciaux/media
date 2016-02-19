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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<link href="/media/public/css/media.css" rel="stylesheet">
		<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/media/public/js/bootstrap-3.3.6.js"></script>
	<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>		
	<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
	<script src="/media/public/js/media.js"></script>
  </head>
  <body role="document">
	<nav class="navbar navbar-inverse" style="margin-bottom: 0px;">
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
					<li><a href="/media/model/disk/view/disk.php"><i class="fa fa-database"></i> Disque dur</a></li>
					<li><a href="/media/model/actor/view/actor.php"><i class="fa fa-user"></i> Acteur</a></li>
					<li><a href="/media/model/content/view/content.php"><i class="fa fa-film"></i> Média</a></li>
					<li>
						<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"> Options<span class="caret"></span></a>
						<ul class="dropdown-menu">
								<li><a href="/media/model/options/type/view/type.php"><i class="fa fa-file-video-o"></i> Type de média</a></li>
								<li><a href="/media/model/options/quality/view/options/quality.php"><i class="fa fa-desktop"></i> Qualité</a></li>
								<li><a href="/media/model/options/category/view/category.php"><i class="fa fa-tags"></i> Catégorie</a></li>
								<li><a href="/media/model/options/language/view/language.php"><i class="fa fa-microphone"></i> Language</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right"></ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
	<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/connection.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/utils.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/formBuilder.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/media/global/modal.php';
	?>