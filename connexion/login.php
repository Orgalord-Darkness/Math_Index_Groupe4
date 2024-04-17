<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="style.css" />
<?php
require_once('connexion.php');
$co = connexionBdd();
// Initialisation de la variable de message
$message = '';

if (isset($_POST['submit'])) {
    $username = $_POST['email'];

    // Préparation de la requête
    $query = $co->prepare('SELECT * FROM user WHERE email=:login');

    // Association des paramètres aux variables/valeurs
    $query->bindParam(':login', $username);

    // Execution de la requête
    $query->execute();

    // Récupération dans la variable $result de toutes les lignes que retourne la requête
    $result = $query->fetch();

    if (empty($result)) {
        // Si la requête ne retourne rien, alors l'utilisateur n'existe pas dans la BD, on lui
        // affiche un message d'erreur
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    } else {
        $password_hash = $result["password"];
        $valid = password_verify($_POST["password"], $password_hash);
        if ($valid) {
            $_SESSION['email'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
    }
}
?>
<div class="php_content">
    <div class="title_categ">Connexion</div>
    
        
    
        
        <div class="bloc_contenu2">
        <p class="texteconection">Cet espace est reservé aux enseignants du lycée Saint-Vincent-Senlis. Si vous n'avez pas encore de compte, veuillez effectuer votre demande directement 
            en envoyant un mail à contact@lyceestvincent.net.  </p>
        
        <p class="texteconection">Cet espace est reservé aux enseignants du lycée Saint-Vincent-Senlis. Si vous n'avez pas encore de compte, veuillez effectuer votre demande directement 
            en envoyant un mail à contact@lyceestvincent.net.  </p>
        
            <form class="box" action="#" method="post" name="login">
                <h1 class="box-title">Connexion</h1>
                <input type="mail" class="box-input" name="email" placeholder="Adresse mail" style="width: 30%; height: 60px;">
                <input type="password" class="box-input" name="password" placeholder="Mot de passe" style="width: 30%; height: 60px;">
                <input type="submit" value="Connexion " name="submit" class="box-button"></input>
                <a href="?mdp_oublier=1">mot de passe oublier</a>
                <p class="box-register">Page d'accueil ? <a href="./index.php">Accueil</a></p>
                <p class="box-register">S'inscrire ? <a href="connexion/register.php">ici</a></p>
                <?php if (!empty($message)) { ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                <?php } ?>
            </form>
        </div>