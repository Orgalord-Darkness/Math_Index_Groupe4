<?php
    $affichage = "Choisir un fichier à télécharger" ;
    $affichageC = "Choisir un fichier à télécharger" ; 
    if(isset($_POST['nom_exercice'])){
            $nom_exercice = $_POST['nom_exercice'] ; 
            $thematique = $_POST['thematique'] ; 
            $classe = $_POST['classe'] ; 
            $nchapitre = $_POST['nchapitre'] ; 
            $difficulte = $_POST['difficulte'] ; 
            $duree = $_POST['duree'] ; 
            $motscles = $_POST['motscles'] ; 
            $info = $_POST['info'] ;
            $origine = $_POST['origine'] ; 
        
        if(!empty($nom_exercice)){ 
            $requete_thema= $connexion->prepare("SELECT id FROM thematic WHERE name = :nom") ;
            $requete_thema->bindParam(':nom',$thematique) ; 
            $requete_thema->execute() ; 
            $id_thematique = $requete_thema->fetchAll(PDO::FETCH_ASSOC) ; 
            $id_thema = implode(';',array_column($id_thematique,'id')) ; 
            
            $requete_classe = $connexion->prepare("SELECT id FROM classroom WHERE name = :nom") ; 
            $requete_classe->bindParam(':nom',$classe) ;
            $requete_classe->execute() ; 
            $tabclasse = $requete_classe->fetchAll(PDO::FETCH_ASSOC) ;         $id_classe = implode(';',array_column($tabclasse,'id')) ;
            
            $requete_origine = $connexion->prepare("SELECT id FROM origin WHERE name = :nom") ; 
            $requete_origine->bindParam(':nom',$origine) ;
            $requete_origine->execute() ; 
            $tabori = $requete_origine->fetchAll(PDO::FETCH_ASSOC) ; 
            $id_origine= implode(';',array_column($tabori,'id')) ;

        }
        if(isset($_POST['envoyer'])){ 
            if (!empty($_FILES['pdfExos']['name']) && !empty($_FILES['pdfCorrect']['name'])) {
                $fichierExerciceNom = $_FILES['pdfExos']['name']; // Nom du fichier
                $fichierTemp = $_FILES['pdfExos']['tmp_name'] ; 
                $fichierType = $_FILES['pdfExos']['type']; // Type MIME du fichier
                $fichierTaille = $_FILES['pdfExos']['size']; // Taille du fichier en octets
                $emplacement =  move_uploaded_file($fichierTemp,  "C:\\wamp64\\www\\Math_Index_Groupe4\\assets\\administration\\fichiers\\"  . $fichierExerciceNom);
                if($emplacement){ 
                    $chemin =   "C:\\wamp64\\www\\Math_Index_Groupe4\\assets\\administration\\fichiers\\" .$fichierExerciceNom; 
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
                $emplacement =  move_uploaded_file($fichierTemp, "C:\\wamp64\\www\\Math_Index_Groupe4\\assets\\administration\\fichiers\\". $fichierCorrectionNom);
                if($emplacement){ 
                    $chemin = "C:\\wamp64\\www\\Math_Index_Groupe4\\assets\\administration\\fichiers\\".$fichierCorrectionNom; 
                }
                $requete=$connexion->prepare("INSERT INTO file(`id`, `name`, `original_name`,`extension`, `size`) 
                    VALUES(Null, :name, :chemin, :extension, :taille) ; ") ;  

                $requete->bindParam(':name',$fichierCorrectionNom) ;
                $requete->bindParam(':chemin', $chemin) ; 
                $requete->bindParam(':extension', $fichierType) ;
                $requete->bindParam(':taille', $fichierTaille, PDO::PARAM_INT) ;  
                $requete->execute();
                

                //requete d'insertion d'exercice 
                $requete_pdfExos = $connexion->prepare("SELECT DISTINCT  id FROM file WHERE name = :nom") ; 
                $requete_pdfExos->bindParam(':nom',$fichierExerciceNom) ;
                $requete_pdfExos->execute() ; 
                $tabpdfExos = $requete_pdfExos->fetchAll(PDO::FETCH_ASSOC) ; 
                $id_pdfExos = implode(';',array_column($tabpdfExos,'id')) ; 

                $requete_pdfCorrection = $connexion->prepare("SELECT DISTINCT id FROM file WHERE name = :nom") ; 
                $requete_pdfCorrection->bindParam(':nom',$fichierCorrectionNom) ;
                $verif = $requete_pdfCorrection->execute() ; 
                $tabpdfCorrection = $requete_pdfCorrection->fetchAll(PDO::FETCH_ASSOC) ; 
                $id_pdfCorrection = implode(';',array_column($tabpdfCorrection,'id')) ; 

                $requete = $connexion->prepare("INSERT INTO exercise(`id`,`name`,`classroom_id`,`thematic_id`,`chapter`,`keywords`,
                `difficulty`,`duration`,`origin_id`,`origin_name`,`origin_information`,`exercice_file_id`,`correction_file_id`,
                `created_by_id`) VALUES(NULL,:nom, :id_class, :id_thematique, :nchapitre, :motscles, :difficulte, :duree,
                :id_origine, :origine, :infos,:id_pdfExos,:id_pdfCorrect,:id_Auteur ) ;") ; 
                $requete->bindParam(':nom', $nom_exercice) ;
                $requete->bindParam(':id_class', $id_classe, PDO::PARAM_INT ) ;
                $requete->bindParam(':id_thematique', $id_thema, PDO::PARAM_INT) ;
                $requete->bindParam(':nchapitre', $nchapitre) ;
                $requete->bindParam(':motscles', $motscles) ;
                $requete->bindParam(':difficulte', $difficulte) ;
                $requete->bindParam(':duree', $duree) ;
                $requete->bindParam(':id_origine', $id_origine, PDO::PARAM_INT) ; 
                $requete->bindParam(':origine', $origine) ; 
                $requete->bindParam(':infos', $info) ;
                $requete->bindParam(':id_pdfExos', $id_pdfExos, PDO::PARAM_INT ) ; 
                $requete->bindParam(':id_pdfCorrect', $id_pdfCorrection, PDO::PARAM_INT) ;
                $requete->bindParam(':id_Auteur', $id_origine, PDO::PARAM_INT) ;
                $test = $requete->execute(); 
            }
        }
    }else{ 
        $err = "err" ; 
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
                     <!--<div class="custom-file-upload">-->
                        <p><?php echo $affichage ; ?></p>
                        <img src="ico/nuage.png" width="40px" height="40px" >
                        <input type="file" name="pdfExos" >
                    <!-- </div>-->
                <br>
                <label for = "pdfExos">Fiche de corection(PDF, WORD)* : </label>
                    <!--<div class="custom-file-upload">-->
                    <p><?php echo $affichageC ; ?></p>
                        <img src="ico/nuage.png" width="40px" height="40px" >
                        <input type="file" name="pdfCorrect" >
                   <!-- </div>-->
                <br>
                    <input type="hidden" name="nom_exercice" value="<?php echo $nom_exercice; ?>">
                    <input type = 'hidden' name = 'thematique'value = "<?php echo $thematique ;?>">
                    <input type = 'hidden' name = 'classe'value = "<?php echo $classe ;  ?>">
                    <input type = 'hidden' name = 'nchapitre' value =" <?php echo $nchapitre ;  ?>">
                    <input type = 'hidden' name = 'difficulte' value = "<?php echo $difficulte ;  ?>">
                    <input type = 'hidden' name = 'motscles'value = "<?php echo $motscles;  ?>">
                    <input type = 'hidden' name = 'duree' value = "<?php echo $duree ;  ?>">
                    <input type = 'hidden' name = 'info' value = "<?php echo $info ;  ?>">
                    <input type = 'hidden' name = 'origine' value = "<?php echo $origine ;?>">
                <button name = "envoyer">Envoyer</button> 
            <?php
                // if(isset($nom_exercice)){ 
                //     var_dump($nom_exercice) ;
                //     echo "<br> tab pdf : </br>" ; 
                //     var_dump( $tabpdfCorrection) ;
                //     echo "id pdf Correction <br>" ;  
                //     var_dump( $id_pdfCorrection) ; 
                //     echo "nom fichier <br> : " ; 
                //     var_dump($fichierCorrectionNom) ; 
                //     echo 'emplacement <br>' ; 
                //     var_dump($emplacement) ; 
                //     echo 'requete pdf <br>' ; 
                //     var_dump($verif) ;  
                //     echo 'tab fichier exos <br>' ; 
                //     var_dump($tabpdfExos) ; 

                // }else{ 
                //     echo "pas de nom exercice" ; 
                // }
                // if(isset($err)){ 
                //     var_dump($err) ; 
                // }
                
            ?>
        </div>
</div>