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


-- --------------------------------------------------------

--
-- Struttura della tabella `citta`
--

CREATE TABLE `citta` (
                         `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero della Citta',
                         `nome` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome in formato stringa della Citta',
                         `nazione_id` int(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria di Nazione'
) ;

--
-- Dump dei dati per la tabella `citta`
--

INSERT INTO `citta` (`id`, `nome`, `nazione_id`) VALUES
                                                     (1, 'Rome', 1),
                                                     (2, 'Milan', 1),
                                                     (3, 'London', 4),
                                                     (4, 'Beijing', 8),
                                                     (5, 'New Delhi', 5),
                                                     (6, 'Los Angeles', 3),
                                                     (7, 'New York', 3),
                                                     (8, 'Boston', 3),
                                                     (9, 'Paris', 6),
                                                     (10, 'Marseille', 6),
                                                     (11, 'Sydney', 9),
                                                     (12, 'Frankfurt', 7),
                                                     (13, 'Tokyo', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
                            `id` int(10) UNSIGNED NOT NULL COMMENT 'Chiave Primaria della Tabella Commento',
                            `post_id` int(10) UNSIGNED NOT NULL COMMENT 'Post su cui è stato inserito il Commento',
                            `utente_id` int(10) UNSIGNED NOT NULL COMMENT 'Utente che ha inserito il Commento nel Post',
                            `testo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Testo del Commento',
                            `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data-ora Creazione del Commento',
                            `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data-ora Aggiornamento del Commento'
) ;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id`, `post_id`, `utente_id`, `testo`, `created_at`, `updated_at`) VALUES
                                                                                               (1, 1, 3, 'Bellissimo Post !!', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                               (2, 2, 3, 'Forza Romaaa !!', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                               (3, 3, 7, 'Buongiorno a tutti i cugini', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                               (4, 4, 1, 'Ok', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                               (5, 8, 4, 'Bella bici', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                               (6, 6, 2, 'Viva il futurismoooo', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                               (7, 5, 6, 'Viva il futurismoooo', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                               (8, 1, 1, 'Ehh già lo so.', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                               (9, 7, 1, 'Molto utile.', '2021-09-23 12:26:09', '2021-09-23 12:26:09');

--
-- Trigger `commento`
--
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_CommentoINSERT` BEFORE INSERT ON `commento` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_CommentoUPDATE` BEFORE UPDATE ON `commento` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `lavoro`
--

CREATE TABLE `lavoro` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero del Lavoro',
                          `nome` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome in formato stringa del Lavoro dell''Utente'
) ;

--
-- Dump dei dati per la tabella `lavoro`
--

INSERT INTO `lavoro` (`id`, `nome`) VALUES
                                        (6, 'Avvocato'),
                                        (10, 'Barista'),
                                        (5, 'Calciatore'),
                                        (14, 'Carabiniere'),
                                        (7, 'Cassiere'),
                                        (9, 'Coltivatore'),
                                        (2, 'Cuoco'),
                                        (3, 'Dipendente'),
                                        (1, 'Disoccupato'),
                                        (4, 'Freelancer'),
                                        (8, 'Giudice'),
                                        (11, 'Imprenditore'),
                                        (15, 'Poliziotto'),
                                        (12, 'Segretario'),
                                        (13, 'Stilista');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
                              `id` int(10) UNSIGNED NOT NULL,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
                                                          (1, '2021_05_16_201732_create_citta_table', 1),
                                                          (2, '2021_05_16_201732_create_lavoro_table', 1),
                                                          (3, '2021_05_16_201732_create_mipiace_table', 1),
                                                          (4, '2021_05_16_201732_create_nazione_table', 1),
                                                          (5, '2021_05_16_201732_create_post_table', 1),
                                                          (6, '2021_05_16_201732_create_richiestaamicizia_table', 1),
                                                          (7, '2021_05_16_201732_create_utente_table', 1),
                                                          (8, '2021_05_16_201732_create_utentelavoro_table', 1),
                                                          (9, '2021_05_16_201733_add_foreign_keys_to_citta_table', 1),
                                                          (10, '2021_05_16_201733_add_foreign_keys_to_mipiace_table', 1),
                                                          (11, '2021_05_16_201733_add_foreign_keys_to_post_table', 1),
                                                          (12, '2021_05_16_201733_add_foreign_keys_to_richiestaamicizia_table', 1),
                                                          (13, '2021_05_16_201733_add_foreign_keys_to_utente_table', 1),
                                                          (14, '2021_05_16_201733_add_foreign_keys_to_utentelavoro_table', 1),
                                                          (15, '2021_05_28_135517_create_trigger_check_amicizia', 1),
                                                          (16, '2021_07_10_164827_create_commento_table', 1),
                                                          (17, '2021_08_06_123610_create_profilo_table', 1),
                                                          (18, '2021_08_06_125200_add_foreign_keys_to_profilo_table', 1),
                                                          (19, '2021_08_18_210623_create_reportistica_table', 1),
                                                          (20, '2021_08_18_211905_create_trigger_user_lavoro_profile_reportistica', 1),
                                                          (21, '2021_08_18_212302_add_foreign_keys_to_reportistica_table', 1),
                                                          (22, '2021_09_18_125359_create_trigger_check_utente_lavoro_data_inizio', 1),
                                                          (23, '2021_09_20_214745_create_dates_checks', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `mipiace`
--

CREATE TABLE `mipiace` (
                           `post_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Post su cui è stato applicatto il Like',
                           `utente_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Utente che ha messo il Like al Post',
                           `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record (consente di ottenere anche la data del Mi piace del Post)',
                           `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Record'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Like degli Utenti ai Post';

--
-- Dump dei dati per la tabella `mipiace`
--

INSERT INTO `mipiace` (`post_id`, `utente_id`, `created_at`, `updated_at`) VALUES
                                                                               (1, 1, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                               (3, 5, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                               (4, 1, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                               (8, 5, '2021-09-23 12:26:09', '2021-09-23 12:26:09');

--
-- Trigger `mipiace`
--
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_MiPiaceINSERT` BEFORE INSERT ON `mipiace` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_MiPiaceUPDATE` BEFORE UPDATE ON `mipiace` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `nazione`
--

CREATE TABLE `nazione` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero della Nazione',
                           `nome` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome in formato stringa della Nazione (identificativo)'
) ;

--
-- Dump dei dati per la tabella `nazione`
--

INSERT INTO `nazione` (`id`, `nome`) VALUES
                                         (9, 'Australia'),
                                         (8, 'China'),
                                         (4, 'England'),
                                         (12, 'Finland'),
                                         (6, 'France'),
                                         (7, 'Germany'),
                                         (5, 'India'),
                                         (1, 'Italy'),
                                         (2, 'Japan'),
                                         (10, 'New Zeland'),
                                         (11, 'Switzerland'),
                                         (3, 'United States');

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
                        `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Identificativo Intero del Post dell'' Utente',
                        `testo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Testo del Post dell'' Utente',
                        `foto` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Foto del Post dell'' Utente (relativa path del file)',
                        `utente_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria di Utente',
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record (consente di ottenere anche la di Pubblicazione del Post)',
                        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Record'
) ;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id`, `testo`, `foto`, `utente_id`, `created_at`, `updated_at`) VALUES
                                                                                        (1, 'Ecco il mio Primo Post.', '2021_05_05_16_43_53.svg', 1, '2021-05-21 15:12:55', '2021-09-23 12:26:09'),
                                                                                        (2, 'Forza Romaaa', '2021_05_15_15_07_34.png', 1, '2021-05-20 16:13:35', '2021-09-23 12:26:09'),
                                                                                        (3, 'Buongiorno a tutti.', '2021_05_06_08_40_54.jpg', 2, '2021-05-12 10:12:59', '2021-09-23 12:26:09'),
                                                                                        (4, 'Ecco la mia Foto di Profilo', '2021_05_14_23_29_51.jpg', 3, '2020-07-10 10:12:59', '2021-09-23 12:26:09'),
                                                                                        (5, 'Opera del Futurismo.', '2021_05_06_08_38_27.jpg', 4, '2019-07-10 10:12:59', '2021-09-23 12:26:09'),
                                                                                        (6, 'Opera del Futurismo.', '2021_05_11_18_19_57.jpg', 5, '2021-03-12 11:12:59', '2021-09-23 12:26:09'),
                                                                                        (7, 'GITHUB.', '2021_05_17_21_23_34.png', 3, '2021-02-12 11:12:59', '2021-09-23 12:26:09'),
                                                                                        (8, 'La mia Bici.', '2021_05_11_18_19_59.webp', 6, '2021-01-12 11:12:59', '2021-09-23 12:26:09');

--
-- Trigger `post`
--
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_PostINSERT` BEFORE INSERT ON `post` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_PostUPDATE` BEFORE UPDATE ON `post` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `profilo`
--

CREATE TABLE `profilo` (
                           `utente_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria di Utente e chiave primaria del Profilo',
                           `descrizione` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Testo della Descrizione del Profilo Utente',
                           `foto` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Foto del Profilo (relativa path del file)',
                           `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record (consente di ottenere anche la di creazione del Profilo)',
                           `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Profilo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Profilo personale dell''Utente';

