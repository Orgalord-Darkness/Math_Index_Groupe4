<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){ 
		if(isset($_POST['envoyer'])){ 
			$Nnom = $_POST['nom'] ; 
			$Nsociete = $_POST['entreprise'] ; 
			$Nvaleur = $_POST['valeur'] ; 
			$Nstatus = $_POST['status'] ; 
			$Ndate = $_POST	['date'] ; 
			$requete= $connexion->prepare("INSERT INTO origin (`id`, `name`) VALUES(NULL, :nom); ") ; 
			$requete->bindParam(':nom', $Nnom) ;
			// $requete->binParam(':entreprise', $Nsociete) ;
			// $requete->binParam(':valeur', $Nvaleur) ;
			// $requete->binParam(':status', $Nstatus) ;
			// $requete->binParam(':dateO', $Ndate) ; 
			$test = $requete->execute();
			header("Location: ?page=origine");
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
			<a href="#"><p>Thématiques</p></a>
			<a href="?page=origine"><p>Origines</p></a>
	</div>
	<div class="bloc_contenu3">
		<div class = "gestion_sources">
			<h1>Ajouter une source</h1>
			<form method = "POST">
				<label for = "nom">Nom :</label>
				<br>
				<input name = "nom">
				<br>
				<br>
				<label for = "entreprise">Entreprise :</label>
				<br>
				<input name = "entreprise">
				<br>
				<br>
				<label for = "valeur">Marché suspecté :</label>
				<br>
				<input name = "valeur">
				<br>
				<br>
				<label for = "status">Status :</label>
				<br>
				<input name = "status">
				<br>
				<br>
				<label for ="date">Date :</label>
				<br>
				<input type = "date" name = "date">
				<button name = "envoyer">Envoyer</button>
				<?php
				/* var_dump($test) ;*/?>
			</form>
		</div>
	</div>
</div>