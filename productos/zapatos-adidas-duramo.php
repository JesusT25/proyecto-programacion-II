<?php
session_start();

// Guarda la página actual
$_SESSION['last_page'] = $_SERVER['REQUEST_URI'];

$valor = isset($_POST['valor']) ? intval($_POST['valor']) : 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['menos']) && $valor > 1) {
    $valor--;
  } else if (isset($_POST['mas']) && $valor < 10) {
    $valor++;
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zapatos adidas duramo</title>
  <link rel="icon" href="../images/icono.png">
  <link rel="stylesheet" href="../css/productos.css">
</head>

<body>
  <header class="header">
    <a class="header-link" href="../index.php"><img class="header-logo" src="../images/logo.svg" alt="logo"></a>

    <!-- Imagen de un carrito de compras -->
    <a href="../carrito.php">
      <svg class="header-icono" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
        style="fill: rgba(0, 0, 0, 1);transform: msFilter">
        <path
          d="M21 4H2v2h2.3l3.28 9a3 3 0 0 0 2.82 2H19v-2h-8.6a1 1 0 0 1-.94-.66L9 13h9.28a2 2 0 0 0 1.92-1.45L22 5.27A1 1 0 0 0 21.27 4 .84.84 0 0 0 21 4zm-2.75 7h-10L6.43 6h13.24z">
        </path>
        <circle cx="10.5" cy="19.5" r="1.5"></circle>
        <circle cx="16.5" cy="19.5" r="1.5"></circle>
      </svg>
    </a>

    <div class="usuario">
      <?php
      if (isset($_SESSION['usuario'])) {
        echo ('<span class="nombre-usuario">¡Hola, ' . $_SESSION['usuario'] . '!</span>');
        echo ('<a href="../logout.php"><img class="boton-desconexion" src="../images/turn-off.svg"  alt="Botón de desconectar"></a>');
      } else {
      ?>
        <a href="../login.php">
          <svg class="header-icono" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            style="fill: rgba(0, 0, 0, 1);transform: msFilter">
            <path
              d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z">
            </path>
            <path
              d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z">
            </path>
          </svg>
        </a>
      <?php
      }
      ?>
    </div>

  </header>

  <main>

    <div class="carrusel" id="skechers-dama">
      <img src="../images/productos/zapatos-adidas-duramo/zapatos-adidas-duramo.webp"
        alt="Imagen 1 de los zapatos adidas duramo">

      <img src="../images/productos/zapatos-adidas-duramo/2.webp" alt="Imagen 2 de los zapatos adidas duramo">

      <img src="../images/productos/zapatos-adidas-duramo/3.webp" alt="Imagen 3 de los zapatos adidas duramo">

    </div>

    <h1 class="titulo">Zapatos deportivos adidas duramo</h1>

    <div class="ofertas">
      <p class="precio">44.99$</p>
      <p class="precio descuento">64.99$</p>
    </div>

    <form class="contenedor" method="POST">
      <!-- Icono " - " -->
      <button class="btn" type="submit" name="menos">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          style="fill: rgba(0, 0, 0, 1);transform: msFilter">
          <path d="M17 5H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm-1 8H8v-2h8z"></path>
        </svg>
      </button>

      <input class="cantidad" type="number" name="valor" value="<?php echo $valor ?>" min="1" max="10" readonly>

      <!-- Icono " + " -->
      <button class="btn" type="submit" name="mas">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          style="fill: rgba(0, 0, 0, 1);transform: msFilter">
          <path
            d="M5 21h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm2-10h4V7h2v4h4v2h-4v4h-2v-4H7v-2z">
          </path>
        </svg>
      </button>

      <button class="boton" type="submit">Agregar al carrito</button>

    </form>

    <details class="detalles">
      <summary>Descripción</summary>

      <p>
        ¿Entrenás para lograr una nueva marca personal o solo intentás llegar a tiempo al autobús? Sea cual sea tu
        objetivo, los
        tenis adidas duramo te ofrecen una pisada más cómoda gracias a la amortiguación LIGHTMOTION que aporta
        ligereza,
        confort y una gran capacidad de respuesta.
      </p>
    </details>

    <details class="detalles">
      <summary>Información de envíos</summary>

      <p>
        <b>Anzoátegui</b>
        <br>
        Para envíos dentro del estado Anzoátegui el tiempo estimado de entrega es dentro de las 24 horas hábiles
        siguientes después de ser procesado el pago. Aplican excepciones únicamente a productos que por sus dimensiones
        no puedan ser trasladados en moto, para lo cual el tiempo estimado de entrega es de hasta 2 días hábiles.

        <br> <br>

        <b>Otros estados del país</b>
        <br>
        Para realizar compras con envios fuera del estado Anzoátegui haz tu pedido por nuestra web y retíralo en tu
        agencia de MRW
        más
        cercana. Contacta a nuestro equipo de atención al cliente para que te indique las agencias de MRW activas y
        selecciones
        la de tu conveniencia. Los pedidos generalmente tardan entre 24 y 72 horas. (Aplican excepciones).
      </p>
    </details>

    <section class="horarios">
      <h2>Horarios de atención:</h2>
      <br>

      <p>Lunes a viernes 8:00am a 12:00m / 1:00pm a 5:00pm</p>
      <br>
      <p>Sábados 9:00am a 12:00m / 1:00pm a 5:00pm</p>

    </section>

  </main>

  <footer class="footer">

    <section class="footer-section">
      <h2 class="footer-h2">Enlances</h2>

      <nav class="nav">
        <ul class="nav-links">
          <li><a class="nav-link" href="#">Métodos de pago</a></li>
          <li><a class="nav-link" href="#">Preguntas frecuentes</a></li>
          <li><a class="nav-link" href="#">Política de cambios</a></li>
          <li><a class="nav-link" href="#">Blog</a></li>
        </ul>
      </nav>
    </section>

    <section class="footer-section">
      <h2 class="footer-h2">Siguenos</h2>

      <div class="footer-div">
        <!-- Icono de instagram -->
        <a class="footer-icono" href="https://www.instagram.com/" target="_blank">
          <svg class="footer-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            style="fill: rgba(255, 255, 255, 1);transform: msFilter">
            <path
              d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z">
            </path>
            <circle cx="16.806" cy="7.207" r="1.078"></circle>
            <path
              d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z">
            </path>
          </svg>
        </a>

        <!-- Icono de facebook -->
        <a class="footer-icono" href="https://www.facebook.com/?locale2=es_ES&_rdr" target="_blank">
          <svg class="footer-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            style="fill: rgba(255, 255, 255, 1);transform: msFilter">
            <path
              d="M20 3H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h8.615v-6.96h-2.338v-2.725h2.338v-2c0-2.325 1.42-3.592 3.5-3.592.699-.002 1.399.034 2.095.107v2.42h-1.435c-1.128 0-1.348.538-1.348 1.325v1.735h2.697l-.35 2.725h-2.348V21H20a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z">
            </path>
          </svg>
        </a>

        <!-- Icono de telegram -->
        <a class="footer-icono" href="https://web.telegram.org/k/" target="_blank">
          <svg class="footer-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            style="fill: rgba(255, 255, 255, 1);transform: msFilter">
            <path
              d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z">
            </path>
          </svg>
        </a>
      </div>

    </section>

    <section class="footer-section">
      <h2 class="footer-h2">Contacto</h2>

      <div class="footer-div">
        <!-- Icono de correo -->
        <svg class="footer-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          style="fill: rgba(255, 255, 255, 1);transform: msFilter">
          <path
            d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 6.223-8-6.222V6h16zM4 18V9.044l7.386 5.745a.994.994 0 0 0 1.228 0L20 9.044 20.002 18H4z">
          </path>
        </svg>
        <p class="footer-parrafo">nexusfit@gmail.com</p>


        <!-- Icono de whatsapp -->
        <svg class="footer-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          style="fill: rgba(255, 255, 255, 1);transform: msFilter">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
          </path>
        </svg>
        <p class="footer-parrafo">0412-1234567</p>
      </div>

    </section>
  </footer>

</body>

</html>