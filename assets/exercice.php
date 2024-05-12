<?php
//SCRIPT POUR RECUPERER LES 3 EXERCICES PUBLIER LES PLUS RECENTS :

$SQL = "SELECT * FROM exercise ORDER BY date_ajout DESC LIMIT 3";
$stmt = $connexion->query($SQL);

//SCRIPT PHP PAGINATION
$resultats_par_page = 2;

$requete_total = $connexion->prepare("SELECT COUNT(*) AS total FROM exercise;");
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

$requete = $connexion->prepare("SELECT name, thematic_id, difficulty, duration, keywords, exercice_file_id FROM exercise LIMIT :offset, :limit;");
$requete->bindParam(':offset', $offset, PDO::PARAM_INT);
$requete->bindParam(':limit', $resultats_par_page, PDO::PARAM_INT);
$requete->execute();
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="php_content">
    <div class="title_categ">Exercices</div>
    <div class="bloc_contenu">
        <div class="container_one_exo">
            <p class="title_exo">Nouveautés</p>
            <table>
                <thead>
                      <th class="big_table">Nom</th>
                      <th class="big_table">Thématiques</th>
                      <th>Difficulté</th>
                      <th>Durée</th>
                      <th class="big_table">Mots clés</th>
                      <th>Fichiers</th>
                  </thead>
                  <tbody>
                  <?php
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['thematic_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['difficulty']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
                            echo "<td class=\"gras_time\">" . htmlspecialchars($row['keywords']) . "</td>";
                            echo "<td><div class=\"bulle_mc\">" . htmlspecialchars($row['exercice_file_id']) . "</div></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<p>Il n'y a pas de nouvelle exercice pour la moment.</p>";
                    }
                    ?>
                  </tbody>
                </table>
        </div>
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
                </thead>
                <tbody>
                <?php
                    if (!empty($donnees)) {
                        foreach ($donnees as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['thematic_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['difficulty']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
                            echo "<td class=\"gras_time\">" . htmlspecialchars($row['keywords']) . "</td>";
                            echo "<td><div class=\"bulle_mc\">" . htmlspecialchars($row['exercice_file_id']) . "</div></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<p>Il n'y a pas d'exercice pour le moment.</p>";
                    }
                    ?>
                </tbody>
                </table>
        </div>
        <div class='pagination'>
            <?php
            if ($total_pages > 1) {
                echo "<a href='?page=classe&num=" . ($page > 1 ? $page - 1 : 1) . "'>&laquo;</a>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?page=classe&num=$i'" . ($page == $i ? " class='active'" : "") . ">$i</a>";
                }
                echo "<a href='?page=classe&num=" . ($page < $total_pages ? $page + 1 : $total_pages) . "'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
</div>
