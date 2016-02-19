<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=elem;charset=utf8', 'root','root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}