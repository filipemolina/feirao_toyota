<?php

require_once "connection.php";

// Realizar a busca apenas se o request for POST

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	// Obter os dados do Post

	$dados = $_POST;

	// Iniciar a conexão com o banco

	$conexao = new Connection;

	// Buscar a carteirinha no banco de dados

	$resultado = $conexao->select('carteiras', array('carteira' => $dados['carteirinha']));

	if(count($resultado) > 0)
	{
		echo json_encode($resultado[0]);
	}
	else
	{
		echo "inexistente";
	}
}