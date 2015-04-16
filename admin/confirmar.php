<?php

require "../includes/connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$confirmar = $_POST['confirmado'];
	$id = $_POST['id'];

	$conexao = new Connection;

	echo $conexao->confirmar($id, $confirmar);
}