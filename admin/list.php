<?php

require('../includes/connection.php');

// Retornar os dados apenas se a request for POST

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($_POST['username'] == 'admin' && $_POST['password'] == 't301t4')
	{
		// Iniciar a conexão

		$conexao = new Connection;

		// Retornar uma lista de dados

		$resultados = $conexao->select('cadastros');

		return json_encode($resultados);
	}
	else
	{
		return json_encode(false);
	}
	
}