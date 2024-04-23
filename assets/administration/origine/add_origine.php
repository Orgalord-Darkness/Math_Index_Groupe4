<?Php
$connexion = connexionBdd();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['envoyer'], $_POST['nom'])) {
        $nom = htmlspecialchars($_POST['nom']);

        $check_query = $connexion->prepare("SELECT COUNT(*) FROM origin WHERE name = ?");
        $check_query->execute([$nom]);
        
        if ($check_query->fetchColumn()) {
            echo "Erreur : Origine déjà existante";
        } else {
            $insert_query = $connexion->prepare("INSERT INTO `origin` (`id`, `name`) VALUES (NULL, :nom)");
            $insert_query->bindParam(':nom', $nom);
            
            if ($insert_query->execute()) {
                header("Location: ?page=origine");
                exit();
            } else {
                echo "Erreur lors de l'ajout de l'origine.";
                print_r($insert_query->errorInfo());
            }
        }
    } else {
        echo "Erreur : Tous les champs requis ne sont pas fournis.";
    }
}



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
        <div class="gestion_sources">
            <p class="title_exo">Ajouter une origine :</p>
            <form method="POST" action="?page=origine">
                <label for="nom">Nom :</label>
                <br>
                <input name="nom">
                <br>
                <br>
                <input type="submit" name="envoyer">
            </form>
        </div>
    </div>
</div>