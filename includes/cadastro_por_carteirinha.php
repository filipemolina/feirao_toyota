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
		$resultado = $resultado[0];

		// Inserir os dados

		$conexao->inserir('cadastros', array(
			'nome' => $resultado['nome'],
			'email' => $resultado['email'],
			'telefone' => $resultado['telefone'],
			'modelo' => $resultado['modelo'],
			'local_partida' => $resultado['local_partida']
		));
	}

}