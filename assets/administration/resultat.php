<?php 
	include_once('menu.php') ; 
	if($_SERVER["REQUEST_METHOD"] == "POST"){ 
		if(isset($_POST['recherche'])){
			$rThematique = $_POST['thematique'] ; 
			$rdifficulte = $_POST['difficulte'] ; 
			$rmots = $_POST['mots'] ; 
			$requete = $connexion->prepare("SELECT id FROM thematic WHERE name = :thematique") ; 
			$requete->bindParam(':thematique', $rThematique) ;  
			$requete->execute() ;  
			$id_Thematique = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
			$requete = $connexion->prepare("SELECT * FROM exercise WHERE keywords = :mots and thematic_id = :thema and difficulty = :difficulty ") ;
			$requete->bindParam(':mots', $_POST['mots']) ;
			$requete->bindParam(':thema', $id_Thematique, PDO::PARAM_INT) ; 
			$requete->bindParam(':difficulty', $rdifficulte) ;  
			$requete->execute() ; 
 			$resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
 			var_dump($resultats) ; 
 			implode(';',$resultats) ; 
 			// $nbresultats = strlen($resultats) ;
 
 			foreach($resultats as $donnee){ 

 				$idFichier = $donne['exercice_file_id'] ; 
 				$requete = $connexion->prepare("SELECT name FROM file WHERE id = :id") ; 
 				bindParam(':id',$idFichier) ; 
 				$requete->execute() ; 
 				$fichiers_exos = $requete->fetchAll(PDO::FETCH_ASSOC) ;

 				$idFichier2 = $donnee['correction_file_id'] ;
 				$requete = $connexion->prepare("SELECT name FROM file WHERE id = :idC") ;
 				bindParam(':idC',$idFichier2) ;  
 				$requete->execute() ; 
 				$fichiers_correct = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
			} 			
		}
	}	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<body>
		<?php
			if(isset($resultats)){ 
				echo "<h1 class = 'titre_section'>".$nbresultats." résultats trouvés.</h1>" ; 
				if($nbresultats > 0) { 
					echo "<table>" ; 
						echo "<thead>" ; 
							echo "<th>Nom</th>" ; 
							echo "<th>Difficulté</th>" ; 
							echo "<th>Mots clés</th>" ; 
							echo "<th>Durée</th>" ; 
							echo "<th>Fichiers</th>" ; 
						echo "</thead>" ; 
						echo "<tbody>" ; 
							echo "<tr>" ; 
								foreach($resultats as $ligne) { 
									echo "<td>".$ligne['name']."</td>" ; 
									echo "<td>".$ligne['difficulty']."</td>" ; 
									echo "<td>".$ligne['keywords']."</td>" ; 
									echo "<td>".$ligne['duration']."</td>" ;
								}
								for($ind = 0 ; $ind < strlen($fichiers_exos) ; $ind++){ 
									echo "<td>".$fichiers_exos[$ind]." ".$fichiers_correct[$ind]."</td>" ; 
								}
							echo "</tr>" ; 
						echo "</tbody>" ; 
					echo "</table>" ; 
				}
			}
		?>	
	</body>
</html>
