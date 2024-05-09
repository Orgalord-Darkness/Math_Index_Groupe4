<?php

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
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	// if(isset($_POST['envoyer'])){ 

	    //     if(empty($_POST['nom_exercice'])){ 
	    //         $erreurs['nom_exercice'][] = "le champ nom doit-être renseigner " ; 
	    //     }
	    //     if(empty($_POST['classe'])){ 
	    //         $erreurs['classe'][] = "le champ classe doit-être renseigner " ; 
	    //     }
	    //     if(empty($_POST['thematique'])){ 
	    //         $erreurs['thematique'][] = "le champ thématique doit-être renseigner " ; 
	    //     }
	    //     if(empty($_POST['motscles'])){ 
	    //         $erreurs['motscles'][] = "le champ mots clés doit-être renseigner " ; 
	    //     }
	    //     if(empty($_POST['nchapitre'])){ 
	    //         $erreurs['nchapitre'][] = "le champ chapitre doit-être renseigner " ; 
	    //     }
	    //     if(empty($_POST['difficulte'])){ 
	    //         $erreurs['difficulte'][] = "le champ difficulté doit-être renseigner " ; 
	    //     }
	    //     if(empty($_POST['duree'])){ 
	    //         $erreurs['duree'][] = "le champ durée doit-être renseigner " ; 
	    //     }
	    //     if(empty($_POST['origine'])){ 
	    //         $erreurs['origine'][] = "le champ origine doit-être renseigner " ; 
	    //     }
	    //     if(empty($_FILES['pdfExos'])){ 
	    //         $erreurs['pdfExos'][] = "le champ fichier exercice doit-être renseigner " ; 
	    //     }
	    //     if(empty($_FILES['pdfCorrect'])){ 
	    //         $erreurs['pdfCorrect'][] = "le champ fichier correction doit-être renseigner " ; 
	    //     }
	    //     if(empty($_POST['idAuteur'])){ 
	    //         $erreurs['idAuteur'][] = "le champ auteur doit-être renseigner " ; 
	    //     }
	    // }
        if(empty($erreurs)){ 
            if(isset($_POST['envoyer'])){ 
               $nom_exercice = $_POST['nom_exercice'] ; 
				$nouvelle_matiere = $_POST['matiere'] ;

		        $nouvelle_classe = $_POST['classe'] ;  
		        $requete = $connexion->prepare("SELECT id FROM classroom WHERE name =:classe; "); 
		        $requete->bindParam(':classe', $nouvelle_classe) ;
		        $id_classe = $requete->execute() ;
		        $id_classe = $requete->fetchAll(PDO::FETCH_ASSOC) ; 

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


				if (!empty($_FILES['pdfExos']['name']) && !empty($_FILES['pdfCorrect']['name'])) {
					$fichierExerciceNom = $_FILES['pdfExos']['name']; // Nom du fichier
					$fichierTemp = $_FILES['pdfExos']['tmp_name'] ; 
					$fichierType = $_FILES['pdfExos']['type']; // Type MIME du fichier
					$fichierTaille = $_FILES['pdfExos']['size']; // Taille du fichier en octets
					$emplacement =  move_uploaded_file($fichierTemp, "../fichiers/" . $fichierExerciceNom);
					if($emplacement){ 
						$chemin = "../fichiers/".$fichierExerciceNom; 
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
					$emplacement =  move_uploaded_file($fichierTemp, "../fichiers/" . $fichierCorrectionNom);
					if($emplacement){ 
						$chemin = "../fichiers/".$fichierCorrectionNom ; 
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

					$requete = $connexion->prepare("INSERT INTO exercise(`id`,`name`,`classroom_id`,`thematic_id`,`chapter`,`keywords`,`difficulty`,`duration`,`origin_id`,`origin_name`,`origin_information`,`exercice_file_id`,`correction_file_id`,`created_by_id`) VALUES(NULL,:nom, :id_class, :id_thematique, :nchapitre, :motscles, :difficulte, :duree, :id_origine, :origine, :infos,:id_pdfExos,:id_pdfCorrect,:id_Auteur ) ;") ; 
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
				}else{ 
					$erreurs['pdfExos'][] = "Le champ nom doit être renseigné." ;
					$erreurs['pdfCorrect'][] = "Le champ nom doit être renseigné." ;
				}
            }
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
									<option value = "seconde">Seconde</option>
									<option value = "premiere">Première</option>
									<option value = "terminal">Terminal</option>
									<option value = "Seconde1">Seconde1</option>
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
									<option value = "suite">Suite</option>
									<option value = "Geometrie">Géométrie</option>
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
								<br>
								<br>
								<label for = "information">Information : </label>
								<br>
								<input name = "information">
								<?php 
									if(isset($_POST['envoyer'])){ 
										addMessageIfValueEmpty($erreurs, 'information', $_POST['information']) ;
									}
								?>
								<br>
								<br>
								<label for = "origine"> Origine : </label>
								<br>
								<input name = "origine">
								<?php 
									if(isset($_POST['envoyer'])){ 
										addMessageIfValueEmpty($erreurs, 'origine', $_POST['origine']) ;
									}
								?>
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
								<label for = 'pdfExos'>Fichier exercice : </label>
								<br>
								<input type = "file" name = "pdfExos" placeholder = "ID exos">
								<?php 
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

							</div>
				
						</div>
						<br>
						<br>
						<button type = "submit" name = "envoyer">Continuer</button>
				</form>
				<?php
					if(isset($_POST['envoyer'])){ 
						//var_dump($test) ; 
					}
				?>
			</div>
	</body>
</html>