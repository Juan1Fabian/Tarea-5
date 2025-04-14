<?php
include('../../app/config/Database.php');

// Obtener las categorías para el formulario
$sqlCategorias = "SELECT * FROM Categorias";
$stmt = $conn->query($sqlCategorias);
$categorias = $stmt->fetchAll();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos del curso
    $sql = "SELECT * FROM Cursos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $curso = $stmt->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcategoria = $_POST['idcategoria'];
    $titulo = $_POST['titulo'];
    $duracionHoras = $_POST['duracionHoras'];
    $nivel = $_POST['nivel'];
    $precio = $_POST['precio'];
    $fechaInicio = $_POST['fechaInicio'];

    // Actualizar datos del curso
    $sql = "UPDATE Cursos SET idcategoria = ?, titulo = ?, duracionHoras = ?, nivel = ?, precio = ?, fechaInicio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idcategoria, $titulo, $duracionHoras, $nivel, $precio, $fechaInicio, $id]);

    echo "<div class='alert alert-success mt-3'>Curso actualizado exitosamente!</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Editar Curso</h2>
    <form method="POST" action="editar.php?id=<?= $id ?>" class="border p-4 rounded shadow-sm bg-light">
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="idcategoria" class="form-select" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id']; ?>" <?= ($curso['idcategoria'] == $categoria['id']) ? 'selected' : ''; ?>>
                        <?= $categoria['categoria']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?= $curso['titulo']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Duración (Horas)</label>
            <input type="number" name="duracionHoras" class="form-control" value="<?= $curso['duracionHoras']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nivel</label>
            <select name="nivel" class="form-select" required>
                <option value="Basico" <?= ($curso['nivel'] == 'Basico') ? 'selected' : ''; ?>>Básico</option>
                <option value="Intermedio" <?= ($curso['nivel'] == 'Intermedio') ? 'selected' : ''; ?>>Intermedio</option>
                <option value="Avanzado" <?= ($curso['nivel'] == 'Avanzado') ? 'selected' : ''; ?>>Avanzado</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01" value="<?= $curso['precio']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Inicio</label>
            <input type="date" name="fechaInicio" class="form-control" value="<?= $curso['fechaInicio']; ?>" required>
        </div>

        <button href="listar.php" type="submit" class="btn btn-success">Actualizar Curso</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>

