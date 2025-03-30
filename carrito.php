<?php
//Evita el error: Confirm Form Resubmission 
header("Cache-Control: no-cache, must-revalidate");

//Inicia una sesion
session_start();


// Guarda la página actual
$_SESSION['last_page'] = $_SERVER['REQUEST_URI'];

//Variables
$nombre = $apellido = $email = $cedula = $telefono = $direccion = $ciudad = $codigo_postal = "";
$nombre_articulo = $fuente = $precio = $subtotal = $iva = $total = $mensaje = "";
$usuario_id = NULL;
$producto_id = "";

$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$estado = isset($_POST['estado']) ? $_POST['estado'] : "";
$metodo_envio = isset($_POST['envio']) ? $_POST['envio'] : "";
$metodo_pago = isset($_POST['metodo-pago']) ? $_POST['metodo-pago'] : "";

$cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : (isset($_SESSION['valor']) ? $_SESSION['valor'] : 1);

//Conexion a la BD
$conexion = mysqli_connect("localhost", "root", "", "nexusfit");

//Pasos para obtener el valor de nombre, apellido y el id correspondiente (tabla usuarios)
if (!empty($email)) {
  $consulta = $conexion->query("SELECT id, nombre, apellido FROM usuarios WHERE email = '$email'");

  if ($consulta->num_rows > 0) {
    $fila = $consulta->fetch_assoc();
    $usuario_id = $fila['id'];
    $nombre = $fila['nombre'];
    $apellido = $fila['apellido'];

    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;
  }
}

//Condionales para obtener el nombre, precio del producto y la imagen del mismo
if (isset($_SESSION['articulo'])) {

  if ($_SESSION['articulo'] == "Termo-Cubbit") {
    $nombre_articulo = "Termo térmico cubitt 800 ml";
    $fuente = "images/productos/termo-cubitt-800ml/termo-cubitt-800ml.png";
    $precio = 8.00;
    $producto_id = 1;
  }
  //
  else if ($_SESSION['articulo'] == "Zapatos-RS-Moon") {
    $nombre_articulo = "Zapatos Deportivos Rs Moon";
    $fuente = "images/productos/zapatos-deportivos-rs-moon/zapatos-deportivos-rs-moon.webp
    ";
    $precio = 40.00;
    $producto_id = 2;
  }
  // 
  else if ($_SESSION['articulo'] == "Balon-Futbol-Qatar-2022") {
    $nombre_articulo = "Balón De Futbol adidas Mundial Qatar 2022 N°5";
    $fuente = "images/productos/balon-futbol-qatar/balon-futbol-qatar.webp";
    $precio = 30.00;
    $producto_id = 3;
  }
  //
  else if ($_SESSION['articulo'] == "Cuerda-Saltar") {
    $nombre_articulo = "Cuerda de saltar para ejercicio";
    $fuente = "images/productos/cuerda-de-saltar/cuerda-de-saltar.png";
    $precio = 5.99;
    $producto_id = 4;
  }
  //
  else if ($_SESSION['articulo'] == "Cronometro-Digital") {
    $nombre_articulo = "Cronómetro Digital Deportivo";
    $fuente = "images/productos/cronometro-digital/cronometro-digital.webp";
    $precio = 4.99;
    $producto_id = 5;
  }
  //
  else if ($_SESSION['articulo'] == "Casco-Ciclismo") {
    $nombre_articulo = "Casco Ciclismo Ac Bikes";
    $fuente = "images/productos/casco-ciclismo/casco-ciclismo.webp";
    $precio = 15.99;
    $producto_id = 6;
  }
  //
  else if ($_SESSION['articulo'] == "Traje-De-Baño-Dama") {
    $nombre_articulo = "Traje de Baño para Dama";
    $fuente = "images/productos/traje-de-baño-dama/traje-de-baño-dama.webp";
    $precio = 10.00;
    $producto_id = 7;
  }
  //
  else if ($_SESSION['articulo'] == "Zapatos-Skechers-Dama") {
    $nombre_articulo = "Zapatos deportivos Skechers Element para Dama";
    $fuente = "images/productos/skechers-element-dama/skechers-element-dama.webp";
    $precio = 44.99;
    $producto_id = 8;
  }
  //
  else if ($_SESSION['articulo'] == "Saco-Boxeo") {
    $nombre_articulo = "Saco de boxeo Everlast 40 libras";
    $fuente = "images/productos/saco-boxeo/saco-boxeo.jpg";
    $precio = 75.98;
    $producto_id = 9;
  }
  //
  else if ($_SESSION['articulo'] == "Zapatos-Adidas-Duramo") {
    $nombre_articulo = "Zapatos deportivos adidas duramo";
    $fuente = "images/productos/zapatos-adidas-duramo/zapatos-adidas-duramo.webp";
    $precio = 44.99;
    $producto_id = 10;
  }
}

