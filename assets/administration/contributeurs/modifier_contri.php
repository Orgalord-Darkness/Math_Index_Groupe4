<?php
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
$connexion = connexionBdd();
var_dump($_GET['id']);
$contactid = isset($_GET['id']) ? $_GET['id'] : null;
$sql = "SELECT * FROM user WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->execute([':id' => $contactid]);
$informations = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($informations);

// Vérifiez si des erreurs existent déjà ou non
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_POST)) {
    $errors = addMessageIfValueIsEmpty($errors, 'last_name');
    $errors = addMessageIfValueIsEmpty($errors, 'first_name');
    $errors = addMessageIfValueIsEmpty($errors, 'role');
    $errors = addMessageIfValueIsEmpty($errors, 'email');
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
        <div class="gestion_sources">
            <p class="title_exo">Modifier un contributeur</p>
            <form method="POST">
                <label for="last_name">Nom :</label><br>
                <input name="last_name" id="last_name" value="<?= isset($informations['last_name']) ? htmlspecialchars($informations['last_name']) : '' ?>"><br><br>
                <?php displayErrors($errors, 'last_name'); ?>

                <label for="first_name">Prénoms :</label><br>
                <input name="first_name" id="first_name" value="<?= isset($informations['first_name']) ? htmlspecialchars($informations['first_name']) : '' ?>"><br><br>
                <?php displayErrors($errors, 'first_name'); ?>

                <label for="role">Rôle :</label><br>
                <select name="role" id="role">
                    <option value="administrateur" <?= (isset($informations['role']) && $informations['role'] == 'administrateur') ? 'selected' : '' ?>>Administrateur</option>
                    <option value="moderateur" <?= (isset($informations['role']) && $informations['role'] == 'moderateur') ? 'selected' : '' ?>>Modérateur</option>
                    <option value="membre" <?= (isset($informations['role']) && $informations['role'] == 'membre') ? 'selected' : '' ?>>Membre</option>
                </select>
                <?php displayErrors($errors, 'role'); ?>

                <br><br>
                <label for="email">Email :</label><br>
                <input name="email" id="email" value="<?= isset($informations['email']) ? htmlspecialchars($informations['email']) : '' ?>"><br><br>
                <?php displayErrors($errors, 'email'); ?>

                <button name="modifier">Modifier</button>
                <input type="hidden" name="id" value="<?= $contactid ?>">
            </form>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['last_name']) && !empty($_POST['first_name']) && !empty($_POST['role']) && !empty($_POST['email'])) {
        $last_name = htmlspecialchars($_POST['last_name']);
        $first_name = htmlspecialchars($_POST['first_name']);
        $role = htmlspecialchars($_POST['role']);
        $email = htmlspecialchars($_POST['email']);
        $contactid = $_POST['id'];

        $sqlupdate = "UPDATE user SET last_name = :nom, first_name = :prenom, role = :role, email = :email WHERE id = :contactid";
        $modif = $connexion->prepare($sqlupdate);
        $modif->execute([
            ':nom' => $last_name,
            ':prenom' => $first_name,
            ':role' => $role,
            ':email' => $email,
            ':contactid' => $contactid,
        ]);
        header('Location: ?gestion_contribu=1');
        exit();
    } else {
        echo "ATTENTION, ERREUR ! Les champs requis ne doivent pas être vides.";
    }
}
?>

