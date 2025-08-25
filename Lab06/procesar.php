<?php
include 'db.php';

$accion = $_GET['accion'] ?? '';
$id = $_GET['id'] ?? null;

// Recibir y limpiar datos del formulario
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$carnet = trim($_POST['carnet'] ?? '');
$curso = trim($_POST['curso'] ?? '');
$fecha_nacimiento = trim($_POST['fecha_nacimiento'] ?? '');

// Validaciones básicas
$errores = [];
if ($nombre === '') $errores[] = 'El nombre es obligatorio.';
if ($apellido === '') $errores[] = 'El apellido es obligatorio.';
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = 'Correo inválido.';
if ($carnet === '') $errores[] = 'El carnet es obligatorio.';
if ($curso === '') $errores[] = 'El curso es obligatorio.';

// Acción insertar
if ($accion === 'insertar') {
  if (count($errores) > 0) {
    foreach ($errores as $err) {
      echo "<p style='color:red;'>$err</p>";
    }
    echo "<p><a href='index.php'>Volver</a></p>";
    exit;
  }

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

  header('Location: index.php');
  exit;
}

// Acción actualizar
if ($accion === 'actualizar' && $id) {
  if (count($errores) > 0) {
    foreach ($errores as $err) {
      echo "<p style='color:red;'>$err</p>";
    }
    echo "<p><a href='index.php?accion=editar&id=$id'>Volver</a></p>";
    exit;
  }

  $sql = "UPDATE alumnos SET
            nombre = :nombre,
            apellido = :apellido,
            correo = :correo,
            carnet = :carnet,
            curso = :curso,
            fecha_nacimiento = :fecha_nacimiento
          WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':nombre' => $nombre,
    ':apellido' => $apellido,
    ':correo' => $correo,
    ':carnet' => $carnet,
    ':curso' => $curso,
    ':fecha_nacimiento' => $fecha_nacimiento,
    ':id' => $id
  ]);

  header('Location: index.php');
  exit;
}

// Acción eliminar
if ($accion === 'eliminar' && $id) {
  $sql = "DELETE FROM alumnos WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':id' => $id]);

  header('Location: index.php');
  exit;
}
?>
