<?php 
$connexion = connexionBdd();

if (isset($_POST['id_suppression'])) {
    $id_suppression = $_POST['id_suppression'];
    $requete = $connexion->prepare("DELETE FROM user WHERE id = :id;");
    $requete->bindParam(':id', $id_suppression);
    $requete->execute();
}

$requete = $connexion->prepare("SELECT * FROM `user` ;") ; 
$requete->execute() ;
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC); 
    foreach($donnees as $ligne){ 
        echo "<tr>" ; 
        echo "<td>" . $ligne['last_name'] . "</td>";
        echo "<td>" . $ligne['first_name'] . "</td>";
        echo "<td>" . $ligne['role'] . "</td>";
        echo "<td>" . $ligne['email'] . "</td>";                
        echo "<tr>" ; 
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
          <p class="title_exo">Gestion des contributeurs</p>
          <p>Rechercher un contributeur par un nom, prénom ou email :</p>
          <div class="container_one_exo">
              <form class="contribu_form" method="POST">
                  <div class="container_admin_search">
                    <input type="text" name="rechercher" placeholder="Rechercher par nom...">
                      <button type="submit" class="btn-search">Rechercher</button>
                      <a href="?page=add_contribu" class="bouton_ajouter">Ajouter +</a>  
                  </div>
              </form>
          </div>
          <div class="container_one_exo">
              <p class="title_exo">Tous les exercices</p>
              <table>
                  <thead>
                      <th class="big_table">Nom</th>
                      <th class="big_table">Prénom</th>
                      <th>Rôle</th>
                      <th>Email</th>
                      <th>Actions</th>
                  </thead>
                  <tbody>
                  <?php
                          foreach($donnees as $ligne){ 
                              echo "<tr>" ; 
                              /* echo "<td>" . $ligne['id'] . "</td>";*/
                              echo "<td>" . $ligne['last_name'] . "</td>";
                              echo "<td>" . $ligne['first_name'] . "</td>";
                              echo "<td>" . $ligne['role'] . "</td>";
                              echo "<td>" . $ligne['email'] . "</td>";
                              $id = $ligne['id'];
                              echo "<td>
                                    <form method='post' action='modification_contri.php'>
                                    <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                    <a href='?page=modif_contribu&id=$id'>Modifier</a>
                                    </form>
                                    <form method='POST'>
                                        <input type='hidden' name='id_suppression' value='" . $ligne['id'] . "'>
                                        <button class='supprimer' type='submit'>Supprimer</button>
                                    </form>

                                    </td>";
                              echo "</tr>" ; 
                          }
                      ?>

                  </tbody>
              </table>
          </div>
          <div class="pagination">PAGINATION</div> 
      </div>  
  </div>
</div>
</div>  
</div>

