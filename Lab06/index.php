<!DOCTYPE html> 
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Alumnos</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <div class="container">
    <h2>Registro de Alumnos</h2>
    <form action="procesar.php" method="POST">
      <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
      </div>

      <div class="form-group">
        <label>Apellido:</label>
        <input type="text" name="apellido" required>
      </div>

      <div class="form-group">
        <label>Correo electrónico:</label>
        <input type="email" name="correo" required>
      </div>

      <div class="form-group">
        <label>Carnet:</label>
        <input type="text" name="carnet" required>
      </div>

      <div class="form-group">
        <label>Curso:</label>
        <input type="text" name="curso" required>
      </div>

      <div class="form-group">
        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" >
      </div>

      <button type="submit" class="btn-submit">Enviar</button>
    </form>

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
        </tr>
      </thead>
      <tbody>
        <?php
          include 'db.php';
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
                  </tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
