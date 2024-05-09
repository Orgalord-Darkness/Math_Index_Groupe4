<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){ 
		if(isset($_POST['envoyer'])){ 
			$Nclasse = $_POST['classe'] ; //thematic
			                                            //thematic
			$requete= $connexion->prepare("INSERT INTO `classroom`  (`id`, `name`) VALUES (NULL, :class); ") ; 
			$requete->bindParam(':class', $Nclasse) ; 
			$test = $requete->execute() ; 
			header("Location: ?page=classe");
            exit;
		}	
	}
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
			<form method  = "POST">
				<h1>Ajouter une classe</h1>
				<label for = "classe">Nom classe : </label>
				<br>
				<input type = "text" name = "classe">
				<?php 
					if(isset($_POST['envoyer'])){ 
						addMessageIfValueEmpty($erreurs, 'classe', $_POST['classe']) ;
					}
				?>
				<button name = "envoyer">Envoyer</button>
			</form>
			<?php
			/*var_dump($test) ; */
			?>
	</div>
</div>