--
-- Dump dei dati per la tabella `profilo`
--

INSERT INTO `profilo` (`utente_id`, `descrizione`, `foto`, `created_at`, `updated_at`) VALUES
                                                                                           (1, 'Ciao a tutti mi chiamo Matteo Lambertucci e sono in cerca di Lavoro !!', '2021_06_19_11_52_26.jpg', '2021-09-23 12:26:08', '2021-09-23 12:26:09'),
                                                                                           (2, 'Ciao a tutti mi chiamo Oprea e sono un Cuoco Cinese.', '2021_05_13_11_14_14.jpg', '2021-09-23 12:26:08', '2021-09-23 12:26:09'),
                                                                                           (3, 'Ciao a tutti mi chiamo Michele Mammucari e sono un Poliziotto Cinese.', '2021_05_13_11_05_08.jpg', '2021-09-23 12:26:08', '2021-09-23 12:26:09'),
                                                                                           (4, 'Buongiorno a tutti sono Carol e mi piace il futurismo 🤣🤣🤣', NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:09'),
                                                                                           (5, 'Bella regaaa io so er Devakk', '2021_05_13_11_12_22.jpg', '2021-09-23 12:26:08', '2021-09-23 12:26:09'),
                                                                                           (6, 'Mi chiamo JIT e sono un Imprenditore Parigino', NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:09'),
                                                                                           (7, 'Bella rega io so Bruno Graziosi e faccio Biologia.  FS', NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:09'),
                                                                                           (8, 'Bella Rega, nso voi ma io so Chialastri Matteooo', NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:09'),
                                                                                           (9, 'Io so Riggi Luigi, vengo da Velletri e ovviamente tifo Roma.', NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                           (10, 'Io so Matteo Ciarla, vengo da Velletri e ovviamente tifo Roma.', NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                           (11, 'Buongiorno. Signori e signore sono un Freelancer di Valmontone.', NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                           (12, 'Ciao a tutti, io mi chiamo Bea Cioc ed ho tanti problemi mentali.', NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                           (13, 'Ciao a tutti io mi chiamo Elisa Lambertucci ed abito a Valmontone.', NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                           (14, 'De giorno so Francesco Ballini, de notte nvece so er Devakkk', NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09');

--
-- Trigger `profilo`
--
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_ProfiloINSERT` BEFORE INSERT ON `profilo` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_ProfiloUPDATE` BEFORE UPDATE ON `profilo` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `reportistica`
--

CREATE TABLE `reportistica` (
                                `utente_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria dell'' Utente.',
                                `num_tot_mipiace` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Numero totale Like di ogni Post di un Utente.',
                                `num_max_mipiace` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Numero massimo di Like ricevuti ad un Post di un Utente.',
                                `num_tot_commenti` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Numero totale Commenti di ogni Post di un Utente.',
                                `num_max_commenti` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Numero massimo di Commenti ricevuti ad un Post di un Utente.',
                                `num_tot_post` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Numero totale di Post pubblicati da un Utente.',
                                `num_tot_richieste_amicizia_ricevute` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Numero totale Richieste Amicizia ricevute, sia in sospeso che accettate.',
                                `num_tot_richieste_amicizia_inviate` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Numero totale Richieste Amicizia inviate, sia in sospeso che accettate.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabella contenente dati di Reportistica relativi ad un singolo Utente.';

--
-- Dump dei dati per la tabella `reportistica`
--

INSERT INTO `reportistica` (`utente_id`, `num_tot_mipiace`, `num_max_mipiace`, `num_tot_commenti`, `num_max_commenti`, `num_tot_post`, `num_tot_richieste_amicizia_ricevute`, `num_tot_richieste_amicizia_inviate`) VALUES
                                                                                                                                                                                                                        (1, 1, 1, 3, 2, 2, 6, 2),
                                                                                                                                                                                                                        (2, 1, 1, 1, 1, 1, 2, 5),
                                                                                                                                                                                                                        (3, 1, 1, 2, 1, 2, 0, 2),
                                                                                                                                                                                                                        (4, 0, 0, 1, 1, 1, 0, 4),
                                                                                                                                                                                                                        (5, 0, 0, 1, 1, 1, 3, 1),
                                                                                                                                                                                                                        (6, 1, 1, 1, 1, 1, 3, 0),
                                                                                                                                                                                                                        (7, 0, 0, 0, 0, 0, 2, 1),
                                                                                                                                                                                                                        (8, 0, 0, 0, 0, 0, 1, 1),
                                                                                                                                                                                                                        (9, 0, 0, 0, 0, 0, 2, 1),
                                                                                                                                                                                                                        (10, 0, 0, 0, 0, 0, 0, 0),
                                                                                                                                                                                                                        (11, 0, 0, 0, 0, 0, 0, 1),
                                                                                                                                                                                                                        (12, 0, 0, 0, 0, 0, 0, 1),
                                                                                                                                                                                                                        (13, 0, 0, 0, 0, 0, 1, 0),
                                                                                                                                                                                                                        (14, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `richiestaamicizia`
--

CREATE TABLE `richiestaamicizia` (
                                     `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Identificativo Intero della Richiesta di Amicizia degli Utenti',
                                     `utenteMittente` bigint(20) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria dell'' Utente (mittente della richiesta di amicizia)',
                                     `utenteRicevente` bigint(20) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria dell'' Utente (ricevente della richiesta di amicizia)',
                                     `stato` enum('Sospesa','Accettata') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sospesa' COMMENT 'Stato della Richiesta di Amicizia (in sospeso, rifiutata, Accettata)',
                                     `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record (consente di ottenere anche la data di Pubblicazione del Post)',
                                     `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Record'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Richieste di Amicizia inviate da un Utente ad un altro';

--
-- Dump dei dati per la tabella `richiestaamicizia`
--

INSERT INTO `richiestaamicizia` (`id`, `utenteMittente`, `utenteRicevente`, `stato`, `created_at`, `updated_at`) VALUES
                                                                                                                     (1, 3, 1, 'Accettata', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (2, 2, 1, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (3, 4, 2, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (4, 1, 6, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (5, 5, 1, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (6, 2, 6, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (7, 3, 5, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (8, 4, 1, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (9, 2, 5, 'Accettata', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (10, 4, 6, 'Accettata', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (11, 2, 7, 'Accettata', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (12, 1, 7, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (13, 4, 8, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (14, 8, 5, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (15, 2, 9, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (16, 9, 2, 'Accettata', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (17, 7, 9, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (18, 11, 13, 'Accettata', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (19, 12, 1, 'Sospesa', '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                     (20, 14, 1, 'Accettata', '2021-09-23 12:26:09', '2021-09-23 12:26:09');

--
-- Trigger `richiestaamicizia`
--
DELIMITER $$
CREATE TRIGGER `CHECK_AmiciziaINSERT` BEFORE INSERT ON `richiestaamicizia` FOR EACH ROW BEGIN
    IF (
           SELECT
               COUNT(ra.id)
           FROM
               RichiestaAmicizia AS ra
                   JOIN Utente u ON ra.utenteMittente = u.id
                   JOIN Utente u2 ON ra.utenteRicevente = u2.id
           WHERE
               (ra.utenteMittente = NEW.utenteMittente OR ra.utenteRicevente = NEW.utenteMittente) AND
               (ra.utenteMittente = NEW.utenteRicevente OR ra.utenteRicevente = NEW.utenteRicevente) AND
                   ra.stato = 'Accettata'
       ) > 0 THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Richiesta Amicizia già esistente!';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CHECK_AmiciziaUPDATE` BEFORE UPDATE ON `richiestaamicizia` FOR EACH ROW BEGIN
    IF (
           SELECT
               COUNT(ra.id)
           FROM
               RichiestaAmicizia AS ra
                   JOIN Utente u ON ra.utenteMittente = u.id
                   JOIN Utente u2 ON ra.utenteRicevente = u2.id
           WHERE
               (ra.utenteMittente = NEW.utenteMittente OR ra.utenteRicevente = NEW.utenteMittente) AND
               (ra.utenteMittente = NEW.utenteRicevente OR ra.utenteRicevente = NEW.utenteRicevente) AND
                   ra.stato = 'Accettata'
       ) > 0 THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Richiesta Amicizia già esistente!';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_RichiestaAmiciziaINSERT` BEFORE INSERT ON `richiestaamicizia` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_RichiestaAmiciziaUPDATE` BEFORE UPDATE ON `richiestaamicizia` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
                          `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Identificativo Intero dell'' Utente',
                          `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email dell'' Utente',
                          `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Password dell'' Utente (memorizzata con bcrypt hashing)',
                          `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome anagrafico dell''Utente',
                          `cognome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Cognome anagrafico dell''Utente',
                          `citta_id` int(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiave Primaria di Citta',
                          `api_token` char(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Token API per alcuni servizi Linkedin',
                          `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record',
                          `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Record'
) ;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `email`, `password`, `nome`, `cognome`, `citta_id`, `api_token`, `created_at`, `updated_at`) VALUES
                                                                                                                             (1, 'matteolambertucci3@gmail.com', '$2y$10$Di/LaFRUBkqNp/qBo1nmH.A0gnBGge7sMtye6APtPH6Ek1QJl0oAG', 'Matteo', 'Lambertucci', 1, '6pAd0LVA8rN8mwfQhvrriSmvjZ34ikaXGPyImGKocJ', '2021-09-23 12:26:08', '2021-09-23 12:26:08'),
                                                                                                                             (2, 'opr@gmail.com', '$2y$10$X/04A/y9A6GOuAIZWMiQMubVmpDqXV6NQAEU80YF1u7ZLC1FPLVJ.', 'Alessandro', 'Oprea', 4, NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:08'),
                                                                                                                             (3, 'mich@gmail.com', '$2y$10$l/u7pHIoDR9eqTv6dE0t9.TU29CUzbOpaXacTqn4vFTIUppqRMhHi', 'Michele', 'Mammucari', 4, NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:08'),
                                                                                                                             (4, 'carol@libero.it', '$2y$10$Pb.vUV6tyYxkLO8P3re5JetYnW4im1whkf24IgPG.6BoN.6RBquvm', 'Carol', 'Muscedere', 2, NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:08'),
                                                                                                                             (5, 'devak@yahoo.it', '$2y$10$CR40SojqJqxXeP6ws3z0RuHUI90wxlk/QiXB.Pe4Ur.6fcQShogRi', 'Devak', 'Ballins', 1, NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:08'),
                                                                                                                             (6, 'jitaru@alice.it', '$2y$10$fMf9pMZLbaEhcqgMZQCh8u6.iGmjYkm6e685ovfsRgYC5UMGEZ2.K', 'Gabriel', 'Jitaru', 9, NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:08'),
                                                                                                                             (7, 'brunograziosi@gmail.it', '$2y$10$kZjqWL63vvucBgehlFeycuqrP2yOjKbw88WaFJPwHhMj0kMv5IuQK', 'Bruno', 'Graziosi', 1, NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:08'),
                                                                                                                             (8, 'chialastri02@gmail.it', '$2y$10$TLgKAVy.ADdg/7u0B2rhLu1hOGbnzJKDHtGXNM5QKm34ooy/3nv5y', 'Matteo', 'Chialastri', 1, NULL, '2021-09-23 12:26:08', '2021-09-23 12:26:08'),
                                                                                                                             (9, 'riggi@gmail.it', '$2y$10$3QmBcZIXCkA3NJraY/PsBeNqqjmGTM77iBbu.mFVeog.KD1ZeJAsC', 'Luigi', 'Riggi', 10, NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                             (10, 'mattciarlax@yahoo.it', '$2y$10$LSVr5SQusLiouwieJDArRukFEux7RGSuea6MByEN1PkxzgoqtzLnC', 'Matteo', 'Ciarla', 11, NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                             (11, 'richcass@libero.it', '$2y$10$LAr9RVDuc1f6pEz1j94E0.zTxMQr4kQ2PhdSQdDg4zJYQnPMgT6pa', 'Riccardo', 'Cassanelli', 12, NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                             (12, 'beaciocc@gmail.com', '$2y$10$d15qJqVoGzSlt90JVSbaRuL38f8ICfkjd.qNwm7OhDpp0Gg/vYhP.', 'Beatrice', 'Cioccari', 1, NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                             (13, 'elisa@gmail.com', '$2y$10$Xbbc3AbMIsTeivRb2FK7YOXi9VlyFklj45dbmiYbRJ6SuZ4EGZWSu', 'Elisa', 'Lambertucci', 10, NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09'),
                                                                                                                             (14, 'francescoballini@alice.it', '$2y$10$7sXdOz5p6Tfco..QNMnp4O8U38z6mqGwxlXU8GGc3Yqcw74d2FuiK', 'Francesco', 'Ballini', 1, NULL, '2021-09-23 12:26:09', '2021-09-23 12:26:09');

--
-- Trigger `utente`
--
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_UtenteINSERT` BEFORE INSERT ON `utente` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CHECK_timestamps_UtenteUPDATE` BEFORE UPDATE ON `utente` FOR EACH ROW BEGIN
    IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UtenteLavoroProfiloReportistica_trigger` AFTER INSERT ON `utente` FOR EACH ROW BEGIN
    INSERT INTO Profilo(utente_id) VALUES(NEW.id);
    INSERT INTO UtenteLavoro(utente_id) VALUES(NEW.id);
    INSERT INTO Reportistica(utente_id) VALUES(NEW.id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `utentelavoro`
--

CREATE TABLE `utentelavoro` (
                                `utente_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiave Primaria di Utente',
                                `lavoro_id` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Riferimento alla Chiave Primaria di Lavoro',
                                `dataInizioLavoro` date DEFAULT NULL COMMENT 'Data inizio Lavoro dell'' Utente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Relazione contenente le Chiavi Primarie della Relazione Utente e della Relazione Lavoro';

--
-- Dump dei dati per la tabella `utentelavoro`
--

INSERT INTO `utentelavoro` (`utente_id`, `lavoro_id`, `dataInizioLavoro`) VALUES
                                                                              (1, 1, NULL),
                                                                              (2, 2, '2020-12-12'),
                                                                              (3, 15, '2021-04-10'),
                                                                              (4, 7, '2019-11-14'),
                                                                              (5, 9, '2021-01-02'),
                                                                              (6, 11, '2021-05-17'),
                                                                              (7, 4, '2021-07-09'),
                                                                              (8, 8, '2021-07-09'),
                                                                              (9, 10, '2021-06-09'),
                                                                              (10, 5, '2021-05-19'),
                                                                              (11, 4, '2019-05-19'),
                                                                              (12, 1, NULL),
                                                                              (13, 12, '2018-08-18'),
                                                                              (14, 1, NULL);

--
-- Trigger `utentelavoro`
--
DELIMITER $$
CREATE TRIGGER `CHECK_UtenteLavoroDataInizio` BEFORE UPDATE ON `utentelavoro` FOR EACH ROW BEGIN
    IF(NEW.dataInizioLavoro > CURRENT_DATE()) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'La data di inizio lavoro deve essere antecedente alla data attuale';
    END IF;
    IF (NEW.dataInizioLavoro IS NULL AND NEW.lavoro_id > 1) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Se è presente un lavoro, deve essere presente anche la data di inizio lavoro.';
    ELSEIF (NOT NEW.dataInizioLavoro IS NULL AND NEW.lavoro_id = 1) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Se non è presente un lavoro, non ci deve essere la data di inizio.';
    END IF;
END
$$
DELIMITER ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `citta`
--
ALTER TABLE `citta`
    ADD PRIMARY KEY (`id`),
    ADD KEY `NazioneCittaFK` (`nazione_id`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `PostUtenteCommento_UNIQUE` (`post_id`,`utente_id`,`created_at`),
    ADD KEY `PostCommentoFK` (`post_id`),
    ADD KEY `UtenteCommentoFK` (`utente_id`);

--
-- Indici per le tabelle `lavoro`
--
ALTER TABLE `lavoro`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `nome_Lavoro_UNIQUE` (`nome`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
    ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `mipiace`
--
ALTER TABLE `mipiace`
    ADD PRIMARY KEY (`post_id`,`utente_id`,`created_at`),
    ADD KEY `PostMiPiaceFK` (`post_id`),
    ADD KEY `UtenteMiPiaceFK` (`utente_id`);

--
-- Indici per le tabelle `nazione`
--
ALTER TABLE `nazione`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `nome_Nazione_UNIQUE` (`nome`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `utenteTestoCreatedAt_UtentePost_UNIQUE` (`utente_id`,`created_at`,`testo`);

--
-- Indici per le tabelle `profilo`
--
ALTER TABLE `profilo`
    ADD PRIMARY KEY (`utente_id`);

--
-- Indici per le tabelle `reportistica`
--
ALTER TABLE `reportistica`
    ADD PRIMARY KEY (`utente_id`);

--
-- Indici per le tabelle `richiestaamicizia`
--
ALTER TABLE `richiestaamicizia`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `utenteMittenteRicevente_Utente_UNIQUE` (`utenteMittente`,`utenteRicevente`),
    ADD KEY `UtenteMittenteRichiestaAmiciziaFK` (`utenteMittente`),
    ADD KEY `UtenteRiceventeRichiestaAmiciziaFK` (`utenteRicevente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `Email_Utente_UNIQUE` (`email`),
    ADD UNIQUE KEY `utente_api_token_unique` (`api_token`),
    ADD KEY `UtenteCittaFK` (`citta_id`),
    ADD KEY `user_account` (`email`,`password`) USING BTREE;

--
-- Indici per le tabelle `utentelavoro`
--
ALTER TABLE `utentelavoro`
    ADD PRIMARY KEY (`utente_id`,`lavoro_id`),
    ADD KEY `LavoroUtenteFK` (`lavoro_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `citta`
--
ALTER TABLE `citta`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero della Citta';

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Chiave Primaria della Tabella Commento';

--
-- AUTO_INCREMENT per la tabella `lavoro`
--
ALTER TABLE `lavoro`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero del Lavoro';

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `nazione`
--
ALTER TABLE `nazione`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero della Nazione';

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero del Post dell'' Utente';

--
-- AUTO_INCREMENT per la tabella `richiestaamicizia`
--
ALTER TABLE `richiestaamicizia`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero della Richiesta di Amicizia degli Utenti', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero dell'' Utente';

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `citta`
--
ALTER TABLE `citta`
    ADD CONSTRAINT `NazioneCittaFK` FOREIGN KEY (`nazione_id`) REFERENCES `nazione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `mipiace`
--
ALTER TABLE `mipiace`
    ADD CONSTRAINT `PostMiPiaceFK` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `UtenteMiPiaceFK` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
    ADD CONSTRAINT `UtentePostFK` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `profilo`
--
ALTER TABLE `profilo`
    ADD CONSTRAINT `ProfiloUtenteFK` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `reportistica`
--
ALTER TABLE `reportistica`
    ADD CONSTRAINT `ReportisticaUtenteFK` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `richiestaamicizia`
--
ALTER TABLE `richiestaamicizia`
    ADD CONSTRAINT `UtenteMittenteRichiestaAmiciziaFK` FOREIGN KEY (`utenteMittente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `UtenteRiceventeRichiestaAmiciziaFK` FOREIGN KEY (`utenteRicevente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
    ADD CONSTRAINT `UtenteCittaFK` FOREIGN KEY (`citta_id`) REFERENCES `citta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utentelavoro`
--
ALTER TABLE `utentelavoro`
    ADD CONSTRAINT `LavoroUtenteFK` FOREIGN KEY (`lavoro_id`) REFERENCES `lavoro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `UtenteLavoroFK` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


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
