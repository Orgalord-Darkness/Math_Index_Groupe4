<?php
    //test de commit sur classe.php 
    require('../../../connexion/connexion.php') ; 
    $connexion = connexionBdd();
    if(isset($_POST['id_suppression'])){ 
        header('Location:supprimer.php') ;
        exit ; 
  }
  if($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifiez si la commande SQL est présente dans les données du formulaire
    }else{ 
      echo "erreur de if" ; 
    }
   $requete= $connexion->prepare("SELECT * FROM classroom") ; 
   $requete->execute() ; 
   $classes = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel= "stylesheet" href = "style.css">
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
    <h1 class = "titre_section">Administration</h1>
    <div class = "classe">
        <h1>Gestion classe</h1>
        <form>
            <label for = "recherche">Rechercher une classe </label>
            <br>
            <input name= "recherche">
    <input type = "submit">
     <a class = "bouton_ajouter" href = "ajouter_classes.php">
        Ajouter +
      </a>

        </form>
        <table>
              <thead>
                  <th>Nom classe</th>
                  <th>Modifier</th>
                  <th>Supprimer</th>
              </thead>
              <tbody>
                  <tr>
          <form>
                      <?php
         
            if(isset($_GET['recherche'])){ 
               echo " recherche : <br>" ; 
              var_dump($_GET['recherche']) ; 
              $recherche = $_GET['recherche'] ; 
              $requete = $connexion->prepare("SELECT * FROM classroom WHERE name = :nom") ; 
              $requete->bindParam(':nom',$recherche) ; 
              $requete->execute() ; 
              $resultats = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
              echo " resultats <br>" ; 
              var_dump($resultats) ; 
              foreach($resultats as $ligne){ 
                  echo "<tr>" ; 
                  echo "<td>".$ligne['name']."</td>" ;
                  echo "<td><form action='modif_classes.php'>
                         <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                           <button type='submit' name='modif'>Modifier " . $ligne['id'] . "</button>
                           </form></td>";


                    echo "<td><form method='post'>
                          <button class = 'openDialog'name='id_suppression' value='" . $ligne['id'] . "'>Supprimer</button></form></td>";
                    echo "</tr>" ;
              }
            }else{ 
              foreach($classes as $ligne){ 
                echo "<tr>" ;
                echo "<td>".$ligne['name']."</td>" ;
                echo "<td><form action='modif_classes.php'>
                       <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                         <button type='submit' name='modif'>Modifier " . $ligne['id'] . "</button>
                         </form></td>";


                  echo "<td><form action = 'supprimer.php'>
                        <input type = 'hidden' name = 'table' value  = 'classroom'>
                        <button class = 'openDialog'name='id_suppression' value='" . $ligne['id'] . "'>Supprimer</button></form></td>";
                echo "</tr>" ;
              }
            }
                      ?>
          </form>
                      <!-- <td><button> <a href = "modif_classes.php">Modifier</a></button></td>
                      <td><button id = "OpenDialog">Supprimer</button></td> -->
                  </tr>
              </tbody>
        </table>
    </div>
    <!-- <div class="modal-overlay"></div>
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
      <form>
        <button id="closeDialog">Annuler</button>
        <button name = "id_suppression" id = "confirm">Confirmer</button>
      </form>
    </div>
  </div> -->
  <script>
    // JavaScript pour ouvrir et fermer la boîte de dialogue
    document.getElementById('openDialog').addEventListener('click', function() {
      // Afficher la superposition modale et la boîte de dialogue
      document.querySelector('.modal-overlay').style.display = 'block';
      document.getElementById('dialog').style.display = 'block';
      // Ajouter une classe au corps pour indiquer que la boîte de dialogue est ouverte
      document.body.classList.add('modal-open');
    });
    document.getElementById('closeDialog').addEventListener('click', function() {
      // Cacher la superposition modale et la boîte de dialogue
      document.querySelector('.modal-overlay').style.display = 'none';
      document.getElementById('dialog').style.display = 'none';
      // Retirer la classe du corps pour indiquer que la boîte de dialogue est fermée
      document.body.classList.remove('modal-open');
    });
  </script>
</body>
</html>