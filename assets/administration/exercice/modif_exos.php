<?php
if(isset($_POST['id_modif'])){ 
  $id = $_POST['id_modif'] ; 
}
if(isset($_GET['id_modif'])){ 
  $id = $_GET['id_modif'] ; 
}

if(isset($_POST['id_modif'])){ 
  $id = $_POST['id_modif'] ; 
}
if(isset($_GET['id_modif'])){ 
  $id = $_GET['id_modif'] ; 
}

$erreurs = [];
$formulaire = [
    'nom_exercice' => isset($_POST['nom_exercice']) ? $_POST['nom_exercice'] : "",
    'classe' => isset($_POST['classe']) ? $_POST['classe'] : "",
    'thematique' => isset($_POST['thematique']) ? $_POST['thematique'] : "",
    'motscles' => isset($_POST['motscles']) ? $_POST['motscles'] : "",
    'nchapitre' => isset($_POST['nchapitre']) ? $_POST['nchapitre'] : "",
    'difficulte' => isset($_POST['difficulte']) ? $_POST['difficulte'] : "",
    'duree' => isset($_POST['duree']) ? $_POST['duree'] : "",
    'origine' => isset($_POST['origine']) ? $_POST['origine'] : "",
    'pdfExos' => isset($_FILES['pdfExos']) ? $_FILES['pdfExos'] : "",
    'pdfCorrect' => isset($_FILES['pdfCorrect']) ? $_FILES['pdfCorrect'] : "",
    'idAuteur' => isset($_POST['idAuteur']) ? $_POST['idAuteur'] : "",
];

