<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){ 
		if(isset($_POST['envoyer'])){ 
			$Nclasse = $_POST['thematic'] ; //thematic
			                                            //thematic
			$requete= $connexion->prepare("INSERT INTO `thematic`  (`id`, `name`) VALUES (NULL, :thema); ") ; 
			$requete->bindParam(':thema', $Nclasse) ; 
			$test = $requete->execute() ; 
			header("Location: ?page=thematic");
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
				<h1>Ajouter une thématique</h1>
				<label for = "classe">Nom thématique : </label>
				<br>
				<input type = "text" name = "thematic">
				<?php 
					if(isset($_POST['envoyer'])){ 
						addMessageIfValueEmpty($erreurs, 'thematic', $_POST['thematic']) ;
					}
				?>
				<button name = "envoyer">Envoyer</button>
			</form>
			<?php
			/*var_dump($test) ; */
			?>
	</div>
</div>