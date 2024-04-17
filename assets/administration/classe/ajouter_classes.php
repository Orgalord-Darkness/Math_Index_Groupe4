<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){ 
		if(isset($_POST['envoyer'])){ 
			$Nclasse = $_POST['classe'] ; 
			$requete= $connexion->prepare("INSERT INTO `classroom` (`id`, `name`) VALUES (NULL, :class); ") ; 
			$requete->bindParam(':class', $Nclasse) ; 
			$test = $requete->execute() ; 
			header("Location: ?classe=1");
            exit;
		}	
	}
?>
<div class="php_content">
	<div class="title_categ">Administration</div>
	<div class="sections">
			<a href="?contribu=1"><p>Contributeurs</p></a>
			<a href="?admin_ex=1"><p>Exercices</p></a>
			<a href="#"><p>Matières</p></a>
			<a href="?classe=1"><p>Classes</p></a>
			<a href="#"><p>Thématiques</p></a>
			<a href="?origine=1"><p>Origines</p></a>
	</div>
	<div class="bloc_contenu3">
			<form method  = "POST">
				<h1>Ajouter une classe</h1>
				<label for = "classe">Nom classe : </label>
				<br>
				<input name = "classe">
				<button name = "envoyer">Envoyer</button>
			</form>
			<?php
			/*var_dump($test) ; */
			?>
	</div>
</div>