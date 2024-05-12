<?php
	// On récupère les variables de session
	session_start();
	
    // Détruit toutes les variables de session --> fermeture de session
    session_destroy();
	
    // Redirige vers la page de connexion
    header("Location: ../index.php?page=accueil");
?>