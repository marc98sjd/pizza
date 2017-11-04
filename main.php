<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pizza Marc Guerra</title>
	</head>
	<body>
		<?php
			$cada_ingrediente = array("Massa","Orenga","Pernil dolç","Baco","Tomaquet","Formatge");
			if (!isset($_POST['comprar']) && !isset($_POST['todo'])){		
		?>		
				<h2>Introdueix els ingredients de la pizza:</h2>
				<FORM method="POST" action="main.php">
					<input type="checkbox" name="ingredientes[]" value="Massa">Massa</input><br>
					<input type="checkbox" name="ingredientes[]" value="Orenga">Orenga</input><br>
					<input type="checkbox" name="ingredientes[]" value="Pernil dolç">Pernil dolç</input><br>
					<input type="checkbox" name="ingredientes[]" value="Baco">Baco</input><br>
					<input type="checkbox" name="ingredientes[]" value="Tomaquet">Tomaquet</input><br>
					<input type="checkbox" name="ingredientes[]" value="Formatge">Formatge</input><br><br>
					<INPUT type="submit" name="comprar" value="comprar"/>
				</FORM>
				<p><strong>*Nota: la massa i la orenga son obligatories.</strong></p>
		<?php
			}elseif (isset($_POST['comprar']) || isset($_POST['todo'])){
				if (isset($_POST['comprar'])){
					$ingredientes = $_POST['ingredientes'];
					$ingredientes = array_filter($ingredientes);
					if (empty($ingredientes)){
						$_POST = array();
						header("Location: main.php");
					}else{
						$ingredientes = $_POST['ingredientes'];
					}
				}else{
					$ingredientes = $_POST['ingredientes2'];
					$ingredientes = array_filter($ingredientes);
					if (empty($ingredientes)){
						$_POST = array();
						header("Location: main.php");
					}else{
						$ingredientes = $_POST['ingredientes2'];
					}
				}
				if (!in_array('Massa', $ingredientes) || !in_array('Orenga', $ingredientes)){
					echo "La massa i l'orenga son obligatoris, s'afegirà automàticament l'ingredient mancant.";
					if (!in_array('Massa', $ingredientes)){
						$ingredientes[]='Massa';
					}
					if (!in_array('Orenga', $ingredientes)){
						$ingredientes[]='Orenga';
					}
					$_POST = array();
					?>	
						<h2>Algun ingredient a afegir?</h2>
					<?php
					$ingredients_checked = "";
					$ingredients_notcheckedd = array();
					$todos = "";
					for ($i=0; $i < count($cada_ingrediente); $i++) { 
						if (!in_array($cada_ingrediente[$i], $ingredientes)) {
							$ingredients_notcheckedd[] = $cada_ingrediente[$i];
						}
					}
					$ingredients_notchecked = "";
					for ($i=0; $i < count($ingredients_notcheckedd) ; $i++) {
						$valor = $ingredients_notcheckedd[$i];
						$ingredients_notchecked = $ingredients_notchecked."<input type='checkbox' name='ingredientes2[]' value='$valor'>$valor</input><br>";
					}
					for ($i=0; $i < count($ingredientes) ; $i++) {
						$valor = $ingredientes[$i];
						$ingredients_checked = $ingredients_checked."<input type='checkbox' name='ingredientes2[]' value='$valor' checked>$valor</input><br>";
					}
					$todos = $ingredients_checked.$ingredients_notchecked;
					$formulari = "	<form method='post' action='main.php'>
            							$todos
       									<br><input type='submit' name='todo' value='comprar'>
    								</form>";
    				echo $formulari;
				}
			}
			if((isset($_POST['todo']) && in_array('Massa', $ingredientes) && in_array('Orenga', $ingredientes)) || (isset($_POST['comprar']) && in_array('Massa', $ingredientes) && in_array('Orenga', $ingredientes))){
				$num_ingredientes = count($ingredientes);
				$precio = ($num_ingredientes * 0.5) + 5;
				echo "<h4>Has escollit ".$num_ingredientes." ingredient(s):</h4>";
				echo "<ul>";
				foreach ($ingredientes as $ingredient){
					echo "<li>".$ingredient."</li>";
				}
				echo "</ul>";
				echo "<h2>El preu final es de: ".$precio." €.";
			}
		?>
	</body>
</html>