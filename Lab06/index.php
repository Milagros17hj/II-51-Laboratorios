<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Alumnos</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h2>Registro de Alumnos</h2>

    <?php
      include 'db.php';

      // Si se está editando, obtener datos del alumno
      $editando = false;
      $datos = [
        'nombre' => '',
        'apellido' => '',
        'correo' => '',
        'carnet' => '',
        'curso' => '',
        'fecha_nacimiento' => ''
      ];

      if (isset($_GET['accion']) && $_GET['accion'] === 'editar' && isset($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM alumnos WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($alumno) {
          $editando = true;
          $datos = $alumno;
        }
      }
    ?>

    <!-- Formulario de registro / edición -->
    <form action="procesar.php?accion=<?= $editando ? 'actualizar&id=' . $datos['id'] : 'insertar' ?>" method="POST">
      <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($datos['nombre']) ?>" required>
      </div>

      <div class="form-group">
        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?= htmlspecialchars($datos['apellido']) ?>" required>
      </div>

      <div class="form-group">
        <label>Correo electrónico:</label>
        <input type="email" name="correo" value="<?= htmlspecialchars($datos['correo']) ?>" required>
      </div>

      <div class="form-group">
        <label>Carnet:</label>
        <input type="text" name="carnet" value="<?= htmlspecialchars($datos['carnet']) ?>" required>
      </div>

      <div class="form-group">
        <label>Curso:</label>
        <input type="text" name="curso" value="<?= htmlspecialchars($datos['curso']) ?>" required>
      </div>

      <div class="form-group">
        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($datos['fecha_nacimiento']) ?>">
      </div>

      <button type="submit" class="btn-submit"><?= $editando ? 'Actualizar' : 'Enviar' ?></button>
      <?php if ($editando): ?>
        <a href="index.php" class="btn-cancelar">Cancelar edición</a>
      <?php endif; ?>
    </form>

    <!-- Tabla de registros -->
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Correo</th>
          <th>Carnet</th>
          <th>Curso</th>
          <th>Fecha de Registro</th>
          <th>Fecha de Nacimiento</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $stmt = $pdo->query("SELECT * FROM alumnos ORDER BY fecha_registro DESC");
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>".htmlspecialchars($row['nombre'])."</td>
                    <td>".htmlspecialchars($row['apellido'])."</td>
                    <td>".htmlspecialchars($row['correo'])."</td>
                    <td>".htmlspecialchars($row['carnet'])."</td>
                    <td>".htmlspecialchars($row['curso'])."</td>
                    <td>{$row['fecha_registro']}</td>
                    <td>{$row['fecha_nacimiento']}</td>
                    <td>
                      <a href='index.php?accion=editar&id={$row['id']}' class='btn-accion editar'>Editar</a>
                      <a href='procesar.php?accion=eliminar&id={$row['id']}' class='btn-accion eliminar' onclick=\"return confirm('¿Estás seguro de eliminar este registro?');\">Eliminar</a>
                    </td>
                  </tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
