<?php 
session_start();
//Test de commit
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

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si la commande SQL est présente dans les données du formulaire
    if (isset($_POST['id_suppression'])) {
        // Récupérez l'identifiant de l'exercice à supprimer
        $id_suppression = $_POST['id_suppression'];

        // Effectuez la suppression
        $requete = $connexion->prepare("DELETE FROM exercise WHERE id = :id;");
        $requete->bindParam(':id', $id_suppression);
        $requete->execute();

        // Redirigez l'utilisateur vers la même page pour afficher les résultats
       // header("Location: nom_de_votre_page.php");
        //exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur de suppression";
    }
//}
  

	// include_once("menu.php") ; 
 //   $connexion = connexionBdd() ;
 //  if($_SERVER["REQUEST_METHOD"] == "POST") {
 //                // Vérifiez si la commande SQL est présente dans les données du formulaire
 //          if(isset($_POST['id_suppression'])) {
 //                    // Récupérez la commande SQL à partir des données du formulaire
 //            $id = $_POST['id_suppression'];
 //            var_dump($id) ; 
 //            $requete = $connexion->prepare("DELETE FROM exercise WHERE id = :id;");
 //            $requete->bindParam(':id', $id);
 //            $requete->execute();
 //          }else{ 
 //            echo "erreur de suppression" ; 
 //          }
        //else{ 
         // echo "erreur de if" ; 
        //}
        $requete = $connexion->prepare("SELECT * FROM `exercise` ;") ; 
        $requete->execute() ;
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC) ;  
        var_dump($donnees) ; 

        foreach($donnees as $ligne){ 
          echo "<tr>" ; 
          echo "<td>" . $ligne['id'] . "</td>";
          echo "<td>" . $ligne['name'] . "</td>";
          echo "<td>" . $ligne['classroom_id'] . "</td>";
          echo "<td>" . $ligne['thematic_id'] . "</td>";
          echo "<td>" . $ligne['chapter'] . "</td>";                
          echo "<td>" . $ligne['keywords'] . "</td>";
          echo "<td>" . $ligne['difficulty'] . "</td>";
          echo "<td>" . $ligne['origin_id'] . "</td>";
          echo "<td>" . $ligne['origin_name'] . "</td>"; 
          echo "<td>" . $ligne['origin_information'] . "</td>"; 
          echo "<td>" . $ligne['exercice_file_id'] . "</td>"; 
          echo "<td>" . $ligne['correction_file_id'] . "</td>"; 
          echo "<td>" . $ligne['created_by_id'] . "</td>"; 
          echo "<tr>" ; 
        }
        var_dump($_SERVER["REQUEST_METHOD"] ) ; 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel = "stylesheet" href = "style.css">
    <style>
      /* Styles pour la boîte de dialogue */
      .dialog {
        display: none;
        width : 29rem ;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 10001; /* Valeur de z-index supérieure pour s'assurer que la boîte de dialogue apparaît au-dessus de la superposition modale */
      }

      .dialog-content {
        text-align: center;
      }
      .align { 
        display : flex ;
        flex-direction : row ;
       }
       .align div { 
          display : inline ;
          line-height : 1rem ;
          text-align : left ;
        }
       .align img { 
          display : flex ;
          flex-direction : column ;
          width : 30px;
          height : 30px;
          padding : 2% ;
          border-radius: 10px/10px;
          margin-top : 5% ;
          margin-right : 1% ;
          background-color : rgb(240,240,240);

       }
      .dialog button {
        width : 9rem;
        margin-right : 1% ;
      }
      button img { 
        width : 0.8rem ;
        height : 0.8rem ;
        top : 50% ;
        left : 50% ;
        padding : 0;
        margin : 0;
       }
      .dialog-content .close { 
        background-color : rgb(240,240,240);
        border : none ;
        border-radius : 5rem ;
        width: 1.5rem  ;
        height : 1.5rem;
        right : 50% ;
        top : 0;
        padding : 0;
        margin : 0;
        justify-content : right ;
       }
      #closeDialog { 
         padding: 10px 20px;
        background-color: rgb(240,240,240);
        color: #000;
        border: none;
        border-radius: 3px;
        cursor: pointer;
       }
       #confirm { 
        padding: 10px 20px;
        background-color: rgb(100,100,100);
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
       }

      .dialog button:hover {
        background-color: #0056b3;
      }

      /* Styles pour la superposition modale */
      .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Couleur semi-transparente */
        z-index: 10000; /* Valeur de z-index pour être en dessous de la boîte de dialogue mais au-dessus du reste de la page */
      }

      /* Styles pour le reste de la page */
      /* Vous pouvez ajuster les styles de votre page pour griser le contenu lorsqu'il est sous la superposition modale */
      body.modal-open {
        overflow: hidden; /* Empêche le défilement de la page lorsque la boîte de dialogue est ouverte */
      }
    </style>
	</head>
	<body>
	<h1 class=  "titre_section">Administration</h1>
	<section class="global_container">
	    <div class="bloc_invisible"></div>
	   	<div class="container_content">
            <div class="content_mathsindex">
                <div class="bloc_global_page">
                    <div class="php_content">
                    	<div class="title_categ">Exercices</div>
                        <div class="bloc_contenu">
                            <div class="container_one_exo">
                              <form method = "POST">
                                  <div>
                                    <label for = "rechercher">Rechercher un exercice</label>
                                  </div>
                                  <br>
                                  <input name = "rechercher">
                                  <button>Rechercher</button>
                          
              
                                      <a class = "bouton_ajouter" href = "ajouter_exos.php">
                                        Ajouter +
                                      </a>
                                   
                              </form>
                                <div class="container_one_exo">
                                    <p class="title_exo">Tous les exercices</p>
                                    <table>
                                        <thead>
                                              <th class="big_table">Nom</th>
                                              <th class="big_table">Thématiques</th>
                                              <th>Difficulté</th>
                                              <th>Durée</th>
                                              <th class="big_table">Mots clés</th>
                                              <th>Fichiers</th>
                                              <th>Modifier</th>
                                              <th>Supprimer</th>
                                          </thead>
                                          <tbody>
                                            <form method=post>
                                           <!--  <tr>
                                              <td>Donnée 1</td>
                                              <td>Donnée 2</td>
                                              <td>Donnée 3</td>
                                              <td class="gras_time">Donnée 3</td>
                                              <td>
                                                <div class="bulle_mc">Donnée 3</div>
                                            </td>
                                              <td>Donnée 3</td>
                                              Del
                                            </tr>
                                            <tr>
                                              <td>Donnée 4</td>
                                              <td>Donnée 5</td>
                                              <td>Donnée 6</td>
                                              <td class="gras_time">Donnée 3</td>
                                              <td>
                                                <div class="bulle_mc">Donnée 3</div>
                                            </td>
                                              <td>Donnée 3</td>
                                            </tr>
                                            <tr>
                                              <td>Donnée 7</td>
                                              <td>Donnée 8</td>
                                              <td>Donnée 9</td>
                                              <td class="gras_time">Donnée 3</td>
                                              <td>
                                                <div class="bulle_mc">Donnée 3</div>
                                            </td>
                                              <td>Donnée 3</td>
                                            </tr> -->
                                            <?php
                                                foreach($donnees as $ligne){ 
                                                  echo "<tr>" ; 
                                                  // echo "<td>" . $ligne['id'] . "</td>";
                                                  echo "<td>" . $ligne['name'] . "</td>";
                                                  echo "<td>" . $ligne['classroom_id'] . "</td>";
                                                  echo "<td>" . $ligne['thematic_id'] . "</td>";
                                                  // echo "<td>" . $ligne['chapter'] . "</td>";                
                                                  // echo "<td>" . $ligne['keywords'] . "</td>";
                                                  echo "<td>" . $ligne['difficulty'] . "</td>";
                                                  // echo "<td>" . $ligne['origin_id'] . "</td>";
                                                  // echo "<td>" . $ligne['origin_name'] . "</td>"; 
                                                  // echo "<td>" . $ligne['origin_information'] . "</td>"; 
                                                  echo "<td>" . $ligne['exercice_file_id'] . "</td>"; 
                                                  echo "<td>" . $ligne['correction_file_id'] . "</td>"; 
                                                  // echo "<td>" . $ligne['created_by_id'] . "</td>"; 
                                                 echo "<td><form method='post' action='modif_exos.php'>
                                                    <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                                    <button type='submit' name='modif'>Modifier " . $ligne['id'] . "</button>
                                                </form></td>";


                                                   echo "<td><form method='post'>
                                                    <button class = 'openDialog'name='id_suppression' value='" . $ligne['id'] . "'>Supprimer</button></form></td>";

                                                  echo "<tr>" ; 
                                                }
                                            ?>
                                          </form>
                                          </tbody>
                                        </table>
                                </div>
                                <div class="pagination">PAGINATION</div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </section>
    <div class="modal-overlay"></div>
    <div id="dialog" class="dialog">
      <div class="dialog-content">
        <button  class = "close" id = "closeDialog">
          <img src = "croix-removebg.png">
        </button>
        <div class = "align">
          <img  src = "check.svg">
          <div>
            <h1>Confirmer la suppression</h1>
            <p>Êtes-vous certains de vouloir supprimer cette exercice ?</p>
          </div>
        </div>
        <form method = "POST">
          <button id="closeDialog">Annuler</button>
          <button name = "valid_suppression" value = "<?php if(isset($_POST['id_suppression'])){ echo $id ; }  ; ?>" id = "confirm">Confirmer</button>
        </form>
      </div>
  </div>

