<?php
session_start();
if (empty($_GET)) {
    header('Location: index.php?accueil=1');
    exit;
}
//Test de commit
require('connexion/connexion.php');
$show_accueil = isset($_GET["accueil"]) ? $_GET["accueil"] : '0';
$show_recherche = isset($_GET["recherche"]) ? $_GET["recherche"] : '0';
$show_exo = isset($_GET["exercices"]) ? $_GET["exercices"] : '0';
$mesexercices = isset($_GET["mesexercices"]) ? $_GET["mesexercices"] : '0';
$soumettre = isset($_GET["soumettre"]) ? $_GET["soumettre"] : '0';
$show_connexion = isset($_GET["connexion"]) ? $_GET["connexion"] : '0';
$show_administration = isset($_GET["admin_ex"]) ? $_GET["admin_ex"] : '0';
$add_exercice = isset($_GET["add_ex"]) ? $_GET["add_ex"] : '0';
$contribu = isset($_GET["contribu"]) ? $_GET["contribu"] : '0';
$classe = isset($_GET["classe"]) ? $_GET["classe"] : '0';
$add_classe = isset($_GET["add_classe"]) ? $_GET["add_classe"] : '0';
$modif_classe = isset($_GET["modif_classe"]) ? $_GET["modif_classe"] : '0';
$origine = isset($_GET["origine"]) ? $_GET["origine"] : '0';
$modif_origine = isset($_GET["modif_ori"]) ? $_GET["modif_ori"] : '0';
$source = isset($_GET["source"]) ? $_GET["source"] : '0';
//PARTI SLIDE_GAUCHE
$connexion = connexionBdd();
$requete = "SELECT last_name, first_name FROM user";
$resultatconnect = $connexion->query($requete);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maths Index</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="slide_bar_top">
        <?php
        if(!isset($_SESSION['email'])){
            echo '<a href="?connexion=1" class="connect_container">
            <img src="ico/Icon login.svg" class="logo_sliderleft" alt="logo connect">&nbsp;&nbsp;
            <p class="connect">Connexion</p>
            
        </a>';
        }else{
            foreach($resultatconnect as $row2) {
                echo'                
            <div class="connect_container">
                <div class="connexion_normal" id="connexion_normal">
                        <p class="connect">'.$row2['last_name'].' '. $row2['first_name'].'</p>   
                    <div class="img_profile"></div>
                </div>';
                if(isset($_SESSION['email'])){
                    echo'
                <div class="pop_up" id="pop_up">
                    <a href="?contribu=1"><p>Administration</p></a>
                    <a href="connexion/logout.php"><p>Déconnexion</p></a>
                </div>
                </div>';
                }
                
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
              <a href="?accueil=1" class="ligne_slide_gauche">
                  <img src="ico/home.svg" alt="img home" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Accueil</p>
              </a>
              <a href="?recherche=1"class="ligne_slide_gauche">
                  <img src="ico/loupe.svg" alt="img loupe" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Recherche</p>
              </a>
              <a href="?exercices=1" class="ligne_slide_gauche">
                  <img src="ico/exercice.svg" alt="img fonction" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Exercices</p>
              </a>
              <a href="?mesexercices=1" class="ligne_slide_gauche">
                  <img src="ico/mes_exercices.svg" alt="img trois traits" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Mes exercices</p>
              </a>
              <a href="?soumettre=1" class="ligne_slide_gauche">
                  <img src="ico/submit.svg" alt="img envoyer" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Soumettre</p>
              </a>

              <?php
          }else{
              ?>
              <a href="?accueil=1" class="ligne_slide_gauche">
              <img src="ico/home.svg" alt="img home" class="logo_sliderleft">&nbsp;&nbsp;
              <p>Accueil</p>
          </a>
          <a href="?recherche=1"class="ligne_slide_gauche">
              <img src="ico/loupe.svg" alt="img loupe" class="logo_sliderleft">&nbsp;&nbsp;
              <p>Recherche</p>
          </a>
          <a href="?exercices=1" class="ligne_slide_gauche">
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
                    
                    <?php
                    //CONDITION POUR IMPORTER LES DIFFÉRENTS MORCEAUX DE PAGE
                    if($show_accueil == '1'){
                      include_once('assets/accueil.php');
                    }
                    else{?>
                    <?php
                    }
                    if($show_exo =='1'){

                      include_once('assets/exercice.php');

                    }
                    else if($show_recherche=='1'){

                      include_once('assets/recherche.php');
                    }
                    else if($mesexercices=='1'){

                      include_once('assets/mesexercices.php');
                    }
                    else if($soumettre=='1'){

                      include_once('assets/soumettre/info_gen.php');
                    }
                    else if($show_connexion=='1'){

                      include_once('connexion/login.php');
                    }
                    else if($show_administration=='1'){
                        include_once('assets/administration/exercice/admin_exercices.php');
                    }
                    else if($add_exercice=='1'){
                        include_once('assets/administration/exercice/ajouter_exos.php');
                    }
                    elseif($contribu=='1'){
                        include_once('assets/administration/contributeurs/gestion_contri.php');
                    }
                    elseif($classe=='1'){
                        include_once('assets/administration/classe/classes.php');
                    }
                    elseif($add_classe=='1'){
                        include_once('assets/administration/classe/ajouter_classes.php');
                    }
                    elseif($modif_classe=='1'){
                        include_once('assets/administration/classe/modif_classes.php');
                    }
                    elseif($origine=='1'){
                        include_once('assets/administration/origines.php');
                    }
                    else if($modif_origine =='1'){
                        include_once('assets/administration/modif_origines.php');
                    }
                    elseif($source=='1'){
                        include_once('assets/administration/ajouter_sources.php');
                    }
                    
                    
                    ?>

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
<?php
session_start();
if (empty($_GET)) {
    header('Location: index.php?accueil=1');
    exit;
}

require('connexion/connexion.php');
$show_accueil = isset($_GET["accueil"]) ? $_GET["accueil"] : '0';
$show_recherche = isset($_GET["recherche"]) ? $_GET["recherche"] : '0';
$show_exo = isset($_GET["exercices"]) ? $_GET["exercices"] : '0';
$mesexercices = isset($_GET["mesexercices"]) ? $_GET["mesexercices"] : '0';
$soumettre = isset($_GET["soumettre"]) ? $_GET["soumettre"] : '0';
$show_connexion = isset($_GET["connexion"]) ? $_GET["connexion"] : '0';
//PARTI SLIDE_GAUCHE
$connexion = connexionBdd();
$requete = "SELECT last_name, first_name FROM user";
$resultatconnect = $connexion->query($requete);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maths Index</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="slide_bar_top">
        <?php
        if(!isset($_SESSION['email'])){
            echo '<a href="?connexion=1" class="connect_container">
            <img src="ico/Icon login.svg" class="logo_sliderleft" alt="logo connect">&nbsp;&nbsp;
            <p class="connect">Connexion</p>
            
        </a>';
        }else{
            foreach($resultatconnect as $row2) {
                echo 
                '<a href="?connexion=1" class="connect_container">
                    <p class="connect">'.$row2['last_name'].' '. $row2['first_name'].'</p>
                    <div class="img_profile"></div>
                </a>';
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
              <a href="?accueil=1" class="ligne_slide_gauche">
                  <img src="ico/home.svg" alt="img home" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Accueil</p>
                  <p>Test de commit</p>  
              </a>
              <a href="?recherche=1"class="ligne_slide_gauche">
                  <img src="ico/loupe.svg" alt="img loupe" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Recherche</p>
              </a>
              <a href="?exercices=1" class="ligne_slide_gauche">
                  <img src="ico/exercice.svg" alt="img fonction" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Exercices</p>
              </a>
              <a href="?mesexercices=1" class="ligne_slide_gauche">
                  <img src="ico/mes_exercices.svg" alt="img trois traits" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Mes exercices</p>
              </a>
              <a href="?soumettre=1" class="ligne_slide_gauche">
                  <img src="ico/submit.svg" alt="img envoyer" class="logo_sliderleft">&nbsp;&nbsp;
                  <p>Soumettre</p>
              </a>

              <?php
          }else{
              ?>
              <a href="?accueil=1" class="ligne_slide_gauche">
              <img src="ico/home.svg" alt="img home" class="logo_sliderleft">&nbsp;&nbsp;
              <p>Accueil</p>
          </a>
          <a href="?recherche=1"class="ligne_slide_gauche">
              <img src="ico/loupe.svg" alt="img loupe" class="logo_sliderleft">&nbsp;&nbsp;
              <p>Recherche</p>
          </a>
          <a href="?exercices=1" class="ligne_slide_gauche">
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
                    
                    <?php
                    //CONDITION POUR IMPORTER LES DIFFÉRENTS MORCEAUX DE PAGE
                    if($show_accueil == '1'){
                      include_once('assets/accueil.php');
                    }
                    else{?>
                    <?php
                    }
                    if($show_exo =='1'){

                      include_once('assets/exercice.php');

                    }
                    else if($show_recherche=='1'){

                      include_once('assets/recherche.php');
                    }
                    else if($mesexercices=='1'){

                      include_once('assets/mesexercices.php');
                    }
                    else if($soumettre=='1'){

                      include_once('assets/soumettre/info_gen.php');
                    }
                    else if($show_connexion=='1'){

                      include_once('connexion/login.php');
                    }
                    
                    ?>

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