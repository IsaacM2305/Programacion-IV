-- Database: `todoApp`
CREATE DATABASE IF NOT EXISTS `checklist_tracker`
DEFAULT CHARACTER SET utf8
COLLATE utf8_general_ci;

USE `checklist_tracker`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(255) NOT NULL,
    `descripcion` text NOT NULL,
    `estado` varchar(20) NOT NULL DEFAULT 'por hacer',
    `fecha_compromiso` date NOT NULL,
    `etiqueta_editado` tinyint(1) NOT NULL DEFAULT 0,
    `responsable` varchar(100) NOT NULL,
    `tipo_tarea` varchar(50) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
-- EJEMPLOS

INSERT INTO `tareas` (`titulo`, `descripcion`, `estado`, `fecha_compromiso`, `etiqueta_editado`, `responsable`, `tipo_tarea`, `created_at`, `updated_at`) 
VALUES
    ('Laptop', 'Mantenimiento', 'por hacer', '2024-04-01', 1, 'Mantenimiento', 'Tarea de testing', '2024-07-04 15:41:54', '2024-08-04 17:04:46'),
    ('Telefono', 'No enciende', 'en progreso', '2024-08-03', 1, 'Tecnico', 'Tarea de testing', '2024-07-04 17:06:42', '2024-08-04 17:07:02'),
    ('Iphone', 'Bateria', 'terminada', '2024-08-01', 1, 'Tecnico', 'Tarea de mantenimiento', '2024-07-04 18:57:01', '2024-08-04 19:27:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_tareas`
--

CREATE TABLE `tipos_tareas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(50) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_tareas`
--

INSERT INTO `tipos_tareas` (`nombre`) VALUES
('Tarea de mantenimiento'),
('Tarea de desarrollo'),
('Tarea de diseño'),
('Tarea de testing');
