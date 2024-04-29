<?php 
$connexion = connexionBdd();

// Comptage total des enregistrements
$total_rows = 10;
$page_afficher = 4;
$current_page = isset($_GET['num']) ? intval($_GET['num']) : 1;

// Calcul des limites
$start_from = ($current_page - 1) * $page_afficher;

// Requête pour récupérer les données de la page actuelle
$requete = $connexion->prepare("SELECT * FROM `exercise` LIMIT :start_from, :records_per_page");
$requete->bindParam(':start_from', $start_from, PDO::PARAM_INT);
$requete->bindParam(':records_per_page', $page_afficher, PDO::PARAM_INT);
$requete->execute();
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['rechercher'])){
  if(isset($_POST['mots_recherche'])){  
    $mot = $_POST['mots_recherche'] ; 
    if(empty($mot)){ 
      echo "veuillez saisir un mot pour la recherche" ; 
    }else{ 
      $requete = $connexion->prepare("SELECT * FROM exercise WHERE name = :mot OR keywords = :mot OR name = origin_name ; ") ; 
      $requete->bindParam(':mot', $mot) ; 
      $requete->execute() ;
      $resultats = $requete->fetchAll(PDO::FETCH_ASSOC) ;  
    }
  }
}
?>

<body>
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
<p class="title_exo">Rechercher des exercices</p>
          <p>Rechercher un exercice par un nom :</p>
    <div class="container_one_exo">
    <form class="contribu_form" method="POST">
         <div class="container_admin_search">
            <input type="text" name="mots_recherche" placeholder="Rechercher par nom...">
            <button type="submit" class="btn-search" name = "rechercher">Rechercher</button>
            <a href="?page=add_ex" class="bouton_ajouter">Ajouter +</a>  
          </div>
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
                              <?php
                                if(isset($resultats)){ 
                                  // echo "<table>".
                                  //     "<thead> 
                                  //       <th class='big_table'>Nom</th>
                                  //       <th class='big_table'>Thématiques</th>
                                  //       <th>Difficulté</th>
                                  //       <th>Durée</th>
                                  //       <th class='big_table'>Mots clés</th>
                                  //       <th>Fichiers</th>
                                  //       <th>Modifier</th>
                                  //       <th>Supprimer</th>
                                  //     </thead>"
                                  //   ."<tbody>" ; 

                                  foreach($resultats as $ligne){ 
                                    echo "<tr>" ; 
                                    // echo "<td>" . $ligne['id'] . "</td>";
                                    echo "<td>" . $ligne['name'] . "</td>";
                                    // echo "<td>" . $ligne['classroom_id'] . "</td>";
                                    // echo "<td>" . $ligne['thematic_id'] . "</td>";
                                    $id_th= $ligne['thematic_id'] ; 
                                    $requete = $connexion->prepare("SELECT name FROM thematic WHERE id = :id;");
                                    $requete->bindParam(':id',$id_th) ; 
                                    $requete->execute();
                                    $thema = $requete->fetchAll(PDO::FETCH_ASSOC);  
                                    $theme = implode(';', array_column($thema, 'name'));

                                    $id_file = $ligne['exercice_file_id'] ;
                                    $requete=$connexion->prepare("SELECT DISTINCT name FROM file WHERE id = :pdf") ;  
                                    $requete->bindParam(':pdf',$id_file) ; 
                                    $requete->execute();
                                    $pdf_exos = $requete->fetchAll(PDO::FETCH_ASSOC);  
                                    $fichier_exercice = implode(';', array_column($pdf_exos, 'name'));

                                    $id_correct = $ligne['correction_file_id'] ; 
                                    $requete=$connexion->prepare("SELECT DISTINCT name FROM file WHERE id = :correct") ;  
                                    $requete->bindParam(':correct',$id_correct) ; 
                                    $requete->execute();
                                    $pdf_correct = $requete->fetchAll(PDO::FETCH_ASSOC);  
                                    $fichier_correction = implode(';', array_column($pdf_correct, 'name'));


                                    echo "<td>".$theme."</td>" ;
                                    // echo "<td>" . $ligne['chapter'] . "</td>";            
                                    echo "<td>" ."Niveau : ". $ligne['difficulty'] . "</td>";
                                    echo "<td>".$ligne['duration']." heure"."</td>" ; 
                                    echo "<td><div class = 'bulle_mc'>" . $ligne['keywords'] ."</div>" ."</td>";
                                    // echo "<td>" . $ligne['origin_id'] . "</td>";
                                    // echo "<td>" . $ligne['origin_name'] . "</td>"; 
                                    // echo "<td>" . $ligne['origin_information'] . "</td>"; 
                                    echo "<td>" .  $fichier_exercice." - ". $fichier_correction . "</td>";  
                                    // echo "<td>" . $ligne['created_by_id'] . "</td>"; 
                                    echo "<td><form method='post' action='?page=modif_ex'>
                                      <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                      <button type='submit' name='modif'>Modifier " . $ligne['id'] . "</button>
                                  </form></td>";
                                      echo "<td><form method = 'POST' action='?page=supp'>
                                      <input type = 'hidden' name = 'table' value = 'exercise'>
                                      <button class = 'openDialog'name='id_suppression' value='" . $ligne['id'] . "'>Supprimer</button></form></td>";

                                    echo "<tr>" ; 
                                  }
                                   $total_pages = ceil($total_rows / $page_afficher);
                                   // echo "</tbody>.</table>" ; 
                                }else{ 
                                  foreach($donnees as $ligne){ 
                                    echo "<tr>" ; 
                                    // echo "<td>" . $ligne['id'] . "</td>";
                                    echo "<td>" . $ligne['name'] . "</td>";
                                    // echo "<td>" . $ligne['classroom_id'] . "</td>";
                                    // echo "<td>" . $ligne['thematic_id'] . "</td>";
                                    $id_th= $ligne['thematic_id'] ; 
                                    $requete = $connexion->prepare("SELECT name FROM thematic WHERE id = :id;");
                                    $requete->bindParam(':id',$id_th) ; 
                                    $requete->execute();
                                    $thema = $requete->fetchAll(PDO::FETCH_ASSOC);  
                                    $theme = implode(';', array_column($thema, 'name'));

                                    $id_file = $ligne['exercice_file_id'] ;
                                    $requete=$connexion->prepare("SELECT DISTINCT name FROM file WHERE id = :pdf") ;  
                                    $requete->bindParam(':pdf',$id_file) ; 
                                    $requete->execute();
                                    $pdf_exos = $requete->fetchAll(PDO::FETCH_ASSOC);  
                                    $fichier_exercice = implode(';', array_column($pdf_exos, 'name'));

                                    $id_correct = $ligne['correction_file_id'] ; 
                                    $requete=$connexion->prepare("SELECT DISTINCT name FROM file WHERE id = :correct") ;  
                                    $requete->bindParam(':correct',$id_correct) ; 
                                    $requete->execute();
                                    $pdf_correct = $requete->fetchAll(PDO::FETCH_ASSOC);  
                                    $fichier_correction = implode(';', array_column($pdf_correct, 'name'));


                                    echo "<td>".$theme."</td>" ;
                                    // echo "<td>" . $ligne['chapter'] . "</td>";            
                                    echo "<td>" ."Niveau : ". $ligne['difficulty'] . "</td>";
                                    echo "<td>".$ligne['duration']." heure"."</td>" ; 
                                    echo "<td><div class = 'bulle_mc'>" . $ligne['keywords'] ."</div>" ."</td>";
                                    // echo "<td>" . $ligne['origin_id'] . "</td>";
                                    // echo "<td>" . $ligne['origin_name'] . "</td>"; 
                                    // echo "<td>" . $ligne['origin_information'] . "</td>"; 
                                    echo "<td>" .  $fichier_exercice." - ". $fichier_correction . "</td>";  
                                    // echo "<td>" . $ligne['created_by_id'] . "</td>"; 
                                    echo "<td><form method='post' action='?page=modif_ex'>
                                      <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                      <button type='submit' name='modif'>Modifier " . $ligne['id'] . "</button>
                                  </form></td>";
                                      echo "<td><form method = 'POST' action='?page=supp'>
                                      <input type = 'hidden' name = 'table' value = 'exercise'>
                                      <button class = 'openDialog'name='id_suppression' value='" . $ligne['id'] . "'>Supprimer</button></form></td>";

                                    echo "<tr>" ; 
                                  }
                                }
                                   $total_pages = ceil($total_rows / $page_afficher);
                              ?>
                            </form>
                            </tbody>
                          </table>
                        </div>
                      <?php
                         echo "<div class='pagination'>";
                                  for ($i = 1; $i <= $total_pages; $i++) {
                                      echo "<a href='?page=admin_ex&num=$i'" . ($current_page == $i ? " class='active'" : "") . ">$i</a>";
                                  }
                          echo "</div>";
                      ?>
                  </div>
              </div>
          </div>
    </div>
</div>

</section>
<div class="modal-overlay"></div>
<<!-- div id="dialog" class="dialog">
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

</div> -->

<!-- <script>
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

</script> -->
 <?php
  // echo "suppression : "."<br>" ; 
//   if(isset($id_suppression)){ 
//     var_dump($id_suppression) ;
//   }else { 
//     echo "echec de id suppression" ; 
//   echo "suppression : "."<br>" ;
//   } ; 
//   echo '<br>' ; 
//   echo "Super globale suppression : <br>" ; 
//   if(isset($_POST['id_suppression'])){ 
//     var_dump($_POST['id_suppression']) ;
//   }else { 
//     echo "echec de POST id suppression" ; 
//   }
// echo "<br> Le thème est :". $theme;
?>
</body>
</html>