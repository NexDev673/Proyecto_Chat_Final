
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
            max-width: 1000px;
            margin: auto;
        }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px #0000000a;
        }

        h1 { color: #1d4ed8; }

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

        .mensaje {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error {
            padding: 12px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        @media (max-width: 650px) {
            body { padding: 12px; }
            .formulario { grid-template-columns: 1fr; }
            .completo { grid-column: auto; }
            .tabla { overflow-x: auto; }
        }
    </style>
</head>

<body>
<main>
    <h1><?= esc($titulo) ?></h1>
    <p>Registra y consulta los departamentos de la empresa.</p>

    <section class="panel">
        <h2>Nuevo departamento</h2>

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

        <form action="<?= site_url('departamentos/guardar') ?>" method="post">
            <?= csrf_field() ?>

            <div class="formulario">
                <div>
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" maxlength="100"
                           value="<?= esc(old('nombre')) ?>" required>
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
                    <button type="submit">Registrar departamento</button>
                </div>
            </div>
        </form>
    </section>

    <section class="panel">
        <h2>Departamentos registrados</h2>

        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($departamentos)): ?>
                        <tr>
                            <td colspan="4">Todavía no hay departamentos registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($departamentos as $departamento): ?>
                            <tr>
                                <td><?= esc($departamento['id']) ?></td>
                                <td><?= esc($departamento['nombre']) ?></td>
                                <td><?= esc($departamento['descripcion'] ?? '') ?></td>
                                <td><?= esc($departamento['estado']) ?></td>
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
