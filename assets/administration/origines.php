<?php
   	$connexion = connexionBdd() ;
  	if($_SERVER["REQUEST_METHOD"] == "POST") {
                // Vérifiez si la commande SQL est présente dans les données du formulaire
          if(isset($_POST['id_suppression'])) {
                    // Récupérez la commande SQL à partir des données du formulaire
            $id = $_POST['id_suppression'];
            var_dump($id) ; 
            $requete = $connexion->prepare("DELETE FROM origin WHERE id = :id;");
            $requete->bindParam(':id', $id);
            $requete->execute();
          }else{ 
            echo "erreur de suppression" ; 
          }
        }else{ 
          echo "erreur de if" ; 
        }
       $requete= $connexion->prepare("SELECT * FROM origin") ; 
       $requete->execute() ; 
       $origines = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
?>
<div class="php_content">
	<div class="title_categ">Administration</div>
	<div class="sections">
			<a href="?contribu=1"><p>Contributeurs</p></a>
			<a href="?admin_ex=1"><p>Exercices</p></a>
			<a href="#"><p>Matières</p></a>
			<a href="?classe=1"><p>Classes</p></a>
			<a href="#"><p>Thématiques</p></a>
			<a href="?origine=1"><p>Origines</p></a>
	</div>
	<div class="bloc_contenu3">
		<div class = "gestion_sources">
			<h1>Gestion des sources</h1>
			<form>
				<label for = "recherche">Rechercher une origine</label>
				<br>
				<input name = "recherche">
				 <a class = "bouton_ajouter" href = "?source=1">
            Ajouter +
          </a>
			</form>
			<table>
				<thead>
					<th>Name</th>
					<!-- <th>Company</th>
					<th>Expected Deal</th>
					<th>Pipeline Status</th>
					<th>Date</th> -->
					<th>Modifier</th>
					<th>Supprimer</th>
				</thead>
				<tbody>
					<tr>
						<?php
              foreach($origines as $ligne){ 
                echo "<td>".$ligne['name']."</td>" ; 

                 echo "<td><form method='post' action='?modif_ori=1'>
                          <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                            <button type='submit' name='modif'>Modifier " . $ligne['id'] . "</button>
                          </form></td>";


                    echo "<td><form method='post'>
                          <button class = 'openDialog'name='id_suppression' value='" . $ligne['id'] . "'>Supprimer</button></form></td>";
              }
						?>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="modal-overlay"></div>
	    <div id="dialog" class="dialog">
	    <div class="dialog-content">
	      <button  class = "close" id = "closeDialog">
	        <img src = "croix-removebg.png">
	      </button>
	      <div class = "align">
	        <img  src = "check.svg">
	        <div>
	          <h1>Confirmer la suppression</h1>
	          <p>Êtes-vous certains de vouloir supprimer cette exercice ?</p>
	        </div>
	      </div>
	      <form>
	        <button id="closeDialog">Annuler</button>
	        <button name = "id_suppression" id = "confirm">Confirmer</button>
	      </form>
	    </div>
	  </div>
		<script>
			// JavaScript pour ouvrir et fermer la boîte de dialogue
			document.getElementById('openDialog').addEventListener('click', function() {
			// Afficher la superposition modale et la boîte de dialogue
			document.querySelector('.modal-overlay').style.display = 'block';
			document.getElementById('dialog').style.display = 'block';
			// Ajouter une classe au corps pour indiquer que la boîte de dialogue est ouverte
			document.body.classList.add('modal-open');
			});
			document.getElementById('closeDialog').addEventListener('click', function() {
			// Cacher la superposition modale et la boîte de dialogue
			document.querySelector('.modal-overlay').style.display = 'none';
			document.getElementById('dialog').style.display = 'none';
			// Retirer la classe du corps pour indiquer que la boîte de dialogue est fermée
			document.body.classList.remove('modal-open');
			});
		</script>
	</div>
</div>