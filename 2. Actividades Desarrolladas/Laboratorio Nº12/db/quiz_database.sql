-- Database: `todoApp`
CREATE DATABASE IF NOT EXISTS `quiz_database`
DEFAULT CHARACTER SET utf8
COLLATE utf8_general_ci;

USE `quiz_database`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla quiz_form_data
--

CREATE TABLE `quiz_form_data` (
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

