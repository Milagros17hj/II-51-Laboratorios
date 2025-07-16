<?php
include 'db.php';

// Recibir y limpiar datos del formulario
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$carnet = trim($_POST['carnet'] ?? '');
$curso = trim($_POST['curso'] ?? '');
$fecha_nacimiento = trim($_POST['fecha_nacimiento'] ?? '');

$errores = [];

// Validaciones básicas
if ($nombre === '') $errores[] = 'El nombre es obligatorio.';
if ($apellido === '') $errores[] = 'El apellido es obligatorio.';
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = 'Correo inválido.';
if ($carnet === '') $errores[] = 'El carnet es obligatorio.';
if ($curso === '') $errores[] = 'El curso es obligatorio.';
if ($fecha_nacimiento === '') $errores[] = 'La fecha de nacimiento es obligatoria.';

// Mostrar errores si hay
if (count($errores) > 0) {
    foreach ($errores as $err) {
        echo "<p style='color:red;'>$err</p>";
    }
    echo "<p><a href='index.php'>Volver</a></p>";
    exit;
}

// Insertar en la base de datos
$sql = "INSERT INTO alumnos (nombre, apellido, correo, carnet, curso, fecha_nacimiento) 
        VALUES (:nombre, :apellido, :correo, :carnet, :curso, :fecha_nacimiento)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nombre' => $nombre,
    ':apellido' => $apellido,
    ':correo' => $correo,
    ':carnet' => $carnet,
    ':curso' => $curso,
    ':fecha_nacimiento' => $fecha_nacimiento
]);

// Redirigir a la página principal
header('Location: index.php');
exit;
?>
