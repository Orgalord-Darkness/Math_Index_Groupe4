<?php
	if(isset($_POST['thematique']) && isset($_POST['motscles'])){ 
		$thematique = $_POST['thematique'] ; 
		$motscles = $_POST['motscles'] ;
		$difficulte = $_POST['difficulte'] ; 

		$requete = $connexion->prepare("SELECT id FROM thematic WHERE name = :thematicname") ; 
        $requete->bindParam(':thematicname', $thematique) ; 
        $test_thema = $requete->execute() ;  
        $id_thematic = $requete->fetchAll(PDO::FETCH_ASSOC) ;    
        $id_theme = implode(';', array_column($id_thematic, 'id'));

		$requete = $connexion->prepare("SELECT * FROM exercise WHERE thematic_id = :thema AND keywords = :motscles AND difficulty = :niveau") ;
		$requete->bindParam(':thema', $id_theme, PDO::PARAM_INT) ; 
		$requete->bindParam(':motscles',$motscles) ;
		$requete->bindParam(':niveau',$difficulte, PDO::PARAM_INT) ; 
		$requete->execute() ; 
		$resultats = $requete->fetchAll(PDO::FETCH_ASSOC) ;  
		$nbreResult = count($resultats); 

		foreach($resultats as $ligne){ 
			$id_file = $ligne['exercice_file_id'] ;
			$requete=$connexion->prepare("SELECT name FROM file WHERE id = :pdf") ;  
			$requete->bindParam(':pdf',$id_file) ; 
			$requete->execute();
			$pdf_exos = $requete->fetchAll(PDO::FETCH_ASSOC);  
			$fichier_exercice = implode(';', array_column($pdf_exos, 'name'));

			$id_correct = $ligne['correction_file_id'] ; 
			$requete=$connexion->prepare("SELECT name FROM file WHERE id = :correct") ;  
			$requete->bindParam(':correct',$id_correct) ; 
			$requete->execute();
			$pdf_correct = $requete->fetchAll(PDO::FETCH_ASSOC);  
			$fichier_correction = implode(';', array_column($pdf_correct, 'name'));
		}

		
	}else{ 
		$erreur = 'true' ; 
	}
	$requete = $connexion->prepare("SELECT * FROM exercise") ; 
	$requete->execute() ; 
	$exercices = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
?>
<style>
	form{
		display : flex ; 
		flex-direction : row ;
		
	}
