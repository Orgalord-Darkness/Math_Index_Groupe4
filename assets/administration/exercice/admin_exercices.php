<?php 
$connexion = connexionBdd();
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si la commande SQL est présente dans les données du formulaire
    if (isset($_POST['id_suppression'])) {
        // Récupérez l'identifiant de l'exercice à supprimer
        $id_suppression = $_POST['id_suppression'];

        // Effectuez la suppression
        $requete = $connexion->prepare("DELETE FROM exercise WHERE id = :id;");
        $requete->bindParam(':id', $id_suppression);
        $requete->execute();

        // Redirigez l'utilisateur vers la même page pour afficher les résultats
       // header("Location: nom_de_votre_page.php");
        //exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur de suppression";
    }
//}
	// include_once("menu.php") ; 
 //   $connexion = connexionBdd() ;
 //  if($_SERVER["REQUEST_METHOD"] == "POST") {
 //                // Vérifiez si la commande SQL est présente dans les données du formulaire
 //          if(isset($_POST['id_suppression'])) {
 //                    // Récupérez la commande SQL à partir des données du formulaire
 //            $id = $_POST['id_suppression'];
 //            var_dump($id) ; 
 //            $requete = $connexion->prepare("DELETE FROM exercise WHERE id = :id;");
 //            $requete->bindParam(':id', $id);
 //            $requete->execute();
 //          }else{ 
 //            echo "erreur de suppression" ; 
 //          }
        //else{ 
         // echo "erreur de if" ; 
        //}
        $requete = $connexion->prepare("SELECT * FROM `exercise` ;") ; 
        $requete->execute() ;
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC) ;  
        var_dump($donnees) ; 

        foreach($donnees as $ligne){ 
          echo "<tr>" ; 
          echo "<td>" . $ligne['id'] . "</td>";
          echo "<td>" . $ligne['name'] . "</td>";
          echo "<td>" . $ligne['classroom_id'] . "</td>";
          echo "<td>" . $ligne['thematic_id'] . "</td>";
          echo "<td>" . $ligne['chapter'] . "</td>";                
          echo "<td>" . $ligne['keywords'] . "</td>";
          echo "<td>" . $ligne['difficulty'] . "</td>";
          echo "<td>" . $ligne['origin_id'] . "</td>";
          echo "<td>" . $ligne['origin_name'] . "</td>"; 
          echo "<td>" . $ligne['origin_information'] . "</td>"; 
          echo "<td>" . $ligne['exercice_file_id'] . "</td>"; 
          echo "<td>" . $ligne['correction_file_id'] . "</td>"; 
          echo "<td>" . $ligne['created_by_id'] . "</td>"; 
          echo "<tr>" ; 
        }
        var_dump($_SERVER["REQUEST_METHOD"] ) ; 
?>
<body>
<div class="php_content">
    <div class="title_categ">Administration</div>
    <div class="sections">
				<a href="?contribu=1"><p>Contributeurs</p></a>
				<a href="?admin_ex=1"><p>Exercices</p></a>
				<a href="#"><p>Matières</p></a>
				<a href="?classe=1"><p>Classes</p></a>
				<a href="#"><p>Thématiques</p></a>
				<a href="?origine=1"><p>Origines</p></a>
			</div>
              <div class="bloc_contenu3">
                  <div class="container_one_exo">
                    <form method = "POST">
                        <div>
                          <label for = "rechercher">Rechercher un exercice</label>
                        </div>
                        <br>
                        <input name = "rechercher">
                        <button>Rechercher</button>
                            <a href="?add_ex=1" class = "bouton_ajouter">Ajouter +
                            </a>
                          
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
                                  <!--  <tr>
                                    <td>Donnée 1</td>
                                    <td>Donnée 2</td>
                                    <td>Donnée 3</td>
                                    <td class="gras_time">Donnée 3</td>
                                    <td>
                                      <div class="bulle_mc">Donnée 3</div>
                                  </td>
                                    <td>Donnée 3</td>
                                    Del
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
                                  </tr> -->
                                  <?php
                                      foreach($donnees as $ligne){ 
                                        echo "<tr>" ; 
                                        // echo "<td>" . $ligne['id'] . "</td>";
                                        echo "<td>" . $ligne['name'] . "</td>";
                                        echo "<td>" . $ligne['classroom_id'] . "</td>";
                                        echo "<td>" . $ligne['thematic_id'] . "</td>";
                                        // echo "<td>" . $ligne['chapter'] . "</td>";                
                                        // echo "<td>" . $ligne['keywords'] . "</td>";
                                        echo "<td>" . $ligne['difficulty'] . "</td>";
                                        // echo "<td>" . $ligne['origin_id'] . "</td>";
                                        // echo "<td>" . $ligne['origin_name'] . "</td>"; 
                                        // echo "<td>" . $ligne['origin_information'] . "</td>"; 
                                        echo "<td>" . $ligne['exercice_file_id'] . "</td>"; 
                                        echo "<td>" . $ligne['correction_file_id'] . "</td>"; 
                                        // echo "<td>" . $ligne['created_by_id'] . "</td>"; 
                                        echo "<td><form method='post' action='modif_exos.php'>
                                          <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                          <button type='submit' name='modif'>Modifier " . $ligne['id'] . "</button>
                                      </form></td>";


                                          echo "<td><form method='post'>
                                          <button class = 'openDialog'name='id_suppression' value='" . $ligne['id'] . "'>Supprimer</button></form></td>";

                                        echo "<tr>" ; 
                                      }
                                  ?>
                                </form>
                                </tbody>
                              </table>
                      </div>
                      <div class="pagination">PAGINATION</div>
                  </div>
              </div>
          </div>
    </div>
</div>

</section>
<div class="modal-overlay"></div>
<div id="dialog" class="dialog">
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
</div>

<script>
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

</script>


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

?>
</body>
</html>