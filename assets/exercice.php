<?php
// Connexion à la base de données en utilisant la fonction connexionBdd()
$connexion = connexionBdd();

$sql = "SELECT name, thematic_id, difficulty, duration, keywords, exercice_file_id FROM exercise";

// Exécution de la requête
$result = $connexion->query($sql);

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
                      // Vérifier si la requête a réussi
                      if ($result->rowCount() > 0) {
                          // Parcourir les résultats et afficher dans le tableau HTML
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<tr>";
                              echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['thematic_id']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['difficulty']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
                              echo "<td class=\"gras_time\">" . htmlspecialchars($row['keywords']) . "</td>";
                              echo "<td><div class=\"bulle_mc\">" . htmlspecialchars($row['exercice_file_id']) . "</div></td>";
                              echo "</tr>";
                              echo'CA MARCHE';
                          }
                      } else {
                          // En cas d'erreur dans la requête
                          echo "<p>Vous n'avez pas encore créé d'exercice.</p>";
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
                if ($result) {
                          // Parcourir les résultats et afficher dans le tableau HTML
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo "<tr>";
                              echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['thematic_id']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['difficulty']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
                              echo "<td class=\"gras_time\">" . htmlspecialchars($row['keywords']) . "</td>";
                              echo "<td><div class=\"bulle_mc\">" . htmlspecialchars($row['exercice_file_id']) . "</div></td>";
                              echo "</tr>";
                              echo'CA MARCHE';
                          }
                      } else {
                          // En cas d'erreur dans la requête
                          echo "Erreur dans la requête : " . $connexion->errorInfo()[2];
                      }
                      ?>
                </tbody>
                </table>
        </div>
        <div class="pagination">PAGINATION</div>
    </div>
</div>
