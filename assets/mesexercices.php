<?php
if(isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];

    $sql = "SELECT name, thematic_id, difficulty, duration, keywords, exercice_file_id 
    FROM exercise
    INNER JOIN user ON exercise.created_by_id = user.id
    WHERE user.email = :email";
    
    $stmt = $connexion->prepare($sql);

    $stmt->bindParam(':email', $user_email);
    $stmt->execute();

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
                            echo "<p>Vous n'avez pas encore créé d'exercice.</p>";
                        }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">PAGINATION</div>
            </div>
        </div>
        <?php

} else {
    echo 'non, TG, Vous ne passez PASSSS!!!!';
}
?>
