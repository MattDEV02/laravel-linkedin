-- Host: 127.0.0.1
-- Creato il: Mag 20, 2021 alle 19:59
-- Versione del server: 10.4.17-MariaDB


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--
-- Database: `Linkedin`
--

SELECT CURRENT_TIMESTAMP();

SHOW SCHEMAS;

DROP SCHEMA IF EXISTS Linkedin;

CREATE SCHEMA IF NOT EXISTS Linkedin;

USE Linkedin;


OPTIMIZE TABLE UtenteLavoro;

REPAIR TABLE UtenteLavoro;

ANALYZE TABLE UtenteLavoro;

SHOW CREATE TABLE UtenteLavoro;

DESCRIBE UtenteLavoro;



COMMIT;

SHOW TABLES;

-- QUERY DI ESEMPIO --

SET @n = 15;

SELECT
    p.id,
    p.utente_id AS utente_id,
    p.foto,
    p.testo,
    DATE_FORMAT(p.created_at,'%Y-%m-%d %H:%i') AS dataPubblicazione,
    CONCAT(u.nome, ' ', u.cognome) AS utente,
    CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso,
    u.email AS utenteEmail,
    COUNT(mp.id) AS miPiace
FROM
    Post p
        LEFT JOIN MiPiace mp ON p.id = mp.post
        JOIN Utente u ON p.utente = u.id
        JOIN UtenteLavoro ul ON ul.utente = u.id
        JOIN Lavoro l ON ul.lavoro = l.id
        JOIN Citta c ON u.citta = c.id
        JOIN Nazione n ON c.nazione = n.id
WHERE
        Nazione <> 'Finlandia' AND
        p.utente_id < (SELECT @n)
GROUP BY
    p.id
ORDER BY
    p.created_at DESC
LIMIT 25;


FLUSH PRIVILEGES;

DROP USER 'Lambertucci'@'%';

CREATE USER IF NOT EXISTS `Lambertucci`@`%` IDENTIFIED BY PASSWORD '12345678'

GRANT ALL ON Linkedin.* TO 'Lambertucci'@'%';

FLUSH PRIVILEGES;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
