<?php 
 $connexion = connexionBdd();

                    // Comptage total des enregistrements
  $total_rows = 10;
  $page_afficher = 4;
  //indique le numéro de page actuel 
  $current_page = isset($_GET['num']) ? intval($_GET['num']) : 1;

  // Calcul des limites
  $start_from = ($current_page - 1) * $page_afficher;

  // Requête pour récupérer les données de la page actuelle
  $requete = $connexion->prepare("SELECT * FROM `exercise` LIMIT :start_from, :records_per_page");
  $requete->bindParam(':start_from', $start_from, PDO::PARAM_INT);
  $requete->bindParam(':records_per_page', $page_afficher, PDO::PARAM_INT);
  $requete->execute();
   $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
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
            <input type="text" name="rechercher" placeholder="Rechercher par nom...">
            <button type="submit" class="btn-search">Rechercher</button>
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
                                    echo "<td>".$theme."</td>" ;
                                    // echo "<td>" . $ligne['chapter'] . "</td>";            
                                    echo "<td>" ."Niveau : ". $ligne['difficulty'] . "</td>";
                                    echo "<td>".$ligne['duration']." heure"."</td>" ; 
                                    echo "<td>" . $ligne['keywords'] . "</td>";
                                    // echo "<td>" . $ligne['origin_id'] . "</td>";
                                    // echo "<td>" . $ligne['origin_name'] . "</td>"; 
                                    // echo "<td>" . $ligne['origin_information'] . "</td>"; 
                                    echo "<td>" . $ligne['exercice_file_id']." - ". $ligne['correction_file_id'] . "</td>";  
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
                                    //cette ligne calcul le nombre total de lien de pagination nécessaire et l'arrondi avec ceil. 
                                   $total_pages = ceil($total_rows / $page_afficher);
                              ?>
                            </form>
                            </tbody>
                          </table>
                        </div>
                      <?php
                        //div où apparaitra la pagination
                         echo "<div class='pagination'>";
                               for ($i = 1; $i <= $total_pages; $i++) {
                                //ici on a une balise a qui renvoie la page où l'on se trouve et le numéro de la partie du tableau divisé pour faire la pagination, la variable num 
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
echo "<br> Le thème est :". $theme;
?>
</body>
</html>