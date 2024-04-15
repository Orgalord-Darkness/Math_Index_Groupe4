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
                    <tr>
                    <td>Donnée 1</td>
                    <td>Donnée 2</td>
                    <td>Donnée 3</td>
                    <td class="gras_time">Donnée 3</td>
                    <td>
                        <div class="bulle_mc">Donnée 3</div>
                    </td>
                    <td>Donnée 3</td>
                    </tr>
                    <tr>
                    <td>Donnée 4</td>
                    <td>Donnée 5</td>
                    <td>Donnée 6</td>
                    <td class="gras_time">Donnée 3</td>
                    <td>
                        <div class="bulle_mc">Donnée 3</div>
                    </td>
                    <td>Donnée 3</td>
                    </tr>
                    <tr>
                    <td>Donnée 7</td>
                    <td>Donnée 8</td>
                    <td>Donnée 9</td>
                    <td class="gras_time">Donnée 3</td>
                    <td>
                        <div class="bulle_mc">Donnée 3</div>
                    </td>
                    <td>Donnée 3</td>
                    </tr>
                </tbody>
                </table>
        </div>
        <div class="pagination">PAGINATION</div>
    </div>
</div>
