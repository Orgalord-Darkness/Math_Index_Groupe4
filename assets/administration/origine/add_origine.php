<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name'])) {
        $last_name = htmlspecialchars($_POST['name']);
        $id = $_POST['id'];

        $sqlupdate = "UPDATE origin SET name = :nom  WHERE id = :id";
        $modif = $connexion->prepare($sqlupdate);
        $modif->bindParam(':id', $id) ; 
        $modif->bindParam(':nom',$last_name) ; 
         $test = $modif->execute() ; 
        // header('Location: ?page=origin');
        // exit();
    } else {
        echo "ATTENTION, ERREUR ! Les champs requis ne doivent pas être vides.";
    }
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
// Assurez-vous de la connexion à la base de données
$connexion = connexionBdd();

// Vérifiez si 'id' est défini dans $_GET
$contactid = isset($_GET['id']) ? $_GET['id'] : null;

// Sélectionnez les informations de la base de données
$sql = "SELECT * FROM origin WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->execute([':id' => $contactid]);
$informations = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifiez si des erreurs existent déjà ou non
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = addMessageIfValueIsEmpty($errors, 'nom');

    if (empty($errors)) {
        $nouveau_nom = htmlspecialchars($_POST['nom']);
        $contactid = $_POST['id_modif']; // Utilisez 'id_modif' pour récupérer l'ID

        $sqlupdate = "UPDATE origin SET name = :nom  WHERE id = :contactid";
        $modif = $connexion->prepare($sqlupdate);
        $modif->bindParam(':contactid', $contactid) ; 
        $modif->bindParam(':nom',$nouveau_nom ) ; 
        // $modif->execute([
        //     ':nom' => $last_name,
        //     ':contactid' => $contactid,
        // ]);
        $test = $modif->execute() ; 
        // header('Location: ?page=origin');
        // exit();
    }
}else{
    echo "erreur de server" ; 
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
        <div class="gestion_sources">
            <h1>Modifier une source</h1>
            <form method="post" action="#">
                <input type="hidden" name="id_modif" value="<?= isset($informations['id']) ? $informations['id'] : '' ?>">

                <label for="nom">Nom :</label>
                <br>
                <input type="text" name="nom" id="nom" value="<?= isset($informations['name']) ? htmlspecialchars($informations['name']) : '' ?>">
                <?php displayErrors($errors, 'nom'); ?>
				<br>
                <br>

                <input type="submit" name="envoyer">
            </form>
        </div>
    </div>
</div>
<?php 
    // echo "id modif : <br>" ; 
    // if(isset($contactid)){ 
    //     var_dump($contactid)  ;
    // }else{ 
    //     echo "erreur de post id modif" ; 
    // }
    // echo "<br>requete : <br>" ; 
    // if(isset($test)){ 
    //     var_dump($test) ; 
    // }else{ 
    //     echo "erreur de test"  ;
    // }

?>