//Declar variables recibidas del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $cedula = $_POST['cedula'];
  $telefono = $_POST['telefono'];
  $direccion = $_POST['direccion'];
  $ciudad = $_POST['ciudad'];
  $codigo_postal = $_POST['codigo_postal'];
  $estado = $_POST['estado'];
  $metodo_envio = $_POST['envio'];
  $cantidad = $_POST['cantidad'];
}

// Boton Calcular precio
if (isset($_POST['calcular-precio'])) {
  $cantidad = isset($cantidad) ? (int)$cantidad : 1;
  $precio = isset($precio) ? (float)$precio : 0;

  $subtotal = $precio * $cantidad;
  $iva = $subtotal * 0.16;
  $total = $subtotal + $iva;

  $subtotal = number_format($subtotal, 2, '.');
  $iva = number_format($iva, 2, '.');
  $total = number_format($total, 2, '.');

  $_SESSION['subtotal'] = $subtotal;
  $_SESSION['iva'] = $iva;
  $_SESSION['total'] = $total;
  $_SESSION['precio_calculado'] = true;
}

// Botón Realizar Pedido
if (isset($_POST['realizar-pedido'])) {

  if (isset($_SESSION['precio_calculado']) && $_SESSION['precio_calculado'] === true) {

    $usuario_id_sql = is_null($usuario_id) ? "NULL" : $usuario_id;

    if (is_null($usuario_id)) {
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
      $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
      $email = isset($_POST['email']) ? $_POST['email'] : "";
    }
    //
    else {
      $nombre = $apellido = $email = "NULL";
    }

    if ($metodo_envio === 'Entrega_Local' && $estado !== 'Anzoátegui') {
      $mensaje = "Error: El envío gratis solo está disponible para el estado Anzoátegui.";
    }
    //
    else {
      $subtotal = $_SESSION['subtotal'];
      $iva = $_SESSION['iva'];
      $total = $_SESSION['total'];

      $ingresar = "INSERT INTO pedidos (usuario_id, nombre, apellido, email, cedula, telefono, direccion, ciudad, codigo_postal, estado, metodo_envio, metodo_pago, producto_id, cantidad, precio_unidad, subtotal, iva, total) VALUES ($usuario_id_sql, '$nombre', '$apellido', '$email', '$cedula', '$telefono', '$direccion', '$ciudad', '$codigo_postal', '$estado', '$metodo_envio', '$metodo_pago', $producto_id, $cantidad, $precio, $subtotal, $iva, $total)";

      $insertar_datos = mysqli_query($conexion, $ingresar);

      if ($insertar_datos) {
        $mensaje = "Pedido registrado exitosamente.";
        unset($_SESSION['subtotal'], $_SESSION['iva'], $_SESSION['total'], $_SESSION['precio_calculado']);

        $cedula = $telefono = $direccion = $ciudad = $codigo_postal = $estado = $metodo_envio = $metodo_pago = $subtotal = $iva = $total = "";
      }
      //
      else {
        $mensaje = "Error al registrar el pedido: " . mysqli_error($conexion);
      }
    }
  }
  //
  else {
    $mensaje = "Nota: debes calcular el precio antes de realizar el pedido.";
  }
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito</title>
  <link rel="icon" href="images/icono.png">
  <link rel="stylesheet" href="css/carrito.css">
</head>

<body>

  <header class="header">
    <a class="header-link" href="index.php"><img class="header-logo" src="images/logo.svg" alt="logo"></a>

    <!-- Imagen de un carrito de compras -->
    <a href="carrito.php">
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
        echo ('<a href="logout.php"><img class="boton-desconexion" src="images/turn-off.svg"  alt="Botón de desconectar"></a>');
      } else {
      ?>
        <a href="login.php">
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

  <main class="main">

    <h1 class="titulo">Realiza tu pedido</h1>

    <form class="formulario" method="post">
      <h2 class="subtitulo">Contacto</h2>
      <input type="text" name="nombre" value="<?php echo (isset($_POST['nombre']) ? $_POST['nombre'] : $nombre); ?>" placeholder="Nombre" required>
      <input type="text" name="apellido" value="<?php echo (isset($_POST['apellido']) ? $_POST['apellido'] : $apellido); ?>" placeholder="Apellido" required>
      <input type="email" name="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : $email); ?>" placeholder="Correo electronico" required>
      <input type="text" name="cedula" value="<?php echo $cedula ?>" placeholder="Cedula" required>
      <input type="text" name="telefono" value="<?php echo $telefono ?>" placeholder="Telefono" required>

      <hr>

      <h2 class="subtitulo">Dirección de entrega</h2>
      <textarea name="direccion" placeholder="Sector, Calle, Casa, etc." required><?php echo $direccion ?></textarea>
      <input type="text" name="ciudad" value="<?php echo $ciudad ?>" placeholder="Ciudad" required>
      <input type="text" name="codigo_postal" value="<?php echo $codigo_postal ?>" placeholder="Código Postal" required>
      <select name="estado" required>
        <option value="" disabled <?php echo empty($estado) ? 'selected' : ''; ?>>Estado</option>
        <option value="Amazonas" <?php echo ($estado == "Amazonas") ? 'selected' : ''; ?>>Amazonas</option>
        <option value="Anzoátegui" <?php echo ($estado == "Anzoátegui") ? 'selected' : ''; ?>>Anzoátegui</option>
        <option value="Apure" <?php echo ($estado == "Apure") ? 'selected' : ''; ?>>Apure</option>
        <option value="Aragua" <?php echo ($estado == "Aragua") ? 'selected' : ''; ?>>Aragua</option>
        <option value="Barinas" <?php echo ($estado == "Barinas") ? 'selected' : ''; ?>>Barinas</option>
        <option value="Bolívar" <?php echo ($estado == "Bolívar") ? 'selected' : ''; ?>>Bolívar</option>
        <option value="Carabobo" <?php echo ($estado == "Carabobo") ? 'selected' : ''; ?>>Carabobo</option>
        <option value="Cojedes" <?php echo ($estado == "Cojedes") ? 'selected' : ''; ?>>Cojedes</option>
        <option value="Delta Amacuro" <?php echo ($estado == "Delta Amacuro") ? 'selected' : ''; ?>>Delta Amacuro</option>
        <option value="Dependencias Federales" <?php echo ($estado == "Dependencias Federales") ? 'selected' : ''; ?>>Dependencias Federales</option>
        <option value="Distrito Capital" <?php echo ($estado == "Distrito Capital") ? 'selected' : ''; ?>>Distrito Capital</option>
        <option value="Falcón" <?php echo ($estado == "Falcón") ? 'selected' : ''; ?>>Falcón</option>
        <option value="Guárico" <?php echo ($estado == "Guárico") ? 'selected' : ''; ?>>Guárico</option>
        <option value="Lara" <?php echo ($estado == "Lara") ? 'selected' : ''; ?>>Lara</option>
        <option value="Mérida" <?php echo ($estado == "Mérida") ? 'selected' : ''; ?>>Mérida</option>
        <option value="Miranda" <?php echo ($estado == "Miranda") ? 'selected' : ''; ?>>Miranda</option>
        <option value="Monagas" <?php echo ($estado == "Monagas") ? 'selected' : ''; ?>>Monagas</option>
        <option value="Nueva Esparta" <?php echo ($estado == "Nueva Esparta") ? 'selected' : ''; ?>>Nueva Esparta</option>
        <option value="Portuguesa" <?php echo ($estado == "Portuguesa") ? 'selected' : ''; ?>>Portuguesa</option>
        <option value="Sucre" <?php echo ($estado == "Sucre") ? 'selected' : ''; ?>>Sucre</option>
        <option value="Táchira" <?php echo ($estado == "Táchira") ? 'selected' : ''; ?>>Táchira</option>
        <option value="Trujillo" <?php echo ($estado == "Trujillo") ? 'selected' : ''; ?>>Trujillo</option>
        <option value="Vargas" <?php echo ($estado == "Vargas") ? 'selected' : ''; ?>>Vargas</option>
        <option value="Yaracuy" <?php echo ($estado == "Yaracuy") ? 'selected' : ''; ?>>Yaracuy</option>
        <option value="Zulia" <?php echo ($estado == "Zulia") ? 'selected' : ''; ?>>Zulia</option>
      </select>

      <hr>

      <h2 class="subtitulo">Métodos de envío</h2>
      <div class="contenedor">
        <label class="radio-contenedor" for="envio-anzoategui">
          <input id="envio-anzoategui" name="envio" value="Entrega_Local"
            <?php echo ($metodo_envio == "Entrega_Local") ? 'checked' : ''; ?> type="radio" checked><span class="alinear-derecha">Anzoátegui</span>
        </label>
        <p class="texto">-</p>
        <p class="texto">Envío gratis</p>
      </div>

      <div class="contenedor">
        <label class="radio-contenedor" for="envio-otro-estado">
          <input id="envio-otro-estado" name="envio" value="Envio_MRW"
            <?php echo ($metodo_envio == "Envio_MRW") ? 'checked' : ''; ?> type="radio"><span class="alinear-derecha">
            Otros Estados</span>
        </label>
        <p class="texto">-</p>
        <p class="texto">MRW (Cobro a destino)</p>
      </div>

      <hr>

      <h2 class="subtitulo">Métodos de pago</h2>

      <div class="contenedor">
        <label class="radio-contenedor" for="pago-paypal">
          <input id="pago-paypal" name="metodo-pago" value="paypal"
            <?php echo ($metodo_pago == "paypal") ? 'checked' : ''; ?> type="radio" checked>
          <img src="images/paypal.svg" alt="Icono de Paypal">
        </label>
      </div>

      <div class="contenedor">
        <label class="radio-contenedor" for="pago-tarjeta">
          <input id="pago-tarjeta" name="metodo-pago" value="tarjeta"
            <?php echo ($metodo_pago == "tarjeta") ? 'checked' : ''; ?> type="radio"><span class="alinear-derecha">
            Tarjeta de crédito o débito</span>
          <img src="images/visa.svg" alt="Icono de Visa">
          <img src="images/mastercard.svg" alt="Icono de Mastercard">
        </label>
      </div>

      <div class="contenedor">
        <label class="radio-contenedor" for="pago-movil">
          <input id="pago-movil" name="metodo-pago" value="pago-movil"
            <?php echo ($metodo_pago == "pago-movil") ? 'checked' : ''; ?> type="radio"><span class="alinear-derecha">
            Pago Movil</span>
          <img src="images/bank.svg" alt="Icono de un Banco">
        </label>
      </div>

      <hr>

      <h2 class="subtitulo">Artículo</h2>
      <input type="text" name="articulo" readonly value="<?php echo $nombre_articulo ?>">

      <?php
      if (!isset($_POST[$nombre_articulo])) {
        if (!empty($fuente)) {
          echo '<img class="imagen-articulo saco-boxeo" src="' . $fuente . '" alt="Imagen del artículo">';
        }
      }
      ?>

      <div class="contenedor">
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" min="1" max="10" value="<?php echo $cantidad ?>">
      </div>

      <input type="submit" id="calcular-precio" name="calcular-precio" value="Calcular precio">

      <div class="contenedor-precios">
        <label for="subtotal">Subtotal:</label>
        <input type="text" id="subtotal" name="subtotal" value="<?php echo $subtotal . "$"; ?>" readonly>
      </div>

      <div class="contenedor-precios">
        <label for="iva">IVA (16%):</label>
        <input type="text" id="iva" name="iva" value="<?php echo $iva . "$"; ?>" readonly>
      </div>

      <div class="contenedor-precios">
        <label for="total">Total a pagar:</label>
        <input type="text" id="total" name="total" value="<?php echo $total . "$"; ?>" readonly>
      </div>

      <!-- Mostrar Factura -->
      <?php if (isset($_POST['calcular-precio'])): ?>
        <section class="factura">
          <h2>Factura</h2>
          <p>Nombre: <?php echo ($nombre . ' ' . $apellido); ?></p>
          <p>Cédula: <?php echo ($cedula); ?></p>
          <p>Teléfono: <?php echo ($telefono); ?></p>
          <p>Estado: <?php echo ($estado); ?></p>
          <p>Ciudad: <?php echo ($ciudad); ?></p>
          <p>Código Postal: <?php echo ($codigo_postal); ?></p>
          <p>Dirección: <?php echo ($direccion); ?></p>
          <hr>
          <p>Artículo: <?php echo ($nombre_articulo); ?></p>
          <p>Cantidad: <?php echo ($cantidad); ?></p>
          <hr>
          <p>Subtotal: <?php echo number_format($subtotal, 2, '.'); ?>$</p>
          <p>IVA (16%): <?php echo number_format($iva, 2, '.'); ?>$</p>
          <p>Total a pagar: <?php echo number_format($total, 2, '.'); ?>$</p>
          <button onclick="window.print()">Imprimir</button>
        </section>
      <?php endif; ?>

      <input type="submit" name="realizar-pedido" value="Realizar pedido">

      <h3 class="mensaje"><?php echo $mensaje ?></h3>

    </form>

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