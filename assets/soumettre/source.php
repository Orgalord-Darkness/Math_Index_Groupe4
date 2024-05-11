<?php
$errors = [];
if(isset($_POST['nom_exercice'])){ 
    $nom_exos = $_POST['nom_exercice'] ; 
    $classe = $_POST['classe'] ; 
    $thematique = $_POST['thematique'] ; 
    $nChapitre = $_POST['nchapitre'] ; 
    $motsCles = $_POST['motscles'] ; 
    $difficulte = $_POST['difficulte'] ; 
    $duree = $_POST['duree'] ; 
    $info = $_POST['info'] ; 
}
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
    $errors = addMessageIfValueIsEmpty($errors, 'origine');
    $errors = addMessageIfValueIsEmpty($errors, 'nom_source');
    $errors = addMessageIfValueIsEmpty($errors, 'info_comple');
    
    // if (empty($errors)) {
    //     header("Location: ?page=fichiers_soumettre");
    //     exit;
    // }
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
        <form method="POST" action="?page=fichiers_soumettre">
            <div>
                <div>
                <?php if (empty($origines)) : ?>
                    <p>Aucune origine n'est présente.</p>
                <?php else : ?>
                    <label for="origine">Origine<span class="etoile">*</span> :</label>
                    <br>
                    <select name="origine" id="origine">
                    <option value=""></option>
                    <?php foreach ($origines as $origine) : ?>
                        <option value="<?= $origine['name'] ?>" <?= (isset($_POST['origine']) && $_POST['origine'] == $origine['name']) ? 'selected' : '' ?>>
                            <?= $origine['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php displayErrors($errors, 'origine'); ?>
                <?php endif; ?>
                    <br>
                    <br>
                    <label for = "nom_source">Nom de la source/lien du site<span class="etoile">*</span> :</label>
                    <br>
                    <input type = "text" name = "nom_source" id="nom_source" placeholder="Maths ">
                    <?php displayErrors($errors, 'nom_source'); ?>
                    <br>
                    <br>
                    <label for = "info_comple">Informations complémentaires :</label>
                    <br>
                    <input type="text" name="info_comple" id="info_comple" placeholder="Page 12, 2ème paragraphe...">
                    <?php displayErrors($errors, 'info_comple'); ?>
                    <br>
                    <br>
                    <input type="hidden" name="nom_exercice" value="<?php echo $nom_exos; ?>">
                    <input type = 'hidden' name = 'thematique'value = "<?php echo $thematique ;?>">
                    <input type = 'hidden' name = 'classe'value = "<?php echo $classe ;  ?>">
                    <input type = 'hidden' name = 'nchapitre' value =" <?php echo $nChapitre ;  ?>">
                    <input type = 'hidden' name = 'difficulte' value = "<?php echo $difficulte ;  ?>">
                    <input type = 'hidden' name = 'motscles'value = "<?php echo $motsCles;  ?>">
                    <input type = 'hidden' name = 'duree' value = "<?php echo $duree ;  ?>">
                    <input type = 'hidden' name = 'info' value = "<?php echo $info ;  ?>">
                <div class="container_button2">
                    <button type="submit" name="envoyer">Continuer</button>
                </div>
        </form>
        <?php
            // if(isset($nom_exos)){ 
            //     var_dump($nom_exos) ; 
            // }else{ 
            //     echo "pas de exos"  ;
            // }
            // if(isset($_POST['envoyer'])){ 
            //     var_dump($_POST['nom_exercice']) ;
            // } 
        ?>
    </div>     
</div>
<?php


?>