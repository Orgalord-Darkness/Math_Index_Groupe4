<?php


	#Fonction � appeler pour se connecter � la base de donn�es
	function connexionBdd() {
		// Permet d'utiliser les variables d'identification pour la connexion
		require('config.php');
		$user = 'root';
		$pass = '';
		$dbName = 'mathindex';
		// Tentative de connexion � la base de donn�es MySQL 
		try{
            // chaine de connexion avec API PDO
			$co  = new PDO("mysql:host=127.0.0.1; dbname=$dbName", $user, $pass);
			$co ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			

		}		
		catch(PDOException $e){
			die('<p class="case_connect">Erreur, la connexion a échoué : </p>' . $e->getMessage());
		}
        return $co ;
	}	




?>