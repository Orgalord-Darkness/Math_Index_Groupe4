<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maths Index</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<div class="php_content">
    
<div class="title_categ">Rechercher un exercice</div>
	<div class="bloc_contenu2">
		<form>
			<label for="matiere">Matière : </label>
			<br>
			<select name = "matiere">
				<option  value = "mathematique">Mathématiques</option>
				<option value = "physique">Physique</option>
			</select>
			<br>
			<label for ="niveau">Niveau : </label>
			<br>
			<select name = "niveau">
				<option value = "college">Collège</option>
				<option value = "lycee">Lycée</option>
			</select>
			<br>
			<label for = "thematique">Thématique :</label>
			<br>
			<select name = "thematique" placeholder = "Sélectionner une thématique">
				<option name = "Algèbre">Algèbre</option>
				<option name = "Géométrie">Géométrie</option>
				<option name = "equation">équation</option> 
			</select>
			<br>
			<div class="container_button">
				<button type  ="submit" name = "rechercher">Rechercher</button>
			</div>
		</form>
	</div>
</div>
</body>
</html>