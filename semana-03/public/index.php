<?php

$controller = require __DIR__ . '/../config/bootstrap.php';

$response = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = $controller->store($_POST);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Micro-HIS - Salas y Camas</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 9px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .success {
            margin-top: 20px;
            padding: 12px;
            background: #e8f5e9;
        }

        .error {
            margin-top: 20px;
            padding: 12px;
            background: #ffebee;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Micro-HIS</h1>

    <h2>Catálogo de salas, wards y camas</h2>

    <form method="POST">

        <h3>Datos de la sala / Ward</h3>

        <label>Nombre</label>
        <input
            type="text"
            name="ward_name"
            required
        >

        <label>Piso</label>
        <input
            type="text"
            name="floor"
        >

        <label>Edificio</label>
        <input
            type="text"
            name="building"
        >

        <h3>Datos de la cama</h3>

        <label>Código de cama</label>
        <input
            type="text"
            name="bed_code"
            required
        >

        <label>Estado operativo</label>

        <select name="bed_status" required>
            <option value="">Seleccione</option>
            <option value="disponible">Disponible</option>
            <option value="ocupada">Ocupada</option>
            <option value="limpieza">Limpieza</option>
            <option value="mantenimiento">Mantenimiento</option>
        </select>

        <label>Notas</label>

        <textarea
            name="notes"
            rows="3"
        ></textarea>

        <button type="submit">
            Registrar sala y cama
        </button>

    </form>

    <?php if ($response): ?>

        <div class="<?= $response['success'] ? 'success' : 'error' ?>">

            <?= htmlspecialchars($response['message']) ?>

            <?php if ($response['success']): ?>

                <p>
                    <strong>Sala:</strong>
                    <?= htmlspecialchars($response['ward']->getName()) ?>
                </p>

                <p>
                    <strong>Cama:</strong>
                    <?= htmlspecialchars($response['bed']->getCode()) ?>
                </p>

                <p>
                    <strong>Estado:</strong>
                    <?= htmlspecialchars($response['bed']->getStatus()->value) ?>
                </p>

            <?php endif; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>