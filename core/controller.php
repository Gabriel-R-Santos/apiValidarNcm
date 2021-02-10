<?php
class controller {

	protected $db;
	public function __construct() {
		global $config;
		$this->db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
	}	

	public function getMethod(){ // OBTER O METHODO DE CHAMADA
		return $_SERVER['REQUEST_METHOD'];
	}

	public function getRequestData(){ // OBTER DADOS DO PEDIDO

		//para testar os Methods https://resttesttest.com/

		switch ($this->getMethod()) {
			case 'GET':
				return $_GET;
				break;
			case 'PUT':
			case 'DELETE':
				//exemplo
				// token=1234&id=19
				parse_str(file_get_contents('php://input'), $data); //constroi  objeto
				return (array)$data; //retorna como array;
				break;			
			case 'POST':
				// methodo post vem em json
				$data = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', file_get_contents('php://input')), true );
				if (is_null($data)){
					$data = $_POST; 
				}
				return (array) $data; //retorna como array;
				break;
		}
	}

	public function returnJson($array){ // RETORNAR RESPOSTA COMO JSON
		header("Content-Type: application/json ");
		echo $array;
		exit;
	}


}