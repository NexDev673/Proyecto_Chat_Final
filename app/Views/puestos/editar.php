<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar puesto</title>

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

    <h1>Editar puesto</h1>

    <form action="<?= site_url('puestos/actualizar/' . $puesto['id']) ?>"
          method="post">

        <?= csrf_field() ?>

        <label>Nombre del puesto</label>

        <input
            type="text"
            name="nombre"
            value="<?= esc(old('nombre', $puesto['nombre'])) ?>"
            required
            maxlength="100"
        >

        <label>Descripción</label>

        <textarea name="descripcion" rows="4" maxlength="1000"><?= esc(old('descripcion', $puesto['descripcion'])) ?></textarea>

        <label>Salario de referencia</label>

        <input
            type="number"
            name="salario_referencia"
            step="0.01"
            min="0"
            value="<?= esc(old('salario_referencia', $puesto['salario_referencia'])) ?>"
            required
        >

        <label>Estado</label>

        <select name="estado">
            <option value="Activo"
                <?= old('estado', $puesto['estado']) === 'Activo' ? 'selected' : '' ?>>
                Activo
            </option>

            <option value="Inactivo"
                <?= old('estado', $puesto['estado']) === 'Inactivo' ? 'selected' : '' ?>>
                Inactivo
            </option>
        </select>

        <button type="submit">Guardar cambios</button>

        <a href="<?= site_url('puestos') ?>" class="volver">
            Cancelar
        </a>

    </form>

</div>

</body>
</html>
