<?php
  include_once("menu.php") ; 
    $id = $_POST['id_modif'] ; 

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Vérifiez si la clé 'id' est définie dans $_POST avant de l'accéde
                    // Récupérez les données du formulaire
        // echo "Test modification".$_POST['id'] ; 
        // if(isset($_POST['id_modif'])){
 
    if (isset($_POST['envoyer'])) {
        // $nouvelle_date = $_POST['Ndate'];
          $nouveau_exercice = $_POST['nom_exercice'] ; 
          // $nouvelle_matiere = $_POST['matiere'] ; 
          $nouvelle_classe = $_POST['classe'] ;  
          $nouvelle_thematique = $_POST['thematique']; 
          $nouveau_ncahpitre = $_POST['nchapitre'] ; 
          $nouvelle_difficulte = $_POST['difficulte'] ; 
          $nouvelle_duree = $_POST['duree'] ;
          $nouveau_motscles = $_POST['motscles'] ; 
          // $nouvelles_infos = $_POST['information'] ; 
          // $pdf_exos = $_POST['pdf_exos'] ; 
          // $pdf_correction = $_POST['pdf_correction'] ; 
          if($_POST['id_modif'] == null or $id ==null  ){ 
            $id = $_POST['id_manu'] ; 
          }
          $requete = $connexion->prepare("SELECT id FROM classroom WHERE name = :classname") ; 
          $requete->bindParam(':classname',$nouvelle_classe) ; 
          $test_class = $requete->execute() ;  
          $id_class = $requete->fetchAll(PDO::FETCH_ASSOC) ;

          $requete = $connexion->prepare("SELECT id FROM thematic WHERE name = :thematicname") ; 
          $requete->bindParam(':thematicname', $nouvelle_thematique) ; 
          $test_thema = $requete->execute() ;  
          $id_thematic = $requete->fetchAll(PDO::FETCH_ASSOC) ;           
                    // Connectez-vous à la base de données
                    // echo "nouvelles infos extra : ".$nouveaun_nom.' '.$nouveau_prenom ; 
                    // Préparez et exécutez la commande SQL pour la mise à jour
        $requete = $connexion->prepare("UPDATE exercise SET name = :nom, classroom_id= :classe, thematic_id = :thematique,  chapter = :nchapitre,  keywords = :motscles, difficulty = :difficulte, duration = :duree
          WHERE id = :id");
        $requete->bindParam(':id',$id , PDO::PARAM_INT);
        // $requete->bindParam(':date_nouvelle', $nouvelle_date);
        $requete->bindParam(':nom', $nouveau_nom);
        // $requete->bindParam(':matiere', $nouvelle_matiere); 
        $requete->bindParam(':classe', $id_class, PDO::PARAM_INT);
        $requete->bindParam(':thematique', $id_thematic, PDO::PARAM_INT);
        $requete->bindParam(':motscles', $nouveau_motscles) ; 
        $requete->bindParam(':nchapitre', $nouveau_nchapitre);
        $requete->bindParam(':difficulte', $nouvelle_difficulte) ;
        $requete->bindParam(':duree', $nouvelle_duree) ;  
                    
        $resultat = $requete->execute();
        var_dump($resultat) ; 

                    // Vérifiez si la mise à jour a réussi
        if ($resultat) {
          echo "Les données ont été mises à jour avec succès.";
        } else {
          echo "Une erreur s'est produite lors de la mise à jour des données.";
        }
      }
      else { 
        echo "pas de modif " ; 
      }
    }
    
?>
    <h1 class = "titre_section">Administration</h1>
    <div class = "ajout_exos">
      <form method= "POST">
        <h1>Modifier un exercice</h1>
          <div>
            <div>
              <label for = "nom_exercice">Nom de l'exercice*</label>
              <br>
              <input type = "text" name = "nom_exercice" placeholder="Nom de l'exercice">
              <br>
              <br>
              <label for = "matiere">Matière*</label>
              <br>
              <select name = "matiere">
                <option value= "mathematique">Mathématique</option>
                <option value = "physique">Physique</option>
              </select>
              <br>
              <br>
              <label for = "classe">Classe*</label>
              <br>
              <select name = "classe">
                <option value = "seconde">Seconde</option>
                <option value = "premiere">Première</option>
                <option value = "terminal">Terminal</option>
                <option value = "Seconde2">Seconde2</option>
              </select>
              <br>
              <br>
              <label for = "thematique">Thématique* : </label>
              <br>
              <select name = "thematique">
                <option value = "suite">Suite</option>
              </select>
              <br>
              <br>
              <label for = "nchapitre">Numéro du chapitre : </label>
              <br>
              <input type = "text" name = "nchapitre">
            </div>
            <div>
              <!-- <label for = "competence">Compétence</label>
              <br>
              <input type = "checkbox" name = "competence" value = "chercher">
              <label for="comptence">Chercher</label>
              <input type = "checkbox" name = "competence" value = "modeliser">
              <label for="comptence">Modéliser</label>
              <br>
              <input type = "checkbox" name = "competence" value = "representer">
              <label for="comptence">Représenter</label>
              <input type = "checkbox" name = "competence" value = "raisonner">
              <label for="comptence">Raisonner</label>
              <br>
              <input type = "checkbox" name = "competence" value = "calculer">
              <label for="comptence">Calculer</label>
              <input type = "checkbox" name = "competence" value = "communiquer">
              <label for="comptence">Communiquer</label>
              <br>
              <br> -->
              <label for = "motscles">Mots clés :</label>
              <br>
              <input name = "motscles" placeholer = "mots clés">
              <br>
              <label for = "difficulte">Difficultés :</label>
              <br>
              <select name = "difficulte">
                <option value = "Niveau1">Niveau 1</option>
                <option value = "Niveau2">Niveau 2</option>
                <option value = "Niveau3">Niveau 3</option>
                <option value = "Niveau4">Niveau 4</option>
                <option value = "Niveau5">Niveau 5</option>
                <option value = "Niveau6">Niveau 6</option>
                <option value = "Niveau7">Niveau 7</option>
                <option value = "Niveau8">Niveau 8</option>
                <option value = "Niveau9">Niveau 9</option>
                <option value = "Niveau10">Niveau 10</option>
                <option value = "Niveau11">Niveau 11</option>
              </select>
              <br>
              <br>
              <label for = "duree">Durée</label>
              <br>
              <input type = "number" name = "duree">
              <input name = "id_manu" placeholder = "id_modif">
            </div>
          </div>
          <br>
          <br>
          <button name = "envoyer">Continuer</button>
          <?php 
          if(isset($resultat) && $resultat == "true"){
            echo "resultat"."<br>" ;  
            var_dump($resultat) ; 
          }else{ 
            echo "echec modif" ; 
          }
         
         echo "class : <br>" ;    
         if(isset($test_class)) { 
            var_dump($test_class) ;
            echo "id"."<br>" ; 
            var_dump($id_class) ; 
          }else{ 
            echo "Pas encore class" ; 
          }
          echo "thema : <br>" ; 
        if(isset($test_thema)){ 
          var_dump($test_thema) ;
          echo "id"."<br>" ; 
            var_dump($id_thematic) ;   
        }else { 
          echo "pas encore thematique" ; 
        }
        echo "<br>" ; 
        echo "pourmodif" ; 
        var_dump($id) ; 
        echo"<br>"."Pour la superglobale" ; 
        var_dump($_POST['id_modif']) ; 
        echo "Pour les variables" ; 
        
          ?>
      </form>
    </div>