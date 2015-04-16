<?php

require "connection.php";

// Realizar o cadastro apenas se a request for POST

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	// Obter os dados do Post

	$dados = $_POST;

	// Iniciar a conexão com o banco

	$conexao = new Connection;

	$resultado = $conexao->select('cadastros', array('email' => $dados['email']));

	// Testar se o cadastro já existe

	if(count($resultado) > 0)
	{
		echo "Este e-mail já está cadastrado no nosso sistema.";
		exit;
	}

	//////////////////////////////////////////////// Validação básica

	// Nome

	if($dados['nome'] == '' || !$dados)
	{
		echo "Preencha o campo nome.";
		exit;
	}

	// Email

	if($dados['email'] == '' || !$dados)
	{
		echo "Preencha o campo email.";
		exit;
	}

	// Telefone

	if($dados['telefone'] == '' || !$dados)
	{
		echo "Preencha o campo telefone.";
		exit;
	}

	// Modelo

	if($dados['modelo'] == '' || !$dados)
	{
		echo "Preencha o campo modelo.";
		exit;
	}


	//////////////////////////////////////////////// Gravação

	// Inserir os dados

	$conexao->inserir('cadastros', array(
		'nome' => $dados['nome'],
		'email' => $dados['email'],
		'telefone' => $dados['telefone'],
		'modelo' => $dados['modelo'],
		'carteira' => $dados['carteira'],
		'num_acompanhantes' => $dados['acompanhantes']
	));

	// Retornar sem nenhum erro

	echo "";
}