<DOCTYPE!>
<html>
	<head>
		<meta : charset = "utf-8"/>
	</head>

	<body>
		<?php 
		$variable = null ;
		$variable = false ;
		$variable = ["valeur1","valeur2"] ; 

		if (empty($variable)) { 
			echo 'La variable est vide ';
		} else { 
			echo 'la variable n\' est pas vide.' ;
		}
		?> 

	</body>
</html>