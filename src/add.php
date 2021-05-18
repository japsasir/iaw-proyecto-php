<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Data</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"  crossorigin="anonymous">
</head>

<body>
<div class = "container">
	<div class="jumbotron">
		<h1 class="display-4">Simple LAMP web app</h1>
		<p class="lead">Final project for IAW</p>
	</div>


<?php
// NOTA: Interesante abrir 'edit.php' en el lateral, los cambios son similares.
// Incluimos el archivo de conexiones con la base de datos
include_once("config.php");

if(isset($_POST['Submit'])) {
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$apellido1 = mysqli_real_escape_string($mysqli, $_POST['apellido1']);
	$apellido2 = mysqli_real_escape_string($mysqli, $_POST['apellido2']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);


	// Si hay un campo vacío, avisa.
	if(empty($name) || empty($apellido1) || empty($apellido2) || empty($age) || empty($email)) {
		if(empty($name)) {
			echo "<div class='alert alert-danger' role='alert'>Name field is empty</div>";
		}

		if(empty($apellido1)) {
			echo "<font color='red'>apellido1 field is empty.</font><br/>";
		}

		if(empty($apellido2)) {
			echo "<font color='red'>apellido2 field is empty.</font><br/>";
		}

		if(empty($age)) {
			echo "<div class='alert alert-danger' role='alert'>Age field is empty</div>";
		}

		if(empty($email)) {
			echo "<div class='alert alert-danger' role='alert'>Email field is empty</div>";
		}
		// Enlace a la página anterior.
		echo "<a href='javascript:self.history.back();' class='btn btn-primary'>Go Back</a>";
	} else {
		// Else (Si todos los campos han sido rellenados)

		// Insertar datos a nuestra base de datos.
		$stmt = mysqli_prepare($mysqli, "INSERT INTO users(name,age,email,apellido1,apellido2) VALUES(?,?,?,?,?)");
		mysqli_stmt_bind_param($stmt, "sis", $name, $apellido1, $apellido2 $age, $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);

		// Mensaje de operación con éxito
		echo "<div class='alert alert-success' role='alert'>Data added successfully</div>";
		echo "<a href='index.php' class='btn btn-primary'>View Result</a>";
	}
}

mysqli_close($mysqli);

?>
</div>
</body>
</html>
