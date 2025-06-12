<?php

include_once 'LOGIC/session.php';
if ($_SESSION['user']['type'] === null) {
    $_SESSION['user']['type'] = 'USER';
} else if ($_SESSION['user']['type'] === 'ADM') {
    $_SESSION['user']['type'] = 'USER';
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME | DailyGreen</title>
    <link rel="icon" type="image/x-icon" href="/DailyGreen-Project/IMAGES/dailyGreen-icon.ico">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/style_main_page.css">
</head>

<body>
        <!-- //? HEADER -->
        <header class="top_bar">
            <div class="logo"></div>
            <div class="main-nav">
                <a class="active">Início</a>
                <!-- <a>Sobre</a>
                <a>Contato</a> -->
            </div>
            <div class="auth-buttons">
                <a href="http://localhost/DailyGreen-Project/SCRIPTS/HTML/pagina_login.html" class="botao_login">Login</a>
                <a href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/accountCreation.php" class="botao_cadastro">Cadastro</a>
            </div>
        </header>
        <!-- //? MAIN -->
        <main class="main-content">
            <div class="inicio-content active">
                <!-- //? Hero Section -->
                <section class="hero">
                    <img class="logo-dailygreen" src="/DailyGreen-Project/IMAGES/logo-dailyGreen-transparentBackground.png" alt="logo-dailygreen">
                    <h1>Transforme seus dia a dia mais sustentavel!</h1>
                    <p>Junte-se à comunidade <strong>DailyGreen</strong> e faça parte da mudança.</p>
                    <a href="http://localhost/DailyGreen-Project/SCRIPTS/PHP/accountCreation.php" class="cta-btn">Comece agora</a>
                </section>

                <!-- //? Sobre o projeto -->
                <section class="about">
                    <h2>O que é o DailyGreen?</h2>
                    <p>
                        <strong>DailyGreen</strong> é uma plataforma colaborativa para promover práticas sustentáveis, conectar pessoas e divulgar
                        eventos relacionados ao meio ambiente
                    </p>
                </section>

                <!-- //? Motivos para usar -->
                <section class="motivos">
                    <h2>8 Motivos para usar o DailyGreen</h2>
                    <div class="container">
                        <div class="card"><h3>1</h3><p>Facilidade para adotar hábitos sustentáveis no dia a dia.</p></div>
                        <div class="card"><h3>2</h3><p>Acesso rápido a conteúdos de educação ambiental.</p></div>
                        <div class="card"><h3>3</h3><p>Conexão com pessoas com o mesmo propósito.</p></div>
                        <div class="card"><h3>4</h3><p>Organização e participação em ações coletivas simplificadas.</p></div>
                        <div class="card"><h3>5</h3><p>Monitoramento do impacto positivo gerado.</p></div>
                        <div class="card"><h3>6</h3><p>Gamificação para motivar e manter o engajamento.</p></div>
                        <div class="card"><h3>7</h3><p>Reconhecimentos por boas práticas.</p></div>
                        <div class="card"><h3>8</h3><p>Integração com serviços e produtos sustentáveis.</p></div>
                    </div>
                </section>

                <!-- //? Depoimentos -->
                <section class="testimonials">
                    <h2>O que dizem nossos usuários</h2>
                    <div class="testimonial-list">
                        <blockquote>
                            "O DailyGreen me ajudou a mudar pequenos hábitos e fazer a diferença!"<br>
                            <span>- Ana, RJ</span>
                        </blockquote>
                        <blockquote>
                            "Adoro participar dos desafios e eventos. A comunidade é incrível!"<br>
                            <span>- Lucas, SP</span>
                        </blockquote>
                    </div>
                </section>

                <!-- //? Destaques de funcionalidades -->
                <section class="features">
                    <h2>Funcionalidades em destaque</h2>
                    <div class="features-list">
                        <div class="feature-card">
                            <h3>Experiencias</h3>
                            <p>Compartilhe experiencias sustentaveis.</p>
                        </div>
                        <div class="feature-card">
                            <h3>Eventos</h3>
                            <p>Participe de eventos e mutirões ecológicos na sua região.</p>
                        </div>
                        <div class="feature-card">
                            <h3>Monitoramento</h3>
                            <p>Acompanhe seu impacto positivo ao longo do tempo.</p>
                        </div>
                    </div>
                </section>
                <section class="features">
                    <h2>Contato</h2>
                    <div class="features-list">
                        <div class="feature-card">
                            <h3>WhatsApp</h3>
                            <p>+55 41 99523-4512</p>
                        </div>
                        <div class="feature-card">
                            <h3>Facebook & Twitter</h3>
                            <p>@DailyGreen</p>
                        </div>
                        <div class="feature-card">
                            <h3>Github</h3>
                            <p>github.com/LucasAioriaSerpa/ DailyGreen-Project</p>
                        </div>
                        
                    </div>
                </section>
            </div>
            <div class="sobre-content">

            </div>
            <div class="contato-content">

            </div>
        </main>

        <!-- //? FOOTER -->
        <footer>
            <div class="footer-content">
                <p>&copy; 2025 DailyGreen. Todos os direitos reservados.</p>
                <div class="footer-links">
                    <a href="#">Termos de uso</a> |
                    <a href="#">Política de privacidade</a>
                </div>
            </div>
        </footer>
    </body>
    <script src="/DailyGreen-Project/SCRIPTS/JS/main_page.js"></script>
</html>
