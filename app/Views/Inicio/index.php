<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($titulo) ?></title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .contenedor {
            display: flex;
            min-height: 100vh;
        }

        /* Menú lateral */
        .sidebar {
            width: 250px;
            background: #172554;
            color: white;
            padding: 30px 20px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 45px;
        }

        .logo span {
            color: #60a5fa;
        }

        .sidebar h3 {
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .menu a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px;
            margin-bottom: 8px;
            border-radius: 7px;
            transition: .3s;
        }

        .menu a:hover,
        .menu a.activo {
            background: #2563eb;
            color: white;
        }

        /* Contenido */
        .contenido {
            flex: 1;
            padding: 35px;
        }

        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .encabezado h1 {
            font-size: 27px;
        }

        .encabezado p {
            color: #64748b;
            margin-top: 7px;
        }

        .perfil {
            background: white;
            padding: 12px 18px;
            border-radius: 9px;
            font-weight: bold;
        }

        /* Presentación */
        .bienvenida {
            background: linear-gradient(120deg, #1e40af, #2563eb);
            color: white;
            padding: 35px;
            border-radius: 14px;
            margin-bottom: 30px;
        }

        .bienvenida h2 {
            font-size: 26px;
            margin-bottom: 12px;
        }

        .bienvenida p {
            color: #dbeafe;
            line-height: 1.6;
            max-width: 650px;
        }

        /* Datos del desarrollador */
        .seccion-titulo {
            margin-bottom: 18px;
            font-size: 20px;
        }

        .datos {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 35px;
            border-left: 5px solid #2563eb;
        }

        .datos h3 {
            margin-bottom: 10px;
            font-size: 21px;
        }

        .datos p {
            color: #64748b;
            line-height: 1.7;
        }

        /* Tarjetas */
        .tarjetas {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .tarjeta {
            background: white;
            padding: 27px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            transition: .3s;
        }

        .tarjeta:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
        }

        .icono {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 10px;
            font-size: 24px;
            margin-bottom: 18px;
        }

        .tarjeta h3 {
            margin-bottom: 10px;
        }

        .tarjeta p {
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 22px;
        }

        .boton {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 11px 18px;
            border-radius: 7px;
            text-decoration: none;
            transition: .3s;
        }

        .boton:hover {
            background: #1d4ed8;
        }

        footer {
            margin-top: 45px;
            padding: 20px 0;
            text-align: center;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            font-size: 13px;
        }

        /* Diseño adaptable */
        @media (max-width: 800px) {
            .sidebar {
                width: 190px;
            }

            .contenido {
                padding: 22px;
            }

            .tarjetas {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 550px) {
            .contenedor {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .logo {
                margin-bottom: 20px;
            }

            .contenido {
                padding: 18px;
            }

            .bienvenida {
                padding: 25px;
            }
        }
    </style>
</head>

<body>

<div class="contenedor">

    <aside class="sidebar">

        <div class="logo">
            ADMINISTRACIÓN<span> PERSONAL</span>
        </div>

        <h3>Menú principal</h3>

        <nav class="menu">

            <a href="<?= site_url('/') ?>" class="activo">
                Inicio
            </a>

            <a href="<?= site_url('departamentos') ?>">
                Departamentos
            </a>

            <a href="<?= site_url('puestos') ?>">
                Puestos
            </a>

        </nav>

    </aside>

    <main class="contenido">

        <header class="encabezado">

            <div>
                <h1>Panel principal</h1>
                <p>Administración y organización del personal</p>
            </div>

            <div class="perfil">
                <?= esc($desarrollador) ?>
            </div>

        </header>

        <section class="bienvenida">

            <h2>¡Bienvenido al sistema!</h2>

            <p>
                Desde este panel puedes acceder a los módulos
                de administración de departamentos y puestos,
                gestionar sus registros y consultar la información
                almacenada en el sistema.
            </p>

        </section>

        <h2 class="seccion-titulo">Información del desarrollador</h2>

        <section class="datos">

            <h3><?= esc($desarrollador) ?></h3>

            <p>
                <strong>Carné:</strong> <?= esc($carnet) ?>
            </p>

            <p>
                <strong>Proyecto:</strong> Sistema de Administración de Personal
            </p>

            <p>
                <?= esc($descripcion) ?>
            </p>

        </section>

        <h2 class="seccion-titulo">Módulos del sistema</h2>

        <section class="tarjetas">

            <article class="tarjeta">


                <h3>Departamentos</h3>

                <p>
                    Administra los departamentos de la institución.
                    Registra, consulta, modifica y elimina departamentos.
                </p>

                <a href="<?= site_url('departamentos') ?>" class="boton">
                    Administrar departamentos
                </a>

            </article>

            <article class="tarjeta">


                <h3>Puestos</h3>

                <p>
                    Gestiona los puestos de trabajo, sus descripciones,
                    salarios de referencia y estados.
                </p>

                <a href="<?= site_url('puestos') ?>" class="boton">
                    Administrar puestos
                </a>

            </article>

        </section>

        <footer>
            Sistema de Administración de Personal |
            Desarrollado por <?= esc($desarrollador) ?>
        </footer>

    </main>

</div>

</body>
</html>
