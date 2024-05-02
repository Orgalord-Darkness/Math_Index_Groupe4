<?php



// Récupération de l'email soumis par le formulaire
if(isset($_POST['rechercher'])){ 
    // Connexion à la base de données//
    $connexion = connexionBdd() ; 
    if(isset($_POST['email'])){ 
        $email = $_POST['email'];
        // Vérifier si l'email existe dans la base de données
        $stmt = $connexion->prepare("SELECT * FROM user WHERE email = ?"); 
        $verif = $stmt->execute([$email]);
        $user = $stmt->fetch();
    }
    if ($user) {
        // Récupérer le nom d'utilisateur et le mot de passe associés
        $username = $user['email'];
        $password = $user['password'];
        
    
        // Envoyer l'email avec les informations de connexion
        $subject = "Informations de connexion";
        $message = "Bonjour,\n\nVoici vos informations de connexion :\n\nNom d'utilisateur: $username\nMot de passe: $password";
        //mail($email, $subject, $message);
    
        echo "Un e-mail contenant vos informations de connexion a été envoyé à votre adresse e-mail.";
    } else {
        echo "Aucun utilisateur trouvé avec cette adresse e-mail.";
    }
}



?>


<div class="php_content">
    <div class="title_categ">Mot de passe oublier </div>
        <div class="bloc_contenu2">
        <p class="texteconection">Vous aller recevoir un mail dans votre boite mail avec vos login-mot passe si biens sur votre adresse-mail est le même que quand vous vous êtes inscris. </p>
        
            <form class="box" action="?page=oubli" method="post" name="login">
                <h1 class="box-title">Connexion</h1>
                <input type="mail" class="box-input" name="email" placeholder="Adresse mail" style="width: 30%; height: 60px;">
                <button type="submit" name="rechercher">Envoyer</button>
                

            </form>
            <?php echo "<br>" ;
            if(isset($_POST['rechercher'])){ 
                if (!empty(($user))) {
                    echo "Un e-mail contenant vos informations de connexion a été envoyé à votre adresse e-mail.";
                } else {
                    echo "Aucun utilisateur trouvé avec cette adresse e-mail.";
                }
            }
            ?>
        </div>
</div>