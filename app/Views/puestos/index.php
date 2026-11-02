
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo) ?></title>

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 30px;
        }

        main {
            max-width: 1100px;
            margin: auto;
        }

        h1 { color: #1d4ed8; }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px #0000000a;
        }

        .formulario {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input, textarea, select, button {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font: inherit;
        }

        textarea { resize: vertical; }
        .completo { grid-column: 1 / -1; }

        button {
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover { background: #1d4ed8; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        th { background: #eff6ff; }

        .mensaje, .error {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .mensaje {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .busqueda {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .busqueda button { width: auto; }

        .busqueda a {
            padding: 11px;
            background: #64748b;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .tabla { overflow-x: auto; }

        @media (max-width: 650px) {
            body { padding: 12px; }
            .formulario { grid-template-columns: 1fr; }
            .completo { grid-column: auto; }
        }
    </style>
</head>

<body>
<main>
    <h1><?= esc($titulo) ?></h1>
    <p>Registra y consulta los puestos de trabajo de la empresa.</p>

    <section class="panel">
        <h2>Nuevo puesto</h2>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <p class="mensaje"><?= esc(session()->getFlashdata('mensaje')) ?></p>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <p class="error"><?= esc(session()->getFlashdata('error')) ?></p>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errores')): ?>
            <div class="error">
                <ul>
                    <?php foreach (session()->getFlashdata('errores') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('puestos/guardar') ?>" method="post">
            <?= csrf_field() ?>

            <div class="formulario">
                <div>
                    <label for="nombre">Nombre del puesto</label>
                    <input id="nombre" name="nombre" maxlength="100"
                           value="<?= esc(old('nombre')) ?>" required>
                </div>

                <div>
                    <label for="salario_referencia">Salario de referencia (Q)</label>
                    <input type="number" id="salario_referencia"
                           name="salario_referencia" min="0" step="0.01"
                           value="<?= esc(old('salario_referencia') ?? '0') ?>" required>
                </div>

                <div>
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>

                <div class="completo">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                              rows="3" maxlength="1000"><?= esc(old('descripcion')) ?></textarea>
                </div>

                <div class="completo">
                    <button type="submit">Registrar puesto</button>
                </div>
            </div>
        </form>
    </section>

    <section class="panel">
        <h2>Puestos registrados</h2>

        <form action="<?= site_url('puestos') ?>" method="get" class="busqueda">
            <input type="search" name="buscar"
                   placeholder="Buscar puesto..."
                   value="<?= esc($buscar) ?>">

            <button type="submit">Buscar</button>

            <a href="<?= site_url('puestos') ?>">Limpiar</a>
        </form>

        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Puesto</th>
                        <th>Descripción</th>
                        <th>Salario (Q)</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($puestos)): ?>
                        <tr>
                            <td colspan="5">No hay puestos registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($puestos as $puesto): ?>
                            <tr>
                                <td><?= esc($puesto['id']) ?></td>
                                <td><?= esc($puesto['nombre']) ?></td>
                                <td><?= esc($puesto['descripcion'] ?? '') ?></td>
                                <td>Q <?= number_format((float)$puesto['salario_referencia'], 2) ?></td>
                                <td><?= esc($puesto['estado']) ?></td>
                                <td>
                                    <a href="<?= site_url('puestos/editar/' . $puesto['id']) ?>">
                                        <button type="submit"> Editar </button>
                                    </a> <br> <br>

                                    <form action="<?= site_url('puestos/eliminar/' . $puesto['id']) ?>"
                                            method="post"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este puesto?');">

                                            <?= csrf_field() ?>

                                            <button type="submit" style="background-color: #ff0000; color: white; border: none; padding: 10px 20px;">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
</body>
</html>
