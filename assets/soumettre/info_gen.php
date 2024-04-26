<?php
$errors = [];

function addMessageIfValueIsEmpty(array $errors, string $field): array
{
    if (empty($_POST[$field])) {
        $errors[$field][] = sprintf('Le champ "%s" doit être renseigné.', $field);
    }

    return $errors;
}

function displayErrors(array $errors, string $field): void
{
    if (isset($errors[$field])) {
        foreach ($errors[$field] as $error) {
            echo '<p class="error">' . $error . '</p>';
        }
    }
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
    
    if (empty($errors)) {
        header("Location: ?page=source_soumettre");
        exit;
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
        <form method="POST" action="">
            <div>
                <div>
                    <label for = "nom_exercice">Nom de l'exercice<span class="etoile">*</span> :</label>
                    <br>
                    <input type = "text" name = "nom_exercice" id="nom_exercice" placeholder="Nom de l'exercice">
                    <?php displayErrors($errors, 'nom_exercice'); ?>
                    <br>
                    <br>
                    <label for = "matiere">Matière<span class="etoile">*</span> :</label>
                    <br>
                    <select name = "matiere" id="matiere">
                        <option value= "mathematique"<?= (isset($informations['matiere']) && $informations['matiere'] == 'mathematique') ? 'selected' : '' ?>>Mathématique</option>
                        <option value = "physique" <?= (isset($informations['matiere']) && $informations['matiere'] == 'physique') ? 'selected' : '' ?>>Physique</option>
                    </select>
                    <?php displayErrors($errors, 'matiere'); ?>
                    <br>
                    <br>
                    <label for = "classe">Classe<span class="etoile">*</span> :</label>
                    <br>
                    <select name = "classe" id="classe">
                        <option value = "seconde" <?= (isset($informations['classe']) && $informations['classe'] == 'seconde') ? 'selected' : '' ?>>Seconde</option>
                        <option value = "premiere" <?= (isset($informations['classe']) && $informations['classe'] == 'premiere') ? 'selected' : '' ?>>Première</option>
                        <option value = "terminal" <?= (isset($informations['classe']) && $informations['classe'] == 'terminale') ? 'selected' : '' ?>>Terminal</option>
                    </select>
                    <?php displayErrors($errors, 'classe'); ?>
                    <br>
                    <br>
                    <label for = "thematique">Thématique<span class="etoile">*</span> :</label>
                    <br>
                    <select name = "thematique" id="thematique">
                        <option value = "suite" <?= (isset($informations['thematique']) && $informations['thematique'] == 'suite') ? 'selected' : '' ?>>Suite</option>
                    </select>
                    <?php displayErrors($errors, 'thematique'); ?>
                    <br>
                    <br>
                    <label for = "nchapitre">Chapitre en cours :</label>
                    <br>
                    <input type = "text" name = "nchapitre" id="nchapitre">
                    <?php displayErrors($errors, 'nchapitre'); ?>
                </div>
                <div>
                    <label for = "motscles">Mots clés :</label>
                    <br>
                    <input name = "motscles" id="motscles" placeholer = "mots clés">
                    <?php displayErrors($errors, 'motscles'); ?>
                    <br>
                    <label for = "difficulte">Difficultés<span class="etoile">*</span> :</label>
                    <br>
                    <select name = "difficulte" id="difficulte">
                        <option value = "Niveau1" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau1') ? 'selected' : '' ?>>Niveau 1</option>
                        <option value = "Niveau2" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau2') ? 'selected' : '' ?>>Niveau 2</option>
                        <option value = "Niveau3" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau3') ? 'selected' : '' ?>>Niveau 3</option>
                        <option value = "Niveau4" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau4') ? 'selected' : '' ?>>Niveau 4</option>
                        <option value = "Niveau5" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau5') ? 'selected' : '' ?>>Niveau 5</option>
                        <option value = "Niveau6" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau6') ? 'selected' : '' ?>>Niveau 6</option>
                        <option value = "Niveau7" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau7') ? 'selected' : '' ?>>Niveau 7</option>
                        <option value = "Niveau8" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau8') ? 'selected' : '' ?>>Niveau 8</option>
                        <option value = "Niveau9" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau9') ? 'selected' : '' ?>>Niveau 9</option>
                        <option value = "Niveau10" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau10') ? 'selected' : '' ?>>Niveau 10</option>
                        <option value = "Niveau11" <?= (isset($informations['difficulte']) && $informations['difficulte'] == 'Niveau11') ? 'selected' : '' ?>>Niveau 11</option>
                    </select>
                    <?php displayErrors($errors, 'motscles'); ?>
                    <br>
                    <br>
                    <label for = "duree">Durée</label>
                    <br>
                    <input type = "number" name = "duree" id="duree">
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