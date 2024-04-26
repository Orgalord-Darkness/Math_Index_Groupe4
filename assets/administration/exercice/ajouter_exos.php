<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
		if(isset($_POST['envoyer'])){ 
			// $id = $_POST['id'] ; 
			$nom_exercice = $_POST['nom_exercice'] ; 
			$nouvelle_matiere = $_POST['matiere'] ;

			$nouvelle_classe = $_POST['classe'];
			$requete = $connexion->prepare("SELECT id FROM classroom WHERE name = :classe");
			$requete->bindParam(':classe', $nouvelle_classe);
			$requete->execute();
			$classe = $requete->fetchAll(PDO::FETCH_ASSOC);
			if ($classe) {
				$id_classe = implode(';', array_column($classe, 'id'));
			} else {
				// Gérer le cas où la classe n'a pas été trouvée dans la base de données
				echo "La classe spécifiée n'existe pas dans la base de données.";
			}
			

	        $nouvelle_thematique = $_POST['thematique'];
	        $requete= $connexion->prepare("SELECT id FROM thematic WHERE name = :thematique") ;
	        $requete->bindParam(':thematique', $nouvelle_thematique) ;
	        $requete->execute() ;
	        $id_thematique =  $requete->fetchAll(PDO::FETCH_ASSOC) ;  

	        $nouveau_nchapitre = $_POST['nchapitre'] ; 
	        $nouvelle_difficulte = $_POST['difficulte'] ; 
	        $nouvelle_duree = $_POST['duree'] ;

	        $nouvelle_origine = $_POST['origine'] ; 
	        $requete = $connexion->prepare("SELECT id FROM origin WHERE name = :origine") ; 
	        $requete->bindParam(':origine', $nouvelle_origine) ; 
	        $requete->execute() ; 
	        $id_origine = $requete->fetchAll(PDO::FETCH_ASSOC) ; 



	        $fichierExerciceNom = $_FILES['pdfExos']['name']; // Nom du fichier
	        $fichierTemp = $_FILES['pdfExos']['tmp_name'] ; 
			$fichierType = $_FILES['pdfExos']['type']; // Type MIME du fichier
			$fichierTaille = $_FILES['pdfExos']['size']; // Taille du fichier en octets
			$emplacement =  move_uploaded_file($fichierTemp, "C:/xampp/htdocs/Math_Index_Groupe4/assets/administration/" . $fichierExerciceNom);
			if($emplacement){ 
			    $chemin = "C:/xampp/htdocs/Math_Index_Groupe4/assets/administration/".$fichierExerciceNom; 
			}
            $requete=$connexion->prepare("INSERT INTO file(`id`, `name`, `original_name`,`extension`, `size`) 
   			 VALUES(Null, :name, :chemin, :extension, :taille) ; ") ;  
 
            $requete->bindParam(':name',$fichierExerciceNom) ;
            $requete->bindParam(':chemin', $chemin) ; 
            $requete->bindParam(':extension', $fichierType) ;
            $requete->bindParam(':taille', $fichierTaille, PDO::PARAM_INT) ;  
            $requete->execute();
 			

            $fichierCorrectionNom = $_FILES['pdfCorrect']['name']; // Nom du fichier
	        $fichierTemp = $_FILES['pdfCorrect']['tmp_name'] ; 
			$fichierType = $_FILES['pdfCorrect']['type']; // Type MIME du fichier
			$fichierTaille = $_FILES['pdfCorrect']['size']; // Taille du fichier en octets
			$emplacement =  move_uploaded_file($fichierTemp, "C:/xampp/htdocs/Math_Index_Groupe4/assets/administration/" . $fichierCorrectionNom);
			if($emplacement){ 
			    $chemin ="C:/xampp/htdocs/Math_Index_Groupe4/assets/administration/".$fichierCorrectionNom ; 
			}
            $requete=$connexion->prepare("INSERT INTO file(`id`, `name`, `original_name`,`extension`, `size`) 
    			VALUES(Null, :name, :chemin, :extension, :taille) ; ") ;  
  
            $requete->bindParam(':name',$fichierCorrectionNom) ;
            $requete->bindParam(':chemin', $chemin) ; 
            $requete->bindParam(':extension', $fichierType) ;
            $requete->bindParam(':taille', $fichierTaille, PDO::PARAM_INT) ;  
            $requete->execute();

            $requete = $connexion->prepare("SELECT id FROM file WHERE name = :name ") ; 
            $requete->bindParam(':name',$fichierExerciceNom) ; 
            $requete->execute() ; 
            $pdfExos = $requete->FetchAll(PDO::FETCH_ASSOC) ; 
            $id_pdfExos = implode(';', array_column($pdfExos, 'id'));

            $requete = $connexion->prepare("SELECT id FROM file WHERE name = :name ") ; 
            $requete->bindParam(':name', $fichierCorrectionNom) ; 
            $requete->execute() ; 
            $pdfCorrect = $requete->FetchAll(PDO::FETCH_ASSOC) ; 
            $id_pdfCorrection = implode(';', array_column($pdfCorrect, 'id'));

	        $nouveau_motscles = $_POST['motscles'] ; 
	        $nouvelles_infos = $_POST['information'] ; 

	        //$pdf_exos = $_POST['pdf_exos'] ;
	        //$pdf_correction = $_POST['pdf_correction'] ; 
	     //    $requete2 = $connexion->prepare("INSERT INTO file ('id', 'name', 'original_name', 'extension', 'size') VALUES(:pdf_exos, :pdf_correction") ; 
	   		// $requete2->bindParam(':pdf_correction', $pdf_correction) ;
	   		// $requete2->bindParam(':pdf_exos', $pdf_exos) ;


	       // $requete = $connexion->prepare("SELECT id FROM file WHERE name = :pdf_exos") ; 
	        // $id_pdfExos = $requete->execute() ; 
	        
	        $id_Auteur = $_POST['idAuteur'] ;
	        $origine_nom = $_POST['origine'] ;
	        // $requete = $connexion->prepare("SELECT id FROM file WHERE name = :pdf_correction");  
	        // $id_pdfCorrection = $requete->execute() ; 

	        $requete = $connexion->prepare("INSERT INTO exercise(`id`,`name`,`classroom_id`,`thematic_id`,`chapter`,`keywords`,`difficulty`,`duration`,`origin_id`,`origin_name`,`origin_information`,`exercice_file_id`,`correction_file_id`,`created_by_id`) 
			VALUES(NULL,:nom, :id_class, :id_thematique, :nchapitre, :motscles, :difficulte, :duree, :id_origine, :origine, :infos,:id_pdfExos,:id_pdfCorrect,:id_Auteur ) ;") ; 
	        $requete->bindParam(':nom', $nom_exercice) ;
	        $requete->bindParam(':id_class', $id_classe, PDO::PARAM_INT ) ;
	        $requete->bindParam(':id_thematique', $id_thematique, PDO::PARAM_INT) ;
	        // $requete->bindParam(':matiere', $nouvelle_matiere) ;
	        $requete->bindParam(':nchapitre', $nouveau_nchapitre) ;
	        $requete->bindParam(':motscles', $nouveau_motscles) ;
	        $requete->bindParam(':difficulte', $nouvelle_difficulte) ;
	        $requete->bindParam(':duree', $nouvelle_duree) ;
	        $requete->bindParam(':id_origine', $id_origine, PDO::PARAM_INT) ; 
	        $requete->bindParam(':origine', $origine_nom) ; 
	        $requete->bindParam(':infos', $nouvelles_infos) ;
	        $requete->bindParam(':id_pdfExos', $id_pdfExos, PDO::PARAM_INT ) ; 
	        $requete->bindParam(':id_pdfCorrect', $id_pdfCorrection , PDO::PARAM_INT) ;
	        $requete->bindParam(':id_Auteur', $id_Auteur, PDO::PARAM_INT) ;
		    $test = $requete->execute(); 
		}
	}
?>
<body>
<div class="php_content">
    <div class="title_categ">Administration</div>
		<div class="sections">
        <a href="?page=contribu"><p>Contributeurs</p></a>
        <a href="?page=admin_ex"><p>Exercices</p></a>
        <a href="#"><p>Matières</p></a>
        <a href="?page=classe"><p>Classes</p></a>
        <a href="#"><p>Thématiques</p></a>
        <a href="?page=origine"><p>Origines</p></a>
		</div>
			<div class="bloc_contenu3">
				<form method = "post" enctype = "multipart/form-data">
					<h1>Ajouter un exercice</h1>
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
									<option value = "Seconde1">Seconde1</option>
								</select>
								<br>
								<br>
								<label for = "thematique">Thématique* : </label>
								<br>
								<select name = "thematique">
									<option value = "suite">Suite</option>
									<option value = "Geometrie">Géométrie</option>
								</select>
								<br>
								<br>
								<label for = "nchapitre">Numéro du chapitre : </label>
								<br>
								<input type = "text" name = "nchapitre">
							</div>
							<div>
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
								<br>
								<br>
								<label for = "information">Information : </label>
								<br>
								<input name = "information">
								<br>
								<br>
								<label for = "origine"> Origine : </label>
								<br>
								<input name = "origine">
								<br>
								<br>
								<!-- <label for = "pdf_exos"> Ficher de l'exercice : </label>
								<br>
								<input type = "file" name = "pdf_exos">
								<br>
								<br>
								<label for = "pdf_correction"> Fichier de correction : </label>
								<br>
								<input type = "file" name = "pdf_correction"> -->
								<input type = "file" name = "pdfExos" placeholder = "ID exos">
								<input type = "file" name = "pdfCorrect" placeholder = "IDCorrect">
								<input type = "int" name = "idAuteur" placeholder = "Auteur">

							</div>
				
						</div>
						<br>
						<br>
						<button type = "submit" name = "envoyer">Continuer</button>
				</form>
				<?php
					if(isset($_POST['envoyer'])){ 
						var_dump($test) ; 
					}
				?>
			</div>
	</body>
</html>