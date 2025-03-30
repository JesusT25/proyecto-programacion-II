-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 01:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexusfit`
--

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `producto_id` int(20) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cedula` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `metodo_envio` varchar(30) NOT NULL,
  `metodo_pago` varchar(30) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unidad` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `producto_id`, `nombre`, `apellido`, `email`, `cedula`, `telefono`, `direccion`, `ciudad`, `codigo_postal`, `estado`, `metodo_envio`, `metodo_pago`, `cantidad`, `precio_unidad`, `subtotal`, `iva`, `total`) VALUES
(1, 1, 1, 'NULL', 'NULL', 'NULL', 'V30.000.000', '0412-1234567', 'Sector 1, Calle 2, Casa 3', 'Barcelona', '6001', 'Anzoátegui', 'Entrega_Local', 'pago-movil', 1, 8.00, 8.00, 1.28, 9.28),
(2, 1, 5, 'NULL', 'NULL', 'NULL', 'V30.000.000', '0412-1234567', 'Sector 1, Calle 2, Casa 3', 'Barcelona', '6001', 'Anzoátegui', 'Entrega_Local', 'paypal', 3, 4.99, 14.97, 2.40, 17.37),
(3, NULL, 7, 'Isabel', 'Rivera', 'isabel@gmail.com', 'V27.000.000', '0412-1234567', 'Casa Nro 123', 'Margarita', '1234', 'Nueva Esparta', 'Envio_MRW', 'tarjeta', 1, 10.00, 10.00, 1.60, 11.60),
(4, NULL, 8, 'Camila', 'Mendoza', 'camila@gmail.com', 'V25.000.000', '0412-1234567', 'Sector ejemplo, calle 7, casa #19', 'Valencia', '12345', 'Carabobo', 'Envio_MRW', 'paypal', 2, 44.99, 89.98, 14.40, 104.38),
(5, 2, 4, 'NULL', 'NULL', 'NULL', 'V28.123.456', '0412-1234567', 'Sector 4, Calle 3, Casa 2', 'Mérida', '5115', 'Mérida', 'Envio_MRW', 'pago-movil', 2, 5.99, 11.98, 1.92, 13.90);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_descuento` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `precio_descuento`, `stock`) VALUES
(1, 'Termo-Cubbit', 'El termo térmico Cubitt de la marca Vacuum es el compañero perfecto para mantener tus bebidas a la temperatura ideal durante todo el día. Con su diseño clásico y elegante, este termo es ideal para llevar contigo a cualquier lugar. Su exterior de plástico garantiza durabilidad y resistencia, mientras que su interior de acero inoxidable mantiene tus bebidas frías durante 12 horas y calientes durante 8 horas. Gracias a su sistema de apertura a rosca con tapa, podrás disfrutar de tus bebidas sin preocuparte por derrames. Con una capacidad de 800 ml, este termo es ideal para mantenerte hidratado en tus actividades diarias.', 8.00, 0.00, 20),
(2, 'Zapatos-RS-Moon', 'Muévete o corre por tu día sintiéndote confortable y listo para todo con estos zapatos RS Performance. Con una malla transpirable, que mantiene tus pies frescos incluso en los días de calor. La suela le aporta amortiguación a cada pisada que das, brindando transpirabilidad, sujeción, flexibilidad, y rendimiento.', 40.00, 0.00, 20),
(3, 'Balon-Futbol-Qatar-2022', 'El balón de fútbol presenta un diseño en color blanco con detalles multicolor inspirados en los rascacielos de Qatar durante la noche. Sus juntas están cosidas a máquina, lo que garantiza una buena resistencia a la abrasión y a la rotura. La cubierta, fabricada en poliuretano, mejora la durabilidad del balón. Además, cumple con el diámetro y el peso requeridos para un balón de talla 5.', 30.00, 0.00, 15),
(4, 'Cuerda-Saltar', 'Cuerda de saltar de alta calidad con rodamientos antienredo, adicional viene con una bolsa para guardarla. Con ella puede mejorar su salud cardiovascular, resistencia y velocidad, mientras mejora la tensión muscular. Una excelente opción para cualquier tipo de entrenamiento, cardio, etc.', 5.99, 0.00, 30),
(5, 'Cronometro-Digital', 'Este Cronómetro digital deportivo es la herramienta ideal para los entusiastas del deporte que buscan precisión y funcionalidad. Diseñado con un material plástico ABS resistente, este cronómetro es perfecto para entrenamientos intensos y condiciones exigentes. Su resistencia al agua garantiza un rendimiento óptimo, sin importar el entorno.', 4.99, 0.00, 30),
(6, 'Casco-Ciclismo', 'Descubre la protección y comodidad en cada aventura con los cascos de montaña de la marca AC BIKES. Diseñados para ofrecerte la máxima seguridad en tus recorridos, estos cascos con un ajuste perfecto y un diseño aerodinámico son ideales para todos los ciclistas, desde principiantes hasta profesionales. No solo te sentirás seguro, sino que también lucirás con estilo mientras conquistas cada sendero.', 19.99, 15.99, 20),
(7, 'Traje-De-Baño-Dama', 'Descubre la protección y comodidad en cada aventura con los cascos de montaña de la marca AC BIKES. Diseñados para ofrecerte la máxima seguridad en tus recorridos, estos cascos con un ajuste perfecto y un diseño aerodinámico son ideales para todos los ciclistas, desde principiantes hasta profesionales. No solo te sentirás seguro, sino que también lucirás con estilo mientras conquistas cada sendero.', 16.00, 10.00, 30),
(8, 'Zapatos-Skechers-Dama', 'Potencia tus entrenamientos con las Skechers Skech-Air® Element 2.0 - New Beginnings. Estas zapatillas deportivas para dama están diseñadas para ofrecer la máxima comodidad y rendimiento. Con una parte superior de malla de ingeniería y detalles sintéticos, garantizan una excelente transpirabilidad y ajuste. La plantilla proporciona una sensación de frescura y amortiguación en cada paso, mientras que la entresuela  translúcida visible añade un toque moderno y soporte adicional. Perfectas para tus rutinas diarias, estas zapatillas te brindan el estilo y la funcionalidad que necesitas para superar tus límites.', 64.99, 44.99, 15),
(9, 'Saco-Boxeo', 'Lleva el boxeo y el entrenamiento de MMA al siguiente nivel con este saco de boxeo colgante de 40 libras, diseñado para soportar entrenamientos intensos. Construido de cuero sintético de alta calidad con correas reforzadas y relleno de mezcla de fibras, ofrece durabilidad y una experiencia realista. Su bucle de doble extremo permite conectarlo a varios puntos de anclaje, ofreciendo mayor funcionalidad en cada sesión.', 89.39, 75.98, 10),
(10, 'Zapatos-Adidas-Duramo', '¿Entrenás para lograr una nueva marca personal o solo intentás llegar a tiempo al autobús? Sea cual sea tu objetivo, los tenis adidas duramo te ofrecen una pisada más cómoda gracias a la amortiguación LIGHTMOTION que aporta ligereza, confort y una gran capacidad de respuesta.', 64.99, 44.99, 15);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `contraseña`) VALUES
(1, 'Rafael', 'Martínez', 'rafael@gmail.com', 'Prueba.123'),
(2, 'Javier', 'Sánchez', 'javier@gmail.com', 'Ejemplo*2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
