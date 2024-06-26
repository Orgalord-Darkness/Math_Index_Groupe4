<?php
require_once('connexion/connexion.php');
$connexion = connexionBdd();
session_start();
if (empty($_GET)) {
    header('Location: ?page=accueil');
    exit;
}
//fonctions filtres formulaires 
function addMessageIfValueEmpty(array $erreurs, string $field, $value)
{
    if (empty($value)) {
        $erreurs[$field] = sprintf("Le champ %s doit être renseigné.", $field);
        echo "<p class = 'erreur'>".$erreurs[$field]."</p>";
    } elseif ($field === 'pdfExos' && isset($_FILES['pdfExos']) && $_FILES['pdfExos']['error'] === UPLOAD_ERR_NO_FILE) {
        $erreurs[$field] = sprintf("Le champ %s doit être renseigné.", $field);
        echo "<p class = 'erreur'>".$erreurs[$field]."</p>";
    } elseif ($field === 'pdfCorrect' && isset($_FILES['pdfCorrect']) && $_FILES['pdfCorrect']['error'] === UPLOAD_ERR_NO_FILE) {
        $erreurs[$field] = sprintf("Le champ %s doit être renseigné.", $field);
        echo "<p class = 'erreur'>".$erreurs[$field]."</p>";
    }
    return $erreurs;
}

  function addChampErreur(string $field ){ 
    if(isset($erreur[$field])){
      foreach($erreurs[$field] as $erreur){
        echo $erreur ; 
      }
    }
  }
  $chemin = __DIR__ . "/assets/administration/fichiers";
$page = isset($_GET["page"]) ? $_GET["page"] : '';
//CONDITION POUR IMPORTER LES DIFFÉRENTS MORCEAUX DE PAGE
ob_start();


switch ($page) {
    //MENU SLIDE
    case 'accueil':
        include_once('assets/accueil.php');
       $title = "Accueil";
        break;
    case 'exercice':
        include_once('assets/exercice.php');
        $title = "Exercices";
        break;
    case 'recherche':
        include_once('assets/recherche.php');
        $title = "Recherche";
        break;
    case 'mesexercices':
        if(isset($_SESSION['email'])){
            include_once('assets/mesexercices.php');
            $title = "Mes exercices";
        }else{
            $title = 'Erreur 404';
        }
        break;
    //SOUMETTRE
    case 'soumettre':
        include_once('assets/soumettre/info_gen.php');
        $title = "Soumettre";
        break;
    case 'source_soumettre':
        include_once('assets/soumettre/source.php');
        $title = "Soumettre";
        break;
    case 'fichiers_soumettre':
        include_once('assets/soumettre/fichiers.php');
        $title = "Soumettre";
        break;
    //CONNEXION
    case 'connexion':
        include_once('connexion/login.php');
        $title = "Connexion";
        break;
    //ADMIN EXERCICE
    case 'admin_ex':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/exercice/admin_exercices.php');
            $title = "Administration exercices";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'add_ex':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/exercice/ajouter_exos.php');
            $title = "Administration exercices";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'modif_ex':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/exercice/modif_exos.php');
        $title = "Administration exercices";
        }else{
            $title = 'Erreur 404';
        } 
        break;
    //ADMIN CONTRIBUTEUR
    case 'contribu':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/contributeurs/gestion_contri.php');
            $title = "Administration contributeurs";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'modif_contribu':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/contributeurs/modification_contri.php');
            $title = "Administration contributeurs";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'add_contribu':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/contributeurs/ajouter_contri.php');
            $title = "Administration contributeurs";
        }
        else{
            $title = 'Erreur 404';
        }
        break;
    //ADMIN CLASSE
    case 'classe':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/classe/classes.php');
            $title = "Administration classes";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'add_classe':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/classe/ajouter_classes.php');
            $title = "Administration classes";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'modif_classe':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/classe/modif_classes.php');
            $title = "Administration classes";
        }else{
            $title = 'Erreur 404';
        }
        break;
    //ADMIN ORIGINE
    case 'origine':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/origine/origines.php');
            $title = "Administration origines";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'modif_ori':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/origine/modif_origines.php');
            $title = "Administration origines";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'add_ori':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/origine/add_origine.php');
            $title = "Administration origines";
        }else{
            $title = 'Erreur 404';
        }
        break;
    //ADMIN THEMATIC
    case 'thematic':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/thematique/gestion_thema.php');
            $title = "Administration thématiques";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'add_thematic':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/thematique/add_thema.php');
            $title = "Administration thématiques";
        }else{
            $title = 'Erreur 404';
        }
        break;
    case 'modif_thematic':
        if(isset($_SESSION['email'])){
            include_once('assets/administration/thematique/modif_thema.php');
            $title = "Administration thématiques";
        }else{
            $title = 'Erreur 404';
        }
        break;
    //ADMIN SOURCE
    case 'source':
        include_once('assets/administration/ajouter_sources.php');
        $title = "Administration sources";
        break;

    case 'oubli' : 
        include('connexion/mdp_oublier.php') ; 
        $title = "mot de passe oublier" ; 
        break ; 
    case 'supp' : 
        include_once('assets/administration/supprimer.php') ;
        $title = "supprimer" ; 
        break ; 
    case 'result' : 
        include_once('assets/administration/resultat.php') ; 
        $title = "résultats" ; 

        break ; 
    default:
        include_once('assets/accueil.php');
        $title = "Accueil";
        break;
}
$content = ob_get_clean();
           
