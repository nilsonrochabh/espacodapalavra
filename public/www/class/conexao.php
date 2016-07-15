<?php
function conectar(){
	try{
		$pdo=new PDO("mysql:host=localhost;dbname=espaco","nilson","123456");
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		return $pdo;
}?>
