<DOCTYPE!> 
<html>
<head>
	<meta : charset = "utf-8"/> 
	<title>cours_1_php</title>
		<?php $prenom = "Prénom"; 
 		$test = True ;
 		$color = "aqua";
		$age = 14;
		$couleur = 'purple' ; 
		$variable = null  ; ?>  
</head>

<body>
	<h1>Bonjour</h1>
	<h2 style = "color : red"> 	
		<?php echo "Jeff" ; ?>
	</h2>   
	<!--ex1--> 
	<h2 style = "color : <?php echo $couleur; ?>">
		<?php echo $prenom.' '.$age; ?>
	</h2>
	<h2 style = "color : <?php echo $couleur; ?>"> 
		<?= $prenom.' '.$age; ?> 
	</h2>
	<!--ex2--> 
	<h2> âge : <?php echo $age ; ?>  </h2>

	<!--ex3--> 
	<h2 style = "color : <?php echo $couleur ; ?>"> Helt </h2> 


	<!--ex4--> 
	<?php
		if ($age < 18){
			echo "la personne est mineure".' '.$age ;}
		elseif ($age > 17 and $age < 64){ 
			echo "la personne est majeure".' '.$age;
		}
		else { 
			echo "la personne est senior".' '.$age ;
		}
	?>

	<?php 
		if(isset($variable)){
			echo'La variable est définie' ;  }
		else{ 
			echo 'La variable n\'est pas définie' ;}
	?>

	<h2>test</h2>
	<?php function addition($name) { 
			$compteur = $name + 1;
			echo $compteur ; }

		echo addition($age); 
	?> 
	<br> 
	<br>
	<?php switch($couleur){

			case 'purple' : 
				echo 'la couleur utilisée est violet'; 
				break ; 
			case 'pink' : 
				echo 'la couleur utilisée est rose  '; 
				break ; 
			case 'aqua' : 
				echo 'la couleur utilisée est aqua' ; 
				bre: 
				echak ; 
			default: 
			echo 'couleur impossible à identifier' ;
				break ; 
			}
	?>
<br>
<br>
	<?php if($age == 1){
		echo 'OK cond1' ; }
	if($age === 1){ 
		echo 'OK cond2';
	}
	if($test ==True) {
	echo 'OK cond3'  ; 
	}
	if($test ===True){
		echo 'OK cond4' ; 
	}
		else{ 
		echo False; 
	}
	?>
<br>
<br>
<br>

	<?php 
	$argent = 10 ; 
	if($argent === 0){ 
		echo 'Je n n\'ai plus d\'argent' ; 
	}elseif($argent > 0 ){ 
		echo 'J\'ai de l\'argent';
	}elseif($argent ===false ){ 
		echo 'On ne m\'as pas donner encore donné d\'argent' ; 
	}else { 
		echo "/" ; 
	} 
	?>
</body>
</html>