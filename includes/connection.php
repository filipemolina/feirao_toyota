<?php

class Connection
{

	// Desenvolvimento

	// private $host = 'localhost';
	// private $dbname = 'etioscomvoce';
	// private $usuario = 'root';
	// private $senha = '';

	// Produção

	private $host = '186.202.152.234';
	private $dbname = 'smkunlike1';
	private $usuario = 'smkunlike1';
	private $senha = 'toyotaetios15';

	// Variável para guardar os erros que podem ocorrer

	private $erros = array();
	private $pdo;

	/*---------------------------------------------------------------------------------------------
	| Construtor da classe - Inicia a conexão com o banco e retorna algum erro que tenha ocorrido
	----------------------------------------------------------------------------------------------*/

	public function __construct()
	{
		$this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->usuario, $this->senha);
		
		if(!$this->pdo){
		    $this->erros[] = 'Erro ao criar a conexão';
		}
	}

	/*---------------------------------------------------------------------------------------------
	| getErrors
	----------------------------------------------------------------------------------------------*/

	// Retorna os erros que ocorreram na última execução e limpa a variável de erros
	// Essa função deve ser chamada após cada operação executada com essa classe para
	// verificar se tudo correu bem.

	public function getErrors()
	{
		$ultimos_erros = $this->erros;

		$this->erros = array();

		return $ultimos_erros;
	}

	/*---------------------------------------------------------------------------------------------
	| Inserir
	----------------------------------------------------------------------------------------------*/

	// Cadastrar informações no banco de dados.

	public function inserir($tabela, $dados)
	{
		// Obter todos os campos da tabela para serem gravados

		$campos = array_keys($dados);
		$campos_implode = implode(",", $campos);
		$campos_param = implode(",:", $campos);

		// Obter os valores para os campos da tabela

		$valores = array_values($dados);

		// Montar a query com os wildcards dos parâmetros

		$query = "INSERT INTO $tabela(";

		$query .= $campos_implode . ") values(:";
		$query .= $campos_param . ");";

		// Preparar a query

		$statement = $this->pdo->prepare($query);

		$i = 0;

		// Passar o parâmetro $valor por referência (&). Caso contrário, todos os campos
		// da tabela assumiriam o último valor enviado

		foreach($valores as &$valor)
		{
			$tipo = (is_numeric($valor)) ? PDO::PARAM_INT : PDO::PARAM_STR;

			$statement->bindParam(":".$campos[$i], $valor, $tipo);

			$i++;
		}

		// Executar o a query

		$executa = $statement->execute();

		// Testar a execução da query

		if($executa)
		{
	   		$this->erros = array();
	   		$this->erros[] = $this->pdo->errorInfo();
		}
		else
		{
	   		$this->erros[] = $this->pdo->errorInfo();
		}
	}

	/*---------------------------------------------------------------------------------------------
	| Select
	----------------------------------------------------------------------------------------------*/

	// Obter os dados do banco

	public function select($tabela, $campos = "")
	{
		// Iniciar a query

		$query = "SELECT * from $tabela WHERE ";

		if($campos == "")
		{
			$resultado = $this->pdo->query("SELECT * FROM $tabela;");

			if(!$resultado)
			{
				echo json_encode($this->pdo->errorInfo());
				exit;
			}

			$resultado = $resultado->fetchAll();
			echo json_encode($resultado);
			exit;

			if($executa)
			{
		   		$this->erros = array();
		   		return $executa;
			}
			else
			{
		   		$this->erros[] = $this->pdo->errorInfo();
		   		exit;
			}
		}

		// Contador e variável usada para deteminar a quantidade de itens no array

		$i = 0;
		$tamanho = count($campos);

		// Iterar pelos itens do array para terminar de montar a query

		foreach($campos as $key => $value)
		{
			// Inserir as condições

			$query .= "$key = :$key";

			// Caso este não seja o último item do array, adicionar um " AND "

			if($i != $tamanho -1)
			{
				$query .= " AND ";
			}
			else
			{
				$query .= ";";
			}

			// Incrementar o contador

			$i++;
		}

		$statement = $this->pdo->prepare($query);

		// Adicionar os parâmetros

		foreach($campos as $key => &$value)
		{
			// Testar o tipo de parâmetro

			$tipo = (is_numeric($value)) ? PDO::PARAM_INT : PDO::PARAM_STR;

			// Adicionar o parâmetro

			$statement->bindParam(":".$key, $value, $tipo);
		}

		// Executar a query

		$executa = $statement->execute();

		if($executa)
		{
	   		$this->erros = array();
	   		return $statement->fetchAll(PDO::FETCH_OBJ);
		}
		else
		{
	   		$this->erros[] = $this->pdo->errorInfo();
		}
	}

	public function confirmar($id, $confirmado)
	{
		$query = "UPDATE cadastros SET confirmado = $confirmado where id = $id";

		$executa = $this->pdo->query($query);

		if(!$executa)
		{
			return json_encode($this->pdo->errorInfo());
		}
		else
		{
			return $confirmado;
		}
	}

}