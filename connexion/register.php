<!DOCTYPE html>
<html>
    <head>
            <link rel="stylesheet" href="style2.css" />
    </head>
    <body>

        <?php
			// Permet d'appeler la fonction de connexion à la BD
            require('connexion.php');
		

// Cas où le formulaire est validé
if (isset($_POST['submit'])) {
    // Tests si les 3 champs ont été remplis
    if (isset($_POST['last_name'], $_POST['first_name'], $_POST['role'], $_POST['email'], $_POST['password'])) {    
        // Récupération des saisies du formulaire
        $lastname = $_POST['last_name'];
        $firstname = $_POST['first_name'];
        $role = $_POST['role'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
        
        // Connexion à la BD
        $co = connexionBdd();

        // Vérification si l'email existe déjà
        $check_query = $co->prepare("SELECT * FROM user WHERE email = :email");
        $check_query->bindParam(':email', $email);
        $check_query->execute();
        $existing_user = $check_query->fetch();

        if ($existing_user) {
            // L'utilisateur est déjà inscrit
            echo "Erreur : Utilisateur déjà inscrit";
        } else {
            // Préparation de la requête
            $query = $co->prepare("INSERT INTO user (last_name, first_name, role, email, password) VALUES (:lastname, :firstname, :role, :email, :password)");

            // Association des paramètres aux variables/valeurs
            $query->bindParam(':lastname', $lastname);
            $query->bindParam(':firstname', $firstname);
            $query->bindParam(':role', $role);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            
            // Exécution de la requête
            $query->execute();

            // Message de succès si l'insertion est réalisée
            echo "<div class='success'>
                    <h3>Vous êtes inscrit avec succès.</h3>
                    <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
                 </div>";
        }
    }
} else {
?>
    <form class="box" action="" method="post">
        <h1 class="box-title">S'inscrire</h1>
        <input type="text" class="box-input" name="last_name" placeholder="Nom de l'utilisateur" required />
        <input type="text" class="box-input" name="first_name" placeholder="Prénom de l'utilisateur" required />
        <input type="text" class="box-input" name="role" placeholder="Role de l'utilisateur" required />
        <input type="text" class="box-input" name="email" placeholder="Email" required />
        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
        <input type="submit" name="submit" value="S'inscrire" class="box-button" />
        <p class="box-register">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
    </form>
<?php
}
?>

    </body>
</html>