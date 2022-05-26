drop schema if exists crud_mvc;
create schema crud_mvc;
use crud_mvc;
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2022 a las 09:26:55
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud_mvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Jefe Estudios'),
(3, 'Profesor');

-- --------------------------------------------------------
create table estado (
	id_estado int(11) NOT NULL,
	nombreEstado varchar(15) NOT NULL,
    primary key (id_estado)
);

INSERT INTO `estado` (`id_estado`, `nombreEstado`) VALUES
(1, 'Aceptado'),
(2, 'Denegado'),
(3, 'Pediente');
--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id_sesion` varchar(40) NOT NULL, 
  `id_usuario` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id_sesion`, `id_usuario`, `fecha_inicio`, `fecha_fin`) VALUES
('177elahk88vvsvk7jk7imnvbsu', 2, '2021-12-28 23:16:41', '2021-12-28 23:17:47'),
('3ha2phav5mhhp3cvautmv3epa5', 2, '2021-12-27 18:31:01', '2021-12-29 17:36:53'),
('aus7ejflu7fdoaj160logf3bgl', 1, '2021-12-28 15:46:08', '2021-12-28 15:46:15'),
('dophn6fqvnag2av4iqp48kdbl1', 1, '2022-01-10 09:19:21', '2022-01-10 09:20:00'),
('i28nqifqvbkfnl7r7pfcpl8c59', 3, '2022-01-10 09:15:24', '2022-01-10 09:15:36'),
('mcvafg495h5vbl4atc5mlveebq', 2, '2021-12-27 17:03:48', '2021-12-27 18:09:26'),
('ud7hma09qpts8ghjbmfq3kio8i', 2, '2021-12-29 17:37:28', '2021-12-29 17:37:45');


-- --------------------------------------------------------


create table tipoPermiso(
	idTipoPermiso int,
    descripcionPermiso varchar(200),
    codTipoPermiso varchar(3),
    foto varchar(500),
    id_estado int(11),
    primary key (idTipoPermiso),
    FOREIGN KEY (id_estado) REFERENCES estado(id_estado)
);


insert into tipoPermiso (idTipoPermiso,descripcionPermiso,codTipoPermiso,foto, id_estado) values
('1', 'Lactancia de hijo menor de 12 meses - 1 hora o fraccionada', 'A01', 'carpeta/ruta/foto1', '3'),
('2', 'Fallecimiento de familiar de primer grado', 'A03', 'carpeta/ruta/foto2','3'),
('3', 'Formación continua', 'A06', 'carpeta/ruta/foto3','3');
--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  /*`dni` varchar(9) NOT NULL,
  `centro` varchar(150) NULL,
  `especialidad` varchar(100) NULL,
  `nrp` varchar(100) NOT NULL,*/
  `email` varchar(120) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `id_rol` int(11) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`,`apellidos`,/*`dni`,`centro`,`especialidad`,`nrp`,*/ `email`, `telefono`, `id_rol`) VALUES
(1, 'Marta', 'Garcia', /*'217488214E', 'CPIFP Bajo Aragón', 'Informatica', '222',*/ 'mgarciaf@cpifpbajoaragon.com', '634667435', 2),
(2, 'Fede', 'Perez', /*'217488214F', 'CPIFP Bajo Aragón', 'Informatica', '333',*/ 'feder@gmail.com', '653466745', 3),
(3, 'Jonatan', 'Segurana', /*'215778214G', 'CPIFP Bajo Aragón', 'Informatica', '254',*/ 'jsegurana@cpifpbajoparagon.com','688469745', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id_sesion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);
  
--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

ALTER TABLE `tipoPermiso`
  MODIFY `idTipoPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;