<script>
  // JavaScript pour ouvrir et fermer la boîte de dialogue
  document.addEventListener('click', function(event) {
      if (event.target.classList.contains('openDialog')) {
          // Afficher la superposition modale et la boîte de dialogue
          document.querySelector('.modal-overlay').style.display = 'block';
          document.getElementById('dialog').style.display = 'block';
          // Ajouter une classe au corps pour indiquer que la boîte de dialogue est ouverte
          document.body.classList.add('modal-open');
      } else if (event.target.id === 'closeDialog') {
          // Cacher la superposition modale et la boîte de dialogue
          document.querySelector('.modal-overlay').style.display = 'none';
          document.getElementById('dialog').style.display = 'none';
          // Retirer la classe du corps pour indiquer que la boîte de dialogue est fermée
          document.body.classList.remove('modal-open');
      }
  });
  
</script>


  <?php echo "suppression : "."<br>" ; 
      if(isset($id_suppression)){ 
        var_dump($id_suppression) ;
      }else { 
        echo "echec de id suppression" ; 
      echo "suppression : "."<br>" ;
      } ; 
      echo '<br>' ; 
      echo "Super globale suppression : <br>" ; 
      if(isset($_POST['id_suppression'])){ 
        var_dump($_POST['id_suppression']) ;
      }else { 
        echo "echec de POST id suppression" ; 
      }

    ?>
	</body>
</html>