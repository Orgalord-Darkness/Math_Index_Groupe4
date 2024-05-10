<?php 
	$connexion = connexionBdd() ; 
	if(isset($_POST['table'])){ 
		$table = $_POST['table'] ;  
	}else { 
		$table = 'pas de table' ;
	}
	if(isset($_POST['id_suppression'])){ 
		$id = $_POST['id_suppression'] ; 
	}else{ 
		$id = 'pas de id' ; 
	}
	switch($table){ 
		case 'exercise':
			if(isset($_POST['id_suppression'])){ 
			    $id = $_POST['id_suppression'] ; 
			    // $table = 'classroom' ; 
			    if(isset($_POST['action']) && $_POST['action'] === 'confirmer'){ 
			        $requete = $connexion->prepare("DELETE FROM $table WHERE id = :id") ; 
			        $requete->bindParam(':id', $id) ; 
			        $result = $requete->execute() ;
			    }
			    if(isset($_POST['action']) && $_POST['action'] === 'annuler'){ 
			        header('Location: ?page=admin_ex');
			        exit(); 
			    }
			} else { 
			    echo "erreur de id suppression" ; 
			    if(isset($_POST['action']) && $_POST['action'] === 'annuler'){ 
			        header('Location: ?page=admin_ex');
			        exit();
			    }
			}

			break ; 
		case 'classroom' : 
			if(isset($_POST['id_suppression'])){ 
			    $id = $_POST['id_suppression'] ; 
			    // $table = 'classroom' ; 
			    if(isset($_POST['action']) && $_POST['action'] === 'confirmer'){ 
			        $requete = $connexion->prepare("DELETE FROM $table WHERE id = :id") ; 
			        $requete->bindParam(':id', $id) ; 
			        $result = $requete->execute() ;
			    }
			    if(isset($_POST['action']) && $_POST['action'] === 'annuler'){ 
			        header("Location: ?page=classe");
					exit();
			    }
			} else { 
			    echo "erreur de id suppression" ; 
			    if(isset($_POST['action']) && $_POST['action'] === 'annuler'){ 
			        header("Location: ?page=classe");
					exit();
			    }
			} 

			break ; 
		case 'origin':
			if(isset($_POST['id_suppression'])){ 
			    $id = $_POST['id_suppression'] ; 
			    // $table = 'classroom' ; 
			    if(isset($_POST['action']) && $_POST['action'] === 'confirmer'){ 
			        $requete = $connexion->prepare("DELETE FROM $table WHERE id = :id") ; 
			        $requete->bindParam(':id', $id) ; 
			        $result = $requete->execute() ;
			    }
			    if(isset($_POST['action']) && $_POST['action'] === 'annuler'){ 
			        header('Location: ?page=origine');
			        exit(); 
			    }
			} else { 
			    echo "erreur de id suppression" ; 
			    if(isset($_GET['action']) && $_GET['action'] === 'annuler'){ 
			        header('Location: ?page=origine');
			        exit(); 
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
			h1 { 
				font-size : 42px ;
			 }
      /* Styles pour la boîte de dialogue */
      .dialog {
      	display : block ;
        /*display: none;*/
        width : 40%  ;
        height : 20rem ;
        /*position: fixed;*/
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
      .dialog p { 
      	color : rgb(180,180,180);
       }
      .dialog-content {
        /*text-align: center;*/
      }
      .align { 
        display : flex ;
        flex-direction : row ;
       }
       .align div { 
          display : inline ;
          line-height : 1rem ;
          text-align : left 
          margin-top : 1% ; ;
        }
        .align div h1 { 
        	margin-top : 10% ; 
         }
       .align img { 
          display : flex ;
          flex-direction : column ;
          width : 5rem;
          height : 5rem;
          padding : 2% ;
          border-radius: 10px/10px;
          margin-top : 5% ;
          margin-right : 1% ;
          background-color : rgb(240,240,240);

       }
      .dialog button {
        margin-left : 15% ; 
      }
      button img { 
        width : 1rem ;
        height : 1rem ;
        top : 50% ;
        left : 50% ;
        padding : 0;
        margin : 0;
       }
      .dialog-content .close { 
        background-color : rgb(240,240,240);
        border : none ;
        border-radius : 5rem ;
        width: 2rem  ;
        height : 2rem;
        left : 0; 
        margin-left : 90% ;


       }
      .close img { 
      	padding : 0 ;
      	margin-left : auto ;
      	margin-right : auto ;

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
       #closeX{ 
       	width : 2rem ;
       	height : 2rem ;
       	border-radius : 10px /10px/10px/10px ; 
        }
      .dialog button:hover {
        background-color: #0056b3;
      }

      /* Styles pour la superposition modale */
      .modal-overlay {
      	/*display: none;*/
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Couleur semi-transparente */
        z-index: 999; /* Valeur de z-index pour être en dessous de la boîte de dialogue mais au-dessus du reste de la page */
      }
       .boutonAction button { 
       		width : 23rem;
       		height : 3rem ;
       		padding :3% ;
       		margin-left : auto ;
       		margin-right : auto ;
       		font-weight: lighter ;
        }
      /* Styles pour le reste de la page */
      /* Vous pouvez ajuster les styles de votre page pour griser le contenu lorsqu'il est sous la superposition modale */
      body.modal-open {
        overflow: hidden; /* Empêche le défilement de la page lorsque la boîte de dialogue est ouverte */
      }
      form{ 
      	display : flex ;
      	flex-direction : row ;
       }
    </style>
	</head>
	<body>
		<div class = "php_content">
			<div class='modal-overlay'></div>

			<div id='dialog' class='dialog'>
				<div class='dialog-content'>
					<form method = 'post'>
						<button name = 'action' value = 'annuler' class='close' id='closeX'>
							<img src='/../../ico/croix-removebg2.png'>
						</button>
					</form>
					 <div class='align'>
						<img src='/../../ico/check.svg'>
						<div>
							<h1>Confirmer la suppression</h1>
							<p>Êtes-vous certains de vouloir supprimer cette <?php echo $table ?> ?</p>
						</div>
					</div>
					<form class = "boutonAction" method = 'post'>
						<input type='hidden' name='id_suppression' value='<?php echo $id; ?>'>
						<input type = 'hidden' name = 'table' value = '<?php echo $table ; ?>'> 
						<button id='closeDialog' name = 'action' value = 'annuler'>Annuler</button>
						<button name='action'value ='confirmer' id='confirm'>Confirmer</button>
					</form>
				</div>
				 <?php 
					// if(isset($table)){ 
					// 	 var_dump($table) ; 
					// }
					?>
			</div> 
			<h1>
				Résultat: 
					<?php
						if(isset($result)){  
							echo $result ? 'Suppression réussie' : 'Échec de la suppression'; 
						}
					?>		
			</h1>
		</div>
	</body>
</html>

