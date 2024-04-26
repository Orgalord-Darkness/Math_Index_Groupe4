<?php
    if(isset($_POT['envoyer'])){ 
        if(isset($_FILES['pdfExos'])){ 
            $fichierNom = $_FILES['pdfExos']['name'] ; //Nom du fichier 
            $fichierEmpl = $_FILES['pdfExos']['tmp_name'] ; //Emplacement temporaire du fichier
            $fichierExtension = $_FILES['pdfExos']['type'] ; //type du fichier 
            $fichierTaille = $_FILES['pdfExos']['size'] ; //taille du fichier 
            $emplacement = move_uploaded_file($fichierEmpl," ") ; 

            $requete = $connexion->prepare("INSERT INTO file(`id`, `name`,`original_name`,`extension`,`size`)
            VALUES(Null, :nom, :chemin, :extension, :taille) ; ") ; 
        }
    }
?>
<div class="php_content">
    <div class="title_categ">Mes exercices</div>
    <div class="sections">
        <a href="?page=soumettre"><p>Informations générales</p></a>
        <a href="?page=source_soumettre"><p>Sources</p></a>
        <a href="?page=fichiers_soumettre"><p>Fichiers</p></a>
    </div>
        <div class="bloc_contenu2">
            <h1><strong>Fichiers</strong></h1>
            <br>
            <form method = "POST" enctype = "multipart/form-data">
                <label for = "pdfExos">Fiche exercice(PDF, WORD)* : </label>
                <br>
                <input type = "file" name  ="pdfExos" placeholder = "Séléctionner un fichier">
                <br>
                <button name = "envoyer"> 
            </form> 
    
        </div>
</div>