-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Estructura de tabla para la tabla `usuario`
CREATE TABLE `usuario` (
  `usuario_id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `usuario_nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usuario_apellido` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usuario_usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usuario_clave` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usuario_email` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcado de datos para la tabla `usuario`
INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`) VALUES
(1, 'Administrador', 'Principal', 'Administrador', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 'admin@equipo5.com');


-- AUTO_INCREMENT de la tabla `usuario`
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


  -- Estructura de tabla para la tabla `proveedores`
  CREATE TABLE `proveedores` (
    `proveedor_id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `proveedor_nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `proveedor_contacto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `proveedor_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

  -- Volcado de datos para la tabla `proveedores`
  INSERT INTO `proveedores` (`proveedor_id`, `proveedor_nombre`, `proveedor_contacto`, `proveedor_email`) VALUES
  (1,'Proveedor A','123456789 - Calle 1','proveedora@example.com');

  -- Estructura de tabla para la tabla `aulas`
  CREATE TABLE `aulas` (
  `aula_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `aula_nombre` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL UNIQUE,
  `aula_ubicacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aula_descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- Estructura de tabla para la tabla `estado`
CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` enum('En reserva','En reparacion','En servicio','Fuera de servicio') NOT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO estado(estado_id,descripcion)VALUES(1,'En reserva');
INSERT INTO estado(estado_id,descripcion)VALUES(2,'En reparacion');
INSERT INTO estado(estado_id,descripcion)VALUES(3,'En servicio');
INSERT INTO estado(estado_id,descripcion)VALUES(4,'Fuera de servicio');

-- Estructura de tabla para la tabla `departamentos`
CREATE TABLE `departamentos` (
  `departamento_id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento_nombre` varchar(255) NOT NULL,
  `ubicación` varchar(50) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`departamento_id`),
  UNIQUE KEY `departamento_nombre` (`departamento_nombre`),
  FOREIGN KEY (`usuario_id`) REFERENCES `usuario`(`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Estructura de tabla para la tabla `recursos`
CREATE TABLE `recursos` (recurso_id INT(11) NOT NULL AUTO_INCREMENT,
`recurso_nombre` varchar(255) NOT NULL,
`recurso_descripcion` text NOT NULL,
`recurso_codigo` varchar(11) NOT NULL,
`recurso_foto` LONGBLOB NOT NULL,
`aula_id` INT(11) NOT NULL,
`estado_id` INT(11) NOT NULL,
`proveedor_id` INT(11),
`precio` decimal(10,2) NOT NULL,
`fecha_compra` date NOT NULL,
`fin_garantia` date NOT NULL,
PRIMARY KEY (`recurso_id`),
FOREIGN KEY  (`aula_id`) REFERENCES `aulas` (`aula_id`),
FOREIGN KEY  (`estado_id`) REFERENCES `estado` (`estado_id`),
FOREIGN KEY  (`proveedor_id`) REFERENCES `proveedores` (`proveedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Estructura de tabla para la tabla `mantenimiento`
CREATE TABLE `mantenimiento` (mantenimiento_id INT AUTO_INCREMENT PRIMARY KEY,
`usuario_id` INT NOT NULL,
`recurso_id` INT NOT NULL,
`fecha` date NOT NULL,
`mantenimiento_descripcion` TEXT NOT NULL,
FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
FOREIGN KEY  (`recurso_id`) REFERENCES  `recursos` (`recurso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Estructura de tabla pra la tabla `HistorialUso`
CREATE TABLE `HistorialUso` (historial_id INT AUTO_INCREMENT PRIMARY KEY,
`usuario_id` INT NOT NULL,
`recurso_id` INT NOT NULL,
`fecha_inicio` datetime NOT NULL,
`fecha_fin` datetime NOT NULL,
FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
FOREIGN KEY (`recurso_id`) REFERENCES `recursos` (`recurso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;