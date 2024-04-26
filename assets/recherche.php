
<div class="php_content">
<div class="title_categ">Rechercher un exercice</div>
	<div class="bloc_contenu2">
		<form method = "POST" action = '?page=result'>
			<label for="thematique">Thématique :</label>
			<br>
			<select name = "thematique">
				<option  value = "mathematique">Mathématiques</option>
				<option value = "physique">Physique</option>
				<option name = "Geometrie">Géométrie</option>
			</select>
			<br>
			<label for ="difficulte">Difficulté : </label>
			<br>
			<select name = "difficulte">
				<!-- <option value = "college">Toutes</option>
				<option value = "college">Collège</option>
				<option value = "lycee">Lycée</option>
				<option value = "lycee">BTS</option> -->
				<option value = 0>Niveau 0</option>
			</select>
			<br>
			<label for = "motscles">Mots clés :</label>
			<br>
			<select name = "motscles" placeholder = "Sélectionner une thématique">
				<option name = "Algèbre">Algèbre</option>
				<option name = "Geometrie">Géométrie</option>
				<option name = "equation">équation</option> 
				<option name = "Physique Test">Physique Test</option>
			</select>
			<br>
			<div class="container_button">
				<button type  ="submit" name = "recherche">Rechercher</button>
			</div>
		</form>
	</div>
</div>