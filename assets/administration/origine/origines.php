<?php
// Vérifiez si la commande SQL est présente dans les données du formulaire
// if (isset($_POST['id_suppression'])) {
//     // Récupérez la commande SQL à partir des données du formulaire
//     $id_suppression = $_POST['id_suppression'];
//     $requete = $connexion->prepare("DELETE FROM origin WHERE id = :id");
//     $requete->bindParam(':id', $id_suppression);
//     $requete->execute();
// } else {
//     echo "erreur de suppression";
// }

//SCRIPT PHP PAGINATION
$resultats_par_page = 2;

$requete_total = $connexion->prepare("SELECT COUNT(*) AS total FROM origin;");
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

$requete = $connexion->prepare("SELECT * FROM `origin` LIMIT :offset, :limit;");
$requete->bindParam(':offset', $offset, PDO::PARAM_INT);
$requete->bindParam(':limit', $resultats_par_page, PDO::PARAM_INT);
$requete->execute();
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

//SCRIPT PHP SELECT
$requete_all = $connexion->prepare("SELECT * FROM origin");
$requete_all->execute();
$origines = $requete_all->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="php_content">
    <div class="title_categ">Administration</div>
    <div class="sections">
        <a href="?page=contribu"><p>Contributeurs</p></a>
        <a href="?page=admin_ex"><p>Exercices</p></a>
        <a href="?page=matiere"><p>Matières</p></a>
        <a href="?page=classe"><p>Classes</p></a>
        <a href="?page=thematic"><p>Thématiques</p></a>
        <a href="?page=origine"><p>Origines</p></a>
    </div>
    <div class="bloc_contenu3">
        <p class="title_exo">Rechercher des origines</p>
        <p>Rechercher une origine par un nom :</p>
        <div class="container_one_exo">
            <form class="contribu_form" method="POST">
                <div class="container_admin_search">
                    <input type="text" name="recherche" placeholder="Rechercher par nom...">
                    <button type="submit" class="btn-search">Rechercher</button>
                    <a href="?page=add_ori" class="bouton_ajouter">Ajouter +</a>
                </div>
            </form>
            <table>
                <thead>
                    <th>Nom</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['recherche'])) {
                        $mots = $_POST['recherche'];
                        $requete = $connexion->prepare("SELECT * FROM origin WHERE name = :mots");
                        $requete->bindParam(':mots', $mots);
                        $requete->execute();
                        $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultats as $nom) {
                            echo "<tr>";
                            echo "<td>" . $nom['name'] . "</td>";
                            echo "<td>
                                    <form method='post'>
                                        <div class='bouton_suppr'>
                                            <input type='hidden' name='id_modif' value='" . $nom['id'] . "'>
                                            <img src='ico/modifier.svg' alt='Bouton modifier'>&nbsp;
                                            <a href='?page=modif_ori&id=" . $nom['id'] . "'>Modifier</a>
                                        </div>
                                    </form>
                                </td>";
                            echo "<td>
                                    <form method='POST'>
                                        <div class='bouton_suppr'>
                                            <input type='hidden' name='id_suppression' value='" . $nom['id'] . "'>
                                            <a name='id_suppression' href='#' onclick='this.parentNode.parentNode.submit(); return false;'>
                                            <img src='ico/supprimer.svg' alt='Bouton supprimer'>&nbsp;Supprimer</a>
                                        </div>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        foreach ($donnees as $ligne) {
                            echo "<tr>";
                            echo "<td>" . $ligne['name'] . "</td>";
                            echo "<td>
                                    <form method='post'>
                                        <div class='bouton_suppr'>
                                            <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                            <img src='ico/modifier.svg' alt='Bouton modifier'>&nbsp;
                                            <a href='?page=modif_ori&id_modif=" . $ligne['id'] . "'>Modifier</a>
                                        </div>
                                    </form>
                                </td>";
                            echo "<td>
                                <form method='post' action = '?page=supp'>
                                    <div class='bouton_suppr'>
                                        <input type='hidden' name='id_suppression' value='" . $ligne['id'] . "'>
                                        <img src='ico/supprimer.svg' alt='Bouton supprimer'>&nbsp;
                                        <a href='?page=supp&id_suppression=" . $ligne['id'] . "&table=origin'>Supprimer </a>
                                    </div>
                                </form>
                                </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class='pagination'>
            <?php
            if ($total_pages > 1) {
                echo "<a href='?page=origine&num=" . ($page > 1 ? $page - 1 : 1) . "'>&laquo;</a>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?page=origine&num=$i'" . ($page == $i ? " class='active'" : "") . ">$i</a>";
                }
                echo "<a href='?page=origine&num=" . ($page < $total_pages ? $page + 1 : $total_pages) . "'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
</div>
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
