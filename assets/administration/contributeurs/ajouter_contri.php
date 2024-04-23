<?php
if (isset($_POST['envoyer'])) {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['role'], $_POST['email'], $_POST['password'])) {
        $lastname = $_POST['nom'];
        $firstname = $_POST['prenom'];
        $role = $_POST['role'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérifier si l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Erreur : Email invalide";
            exit();
        }

        // Vérifier la longueur du mot de passe
        if (strlen($password) < 8) {
            echo "Erreur : Le mot de passe doit contenir au moins 8 caractères";
            exit();
        }

        // Vérification si l'email existe déjà
        $check_query = $connexion->prepare("SELECT * FROM user WHERE email = :email");
        $check_query->bindParam(':email', $email);
        $check_query->execute();
        $existing_user = $check_query->fetch();

        if ($existing_user) {
            // L'utilisateur est déjà inscrit
            echo "Erreur : Utilisateur déjà inscrit";
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
    }else{
        $query->execute();
        header("Location: ?page=contribu");
        exit();
    }
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
		<div class = "gestion_sources">
      <p class="title_exo">Ajouter un contributeur</p>
			<form method = "POST">
				<label for = "nom">Nom :</label>
				<br>
				<input name = "nom">
				<br>
				<br>
				<label for = "prenom">Prénoms :</label>
				<br>
				<input name = "prenom">
				<br>
				<br>
				<label for="role">Rôle :</label>
        <select name="role">
        <option value="administrateur">Administrateur</option>
        <option value="moderateur">Modérateur</option>
        <option value="membre">Membre</option>
        </select>
				<br>
				<br>
				<label for = "email">Email :</label>
				<br>
				<input name = "email">
        <label for = "password">Password :</label>
				<br>
				<input name = "password" type="password">
				<br>
				<br>
				<form id="form_envoyer" action="index.php" method="post">
          <button type="submit" name="envoyer">Envoyer</button>
          <input type="hidden" name="contribu" value="1">
        </form>
    </form>
</div>
</div>
</div>