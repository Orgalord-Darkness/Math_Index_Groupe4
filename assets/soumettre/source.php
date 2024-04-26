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
    
    if (empty($errors)) {
        header("Location: ?page=source_soumettre");
        exit;
    }
}
$requete = $connexion->prepare("SELECT name FROM origin");
$requete->execute();
$origines = $requete->fetchAll(PDO::FETCH_ASSOC);

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
                <?php if (empty($origines)) : ?>
                    <p>Aucune origine n'est présente.</p>
                <?php else : ?>
                    <label for="nom_exercice">Origine<span class="etoile">*</span> :</label>
                    <br>
                    <select name="origine" id="origine">
                        <?php foreach ($origines as $origine) : ?>
                            <option value="<?= htmlspecialchars($origine['name']) ?>"><?= htmlspecialchars($origine['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                    <br>
                    <br>
                    <label for = "matiere">Nom de la source/lien du site<span class="etoile">*</span> :</label>
                    <br>
                    <input type = "text" name = "nom_exercice" placeholder="Maths ">
                    <br>
                    <br>
                    <label for = "thematique">Informations complémentaires :</label>
                    <br>
                    <input type="text" name="info_comple" placeholder="Page 12, 2ème paragraphe...">
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