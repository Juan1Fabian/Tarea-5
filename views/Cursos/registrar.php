<?php
include('../../app/config/Database.php');

// Obtener las categorías para el formulario
$sqlCategorias = "SELECT * FROM Categorias";
$stmt = $conn->query($sqlCategorias);
$categorias = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcategoria = $_POST['idcategoria'];
    $titulo = $_POST['titulo'];
    $duracionHoras = $_POST['duracionHoras'];
    $nivel = $_POST['nivel'];
    $precio = $_POST['precio'];
    $fechaInicio = $_POST['fechaInicio'];

    // Insertar el curso en la base de datos
    $sql = "INSERT INTO Cursos (idcategoria, titulo, duracionHoras, nivel, precio, fechaInicio) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idcategoria, $titulo, $duracionHoras, $nivel, $precio, $fechaInicio]);

    echo "<div class='alert alert-success mt-3'>Curso creado exitosamente!</div>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Crear nuevo curso</h2>
    <form method="POST" action="registrar.php" class="border p-4 rounded shadow-sm bg-light">
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="idcategoria" class="form-select" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id']; ?>"><?= $categoria['categoria']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Duración (Horas)</label>
            <input type="number" name="duracionHoras" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nivel</label>
            <select name="nivel" class="form-select" required>
                <option value="Basico">Básico</option>
                <option value="Intermedio">Intermedio</option>
                <option value="Avanzado">Avanzado</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Inicio</label>
            <input type="date" name="fechaInicio" class="form-control" required>
        </div>

        <button href="listar.php" type="submit" class="btn btn-primary">Crear Curso</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
