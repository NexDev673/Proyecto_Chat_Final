<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar departamento</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 30px;
            color: #1e293b;
        }

        .contenedor {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        label {
            display: block;
            margin: 15px 0 6px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button, .volver {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 18px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .volver {
            background: #64748b;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>Editar departamento</h1>

    <form action="<?= site_url('departamentos/actualizar/' . $departamento['id']) ?>"
          method="post">

        <?= csrf_field() ?>

        <label>Nombre del departamento</label>

        <input
            type="text"
            name="nombre"
            value="<?= esc(old('nombre', $departamento['nombre'])) ?>"
            required
            maxlength="100"
        >

        <label>Descripción</label>

        <textarea name="descripcion" rows="4" maxlength="1000"><?= esc(old('descripcion', $departamento['descripcion'])) ?></textarea>

        <label>Estado</label>

        <select name="estado">
            <option value="Activo"
                <?= old('estado', $departamento['estado']) === 'Activo' ? 'selected' : '' ?>>
                Activo
            </option>

            <option value="Inactivo"
                <?= old('estado', $departamento['estado']) === 'Inactivo' ? 'selected' : '' ?>>
                Inactivo
            </option>
        </select>

        <button type="submit">Guardar cambios</button>

        <a href="<?= site_url('departamentos') ?>" class="volver">
            Cancelar
        </a>

    </form>

</div>

</body>
</html>
