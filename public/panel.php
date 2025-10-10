<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sistema-produccion/public/css/style_panel.css">
</head>
<body>
    <header>
        <nav>
            <a href="">Home</a>
            <a href="contacts.php">Contacts</a>
            <a href="">Info</a>
        </nav>
        <nav><div class="nav-right">
            <a href="login.html" class="login-button">Iniciar sesión</a>
        </div></nav>
    </header>

    <!-- carousel -->
    <div class="carousel">
        <!-- list item -->
        <div class="list">
            <?php
            // Lista de imágenes
            $images = ['coraqua1.jpg', 'coraqua2.jpg', 'coraqua3.jpg', 'coraqua4.jpg'];
            foreach ($images as $img) {
                echo '
                <div class="item">
                    <img src="/sistema-produccion/public/img/' . $img . '">
                    <div class="content">
                        <div class="author">CORAQUA</div>
                        <div class="title">CORAQUA PERÚ</div>
<div class="topic">Acuicultura Sostenible</div>

                        <div class="des">
    Somos una empresa peruana con más de 18 años de experiencia. 
    Líderes en la importación de ovas de trucha, producción de alevines de alta calidad 
    e importación de equipos para el sector acuícola. Importamos ovas embrionadas de 
    Trucha Arcoíris de procedencia americana de la marca 
</div>

                        <div class="buttons">
                            <button>SEE MORE</button>
                            <button>SUBSCRIBE</button>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>

        <!-- list thumbnail -->
        <div class="thumbnail">
            <?php
            foreach ($images as $img) {
                echo '
                <div class="item">
                    <img src="/sistema-produccion/public/img/' . $img . '">
                    <div class="content">
                        <div class="title">Name Slider</div>
                        <div class="description">Description</div>
                    </div>
                </div>';
            }
            ?>
        </div>

        <!-- next prev -->
        <div class="arrows">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>

        <!-- time running -->
        <div class="time"></div>
    </div>

    <script src="/sistema-produccion/public/js/app_panel.js"></script>
</body>
</html>