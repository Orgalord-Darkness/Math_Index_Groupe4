<?php 
if($_SERVER['REQUEST_METHOD'] == "POST"){ 
	if(isset($_POST['envoyer'])){ 
		$id = $_POST['id_modif'] ; 
		$nouvelle_origine = $_POST['nom'] ; 
		$requete = $connexion->prepare("UPDATE origin SET name = :nom WHERE id= :id") ;
		$requete->bindParam(':id', $id) ;
		$requete->bindParam(':nom', $nouvelle_origine) ; 
		$resultat = $requete->execute() ;
		header("Location: ?origine=1");
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
	<div class = "gestion_sources">
		<h1>Modifier une source</h1>
			<form method="post" action="?origine=1">
				<label for = "nom">Nom :</label>
				<br>
				<input name = "nom">
				<br>
				<br>
			<!--<label for = "entreprise">Entreprise :</label>
				<br>
				<input name = "nom">
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
				<br> -->
				<input type = "submit" name = "envoyer">
			</form>
		</div>
	</div>
</div>