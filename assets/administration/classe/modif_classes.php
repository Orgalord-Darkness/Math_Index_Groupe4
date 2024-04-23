<?php
//if($_SERVER['REQUEST_METHOD'] == "POST"){ 
	if(isset($_POST['id_modif'])){
		$id = $_POST['id_modif'];
		if(isset($_POST['envoyer'])){  
			$classe = $_POST['classe']; // Récupération du nom de la classe
			$requete = $connexion->prepare("UPDATE classroom SET name = :classe WHERE id= :id");
			$requete->bindParam(':id', $id);
			$requete->bindParam(':classe', $classe); // Liaison avec la variable contenant le nom de la classe
			$resultat = $requete->execute();
			header("Location: ?page=classe");
			exit;
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
			<a href="#"><p>Thématiques</p></a>
			<a href="?page=origine"><p>Origines</p></a>
		</div>
		<div class="bloc_contenu3">
			<form method="POST" action="#">
				<h1>Modifier une classe</h1>
				<label for="classe">Nom classe : </label>
				<br>
				<input name="classe">
				<input type="hidden" name="id_modif" value="<?php echo $id; ?>"> <!-- Ajout d'un champ caché pour envoyer l'ID -->
				<input type="submit" name="envoyer">
				<?php 
					// if(isset($resultat)){ 
					// 	var_dump($resultat) ;
					// }else{ 
					// 	echo "erreur de requete" ; 
					// }
				?>
			</form>
		</div>
	</div>
	