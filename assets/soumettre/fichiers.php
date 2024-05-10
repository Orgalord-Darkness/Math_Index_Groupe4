<?php
    $affichage = "Choisir un fichier à télécharger" ;
    $affichageC = "Choisir un fichier à télécharger" ; 
    if(isset($_POST['envoyer'])){ 
        if(isset($_FILES['pdfExos'])){ 
           $affichage = $_FILES['pdfExos']['name'] ; 
            $fichierNom = $_FILES['pdfExos']['name'] ; //Nom du fichier 
            $fichierEmpl = $_FILES['pdfExos']['tmp_name'] ; //Emplacement temporaire du fichier
            $fichierExtension = $_FILES['pdfExos']['type'] ; //type du fichier 
            $fichierTaille = $_FILES['pdfExos']['size'] ; //taille du fichier 
            $emplacement =  move_uploaded_file($fichierEmpl, "C:/xampp/htdocs/Math_Index_Groupe4/assets/administration/fichiers" . $fichierNom);
            if($emplacement){ 
                $chemin = "C:/xampp/htdocs/Math_Index_Groupe4/assets/administration/fichiers".$fichierNom; 
            }

            $requete = $connexion->prepare("INSERT INTO file(`id`, `name`,`original_name`,`extension`,`size`)
            VALUES(Null, :nom, :chemin, :extension, :taille) ; ") ; 
            $requete->bindParam(':nom',$fichierNom) ; 
            $requete->bindParam(':chemin', $chemin) ;
            $requete->bindParam(':extension', $fichierExtension) ; 
            $requete->bindParam(':taille', $fichierTaille) ; 
            $requete->execute() ; 
             

            //requete d'insertion d'exercice 
            
	        // $requete = $connexion->prepare("INSERT INTO exercise(`id`,`name`,`classroom_id`,`thematic_id`,`chapter`,`keywords`,`difficulty`,`duration`,`origin_id`,`origin_name`,`origin_information`,`exercice_file_id`,`correction_file_id`,`created_by_id`) VALUES(NULL,:nom, :id_class, :id_thematique, :nchapitre, :motscles, :difficulte, :duree, :id_origine, :origine, :infos,:id_pdfExos,:id_pdfCorrect,:id_Auteur ) ;") ; 
	        // $requete->bindParam(':nom', $nom_exercice) ;
	        // $requete->bindParam(':id_class', $id_classe, PDO::PARAM_INT ) ;
	        // $requete->bindParam(':id_thematique', $id_thematique, PDO::PARAM_INT) ;
	        // // $requete->bindParam(':matiere', $nouvelle_matiere) ;
	        // $requete->bindParam(':nchapitre', $nouveau_nchapitre) ;
	        // $requete->bindParam(':motscles', $nouveau_motscles) ;
	        // $requete->bindParam(':difficulte', $nouvelle_difficulte) ;
	        // $requete->bindParam(':duree', $nouvelle_duree) ;
	        // $requete->bindParam(':id_origine', $id_origine, PDO::PARAM_INT) ; 
	        // $requete->bindParam(':origine', $origine_nom) ; 
	        // $requete->bindParam(':infos', $nouvelles_infos) ;
	        // $requete->bindParam(':id_pdfExos', $id_pdfExos, PDO::PARAM_INT ) ; 
	        // $requete->bindParam(':id_pdfCorrect', $id_pdfCorrection, PDO::PARAM_INT) ;
	        // $requete->bindParam(':id_Auteur', $id_Auteur, PDO::PARAM_INT) ;
		    //  $test = $requete->execute(); 
        }
        if(isset($_FILES['pdfCorrect'])){ 
            $affichageC= $_FILES['pdfCorrect']['name'] ; 
            $fichierNom = $_FILES['pdfCorrect']['name'] ; //Nom du fichier 
            $fichierEmpl = $_FILES['pdfCorrect']['tmp_name'] ; //Emplacement temporaire du fichier
            $fichierExtension = $_FILES['pdfCorrect']['type'] ; //type du fichier 
            $fichierTaille = $_FILES['pdfCorrect']['size'] ; //taille du fichier 
            $emplacement =  move_uploaded_file($fichierEmpl, "C:/xampp/htdocs/Math_Index_Groupe4/assets/administration/fichiers" . $fichierNom);
            if($emplacement){ 
                $chemin = "C:/xampp/htdocs/Math_Index_Groupe4/assets/administration/fichiers".$fichierNom; 
            }

            $requete = $connexion->prepare("INSERT INTO file(`id`, `name`,`original_name`,`extension`,`size`)
            VALUES(Null, :nom, :chemin, :extension, :taille) ; ") ; 
            $requete->bindParam(':nom',$fichierNom) ; 
            $requete->bindParam(':chemin', $chemin) ;
            $requete->bindParam(':extension', $fichierExtension) ; 
            $requete->bindParam(':taille', $fichierTaille) ; 
            $requete->execute() ; 
             

            //requete d'insertion d'exercice 
            
	        // $requete = $connexion->prepare("INSERT INTO exercise(`id`,`name`,`classroom_id`,`thematic_id`,`chapter`,`keywords`,`difficulty`,`duration`,`origin_id`,`origin_name`,`origin_information`,`exercice_file_id`,`correction_file_id`,`created_by_id`) VALUES(NULL,:nom, :id_class, :id_thematique, :nchapitre, :motscles, :difficulte, :duree, :id_origine, :origine, :infos,:id_pdfExos,:id_pdfCorrect,:id_Auteur ) ;") ; 
	        // $requete->bindParam(':nom', $nom_exercice) ;
	        // $requete->bindParam(':id_class', $id_classe, PDO::PARAM_INT ) ;
	        // $requete->bindParam(':id_thematique', $id_thematique, PDO::PARAM_INT) ;
	        // // $requete->bindParam(':matiere', $nouvelle_matiere) ;
	        // $requete->bindParam(':nchapitre', $nouveau_nchapitre) ;
	        // $requete->bindParam(':motscles', $nouveau_motscles) ;
	        // $requete->bindParam(':difficulte', $nouvelle_difficulte) ;
	        // $requete->bindParam(':duree', $nouvelle_duree) ;
	        // $requete->bindParam(':id_origine', $id_origine, PDO::PARAM_INT) ; 
	        // $requete->bindParam(':origine', $origine_nom) ; 
	        // $requete->bindParam(':infos', $nouvelles_infos) ;
	        // $requete->bindParam(':id_pdfExos', $id_pdfExos, PDO::PARAM_INT ) ; 
	        // $requete->bindParam(':id_pdfCorrect', $id_pdfCorrection, PDO::PARAM_INT) ;
	        // $requete->bindParam(':id_Auteur', $id_Auteur, PDO::PARAM_INT) ;
		    //  $test = $requete->execute(); 
        }
    }
?>
<?php

    // if(isset($_POST['envoyer'])){ 
    //     if(isset($_FILES['pdfExos'])){ 
    //         $fichierNom = $_FILES['pdfExos']['name'] ; //Nom du fichier 
    //         $fichierEmpl = $_FILES['pdfExos']['tmp_name'] ; //Emplacement temporaire du fichier
    //         $fichierExtension = $_FILES['pdfExos']['type'] ; //type du fichier 
    //         $fichierTaille = $_FILES['pdfExos']['size'] ; //taille du fichier 
    //         $emplacement = move_uploaded_file($fichierEmpl,"C:/Math_Index_Groupe4/assets/administration/fichier/".$fichierNom) ; 
    //         if($emplcement){ 
    //             $chemin = "C:/Math_Index_Groupe4/assets/administration/fichier/".$fichierNom ; 
    //         }
    //         $requete = $connexion->prepare("INSERT INTO file(`id`, `name`,`original_name`,`extension`,`size`)
    //         VALUES(Null, :nom, :chemin, :extension, :taille) ; ") ; 
    //     }
    // } 
?>
<div class="php_content">
    <div class="title_categ">Mes exercices</div>
    <div class="sections">
        <a href="?page=soumettre"><p>Informations générales</p></a>
        <a href="?page=source_soumettre"><p>Sources</p></a>
        <a href="?page=fichiers_soumettre"><p>Fichiers</p></a>
    </div>
        <div class="bloc_contenu3">
            <div class="title_soumettre">Fichiers</div>
            <br>
            <form method = "POST" enctype = "multipart/form-data">
                <label for = "pdfExos">Fiche exercice(PDF, WORD)* : </label>
                    <div class="custom-file-upload">
                        <p><?php echo $affichage ; ?></p>
                        <img src="ico/nuage.png" width="40px" height="40px" >
                        <input type="file" name="pdfExos" >
                    </div>
                <br>
                <label for = "pdfExos">Fiche de corection(PDF, WORD)* : </label>
                    <div class="custom-file-upload">
                    <p><?php echo $affichageC ; ?></p>
                        <img src="ico/nuage.png" width="40px" height="40px" >
                        <input type="file" name="pdfCorrect" >
                    </div>
                <input type = "file" name  ="pdfExos" placeholder = "Séléctionner un fichier">
                <br>
                <button name = "envoyer">Envoyer</button> 
        
        </div>
</div>