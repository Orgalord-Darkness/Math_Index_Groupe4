<?php
// SCRIPT PHP SUPPRESSION
if (isset($_POST['id_suppression'])) {
    $id_suppression = $_POST['id_suppression'];
    $requete = $connexion->prepare("DELETE FROM user WHERE id = :id;");
    $requete->bindParam(':id', $id_suppression);
    $requete->execute();
}
//SCRIPT PHP PAGINATION
$resultats_par_page = 2; 

$requete_total = $connexion->prepare("SELECT COUNT(*) AS total FROM user;");
$requete_total->execute();
$total_rows = $requete_total->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages = ceil($total_rows / $resultats_par_page);

if (isset($_GET['num']) && is_numeric($_GET['num'])) {
    $page = intval($_GET['num']);
    if ($page < 1) {
        $page = 1;
    } elseif ($page > $total_pages) {
        $page = $total_pages;
    }
} else {
    $page = 1;
}

$offset = ($page - 1) * $resultats_par_page;

$requete = $connexion->prepare("SELECT * FROM `user` LIMIT :offset, :limit;");
$requete->bindParam(':offset', $offset, PDO::PARAM_INT);
$requete->bindParam(':limit', $resultats_par_page, PDO::PARAM_INT);
$requete->execute();
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

//SCRIPT PHP RECHERCHE
if (isset($_POST['recherche'])) {
    // AVEC UNE RECHERCHE
    $recherche = $_POST['recherche'];
    $requete = $connexion->prepare("SELECT * FROM user WHERE last_name LIKE :nom OR first_name LIKE :nom OR email LIKE :nom");
    $requete->bindValue(':nom', '%' . $recherche . '%');
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
} else {
    // SI AUCUNE RECHERCHE, AFFICHER TOUTES LES DONNÉES
    $requete = $connexion->prepare("SELECT * FROM user");
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="php_content">
  <div class="title_categ">Administration</div>
      <div class="sections">
          <a href="?page=contribu"><p>Contributeurs</p></a>
          <a href="?page=admin_ex"><p>Exercices</p></a>
          <a href="#"><p>Matières</p></a>
          <a href="?page=classe"><p>Classes</p></a>
          <a href="?page=thematic"><p>Thématiques</p></a>
          <a href="?page=origine"><p>Origines</p></a>
      </div>
      <div class="bloc_contenu3">
          <p class="title_exo">Gestion des contributeurs</p>
          <p>Rechercher un contributeur par un nom, prénom ou email :</p>
          <div class="container_one_exo">
              <form class="contribu_form" method="POST">
                  <div class="container_admin_search">
                    <input type="text" name="recherche" placeholder="Rechercher par nom...">
                      <button type="submit" class="btn-search">Rechercher</button>
                      <a href="?page=add_contribu" class="bouton_ajouter">Ajouter +</a>  
                  </div>
              </form>
          </div>
          <?php 
          if(isset($_POST['recherche'])) { ?>
                <div class='container_one_exo'>
                <p class='title_exo'>Résultats de la recherche</p>
                <table>
                <thead>
                <th class='big_table'>Nom</th>
                <th class='big_table'>Prénom</th>
                <th>Rôle</th>
                <th>Email</th>
                <th>Actions</th>
                </thead>
                <tbody> 
            <?php
              foreach ($resultats as $ligne) {
                echo "<tr>";
                echo "<td>" . $ligne['last_name'] . "</td>";
                echo "<td>" . $ligne['first_name'] . "</td>";
                echo "<td>" . $ligne['role'] . "</td>";
                echo "<td>" . $ligne['email'] . "</td>";
                $id = $ligne['id'];
                echo "<td>
                <form method='post'>
                              <div class='bouton_suppr'>
                                    <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                    <img src='ico/modifier.svg' alt='Bouton modifier'>&nbsp;
                                    <a href='?page=modif_contribu&id=" . $ligne['id'] . "'>Modifier</a>
                              </div>
                          </form>
                          <form method='POST'>
                              <div class='bouton_suppr'>
                                    <input type='hidden' name='id_suppression' value='" . $ligne['id'] . "'>
                                    <a name='id_suppression' href='#' onclick='this.parentNode.parentNode.submit(); return false;'>
                                    <img src='ico/supprimer.svg' alt='Bouton supprimer'>&nbsp;Supprimer</a>
                              </div>
                          </form>
                      </td>";
                      echo "</tr>";
              } ?>
                </tbody>
                </table>
                </div> 
            <?php
          } else {
              $chunked_data = array_chunk($donnees, $resultats_par_page);
              foreach ($chunked_data as $chunk) { ?>
                    <div class='container_one_exo'>
                    <p class='title_exo'>Tous les exercices</p>
                    <table>
                    <thead>
                    <th class='big_table'>Nom</th>
                    <th class='big_table'>Prénom</th>
                    <th>Rôle</th>
                    <th>Email</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                <?php
                  foreach ($chunk as $ligne) {
                      echo "<tr>";
                      echo "<td>" . $ligne['last_name'] . "</td>";
                      echo "<td>" . $ligne['first_name'] . "</td>";
                      echo "<td>" . $ligne['role'] . "</td>";
                      echo "<td>" . $ligne['email'] . "</td>";
                      $id = $ligne['id'];
                      echo "<td>
                          <form method='post'>
                              <div class='bouton_suppr'>
                                    <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                    <img src='ico/modifier.svg' alt='Bouton modifier'>&nbsp;
                                    <a href='?page=modif_contribu&id=" . $ligne['id'] . "'>Modifier</a>
                              </div>
                          </form>
                          <form method='POST'>
                              <div class='bouton_suppr'>
                                    <input type='hidden' name='id_suppression' value='" . $ligne['id'] . "'>
                                    <a name='id_suppression' href='#' onclick='this.parentNode.parentNode.submit(); return false;'>
                                    <img src='ico/supprimer.svg' alt='Bouton supprimer'>&nbsp;Supprimer</a>
                              </div>
                          </form>
                      </td>";
                      echo "</tr>";
                    }
                  }?>
                    </tbody>
                    </table>
                    </div>
                <?php
              }
                echo "<div class='pagination'>";
                /*&laquo; = VARIABLE HTML FAIT POUR LA PAGINATION... &laquo; = <-- et &rarr; = -->*/
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($page > 1) {
                        echo "<a href='?page=contribu&num=" . ($page - 1) . "'>&laquo;</a>";
                    }
                    echo "<a href='?page=contribu&num=$i'" . ($page == $i ? " class='active'" : "") . ">$i</a>";
                    }
                    if ($page < $total_pages) {
                        echo "<a href='?page=contribu&num=" . ($page + 1) . "'>&rarr;</a>";
                    }
                    echo "</div>";
                ?>
      </div>  
  </div>
