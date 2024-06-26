<?php
	$erreurs = [] ;
	// if(isset($_POST['envoyer'])){  
	// 	if(empty($_POST['classe'])){ 
	// 		$erreurs['classe'][] = "le champ nom classe doit-être rempli" ; 
	// 	}
	// }
	//if($_SERVER['REQUEST_METHOD'] == "POST"){ 
	if(empty($erreurs)){
		if(isset($_GET['id_modif'])){
			$id = $_GET['id_modif'];
			if(isset($_POST['envoyer'])){  
				$classe = $_POST['classe']; // Récupération du nom de la classe
				$requete = $connexion->prepare("UPDATE classroom SET name = :classe WHERE id= :id");
				$requete->bindParam(':id', $id);
				$requete->bindParam(':classe', $classe); // Liaison avec la variable contenant le nom de la classe
				$resultat = $requete->execute();
				// header("Location: ?page=classe");
				// exit;
			}
		}
	}
//}
?>
	
	<div class="php_content">
		<div class="title_categ">Administration</div>
		<div class="sections">
			<a href="?page=contribu"><p>Contributeurs</p></a>
			<a href="?page=admin_ex"><p>Exercices</p></a>
			<a href="#"><p>Matières</p></a>
			<a href="?page=classe"><p>Classes</p></a>
			<a href="?page=thematic"><p>Thématiques</p></a>
			<a href="?page=origine"><p>Origines</p></a>
		</div>
		<div class="bloc_contenu3">
			<form  method = "POST" action="#">
				<h1>Modifier une classe</h1>
				<label for="classe">Nom classe : </label>
				<br>
				<input name="classe">
				<?php 
					if(isset($_POST['envoyer'])){ 
						addMessageIfValueEmpty($erreurs, 'classe', $_POST['classe']) ;
					}
				?>
				<input type="hidden" name="id_modif" value="<?php  if(isset($id)){echo $id;} ?>"> <!-- Ajout d'un champ caché pour envoyer l'ID -->
				<input type="submit" name="envoyer">
				<?php 
					echo "superglobale : <br>" ; 
					if(isset($_GET['id_modif'])){ 
						echo $_GET['id_modif']."<br>"  ; 
					}else{ 
						echo 'pas de superglobale'."<br>" ; 
					}
					echo "variable id <br>" ; 
					if(isset($id)){ 
						var_dump($id) ; 
					}else{ 
						echo "pas de variable id <br>" ; 
					}
					if(isset($resultat)){ 
						var_dump($resultat) ;
					}else{ 
						echo "erreur de requete" ; 
					}
				?>
			</form>
		</div>
	</div>
	