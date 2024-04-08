<link href="style2.css" rel="stylesheet">
<?Php 
require_once('base_dd.php');


if(isset($_POST['contactid'])) {
    $contactid = $_POST['contactid'];

    $recuperation = "SELECT * FROM user WHERE identifiant = $contactid";
    $requete = $mysqlClient ->query($recuperation);
    if($informations = $requete->fetch()) {   
?>
    <div class="row">
        <section>
            <h1 class="box-title">Modification</h1>
            <form name="contact" method="POST">
                <input class="box-input" type="hidden" name="contactid" value="<?= $contactid ?>">
                <div>
                    <label for="contact-nom">Votre nom * :</label>
                    <div>
                        <input class="box-input" type="text" id="nom" name="nom" value="<?= $informations['nom'] ?>">
                    </div>
                </div>
                <div>
                    <label for="prenom">Votre prénom * :</label>
                    <div>
                        <input class="box-input" type="text" id="prenom" name="prenom" value="<?= $informations['prenom'] ?>">
                    </div>
                </div>
                <div>
                    <label for="email">Votre email :</label>
                    <div>
                        <input class="box-input" type="email" id="email" name="email" value="<?= $informations['email'] ?>">
                    </div>
                </div>
                <div>
                    <label for="tel">Votre téléphone :</label>
                    <div>
                        <input class="box-input" type="tel" id="telephone" name="telephone" value="<?= $informations['telephone']?>">
                    </div>
                </div>
                <div>
                    <label for="objet">Objet * :</label>
                    <div>
                        <select class="box-input" id="objet" name="objet">
                            <option value="Offre de stage" <?= ($informations['objet'] == 'Offre de stage') ? 'selected' : '' ?>>Offre de stage</option>
                            <option value="Partenariat" <?= ($informations['objet'] == 'Partenariat') ? 'selected' : '' ?>>Partenariat</option>
                            <option value="Autre" <?= ($informations['objet'] == 'Autre') ? 'selected' : '' ?>>Autre</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="message">Message * :</label>
                    <div>
                        <textarea class="box-mess" name="message" id="message" rows="5"><?= $informations['message'] ?></textarea>
                    </div>
                </div>
                <div>
                    <div></div>
                    <button class="box-button" type="submit" name="modifier">Modifier</button>
                </div>
            </form>
        </section>
        
    </div>
<?php
    }
} else {
    echo "L'id n'est pas correcte";
}

//MODIFICATION
if(isset($_POST['modifier'])) { 
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['objet']) && isset($_POST['message'])) { 

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $objet = $_POST['objet'];
        $message = $_POST['message'];

        $sqlupdate = "UPDATE contact SET nom = :nom, prenom = :prenom , email = :email, telephone = :telephone, objet = :objet, message = :message, date = :date WHERE identifiant = :contactid";
        $date = date("Y-m-d H:i:s");
        $modif = $mysqlClient ->prepare($sqlupdate);
        $modif->execute(array(
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':objet' => $objet,
            ':message' => $message,
            ':contactid' => $contactid,
            ':date' => $date,
        ));
    header("location:admin.php");
    } else {
        echo "ATTENTION, ERREUR !!!!";
    }
}
?>




