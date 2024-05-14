<?php
if(isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];

    //SCRIPT PHP PAGINATION
    $resultats_par_page = 2;
    $requete_total = $connexion->prepare("SELECT COUNT(*) AS total FROM exercise INNER JOIN user ON exercise.created_by_id = user.id WHERE user.email = :email");
    $requete_total->bindParam(':email', $user_email); // Ajout du paramètre :email
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



    $requete_total = $connexion->prepare("SELECT COUNT(*) AS total FROM exercise INNER JOIN user ON exercise.created_by_id = user.id WHERE user.email = :email");
    $requete_total->bindParam(':email', $user_email); // Ajout du paramètre :email
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

    $requete = $connexion->prepare("SELECT name, thematic_id, difficulty, duration, keywords, exercice_file_id, correction_file_id
                                    FROM exercise
                                    INNER JOIN user ON exercise.created_by_id = user.id
                                    WHERE user.email = :email
                                    LIMIT :offset, :limit;");
    $requete->bindParam(':email', $user_email);
    $requete->bindParam(':offset', $offset, PDO::PARAM_INT);
    $requete->bindParam(':limit', $resultats_par_page, PDO::PARAM_INT);
    $requete->execute();
    $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="php_content">
    <div class="title_categ">Mes exercices</div>
    <div class="bloc_contenu">
        <div class="container_one_exo">
            <p class="title_exo">Vous pouvez modifier ou supprimer un de vos exercices</p>
            <table>
                <thead>
                    <th class="big_table">Nom</th>
                    <th class="big_table">Thématiques</th>
                    <th>Difficulté</th>
                    <th>Durée</th>
                    <th class="big_table">Mots clés</th>
                    <th>Fichiers</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                    if (!empty($donnees)) {
                        foreach ($donnees as $row) {
                            $id_file = $row['exercice_file_id'] ;
                            $requete=$connexion->prepare("SELECT DISTINCT name FROM file WHERE id = :pdf") ;  
                            $requete->bindParam(':pdf',$id_file) ; 
                            $requete->execute();
                            $pdf_exos = $requete->fetchAll(PDO::FETCH_ASSOC);  
                            $fichier_exercice = implode(';', array_column($pdf_exos, 'name'));

                            $id_correct = $row['correction_file_id'] ; 
                            $requete=$connexion->prepare("SELECT DISTINCT name FROM file WHERE id = :correct") ;  
                            $requete->bindParam(':correct',$id_correct) ; 
                            $requete->execute();
                            $pdf_correct = $requete->fetchAll(PDO::FETCH_ASSOC);  
                            $fichier_correction = implode(';', array_column($pdf_correct, 'name'));
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['thematic_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['difficulty']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
                            echo "<td class=\"gras_time\">" . htmlspecialchars($row['keywords']) . "</td>";
                            echo "<td><a href='/Math_Index_Groupe4/assets/administration/fichiers/" . $fichier_exercice . "' download>Exercice</a> || " . "<a href='/Math_Index_Groupe4/assets/administration/fichiers/" . $fichier_correction . "' download>Correction</a></td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<p>Vous n'avez pas encore créé d'exercice.</p>";
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
<?php
}
?>
