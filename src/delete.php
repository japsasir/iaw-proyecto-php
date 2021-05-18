<?php
// Referencia conexión a base de datos
include("config.php");

// Id del dato extraido de URL 
$id = $_GET['id'];

// Borramos la fila de la tabla.
$stmt = mysqli_prepare($mysqli, "DELETE FROM users WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($mysqli);

// Redirección con header, vuelta a index.
header("Location:index.php");
?>