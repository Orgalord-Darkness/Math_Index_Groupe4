<?php 
	require('../../connexion/connexion.php') ;
	if(isset($_GET['table'])){ 
		$table = $_GET['table'] ;  
	}else { 
		$table = 'pas de table' ;
		$texte_confirm = '' ; 
	}
	if(isset($_GET['id_suppression'])){ 
		$id = $_GET['id_suppression'] ; 
	}else{ 
		$id = 'pas de id' ; 
	}
	switch($table){ 
		case 'exercise':
			if(isset($_GET['id_suppression'])){ 
			    $id = $_GET['id_suppression'] ; 
			    // $table = 'classroom' ; 
				$texte_confirm = '' ; 
			    if(isset($_GET['action']) && $_GET['action'] === 'confirmer'){ 
			        $requete = $connexion->prepare("DELETE FROM $table WHERE id = :id") ; 
			        $requete->bindParam(':id', $id) ; 
			        $result = $requete->execute() ;
			    }
			    if(isset($_GET['action']) && $_GET['action'] === 'annuler'){ 
			        header('Location: admin_exercices.php');
			        exit; 
			    }
			} else { 
			    echo "erreur de id suppression" ; 
			    if(isset($_GET['action']) && $_GET['action'] === 'annuler'){ 
			        header('Location: admin_exercices.php');
			        exit; 
			    }
			}

			break ; 
		case 'classroom' : 
			$texte_confirm = '' ; 
			if(isset($_GET['id_suppression'])){ 
			    $id = $_GET['id_suppression'] ; 
			    // $table = 'classroom' ; 
			    if(isset($_GET['action']) && $_GET['action'] === 'confirmer'){ 
			        $requete = $connexion->prepare("DELETE FROM $table WHERE id = :id") ; 
			        $requete->bindParam(':id', $id) ; 
			        $result = $requete->execute() ;
			    }
			    if(isset($_GET['action']) && $_GET['action'] === 'annuler'){ 
			        header('Location: classes.php');
			        exit; 
			    }
			} else { 
			    echo "erreur de id suppression" ; 
			    if(isset($_GET['action']) && $_GET['action'] === 'annuler'){ 
			        header('Location: classes.php');
			        exit; 
			    }
			} 

			break ; 
		case 'origin':
			$texte_confirm = '' ; 
			if(isset($_GET['id_suppression'])){ 
			    $id = $_GET['id_suppression'] ; 
			    // $table = 'classroom' ; 
			    if(isset($_GET['action']) && $_GET['action'] === 'confirmer'){ 
			        $requete = $connexion->prepare("DELETE FROM $table WHERE id = :id") ; 
			        $requete->bindParam(':id', $id) ; 
			        $result = $requete->execute() ;
			    }
			    if(isset($_GET['action']) && $_GET['action'] === 'annuler'){ 
			        header('Location: origines.php');
			        exit; 
			    }
			} else { 
			    echo "erreur de id suppression" ; 
			    if(isset($_GET['action']) && $_GET['action'] === 'annuler'){ 
			        header('Location: origines.php');
			        exit; 
			    }
			} 


			break ; 
	}
?> 
<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "style.css">
		<meta charset="utf-8">
		<style>
      /* Styles pour la boîte de dialogue */
      .dialog {
        /*display: none;*/
        width : 29rem ;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 10001; /* Valeur de z-index supérieure pour s'assurer que la boîte de dialogue apparaît au-dessus de la superposition modale */
      }

      .dialog-content {
        text-align: center;
      }
      .align { 
        display : flex ;
        flex-direction : row ;
       }
       .align div { 
          display : inline ;
          line-height : 1rem ;
          text-align : left ;
        }
       .align img { 
          display : flex ;
          flex-direction : column ;
          width : 30px;
          height : 30px;
          padding : 2% ;
          border-radius: 10px/10px;
          margin-top : 5% ;
          margin-right : 1% ;
          background-color : rgb(240,240,240);

       }
      .dialog button {
        width : 9rem;
        margin-right : 1% ;
      }
      button img { 
        width : 0.8rem ;
        height : 0.8rem ;
        top : 50% ;
        left : 50% ;
        padding : 0;
        margin : 0;
       }
      .dialog-content .close { 
        background-color : rgb(240,240,240);
        border : none ;
        border-radius : 5rem ;
        width: 1.5rem  ;
        height : 1.5rem;
        right : 50% ;
        top : 0;
        padding : 0;
        margin : 0;
        justify-content : right ;
       }
      #closeDialog { 
         padding: 10px 20px;
        background-color: rgb(240,240,240);
        color: #000;
        border: none;
        border-radius: 3px;
        cursor: pointer;
       }
       #confirm { 
        padding: 10px 20px;
        background-color: rgb(100,100,100);
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
       }

      .dialog button:hover {
        background-color: #0056b3;
      }

      /* Styles pour la superposition modale */
      .modal-overlay {
      	/*display : none ;*/
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Couleur semi-transparente */
        z-index: 999; /* Valeur de z-index pour être en dessous de la boîte de dialogue mais au-dessus du reste de la page */
      }

      /* Styles pour le reste de la page */
      /* Vous pouvez ajuster les styles de votre page pour griser le contenu lorsqu'il est sous la superposition modale */
      body.modal-open {
        overflow: hidden; /* Empêche le défilement de la page lorsque la boîte de dialogue est ouverte */
      }
    </style>
	</head>
	<body>
		<div class='modal-overlay'></div>
					    <div id='dialog' class='dialog'>
					        <div class='dialog-content'>
					        	<form>
						            <button name = 'action' value = 'annuler' class='close' id='closeDialog'>
						                <img src='croix-removebg.png'>
						            </button>
						         </form>
					            <div class='align'>
					                <img src='check.svg'>
					                <div>
					                    <h1>Confirmer la suppression</h1>
					                    <p>Êtes-vous certains de vouloir supprimer cette <?php echo $table ?> ?</p>
					                </div>
					            </div>
					            <form>
					            	<input type='hidden' name='id_suppression' value='<?php echo $id; ?>'>
					            	<input type = 'hidden' name = 'table' value = '<?php echo $table ; ?>'> 
					                <button id='closeDialog' name = 'action' value = 'annuler'>Annuler</button>
					                <button name='action'value ='confirmer' id='confirm'>Confirmer</button>
					            </form>
					        </div>
					        <?php 
					        	if(isset($table)){ 
					        		var_dump($table) ; 
					        	}
					        ?>
					    </div> 
		<h1>Résultat: <?php echo $result ? 'Suppression réussie' : 'Échec de la suppression'; ?></h1>
	</body>
</html>

