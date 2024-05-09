
<div class="php_content">
<div class="title_categ">Rechercher un exercice</div>
	<div class="bloc_contenu2">
		<form method = "POST" action = '?page=result'>
			<label for="thematique">Thématique :</label>
			<br>
			<select name = "thematique">
			<?php 
				$requete = $connexion->prepare("SELECT DISTINCT thematic_id FROM exercise");
				$requete->execute();
				$ids = $requete->fetchAll(PDO::FETCH_ASSOC);
				$themes = [] ; 
				foreach($ids as $id){ 
				 	$requete_theme = $connexion->prepare("SELECT DISTINCT name FROM thematic WHERE id = :id") ; 
					$requete_theme->bindParam(':id', $id['thematic_id'], PDO::PARAM_INT) ; 
					$requete_theme->execute() ; 
					 $theme = $requete_theme->fetch(PDO::FETCH_ASSOC) ;  // Utilisez fetch() pour récupérer une seule ligne
					if($theme) {  // Vérifiez si le résultat est non vide
					 	$themes[] = $theme['name'] ;  
					 }
				}
				for($ind = 0 ; $ind < count($themes) ; $ind++){ 
				echo "<option value='".$themes[$ind]."'>".$themes[$ind]."</option>"; 
				}
			?>
			</select>
			<br>
			<label for ="difficulte">Difficulté : </label>
			<br>
			<select name = "difficulte">
			<?php 
				$requete = $connexion->prepare("SELECT DISTINCT difficulty FROM exercise ") ; 
				$requete->execute() ; 
				$difficultes = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
				foreach($difficultes as $difficulte){ 
					 echo "<option value='".$difficulte['difficulty']."'>Niveau ".$difficulte['difficulty']."</option>"; 
				}
			?>
			</select>
			<br>
			<label for = "motscles">Mots clés :</label>
			<br>
			<select name = "motscles" placeholder = "Sélectionner une thématique">
			<?php 
				$requete = $connexion->prepare("SELECT DISTINCT keywords FROM exercise ") ; 
				$requete->execute() ; 
				$difficultes = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
				foreach($difficultes as $difficulte){ 
					 echo "<option value='".$difficulte['keywords']."'>".$difficulte['keywords']."</option>"; 
				}
			?>
			</select>
			<br>
			<div class="container_button">
				<button type  ="submit" name = "recherche">Rechercher</button>
			</div>
		</form>
	</div>
</div>