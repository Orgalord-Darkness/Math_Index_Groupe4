<section class="BLOC5_Global">
<?php 
    // Si l'utilisateur est connecté, affichez le bouton de déconnexion

            //SUPPRESSION
            require_once('base_dd.php');

            if(!empty($_POST) && isset($_POST['method']) && $_POST['method'] === 'suppr' && isset($_POST['contactid'])) {
                $sql2 = "DELETE FROM user WHERE id = :contactid";
                $delete = $mysqlClient ->prepare($sql2);
                $delete->execute(array(':contactid' => $_POST['contactid']));
            }
            ?>
                    <!--CSS TABLEAU-->
                    <style>
                table{
                    display: flex;
                    flex-direction: column;
                    width: 50%;
                    height: auto;
                }
                .categ, .categ1{
                    display: flex;
                    width: auto;
                    height: auto;
                    margin: 10px;
                    text-wrap:nowrap;
                    font-size: 25px;
                }
                .categ1{
                    background-color: #f05665;
                    border-radius: 5px;
                    margin: 5px;
                }
                button, .retour{
                    border: solid #f05665 1px;
                    background:transparent;
                    border-radius:15px;
                    transition: 0.5s linear;
                }
                button:hover, .retour:hover{
                    transition: 0.5s linear;
                    background:red;
                }
                .retour{
                    display: flex;
                    width: auto;
                    height: 40px;
                    margin: 10px;
                    align-items: center;
                    font-size: 25px;
                    
                }
                .message{
                    width: 180px;
                    height: max-content;
                }
                .BLOC5_Global{
                    display: flex;
                    flex-direction: column;
                    background: #f4f4f4;
                    width: 100%;
                    height: auto;
                    justify-content: center;
                    align-items: center;
                }
                td{
                    text-wrap: nowrap;
                    display: flex;
                    width: auto;
                    height: auto;
                    margin: 10px;
                    text-wrap:nowrap;
                    font-size: 18px;
                }
                .message{
                    text-wrap: wrap;
                }
                tr{
                    display: flex;
                }
                a{
                    text-decoration: none;
                    color: black;
                }
                .ligne2{
                    display: flex;
                    justify-content: center;
                    width: 50%;
                    height: auto;
                }
                
            </style>

            <table>
                <thead>
                    <td class="categ1">id : </td>
                    <td class="categ">Nom : </td>
                    <td class="categ">Prénom :</td>
                    <td class="categ">Email :</td>
                    <td class="categ">Téléphone :</td>
                    <td class="categ">Objet :</td>
                    <td class="categ">Message :</td>
                    <td class="categ">Date : </td>
                    <td class="categ">Modification :</td>
                    <td class="categ">Suppression :</td>   
                </thead>
            <?php
            $sql1 = "SELECT * FROM user";
            $requete = $mysqlClient ->query($sql1);
            while($trans = $requete->fetch()){
                echo '<tr class="global_case";>
                <td>'.$trans['identifiant'].'</td>
                <td>'. $trans['nom'] .'</td>
                <td>'. $trans['prenom'].'</td>
                <td>'.$trans['email'] .'</td>
                <td>'. $trans['telephone'].'</td>
                <td>'. $trans['objet'] .'</td>
                <td class="message">'. $trans['message'].'</td>
                <td>'. $trans['date'].'</td>
                <!--MODIFICATION-->
                <td>'.'<form action="modification.php" method="POST">
                <input type="hidden" name="contactid" id="contactid" value='.$trans['identifiant'].'>
                <button type="submit" value="modif" id="method2" name="method2">Modifications</button></form>'.'</td>
                <!--SUPPRIMER-->
                <td>'.'<form action="#" method="POST"><input type="hidden" name="contactid" id="contactid" value='.$trans['identifiant'].'>
                <button type="submit" value="suppr" id="method" name="method">Supprimer</button></form>'.'</td></tr>';
            }


?>
</table>
<div class="ligne2">
    <button class="retour"> <a href="../index.php">Revenir en arrière</a></button>
</div>

</section>