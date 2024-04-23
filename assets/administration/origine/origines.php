<?php
    // Vérifiez si la commande SQL est présente dans les données du formulaire
    if (isset($_POST['id_suppression'])) {
        // Récupérez la commande SQL à partir des données du formulaire
        $id = $_POST['id_suppression'];
        $requete = $connexion->prepare("DELETE FROM origin WHERE id = :id");
        $requete->bindParam(':id', $id);
        $requete->execute();
    } else {
        echo "erreur de suppression";
    }
$requete = $connexion->prepare("SELECT * FROM origin");
$requete->execute();
$origines = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
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
        <p class="title_exo">Rechercher des origines</p>
        <p>Rechercher une origine par un nom :</p>
        <div class="container_one_exo">
            <form class="contribu_form" method="POST">
                <div class="container_admin_search">
                    <input type="text" name="rechercher" placeholder="Rechercher par nom...">
                    <button type="submit" class="btn-search">Rechercher</button>
                    <a href="?page=add_ori" class="bouton_ajouter">Ajouter +</a>
                </div>
            </form>
            <table>
                <thead>
                    <th>Nom</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($origines as $ligne) {
                        echo "<tr>";
                        echo "<td>".$ligne['name']."</td>";
                        $id = $ligne['id'];
                        echo "<td><form method='post' action='?page=modif_ori'>
                        <input type='hidden' name='id_modif' value='" . $ligne['id'] . "'>
                        <a href='?page=modif_ori&id=$id'>Modifier</a>
                        </form></td>";
                        echo "<td><form method='post'>
                                  <button class='openDialog' name='id_suppression' value='" . $ligne['id'] . "'>Supprimer</button>
                              </form></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">PAGINATION</div>
        <div class="modal-overlay"></div>
        <div id="dialog" class="dialog">
            <div class="dialog-content">
                <button class="close" id="closeDialog">
                    <img src="croix-removebg.png">
                </button>
                <div class="align">
                    <img src="check.svg">
                    <div>
                        <h1>Confirmer la suppression</h1>
                        <p>Êtes-vous certains de vouloir supprimer cette origine ?</p>
                    </div>
                </div>
                <form method="post">
                    <button id="closeDialog">Annuler</button>
                    <button type="submit" name="id_suppression" id="confirm">Confirmer</button>
                </form>
            </div>
        </div>
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