<?php
if(isset($_SESSION['email'])){
    ?>
<div class="php_content">
    <div class="title_categ">Soumettre un exercice</div>
    <div class="sections">
            <p>Informations générales</p>

            <p>Sources</p>

            <p>Fichiers</p>
    </div>
    <div class="bloc_contenu3">
        <form>
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
                </div>
            </div>
            <br>
            <br>
            <div class="container_button2">
                <button type = "submit">Continuer</button>
            </div>
        </form>
    </div>     
</div>
<?php
}else{
    echo'non, TG, Vous ne passez PASSSS!!!!';
}

?>