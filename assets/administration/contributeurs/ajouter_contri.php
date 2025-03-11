<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['envoyer'])) {
    if (empty($_POST['nom'])) {
        $errors['nom'][] = 'Le champ "Nom" doit être renseigné.';
    }

    if (empty($_POST['prenom'])) {
        $errors['prenom'][] = 'Le champ "Prénom" doit être renseigné.';
    }

    if (empty($_POST['role'])) {
        $errors['role'][] = 'Le champ "Rôle" doit être renseigné.';
    }

    if (empty($_POST['email'])) {
        $errors['email'][] = 'Le champ "Email" doit être renseigné.';
    }

    if (empty($_POST['password'])) {
        $errors['password'][] = 'Le champ "Mot de passe" doit être renseigné.';
    }

    if (empty($errors)) {
        // Si aucun champ requis n'est vide, alors procéder à la vérification du formulaire
        // Je suppose que $connexion est déjà initialisé ailleurs dans votre code
        $lastname = $_POST['nom'];
        $firstname = $_POST['prenom'];
        $role = $_POST['role'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérification si l'email existe déjà
        $check_query = $connexion->prepare("SELECT * FROM user WHERE email = :email");
        $check_query->bindParam(':email', $email);
        $check_query->execute();
        $existing_user = $check_query->fetch();

        if ($existing_user) {
            // L'utilisateur est déjà inscrit
          echo "";
        } else {
            // Hash du mot de passe
            $password = password_hash($password, PASSWORD_ARGON2I);

            // Préparation de la requête
            $query = $connexion->prepare("INSERT INTO user (last_name, first_name, role, email, password) VALUES (:lastname, :firstname, :role, :email, :password)");

            // Association des paramètres aux variables/valeurs
            $query->bindParam(':lastname', $lastname);
            $query->bindParam(':firstname', $firstname);
            $query->bindParam(':role', $role);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);

            // Exécution de la requête
            $query->execute();
            header("Location: ?page=contribu");
            exit();
        }
    }
}
?>
<div class="php_content">
    <div class="title_categ">Administration</div>
    <div class="sections">
        <a href="?page=contribu"><p>Contributeurs</p></a>
        <a href="?page=admin_ex"><p>Exercices</p></a>
        <a href="?page=matiere"><p>Matières</p></a>
        <a href="?page=classe"><p>Classes</p></a>
        <a href="?page=thematic"><p>Thématiques</p></a>
        <a href="?page=origine"><p>Origines</p></a>
    </div>
    <div class="bloc_contenu3">
        <div class="gestion_sources">
            <p class="title_exo">Ajouter un contributeur</p>
            <form method="POST">
                <label for="nom">Nom :</label><br>
                <input name="nom" id="nom" placeholder="Saisissez le nom :" value="<?= isset($informations['nom']) ? htmlspecialchars($informations['nom']) : '' ?>"><br>
                <?php if (isset($errors['nom'])) {
                    foreach ($errors['nom'] as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                } ?><br>

                <label for="prenom">Prénoms :</label><br>
                <input name="prenom" id="prenom" placeholder="Saisissez le prénom :" value="<?= isset($informations['prenom']) ? htmlspecialchars($informations['prenom']) : '' ?>"><br>
                <?php if (isset($errors['prenom'])) {
                    foreach ($errors['prenom'] as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                } ?><br>

                <label for="role">Rôle :</label><br>
                <select name="role" id="role">
                    <option value="" disabled selected>Choisissez un rôle</option>
                    <option value="enseignant" <?= (isset($informations['role']) && $informations['role'] == 'enseignant') ? 'selected' : '' ?>>Enseignant</option>
                    <option value="eleve" <?= (isset($informations['role']) && $informations['role'] == 'eleve') ? 'selected' : '' ?>>Elève</option>
                </select><br>
                <?php if (isset($errors['role'])) {
                    foreach ($errors['role'] as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                } ?><br>

                <label for="email">Email :</label><br>
                <input name="email" id="email" placeholder="Saisissez l'email :" value="<?= isset($informations['email']) ? htmlspecialchars($informations['email']) : '' ?>"><br>
                <?php if (isset($errors['email'])) {
                    foreach ($errors['email'] as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                } ?><br>

                <label for="password">Password :</label><br>
                <input name="password" type="password" id="password" placeholder="Saisissez le mot de passe :"><br>
                <?php if (isset($errors['password'])) {
                    foreach ($errors['password'] as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                } ?><br>

                <?php if(isset($erreurutiinscrit)){
                    echo "<p class='error'>Erreur : Utilisateur déjà inscrit ! </p> ";
                }  ?>
                <form id="form_envoyer" method="post">
                    <button type="submit" name="envoyer">Envoyer</button>
                    <input type="hidden" name="contribu" value="1">
                </form>
            </form>
        </div>
    </div>
</div>
