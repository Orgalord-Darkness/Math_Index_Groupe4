<?php
	$erreurs = [] ;

	if (empty($erreurs)) {
		if (isset($_GET['id_modif'])) {
			$id = $_GET['id_modif'];
			$requete = $connexion->prepare("SELECT name FROM classroom WHERE id = :id");
			$requete->bindParam(':id', $id);
			$requete->execute();
			$classeData = $requete->fetch(PDO::FETCH_ASSOC);
			if ($classeData) {
				$classe = $classeData['name']; 
			}
	
			if (isset($_POST['envoyer'])) {
				$classe = $_POST['classe'];
				$requete = $connexion->prepare("UPDATE classroom SET name = :classe WHERE id = :id");
				$requete->bindParam(':id', $id);
				$requete->bindParam(':classe', $classe); // Liaison avec la variable contenant le nom de la classe
				$resultat = $requete->execute();
				header("Location: ?page=classe");
				exit();
			}
		}
	}
?>
	
	<div class="php_content">
		<div class="title_categ">Administration</div>
		<div class="sections">
			<a href="?page=contribu"><p>Contributeurs</p></a>
			<a href="?page=admin_ex"><p>Exercices</p></a>
			<a href="?page=matiere"><p>Matières</p></a>
			<a href="?page=classe"><p>Classes</p></a>
			<a href="?page=thematic"><p>Thématiques</p></a>
			<a href="?page=origine"><p>Origines</p></a>
		</div>
		<div class="bloc_contenu3">
			<form  method = "POST" action="#">
				<h1>Modifier une classe</h1>
				<label for="classe">Nom classe : </label>
				<br>
				<input name="classe" type="text" value="<?= isset($classe) ? htmlspecialchars($classe) : '' ?>">
				<?php 
					if(isset($_POST['envoyer'])){ 
						addMessageIfValueEmpty($erreurs, 'classe', $_POST['classe']) ;
					}
				?>
				<input type="hidden" name="id_modif" value="<?php  if(isset($id)){echo $id;} ?>"> <!-- Ajout d'un champ caché pour envoyer l'ID -->
				<input type="submit" name="envoyer">
			</form>
		</div>
	</div>
	