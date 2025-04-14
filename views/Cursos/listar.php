<?php
include('../../app/config/Database.php');

// Consulta con INNER JOIN para mostrar el nombre de la categoría
$sql = "SELECT C.id, C.titulo, CA.categoria, C.duracionHoras, C.nivel, C.precio, C.fechaInicio
        FROM Cursos C
        INNER JOIN Categorias CA ON C.idcategoria = CA.id
        ORDER BY C.id DESC";
$stmt = $conn->query($sql);
$cursos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Lista de Cursos</h2>
    <a href="registrar.php" class="btn btn-primary mb-3">Crear nuevo curso</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Duración (Horas)</th>
                    <th>Nivel</th>
                    <th>Precio</th>
                    <th>Fecha de Inicio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursos as $curso): ?>
                    <tr>
                        <td><?= $curso['id']; ?></td>
                        <td><?= $curso['titulo']; ?></td>
                        <td><?= $curso['categoria']; ?></td>
                        <td><?= $curso['duracionHoras']; ?></td>
                        <td><?= $curso['nivel']; ?></td>
                        <td>S/. <?= number_format($curso['precio'], 2); ?></td>
                        <td><?= $curso['fechaInicio']; ?></td>
                        <td>
                            <a href="editar.php?id=<?= $curso['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="eliminar.php?id=<?= $curso['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este curso?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
