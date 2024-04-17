<?php
	//if($_SERVER['REQUEST_METHOD'] == "POST"){ 
		if(isset($_POST['id_modif'])){
			$id = $_POST['id_modif'] ; 
			$nouvelle_classe = $_POST['classe'] ;
			if(isset($_POST['envoyer'])){  
				$requete = $connexion->prepare("UPDATE classroom SET name = :classe WHERE id= :id") ;
				$requete->bindParam(':id', $id) ;
				$requete->bindParam(':classe', $nouvelle_classe) ; 
				$resultat = $requete->execute();
				header("Location: ?classe=1");
				exit;
			}
		}
	//}
?>

<div class="php_content">
	<div class = "title_categ">Administration</div>
		<div class="sections">
			<a href="?contribu=1"><p>Contributeurs</p></a>
			<a href="?admin_ex=1"><p>Exercices</p></a>
			<a href="#"><p>Matières</p></a>
			<a href="?classe=1"><p>Classes</p></a>
			<a href="#"><p>Thématiques</p></a>
			<a href="?origine=1"><p>Origines</p></a>
		</div>
		<div class = "bloc_contenu3">
			<form method ="POST" action="?classe=1">
				<h1>Modifier une classe</h1>
				<label for = "classe">Nom classe : </label>
				<br>
				<input name = "classe">
				<input type = "submit" name = "envoyer">
				<?php 
					/*var_dump($resultat) ; */
				?>
			</form>
		</div>
</div>