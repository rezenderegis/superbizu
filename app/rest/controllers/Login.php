<?php
namespace controllers{
	/*
	Classe pessoa
	*/
	class Login{
		//Atributo para banco de dados
		private $PDO;
 
		/*
		__construct
		Conectando ao banco de dados
		*/
		function __construct(){
			$this->PDO = new \PDO('mysql:host=localhost;dbname=bizu', 'root', 'rnk30ghhh'); //Conexão
			$this->PDO->setAttribute( \PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION ); //habilitando erros do PDO
		}
		/*
		lista
		Listand pessoas
		*/
		public function lista(){
			global $app;
			$sth = $this->PDO->prepare("SELECT * FROM usuario");
			$sth->execute();
			$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
			$app->render('default.php',["data"=>$result],200); 
		}
		/*
		get
		param $id
		Pega pessoa pelo id
		*/
		public function get($id){
			global $app;
			$sth = $this->PDO->prepare("SELECT * FROM usuario WHERE id = :id");
			$sth ->bindValue(':id',$id);
			$sth->execute();
			$result = $sth->fetch(\PDO::FETCH_ASSOC);
			$app->render('default.php',["data"=>$result],200); 
		}
 
		
	}
}