// if(isset($_POST['envoyer'])) {
//     if(empty($_POST['nom_exercice'])) {
//         $erreurs['nom'][] = "le champ nom doit-être renseigner ";
//     }
//     if(empty($_POST['classe'])) {
//         $erreurs['classe'][] = "le champ classe doit-être renseigner ";
//     }
//     if(empty($_POST['thematique'])) {
//         $erreurs['thematique'][] = "le champ thématique doit-être renseigner ";
//     }
//     if(empty($_POST['motscles'])) {
//         $erreurs['motscles'][] = "le champ mots clés doit-être renseigner ";
//     }
//     if(empty($_POST['nchapitre'])) {
//         $erreurs['nchapitre'][] = "le champ chapitre doit-être renseigner ";
//     }
//     if(empty($_POST['difficulte'])) {
//         $erreurs['difficulte'][] = "le champ difficulté doit-être renseigner ";
//     }
//     if(empty($_POST['duree'])) {
//         $erreurs['duree'][] = "le champ durée doit-être renseigner ";
//     }
//     if(empty($_POST['origine'])) {
//         $erreurs['origine'][] = "le champ origine doit-être renseigner ";
//     }
//     if(empty($_FILES['pdfExos'])) {
//         $erreurs['pdfExos'][] = "le champ fichier exercice doit-être renseigner ";
//     }
//     if(empty($_FILES['pdfCorrect'])) {
//         $erreurs['pdfCorrect'][] = "le champ fichier correction doit-être renseigner ";
//     }
//     if(empty($_POST['idAuteur'])) {
//         $erreurs['idAuteur'][] = "le champ auteur doit-être renseigner ";
//     }
// }
if(empty($erreurs)) {
    if(isset($_POST['envoyer'])) {
        // $nouvelle_date = $_POST['Ndate'];
        if(empty($id) or $id === null or $_POST['id_modif'] === null){
          $id = $_POST['save_id'] ;  

        } 
        $nouveau_nom = $_POST['nom_exercice'];
        $nouvelle_classe = $_POST['classe'];
        $nouvelle_thematique = $_POST['thematique'];
        $nouveau_nchapitre = $_POST['nchapitre'];
        $nouvelle_difficulte = $_POST['difficulte'];
        $nouvelle_duree = $_POST['duree'];
        $nouveau_motscles = $_POST['motscles'];
        $nouvelles_infos = "TESTTESTTEST";
        $origin_n = $_POST['origine'];
        $nouvelle_origine = $_POST['origine'];

        $requete = $connexion->prepare("SELECT id FROM classroom WHERE name = :classname");
        $requete->bindParam(':classname', $nouvelle_classe);
        $test_class = $requete->execute();
        $id_class = $requete->fetchAll(PDO::FETCH_ASSOC);
        $classe = implode(';', array_column($id_class, 'id'));

        $requete = $connexion->prepare("SELECT id FROM thematic WHERE name = :thematicname");
        $requete->bindParam(':thematicname', $nouvelle_thematique);
        $test_thema = $requete->execute();
        $id_thematic = $requete->fetchAll(PDO::FETCH_ASSOC);
        $theme = implode(';', array_column($id_thematic, 'id'));

        $auteur = $_SESSION['email'] ; 
				$requete_createby = $connexion->prepare("SELECT id FROM user WHERE email = :email") ;
				$requete_createby->bindParam(':email',$auteur) ; 
				$requete_createby->execute() ; 
				$id_Aut = $requete_createby->fetchAll(PDO::FETCH_ASSOC) ; 
				$id_auteur = implode(';', array_column($id_Aut, 'id')) ; 

        $auteur = $_SESSION['email'] ; 
				$requete_createby = $connexion->prepare("SELECT id FROM user WHERE email = :email") ;
				$requete_createby->bindParam(':email',$auteur) ; 
				$requete_createby->execute() ; 
				$id_Aut = $requete_createby->fetchAll(PDO::FETCH_ASSOC) ; 
				$id_auteur = implode(';', array_column($id_Aut, 'id')) ; 

        $auteur = $_SESSION['email'] ; 
				$requete_createby = $connexion->prepare("SELECT id FROM user WHERE email = :email") ;
				$requete_createby->bindParam(':email',$auteur) ; 
				$requete_createby->execute() ; 
				$id_Aut = $requete_createby->fetchAll(PDO::FETCH_ASSOC) ; 
				$id_auteur = implode(';', array_column($id_Aut, 'id')) ; 

        $auteur = $_SESSION['email'] ; 
				$requete_createby = $connexion->prepare("SELECT id FROM user WHERE email = :email") ;
				$requete_createby->bindParam(':email',$auteur) ; 
				$requete_createby->execute() ; 
				$id_Aut = $requete_createby->fetchAll(PDO::FETCH_ASSOC) ; 
				$id_auteur = implode(';', array_column($id_Aut, 'id')) ; 

        $requete = $connexion->prepare("SELECT id FROM origin WHERE name = :originName");
        $requete->bindParam(':originName', $nouvelle_origine);
        $test_origin = $requete->execute();
        $id_origin = $requete->fetchAll(PDO::FETCH_ASSOC);
        $origin_id = implode(';', array_column($id_origin, 'id'));

        $pdfExos = isset($_FILES['pdfExos']) ? $_FILES['pdfExos'] : null;
        $pdfCorrect = isset($_FILES['pdfCorrect']) ? $_FILES['pdfCorrect'] : null;

        $email = $_SESSION['email'] ; 
        $requete_createdby = $connexion->prepare("SELECT id FROM user WHERE email = :email") ; 
        $requete_createdby->bindParam(':email',$email) ; 
        $requete_createdby->execute() ; 
        $auteur = $requete_createdby->fetchAll(PDO::FETCH_ASSOC) ; 
        $id_auteur = implode(';', array_column($auteur, 'id')) ; 

        if($_FILES['pdfExos']['error'] === UPLOAD_ERR_OK) {
          $fichierExerciceNom = $_FILES['pdfExos']['name']; // Nom du fichier
          $fichierTemp = $_FILES['pdfExos']['tmp_name'] ; 
          $fichierType = $_FILES['pdfExos']['type']; // Type MIME du fichier
          $fichierTaille = $_FILES['pdfExos']['size']; // Taille du fichier en octets
          $emplacement =  move_uploaded_file($fichierTemp, "C:\\wamp64\\www\\Math_Index_Groupe4\\assets\\administration\\fichiers\\" . $fichierExerciceNom);
          if($emplacement){ 
              $chemin = "C:\\wamp64\\www\\Math_Index_Groupe4\\assets\\administration\\fichiers\\".$fichierExerciceNom; 
          }
                $requete=$connexion->prepare("INSERT INTO file(`id`, `name`, `original_name`,`extension`, `size`) 
             VALUES(Null, :name, :chemin, :extension, :taille) ; ") ;  
     
                $requete->bindParam(':name',$fichierExerciceNom) ;
                $requete->bindParam(':chemin', $chemin) ; 
                $requete->bindParam(':extension', $fichierType) ;
                $requete->bindParam(':taille', $fichierTaille, PDO::PARAM_INT) ;  
                $test_fichierE = $requete->execute();
              

                $fichierCorrectionNom = $_FILES['pdfCorrect']['name']; // Nom du fichier
                $fichierTemp = $_FILES['pdfCorrect']['tmp_name'] ; 
                $fichierType = $_FILES['pdfCorrect']['type']; // Type MIME du fichier
                $fichierTaille = $_FILES['pdfCorrect']['size']; // Taille du fichier en octets
                $emplacement =  move_uploaded_file($fichierTemp,"C:\\wamp64\\www\\Math_Index_Groupe4\\assets\\administration\\fichiers\\" . $fichierCorrectionNom);
                if($emplacement){ 
                    $chemin = "C:\\wamp64\\www\\Math_Index_Groupe4\\assets\\administration\\fichiers\\".$fichierCorrectionNom ; 
                }
                $requete=$connexion->prepare("INSERT INTO file(`id`, `name`, `original_name`,`extension`, `size`) 
              VALUES(Null, :name, :chemin, :extension, :taille) ; ") ;  
      
                $requete->bindParam(':name',$fichierCorrectionNom) ;
                $requete->bindParam(':chemin', $chemin) ; 
                $requete->bindParam(':extension', $fichierType) ;
                $requete->bindParam(':taille', $fichierTaille, PDO::PARAM_INT) ;  
                $test_fichierC = $requete->execute();

                $requete = $connexion->prepare("SELECT id FROM file WHERE name = :name ") ; 
                $requete->bindParam(':name',$fichierExerciceNom) ; 
                $requete->execute() ; 
                $pdfExos = $requete->FetchAll(PDO::FETCH_ASSOC) ; 
                $pdf_exos = implode(';', array_column($pdfExos, 'id'));

                $requete = $connexion->prepare("SELECT id FROM file WHERE name = :name ") ; 
                $requete->bindParam(':name', $fichierCorrectionNom) ; 
                $requete->execute() ; 
                $pdfCorrect = $requete->FetchAll(PDO::FETCH_ASSOC) ; 
                $pdf_correction = implode(';', array_column($pdfCorrect, 'id'));
            }

        $requete = $connexion->prepare("UPDATE exercise SET name = :nom, classroom_id= :classe, thematic_id = :thematique, 
         chapter = :nchapitre,  keywords = :motscles, difficulty = :difficulte, duration = :duree, origin_id = :originId,
          origin_name = :originN, origin_information = :info, exercice_file_id = :pdfE, correction_file_id = :pdC,
           created_by_id = :email WHERE id = :id");
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        $requete->bindParam(':nom', $nouveau_nom);
        $requete->bindParam(':classe', $classe, PDO::PARAM_INT);
        $requete->bindParam(':thematique', $theme, PDO::PARAM_INT);
        $requete->bindParam(':motscles', $nouveau_motscles);
        $requete->bindParam(':nchapitre', $nouveau_nchapitre);
        $requete->bindParam(':difficulte', $nouvelle_difficulte);
        $requete->bindParam(':duree', $nouvelle_duree);
        $requete->bindParam(':pdfE', $pdf_exos, PDO::PARAM_INT);
        $requete->bindParam(':pdC', $pdf_correction, PDO::PARAM_INT);
        $requete->bindParam(':info', $nouvelles_infos);
        $requete->bindParam(':originN', $origin_n);
        $requete->bindParam(':originId', $origin_id, PDO::PARAM_INT);
        $requete->bindParam(':email', $id_auteur, PDO::PARAM_INT) ;  
        $requete->bindParam(':email', $id_auteur, PDO::PARAM_INT) ;  

        $resultat = $requete->execute();
        var_dump($resultat);

        if ($resultat) {
            echo "Les données ont été mises à jour avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la mise à jour des données.";
        }
    } else {
        echo "pas de modif ";
    }
} else {
    echo "GET";
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
    <div class = "bloc_contenu3">
      <form method= "POST" enctype = "multipart/form-data">
          <div>
            <div>
              <label for = "nom_exercice">Nom de l'exercice*</label>
              <br>
              <input type = "text" name = "nom_exercice" placeholder="Nom de l'exercice">
              <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'nom_exercice', $_POST['nom_exercice']) ;
                  }
                ?>
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
              <?php 
										$requete = $connexion->prepare("SELECT DISTINCT name FROM classroom ; ") ; 
										$requete->execute() ; 
										$classes = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
										foreach($classes as $classe){ 
											echo "<option value='".$classe['name']."'>".$classe['name']."</option>"; 
										}
									?>
              </select>
              <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'classe', $_POST['classe']) ;
                  }
                ?>
              <br>
              <br>
              <label for = "thematique">Thématique* : </label>
              <br>
              <select name = "thematique">
              <?php 
										$requete = $connexion->prepare("SELECT DISTINCT name FROM thematic ; ") ; 
										$requete->execute() ; 
										$themes = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
										foreach($themes as $theme){ 
											echo "<option value='".$theme['name']."'>".$theme['name']."</option>"; 
										}


									?>
              </select>
              <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'thematique', $_POST['thematique']) ;
                  }
                ?>
              <br>
              <br>
              <label for = "nchapitre">Numéro du chapitre : </label>
              <br>
              <input type = "text" name = "nchapitre">
              <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'nchapitre', $_POST['nchapitre']) ;
                  }
                ?>
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
              <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'motscles', $_POST['motscles']) ;
                  }
                ?>
              <br>
              <br>
              <label for = "origine">Origine : </label>
              <br>
              <input name = "origine">
              <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'origine', $_POST['origine']) ;
                  }
                ?>
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
              <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'difficulte', $_POST['difficulte']) ;
                  }
                ?>
              <br>
              <br>
              <label for = "duree">Durée</label>
              <br>
              <input type = "number" name = "duree">
              <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'duree', $_POST['duree']) ;
                  }
                ?>
              <!-- <input name = "id_manu" placeholder = "id_modif"> -->
              <!-- <input name = "id_manu" placeholder = "id_modif"> -->
              <!-- <input name = "id_manu" placeholder = "id_modif"> -->
              <!-- <input name = "id_manu" placeholder = "id_modif"> -->
            </div>
          </div>
          <br>
          <br>
          <label for = 'pdfExos'>Fichier exercice : </label>
                <br>
                <input type = "file" name = "pdfExos" placeholder = "ID exos">
                <?php
                  //vérifier si le formulaire a été envoyé  
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'pdfExos', $_FILES['pdfExos']) ;
                  }
                ?>
                <label for = 'pdfCorrect'>Fichier de correction : </label>
                <br>
                <input type = "file" name = "pdfCorrect" placeholder = "IDCorrect">
                <?php 
                  if(isset($_POST['envoyer'])){ 
                    addMessageIfValueEmpty($erreurs, 'pdfCorrect', $_FILES['pdfCorrect']) ;
                  }
                ?>
          <input type="hidden" name="id_modif" value="<?php echo $id; ?>">
          <?php var_dump($id); ?>
          <input type="hidden" name="id_modif" value="<?php echo $id; ?>">
          <?php var_dump($id); ?>
          <button name = "envoyer">Continuer</button>
          <?php 
      //     if(isset($resultat) && $resultat == "true"){
      //       echo "resultat"."<br>" ;  
      //       var_dump($resultat) ; 
      //     }else{ 
      //       echo "echec modif" ; 
      //     }
      //     if(isset($resultat) && $resultat == "true"){
      //       echo "resultat"."<br>" ;  
      //       var_dump($resultat) ; 
      //     }else{ 
      //       echo "echec modif" ; 
      //     }
      //     if(isset($resultat) && $resultat == "true"){
      //       echo "resultat"."<br>" ;  
      //       var_dump($resultat) ; 
      //     }else{ 
      //       echo "echec modif" ; 
      //     }
         
      //    echo "class : <br>" ;    
      //    if(isset($test_class)) { 
      //       var_dump($test_class) ;
      //       echo "id class : "."<br>" ; 
      //       var_dump($id_class) ; 
      //     }else{ 
      //       echo "Pas encore class" ; 
      //     }
      //     echo "thema : <br>" ; 
      //   if(isset($test_thema)){ 
      //     var_dump($test_thema) ;
      //     echo "id thema "."<br>" ; 
      //       var_dump($id_thematic) ;   
      //   }else { 
      //     echo "pas encore thematique" ; 
      //   }
      //   echo "<br> id modif :<br> " ; 
      //   if(isset($id)){ 
      //     echo "<br>" ; 
      //     echo "pourmodif" ; 
      //     var_dump($id) ; 
      //     echo"<br>"."Pour la superglobale" ; 
      //     var_dump($_POST['id_modif']) ; 
      //     echo "Pour les variables" ; 
      //   }
      //   if(isset($nouveau_nom)){ 
      //     var_dump($nouveau_nom) ; 
      //   }else{
      //    echo "<br> problème nom " ; }
      //   echo "<br> Resultat : <br> " ;   
      //   var_dump($resultat) ; 
      //   echo "<br>origine : <br>" ; 
      //   if(isset( $origin_id)){ 
      //     var_dump($origin_id) ; 
      //   }else{echo "erreur id origine <br>" ; 
      //   }
      //  echo "<br>requete select origine : <br> " ; 
      //  if(isset($test_origin)){ 
      //   var_dump($test_origin) ; 
      //  }else{ 
      //   echo " requete inexistante<br> " ; 
      //  }
      //  echo "resultat origine :<br> " ; 
      //  if(isset($id_origin)){ 
      //     var_dump($id_origin) ; 
      //  }else{ 
      //     echo "pas de résultat origine <br>" ; 
      //  }
      //   if(isset($nouveau_nom)){
      //     var_dump($nouveau_nom) ; 
      //   }else{ echo "erreur nom exercice <br>" ; }
      //   echo "fichiers exo insert : <br>" ; 
      //   if(isset($test_fichierE)){ 
      //     var_dump($test_fichierE) ; 
      //   }else{ 
      //     echo "inexistant<br>" ; 
      //   }
      //   if(isset($test_fichierC)){ 
      //     var_dump($test_fichierC) ; 
      //   }else{ 
      //     echo "<br> inexistant" ; 
      //   }
      //   echo "pour les id de fichiers : " ; 
      //   if(isset($pdf_exos)){
      //     var_dump($pdf_exos) ; 
      //   }else{ 
      //     echo " inexistant " ; 
      //   }
      //    echo "class : <br>" ;    
      //    if(isset($test_class)) { 
      //       var_dump($test_class) ;
      //       echo "id class : "."<br>" ; 
      //       var_dump($id_class) ; 
      //     }else{ 
      //       echo "Pas encore class" ; 
      //     }
      //     echo "thema : <br>" ; 
      //   if(isset($test_thema)){ 
      //     var_dump($test_thema) ;
      //     echo "id thema "."<br>" ; 
      //       var_dump($id_thematic) ;   
      //   }else { 
      //     echo "pas encore thematique" ; 
      //   }
      //   echo "<br> id modif :<br> " ; 
      //   if(isset($id)){ 
      //     echo "<br>" ; 
      //     echo "pourmodif" ; 
      //     var_dump($id) ; 
      //     echo"<br>"."Pour la superglobale" ; 
      //     var_dump($_POST['id_modif']) ; 
      //     echo "Pour les variables" ; 
      //   }
      //   if(isset($nouveau_nom)){ 
      //     var_dump($nouveau_nom) ; 
      //   }else{
      //    echo "<br> problème nom " ; }
      //   echo "<br> Resultat : <br> " ;   
      //   var_dump($resultat) ; 
      //   echo "<br>origine : <br>" ; 
      //   if(isset( $origin_id)){ 
      //     var_dump($origin_id) ; 
      //   }else{echo "erreur id origine <br>" ; 
      //   }
      //  echo "<br>requete select origine : <br> " ; 
      //  if(isset($test_origin)){ 
      //   var_dump($test_origin) ; 
      //  }else{ 
      //   echo " requete inexistante<br> " ; 
      //  }
      //  echo "resultat origine :<br> " ; 
      //  if(isset($id_origin)){ 
      //     var_dump($id_origin) ; 
      //  }else{ 
      //     echo "pas de résultat origine <br>" ; 
      //  }
      //   if(isset($nouveau_nom)){
      //     var_dump($nouveau_nom) ; 
      //   }else{ echo "erreur nom exercice <br>" ; }
      //   echo "fichiers exo insert : <br>" ; 
      //   if(isset($test_fichierE)){ 
      //     var_dump($test_fichierE) ; 
      //   }else{ 
      //     echo "inexistant<br>" ; 
      //   }
      //   if(isset($test_fichierC)){ 
      //     var_dump($test_fichierC) ; 
      //   }else{ 
      //     echo "<br> inexistant" ; 
      //   }
      //   echo "pour les id de fichiers : " ; 
      //   if(isset($pdf_exos)){
      //     var_dump($pdf_exos) ; 
      //   }else{ 
      //     echo " inexistant " ; 
      //   }
      //    echo "class : <br>" ;    
      //    if(isset($test_class)) { 
      //       var_dump($test_class) ;
      //       echo "id class : "."<br>" ; 
      //       var_dump($id_class) ; 
      //     }else{ 
      //       echo "Pas encore class" ; 
      //     }
      //     echo "thema : <br>" ; 
      //   if(isset($test_thema)){ 
      //     var_dump($test_thema) ;
      //     echo "id thema "."<br>" ; 
      //       var_dump($id_thematic) ;   
      //   }else { 
      //     echo "pas encore thematique" ; 
      //   }
      //   echo "<br> id modif :<br> " ; 
      //   if(isset($id)){ 
      //     echo "<br>" ; 
      //     echo "pourmodif" ; 
      //     var_dump($id) ; 
      //     echo"<br>"."Pour la superglobale" ; 
      //     var_dump($_POST['id_modif']) ; 
      //     echo "Pour les variables" ; 
      //   }
      //   if(isset($nouveau_nom)){ 
      //     var_dump($nouveau_nom) ; 
      //   }else{
      //    echo "<br> problème nom " ; }
      //   echo "<br> Resultat : <br> " ;   
      //   var_dump($resultat) ; 
      //   echo "<br>origine : <br>" ; 
      //   if(isset( $origin_id)){ 
      //     var_dump($origin_id) ; 
      //   }else{echo "erreur id origine <br>" ; 
      //   }
      //  echo "<br>requete select origine : <br> " ; 
      //  if(isset($test_origin)){ 
      //   var_dump($test_origin) ; 
      //  }else{ 
      //   echo " requete inexistante<br> " ; 
      //  }
      //  echo "resultat origine :<br> " ; 
      //  if(isset($id_origin)){ 
      //     var_dump($id_origin) ; 
      //  }else{ 
      //     echo "pas de résultat origine <br>" ; 
      //  }
      //   if(isset($nouveau_nom)){
      //     var_dump($nouveau_nom) ; 
      //   }else{ echo "erreur nom exercice <br>" ; }
      //   echo "fichiers exo insert : <br>" ; 
      //   if(isset($test_fichierE)){ 
      //     var_dump($test_fichierE) ; 
      //   }else{ 
      //     echo "inexistant<br>" ; 
      //   }
      //   if(isset($test_fichierC)){ 
      //     var_dump($test_fichierC) ; 
      //   }else{ 
      //     echo "<br> inexistant" ; 
      //   }
      //   echo "pour les id de fichiers : " ; 
      //   if(isset($pdf_exos)){
      //     var_dump($pdf_exos) ; 
      //   }else{ 
      //     echo " inexistant " ; 
      //   }
        ?>        
      </form>
    </div>