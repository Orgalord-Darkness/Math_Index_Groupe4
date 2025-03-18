<?php
$errors = []; 
function addMessageIfValueIsEmpty(array $errors, string $field): array
  {
      if (empty($_POST[$field])) {
          $errors[$field][] = sprintf('Le champ "%s" doit être renseigné.', $field);
      }
      return $errors;
  
} 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['envoyer'])) {
    $errors = addMessageIfValueIsEmpty($errors, 'nom_exercice');
    $errors = addMessageIfValueIsEmpty($errors, 'matiere');
    $errors = addMessageIfValueIsEmpty($errors, 'classe');
    $errors = addMessageIfValueIsEmpty($errors, 'thematique');
    $errors = addMessageIfValueIsEmpty($errors, 'nchapitre');
    $errors = addMessageIfValueIsEmpty($errors, 'motscles');
    $errors = addMessageIfValueIsEmpty($errors, 'difficulte');
    $errors = addMessageIfValueIsEmpty($errors, 'duree');
}
function displayErrors(array $errors, string $field): void
{
    if (isset($errors[$field])) {
        foreach ($errors[$field] as $error) {
            echo '<p class="error">' . $error . '</p>';
        }
    }
} 
?>
<div class="php_content">
    <div class="title_categ">Soumettre un exercice</div>
    <div class="sections">
        <a href="?page=soumettre"><p>Informations générales</p></a>
        <a href="?page=source_soumettre"><p>Sources</p></a>
        <a href="?page=fichiers_soumettre"><p>Fichiers</p></a>
    </div>
    <div class="bloc_contenu3">
        <form method="POST" action="?page=source_soumettre">

            <div>
                <div>
                    <label for = "nom_exercice">Nom de l'exercice<span class="etoile">*</span> :</label>
                    <br>
                    <input type = "text" name = "nom_exercice" id="nom_exercice" placeholder="Nom de l'exercice...">
                    <?php displayErrors($errors, 'nom_exercice'); ?>
                    <br>
                    <br>
                    <label for = "matiere">Matière<span class="etoile">*</span> :</label>
                    <br>
                    <select name = "matiere" id="matiere">
                        <option value="" disabled selected>Choisissez une matière...</option>
                        <?php 
                            $requete = $connexion->query("SELECT id, name FROM matter");
                            $matieres = $requete->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($matieres as $matiere) {
                                echo "<option value='".$matiere['id']."'>".$matiere['name']."</option>";
                            }
                        ?>
                    </select>
                    <?php displayErrors($errors, 'matiere'); ?>
                    <br>
                    <br>
                    <label for = "classe">Classe<span class="etoile">*</span> :</label>
                    <br>
                    <select name = "classe" id="classe">
                        <option value="" disabled selected>Choisissez une classe...</option>
                    <?php 
						$requete = $connexion->query("SELECT id, name FROM classroom");
                        $classrooms = $requete->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($classrooms as $classroom) {
                            echo "<option value='".$classroom['id']."'>".$classroom['name']."</option>";
                        }
					?>
                    </select>
                    <?php displayErrors($errors, 'classe'); ?>
                    <br>
                    <br>
                    <label for = "thematique">Thématique<span class="etoile">*</span> :</label>
                    <br>
                    <select name = "thematique" id="thematique">
                        <option value="" disabled selected>Choisissez une thématique...</option>
                    <?php 
                        $requete = $connexion->query("SELECT id, name FROM thematic");
                        $thematics = $requete->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($thematics as $thematic) {
                            echo "<option value='".$thematic['id']."'>".$thematic['name']."</option>";
                        }
                    ?>
                    </select>
                    <?php displayErrors($errors, 'thematique'); ?>
                    <br>
                    <br>
                    <label for = "nchapitre">Chapitre en cours :</label>
                    <br>
                    <input type = "text" name = "nchapitre" id="nchapitre" placeholder="Choisissez le chapitre...">
                    <?php displayErrors($errors, 'nchapitre'); ?>
                </div>
                <div>
                    <label for = "motscles">Mots clés :</label>
                        <br>
                    <input name="motscles" id="motscles" placeholder="Mots clés...">
                    <?php displayErrors($errors, 'motscles'); ?>
                        <br>
                    <label for = "info">Informations : </label>
                        <br>
                    <input name = 'info' placeholder = 'informations sur exercices'> 
                        <br>
                    <?php displayErrors($errors, 'info'); ?>
                   <label for = "difficulte">Difficultés<span class="etoile">*</span> :</label>
                        <br>
                    <select name = "difficulte" id="difficulte">
                        <option value="" disabled selected>Choisissez une difficultée...</option>
                        <option value = "Niveau1">Niveau 1</option>
                        <option value = "Niveau2">Niveau 2</option>
                        <option value = "Niveau3">Niveau 3</option>
                        <option value = "Niveau4">Niveau 4</option>
                        <option value = "Niveau5">Niveau 5</option>
                        <option value = "Niveau6">Niveau 6</option>
                        <option value = "Niveau7">Niveau 7</option>
                        <option value = "Niveau8">Niveau 8</option>
                        <option value = "Niveau9">Niveau 9</option>
                        <option value = "Niveau10">Niveau 10</option>
                        <option value = "Niveau11">Niveau 11</option>
                    </select>
                    <?php displayErrors($errors, 'difficulte'); ?>
                    <br>
                    <br>
                    <label for = "duree">Durée</label>
                    <br>
                    <input type = "number" name = "duree" id="duree" placeholder="Durée en heures...">
                    <?php displayErrors($errors, 'duree'); ?>
                </div>
            </div>
            <br>
            <br>
            <div class="container_button2">
                <button type="submit" name="envoyer">Continuer</button>
            </div>
        </form>
    </div>     
</div>
<?php


?>