//PARTI SLIDE_GAUCHE
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="ico/exercice.svg">
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="slide_bar_top">
        <?php
        if(!isset($_SESSION['email'])){
            echo '<a href="?page=connexion" class="connect_container">
            <img src="ico/Icon login.svg" class="logo_sliderleft" alt="logo connect">&nbsp;&nbsp;
            <p class="connect">Connexion</p>
            
        </a>';
        }else{
                $email = $_SESSION['email'];
                $requete = "SELECT last_name, first_name FROM user WHERE email = '$email'";
                $resultatconnect = $connexion->query($requete);
                foreach($resultatconnect as $row2) {
                    echo '                
                    <div class="connect_container">
                        <div class="connexion_normal" id="connexion_normal">
                            <p class="connect">'.$row2['last_name'].' '. $row2['first_name'].'</p>   
                            <div class="img_profile"></div>
                        </div>';
                        echo '
                        <div class="pop_up" id="pop_up">

                            <div class="container_popup">
                                <a href="?page=contribu"><p>Administration</p></a>
                                <img src="ico/admin_logo.svg" alt="logo administration" width="30px" height="30px">
                            </div>
                            <div class="container_popup">
                                <a href="connexion/logout.php"><p>Déconnexion</p></a>
                                <img src="ico/logo_deco.svg" alt="logo administration" width="30px" height="30px">
                            </div>

                        </div>
                    </div>';
                }
                
            }
        ?>
                
</div>
<div class="slide_gauche">
  <div class="container_global_slidebar">
      <div class="saint_vincent">
          <img src="ico/saint_vincent.png" alt="ico saint_vincent" width="40px" height="40px">
          <div class="container_nameofproject">
              <div class="projet_name">Maths Index</div>
              <div class="name_of_school">Lycée Saint-Vincent-Senlis</div>
          </div>
      </div>
      <div class="container_menutaskbar">
          <?Php 
          if(isset($_SESSION['email'])){
              ?>
              <a href="?page=accueil" class="ligne_slide_gauche">
                  <img src="ico/home.svg" alt="img home" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Accueil</p>
              </a>
              <a href="?page=recherche"class="ligne_slide_gauche">
                  <img src="ico/loupe.svg" alt="img loupe" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Recherche</p>
              </a>
              <a href="?page=exercice" class="ligne_slide_gauche">
                  <img src="ico/exercice.svg" alt="img fonction" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Exercices</p>
              </a>
              <a href="?page=mesexercices" class="ligne_slide_gauche">
                  <img src="ico/mes_exercices.svg" alt="img trois traits" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Mes exercices</p>
              </a>
              <a href="?page=soumettre" class="ligne_slide_gauche">
                  <img src="ico/submit.svg" alt="img envoyer" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Soumettre</p>
              </a>

              <?php
          }else{
              ?>
              <a href="?page=accueil" class="ligne_slide_gauche">
              <img src="ico/home.svg" alt="img home" class="logo_sliderleft">&nbsp;&nbsp;
              <p>Accueil</p>
          </a>
          <a href="?page=recherche"class="ligne_slide_gauche">
              <img src="ico/loupe.svg" alt="img loupe" class="logo_sliderleft">&nbsp;&nbsp;
              <p>Recherche</p>
          </a>
          <a href="?page=exercice" class="ligne_slide_gauche">
              <img src="ico/exercice.svg" alt="img fonction" class="logo_sliderleft">&nbsp;&nbsp;
              <p>Exercices</p>
          </a>    
          <?php
          }?>
          
          
      </div>
  </div>
  <?php 
  if(isset($_SESSION['email'])){
      echo '<div class="deconnect_container">
      <a href="connexion/logout.php" class="content_deconnect">
          <img src="ico/deconnect.svg" alt="img deconnect" class="logo_sliderleft">&nbsp;&nbsp;
          <p>Déconnexion</p>
      </a>
</div>';
  }else{
      
      echo'';
  }
  ?>
  
</div>
<section class="global_container">
        <div class="bloc_invisible"></div>
    <div class="container_content">
            <div class="content_mathsindex">
                    <div class="bloc_global_page">
                    
                     <?php echo $content; ?>

                    </div>
            </div>
        </div>

    </section>
</body>
<div class="footer">
    <p>Mention légales</p>&nbsp;&nbsp;
        <div class="mini_rond"></div>&nbsp;&nbsp;
            <p>Contact</p>&nbsp;&nbsp;
                <div class="mini_rond"></div>&nbsp;&nbsp;
                    <p>Lycée Saint-Vincent</p>
</div>
</html>
