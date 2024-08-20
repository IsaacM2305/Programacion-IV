-- Database: `pasteleria`
CREATE DATABASE IF NOT EXISTS `pasteleria`
DEFAULT CHARACTER SET utf8
COLLATE utf8_general_ci;

USE `pasteleria`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla usuarios
--

CREATE TABLE pasteleria.`usuarios` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `firstName` varchar(150) NOT NULL,
    `lastName` varchar(150) NULL,
    `username` varchar(150) NULL,
    `email` varchar(250) NULL,
    `phone` varchar(15) NULL,
    `pwd` varchar(150) NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) 