</style>
<div class="title_categ">Rechercher un exercice</div>
<div class="php_content">
	<div class="bloc_contenu3">
		<form method = "POST" action = '?page=recherche'>
			<label for="thematique">Thématique :</label>
			<select name = "thematique">
			<?php 
				$requete = $connexion->prepare("SELECT DISTINCT thematic_id FROM exercise");
				$requete->execute();
				$ids = $requete->fetchAll(PDO::FETCH_ASSOC);
				$themes = [] ; 
				foreach($ids as $id){ 
				 	$requete_theme = $connexion->prepare("SELECT DISTINCT name FROM thematic WHERE id = :id") ; 
					$requete_theme->bindParam(':id', $id['thematic_id'], PDO::PARAM_INT) ; 
					$requete_theme->execute() ; 
					 $theme = $requete_theme->fetch(PDO::FETCH_ASSOC) ;  // Utilisez fetch() pour récupérer une seule ligne
					if($theme) {  // Vérifiez si le résultat est non vide
					 	$themes[] = $theme['name'] ;  
					 }
				}
				for($ind = 0 ; $ind < count($themes) ; $ind++){ 
				echo "<option value='".$themes[$ind]."'>".$themes[$ind]."</option>"; 
				}
			?>
			</select>
			<label for ="difficulte">Difficulté : </label>
			<select name = "difficulte">
			<?php 
				for($ind = 0 ; $ind < 12 ; $ind++){
					echo "<option value = ".$ind.">Niveau".$ind."</option>" ; 
				}
			?>
			</select>
			<label for = "motscles">Mots clés :</label>
			<input name = "motscles">
			<div class="container_button">
				<button type  ="submit" name = "recherche">Rechercher</button>
			</div>
		</form>
		<table>
             <thead>
                <th class="big_table">Nom</th>
                <th class="big_table">Difficulté</th>
                 <th class="big_table">Mots clés</th>
				<th class="big_table">Durée</th>
                <th class="big_table">Fichiers</th>
                 <th class = "big_table" >Actions</th>
            </thead>
             <tbody>
                <form method=post>
                              <?php
								if(isset($resultats)){

										foreach($resultats as $ligne) { 
											echo "<tr>" ; 
											echo "<td>".$ligne['name']."</td>" ; 
											echo "<td>".$ligne['difficulty']."</td>" ; 
											echo "<td>".$ligne['keywords']."</td>" ; 
											echo "<td>".$ligne['duration']."</td>" ;
											echo "<td><a href='/Math_Index_Groupe4/assets/administration/fichiers/" . $fichier_exercice . "' download>Exercice</a> || " . "<a href='/Math_Index_Groupe4/assets/administration/fichiers/" . $fichier_correction . "' download>Correction</a></td>";
										   echo "<td>
										   <form method='post'>
												<div class='bouton_suppr'>
													  <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
													  <img src='ico/modifier.svg' alt='Bouton modifier'>&nbsp;
													  <a href='?page=modif_ex&id_modif=" . $ligne['id'] . "'>Modifier</a>
												</div>
											</form>
											<form method='POST'>
												<div class='bouton_suppr'>
													  <input type='hidden' name='id_suppression' value='" . $ligne['id'] . "'>
													  <a href='?page=supp&table=exercise&id_suppression=" . $ligne['id'] . "'>
													  <img src='ico/supprimer.svg' alt='Bouton supprimer'>&nbsp;Supprimer</a>
												</div>
											</form>
										</td>";
								echo "<tr>" ;  
											echo "</tr>" ; 
										}
								}else{
                                  foreach($exercices as $ligne){ 
                                    echo "<tr>" ; 

                                    $id_file = $ligne['exercice_file_id'] ;
                                    $requete=$connexion->prepare("SELECT DISTINCT name FROM file WHERE id = :pdf") ;  
                                    $requete->bindParam(':pdf',$id_file) ; 
                                    $requete->execute();
                                    $pdf_exos = $requete->fetchAll(PDO::FETCH_ASSOC);  
                                    $fichier_exercice = implode(';', array_column($pdf_exos, 'name'));

                                    $id_correct = $ligne['correction_file_id'] ; 
                                    $requete=$connexion->prepare("SELECT DISTINCT name FROM file WHERE id = :correct") ;  
                                    $requete->bindParam(':correct',$id_correct) ; 
                                    $requete->execute();
                                    $pdf_correct = $requete->fetchAll(PDO::FETCH_ASSOC);  
                                    $fichier_correction = implode(';', array_column($pdf_correct, 'name'));

									echo "<td>".$ligne['name']."</td>" ; 
                                    echo "<td>" ."Niveau : ". $ligne['difficulty'] . "</td>";
                                    echo "<td><div class = 'bulle_mc'>" . $ligne['keywords'] ."</div>" ."</td>";
									echo "<td>".$ligne['duration']." h00"."</td>" ; 
									echo "<td><a href='/Math_Index_Groupe4/assets/administration/fichiers/" . $fichier_exercice . "' download>Exercice</a> || " . "<a href='/Math_Index_Groupe4/assets/administration/fichiers/" . $fichier_correction . "' download>Correction</a></td>";
                
                                      echo "<td>
                                               <form method='post'>
                                                    <div class='bouton_suppr'>
                                                          <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                                                          <img src='ico/modifier.svg' alt='Bouton modifier'>&nbsp;
                                                          <a href='?page=modif_ex&id_modif=" . $ligne['id'] . "'>Modifier</a>
                                                    </div>
                                                </form>
                                                <form method='POST'>
                                                    <div class='bouton_suppr'>
                                                          <input type='hidden' name='id_suppression' value='" . $ligne['id'] . "'>
                                                          <a href='?page=supp&table=exercise&id_suppression=" . $ligne['id'] . "'>
                                                          <img src='ico/supprimer.svg' alt='Bouton supprimer'>&nbsp;Supprimer</a>
                                                    </div>
                                                </form>
                                            </td>";
                                    echo "<tr>" ; 
                                  }
								}
                              ?>
                            </form>
                            </tbody>
                          </table> 
	</div>
</div>