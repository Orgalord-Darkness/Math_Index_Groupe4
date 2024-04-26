<?php 

	if(isset($_POST['thematique']) && isset($_POST['motscles'])){ 
		$thematique = $_POST['thematique'] ; 
		$motscles = $_POST['motscles'] ;
		$difficulte = $_POST['difficulte'] ; 

		$requete = $connexion->prepare("SELECT id FROM thematic WHERE name = :thematicname") ; 
        $requete->bindParam(':thematicname', $thematique) ; 
        $test_thema = $requete->execute() ;  
        $id_thematic = $requete->fetchAll(PDO::FETCH_ASSOC) ;    
        $id_theme = implode(';', array_column($id_thematic, 'id'));
		$requete = $connexion->prepare("SELECT * FROM exercise WHERE thematic_id = :thema AND keywords = :motscles AND difficulty = :niveau") ;
		$requete->bindParam(':thema', $id_theme, PDO::PARAM_INT) ; 
		$requete->bindParam(':motscles',$motscles) ;
		$requete->bindParam('niveau',$difficulte, PDO::PARAM_INT) ;  

		$requete->execute() ; 
		$resultats = $requete->fetchAll(PDO::FETCH_ASSOC) ;  
		$nbreResult = count($resultats); 
	}else{ 
		$erreur = 'true' ; 
	}

	

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<body>
		<div class = "content_php">
			<div></div>
			 <p class="title_exo">Recherche exercice</p>
          <p>Voici les résultats de votre recherche :</p>
          <p> 
          	Nous avons trouvé <?php echo $nbreResult ?> éléments correspondant à votre recherche : 
          </p>
			<table>
				<thead>
					<th>Nom</th>
					<th>Difficulté</th>
					<th>Mots clés</th>
					<th>Durée</th> 
					<th>Fichiers</th>
				</thead>
				<tbody>
					<tr>
						<?php
							if(isset($resultats)){ 
								// echo "<h1 class = 'titre_section'>".$nbresultats." résultats trouvés.</h1>" ; 
								// if($nbresultats > 0) { 
								foreach($resultats as $ligne) { 
									echo "<tr>" ; 
									echo "<td>".$ligne['name']."</td>" ; 
									echo "<td>".$ligne['difficulty']."</td>" ; 
									echo "<td>".$ligne['keywords']."</td>" ; 
									echo "<td>".$ligne['duration']."</td>" ;
									echo "</tr>" ; 
								}
												// for($ind = 0 ; $ind < strlen($fichiers_exos) ; $ind++){ 
												// 	echo "<td>".$fichiers_exos[$ind]." ".$fichiers_correct[$ind]."</td>" ; 
												// } 
								// }else{ 
								// 	echo "pas de nbre resultats"  ;
								// }
							}else{ 
								echo "pas de résultats " ; 
							}
						?>	
					</tr>
				</tbody>
			</table>
			<?php 
			// echo '<br>theme : ' ; 
			// if(isset($id_theme)){ 
			// 	var_dump($id_theme) ; 
			// }else{ 
			// 	echo "erreur de id theme" ; 
			// }
			// echo "<br> mots:  " ; 
			// if(isset($motscles)){ 
			// 		var_dump($motscles) ; 
			// }else{ 
			// 	echo "pas de mots" ; 
			// }
			// echo "<br>superglobales : " ; 
			// if(isset($erreur) && $erreur === 'true'){ 
			// 	echo "pas de POST" ; 
			// }else{ 
			// 	var_dump($_POST['thematique']) ; 
			// 	echo "<br>" ; 
			// 	var_dump($_POST['motscles']) ; 
			// }
			?>
		</div>
	</body>
</html>
