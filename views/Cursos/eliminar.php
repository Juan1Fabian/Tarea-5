<?php
include('../../app/config/Database.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Eliminar el curso
        $sql = "DELETE FROM Cursos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        echo '<div class="alert alert-success">Curso eliminado exitosamente!</div>';
    } else {
        echo '<div class="alert alert-warning">ID no especificado.</div>';
    }
    ?>

    <a href="listar.php" class="btn btn-primary mt-3">Volver al listado</a>
</div>
</body>
</html>

