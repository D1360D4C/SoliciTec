<?php
session_start();

if(isset($_POST['cerrar'])){
    session_destroy();
    header("location:index.html");
    exit();
}

$nick = isset($_SESSION['nick']) ? htmlspecialchars($_SESSION['nick']) : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamo de Equipos — Sala de Servidores</title>
    <link rel="stylesheet" href="oculto1.css">
</head>
<body>
    <header class="nav">
        <div class="container nav-inner">
            <div class="brand">Sala de Servidores</div>
            <nav class="menu">
                <a href="inicio.php" class="active">Inicio</a>
                <a href="#">Mis Préstamos</a>
                <a href="#">Contacto</a>
            </nav>
            <div>
                <?php if($nick): ?>
                    <form action="" method="post" style="display:inline;">
                        <button class="btn btn-outline" type="submit" name="cerrar">Cerrar sesión</button>
                    </form>
                <?php else: ?>
                    <a class="btn btn-outline" href="index.html">Iniciar sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="main">
        <section class="hero">
            <div class="hero-bg" aria-hidden="true">
                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1600&q=80" alt="Fondo tecnológico 1">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1600&q=80" alt="Fondo tecnológico 2">
                <img src="https://images.unsplash.com/photo-1510511459019-5dda7724fd87?auto=format&fit=crop&w=1600&q=80" alt="Fondo tecnológico 3">
            </div>
            <div class="container">
                <h1 class="title">Préstamo de Equipos</h1>
                <p class="subtitle">Todo lo que necesitas para tus proyectos y estudios, al alcance de tu mano.</p>
                <a class="catalog-btn btn btn-primary" href="catalogo.html">Explorar Catálogo</a>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                        </div>
                        <div>
                            <h3>Rápido y Sencillo</h3>
                            <p>Solicitá tus equipos en pocos pasos, sin complicaciones.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect></svg>
                        </div>
                        <div>
                            <h3>Disponibilidad Clara</h3>
                            <p>Catálogo ordenado con stock visible y categorías bien definidas.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l4 4-4 4-4-4 4-4z"></path><path d="M2 12l4 4-4 4 4-4-4-4z"></path></svg>
                        </div>
                        <div>
                            <h3>Soporte Técnico</h3>
                            <p>Asistencia del equipo de la sala de servidores ante cualquier duda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <h2 class="title" style="font-size:22px;">¿Cómo funciona?</h2>
                <div class="steps">
                    <div class="step">
                        <div class="num">1</div>
                        <h3>Ingresá al catálogo</h3>
                        <p>Explorá las categorías y elegí el equipo que necesitás.</p>
                    </div>
                    <div class="step">
                        <div class="num">2</div>
                        <h3>Solicitá el préstamo</h3>
                        <p>Completá los datos requeridos y enviá tu solicitud.</p>
                    </div>
                    <div class="step">
                        <div class="num">3</div>
                        <h3>Retirá y usá</h3>
                        <p>Retirá el equipo y comenzá tu proyecto sin demoras.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="container">
            <div class="links">
                <a href="#">Horarios de Atención</a>
                <a href="#">Política de Préstamo</a>
                <a href="#">Manual de Uso</a>
            </div>
            <small>© 2024 Colegio Técnico. Todos los derechos reservados.</small>
            <div class="credit">Creado por <a href="https://github.com/Workill3199" target="_blank" rel="noopener"><strong>Lautaro Almeida</strong></a></div>
        </div>
    </footer>
</body>
</html>