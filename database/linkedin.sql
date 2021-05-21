-- Host: 127.0.0.1
-- Creato il: Mag 20, 2021 alle 19:59
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.2


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

CREATE SCHEMA IF NOT EXISTS Linkedin;

-- --------------------------------------------------------

--
-- Struttura della tabella `citta`
--

CREATE TABLE IF NOT EXISTS Citta (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificativo Intero della Citta',
    nome VARCHAR(35) NOT NULL COMMENT 'Nome in formato stringa della Citta', -- Il Nome di una Citta non è univoco. --
    nazione INT(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria di Nazione',
    CONSTRAINT NazioneCittaFK FOREIGN KEY(nazione) REFERENCES Nazione(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Citta dove risiede l\'Utente';

OPTIMIZE TABLE Citta;

SHOW CREATE TABLE Citta;

DESCRIBE Citta;

-- --------------------------------------------------------

--
-- Struttura della tabella `descrizioneutente`
--

CREATE TABLE `descrizioneutente` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero della Descrizione dell'' Utente',
                                     `testo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Testo della Descrizione dell'' Utente',
                                     `foto` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Foto della Descrizione dell'' Utente (relative path del file)',
                                     `utente` int(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria di Utente',
                                     `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record',
                                     `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Record'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Profilo personale dell''Utente';

--
-- Dump dei dati per la tabella `descrizioneutente`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `lavoro`
--

CREATE TABLE `lavoro` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero del Lavoro',
                          `nome` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome in formato stringa del Lavoro dell''Utente'
) ;


--
-- Struttura della tabella `mipiace`
--

CREATE TABLE `mipiace` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT 'Chiave Primaria della Tabella MiPiace',
                           `post` int(10) UNSIGNED NOT NULL,
                           `utente` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Like degli Utenti ai Post';


-- --------------------------------------------------------

--
-- Struttura della tabella `nazione`
--

CREATE TABLE `nazione` (
                           `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero della Nazione',
                           `nome` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome in formato stringa della Nazione (identificativo)'
) ;


-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
                        `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero del Post dell'' Utente',
                        `testo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Testo del Post dell'' Utente',
                        `foto` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Foto del Post dell'' Utente (relativa path del file)',
                        `utente` int(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria di Utente',
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record (consente di ottenere anche la di Pubblicazione del Post)',
                        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Record'
) ;



-- --------------------------------------------------------

--
-- Struttura della tabella `richiestaamicizia`
--

CREATE TABLE `richiestaamicizia` (
                                     `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero della Richiesta di Amicizia degli Utenti',
                                     `utenteMittente` int(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria dell'' Utente (mittente della richiesta di amicizia)',
                                     `utenteRicevente` int(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria dell'' Utente (ricevente della richiesta di amicizia)',
                                     `stato` enum('Sospesa','Accettata') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sospesa' COMMENT 'Stato della Richiesta di Amicizia (in sospeso, rifiutata, Accettata)',
                                     `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record (consente di ottenere anche la data di Pubblicazione del Post)',
                                     `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Record'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Richieste di Amicizia inviate da un Utente ad un altro';

--
-- Dump dei dati per la tabella `richiestaamicizia`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
                          `id` int(10) UNSIGNED NOT NULL COMMENT 'Identificativo Intero dell'' Utente',
                          `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email dell'' Utente',
                          `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Password dell'' Utente',
                          `nome` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome anagrafico dell''Utente',
                          `cognome` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Cognome anagrafico dell''Utente',
                          `citta` int(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiave Primaria di Citta',
                          `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data Creazione del Record',
                          `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data Aggiornamento del Record'
) ;


-- --------------------------------------------------------

--
-- Struttura della tabella `utentelavoro`
--

CREATE TABLE `utentelavoro` (
                                `utente` int(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiave Primaria di Utente',
                                `lavoro` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Riferimento alla Chiave Primaria di Lavoro',
                                `dataInizioLavoro` date DEFAULT NULL COMMENT 'Data inizio Lavoro dell'' Utente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Relazione contenente le Chiavi Primarie della Relazione Utente e della Relazione Lavoro';


--
-- Indici per le tabelle scaricate
--


--
-- Indici per le tabelle `descrizioneutente`
--
ALTER TABLE `descrizioneutente`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `utente_Utente_UNIQUE` (`utente`);

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
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `PostUtenteMiPiace_UNIQUE` (`post`,`utente`),
    ADD KEY `PostMiPiaceFK` (`post`),
    ADD KEY `UtenteMiPiaceFK` (`utente`);

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
    ADD UNIQUE KEY `utenteTestoCreatedAt_UtentePost_UNIQUE` (`utente`,`created_at`,`testo`);

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
    ADD KEY `UtenteCittaFK` (`citta`);

--
-- Indici per le tabelle `utentelavoro`
--
ALTER TABLE `utentelavoro`
    ADD PRIMARY KEY (`utente`,`lavoro`),
    ADD KEY `LavoroUtenteFK` (`lavoro`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `descrizioneutente`
--
ALTER TABLE `descrizioneutente`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero della Descrizione dell'' Utente', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `lavoro`
--
ALTER TABLE `lavoro`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero del Lavoro';

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1481;

--
-- AUTO_INCREMENT per la tabella `mipiace`
--
ALTER TABLE `mipiace`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Chiave Primaria della Tabella MiPiace', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `nazione`
--
ALTER TABLE `nazione`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero della Nazione';

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero del Post dell'' Utente';

--
-- AUTO_INCREMENT per la tabella `richiestaamicizia`
--
ALTER TABLE `richiestaamicizia`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero della Richiesta di Amicizia degli Utenti', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificativo Intero dell'' Utente';

--
-- Limiti per le tabelle scaricate
--

-- Limiti per la tabella `descrizioneutente`
--
ALTER TABLE `descrizioneutente`
    ADD CONSTRAINT `UtenteDescrizioneFK` FOREIGN KEY (`utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `mipiace`
--
ALTER TABLE `mipiace`
    ADD CONSTRAINT `PostMiPiaceFK` FOREIGN KEY (`post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `UtenteMiPiaceFK` FOREIGN KEY (`utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
    ADD CONSTRAINT `UtentePostFK` FOREIGN KEY (`utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
    ADD CONSTRAINT `UtenteCittaFK` FOREIGN KEY (`citta`) REFERENCES `citta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


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

--
-- Dump dei dati per la tabella `nazione`
--

INSERT INTO `nazione` (`id`, `nome`) VALUES
(9, 'Australia'),
(8, 'Cina'),
(12, 'Finlandia'),
(6, 'Francia'),
(7, 'Germania'),
(2, 'Giappone'),
(5, 'India'),
(4, 'Inghilterra'),
(1, 'Italia'),
(10, 'Nuova Zelanda'),
(3, 'Stati Uniti'),
(11, 'Svizzera');

--
-- Dump dei dati per la tabella `citta`
--

INSERT INTO `citta` (`id`, `nome`, `nazione`) VALUES
(1, 'Roma', 1),
(2, 'Milano', 1),
(3, 'Londra', 4),
(4, 'Pechino', 8),
(6, 'Los Angeles', 3),
(7, 'New York', 3),
(8, 'Boston', 3),
(9, 'Parigi', 6),
(10, 'Marsiglia', 6),
(11, 'Sydney', 9),
(12, 'Francoforte', 7),
(13, 'Tokyo', 2);


--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `email`, `password`, `nome`, `cognome`, `citta`, `created_at`, `updated_at`) VALUES
(1, 'matteolambertucci3@gmail.com', '$2y$10$e90jbP8BXml6/4r3iqla5uyjBRItI9N/Er.vwO.DXPUoRfyJvFAKC', 'Matteo', 'Lambertucci', 1, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
(2, 'opr@gmail.com', '$2y$10$J6qj1VDPCmHC4FnnMDD.QeeuTkXT/dy4Mvv/eW3yBLfc/VXtMMO5S', 'Alessandro', 'Oprea', 4, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
(3, 'mich@gmail.com', '$2y$10$wgbYX07RN9ezScIIhYON.ujyFbEnYXY1JIO7lGBMtLEETyTkAKhia', 'Michele', 'Mammucari', 4, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
(4, 'carol@libero.it', '$2y$10$BJKxsFbDzWbP7eqyABXFmOSWTUZYb79OG2Ij91CmA89AuoKErr1RW', 'Carol', 'Muscedere', 2, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
(5, 'devak@yahoo.it', '$2y$10$drIHung.GZ2vEYiIHnMmDOpXk113YdGBksdLZHuWK9yPfaTgEf0/u', 'Devak', 'Ballins', 1, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
(6, 'jitaru@alice.it', '$2y$10$8M7n2utt.Ybuh4cLBg1Oy.egspVwGQeEyvaAVTtTzxTlXlRKPnaPa', 'Gabriel', 'Jitaru', 9, '2021-05-20 17:59:11', '2021-05-20 17:59:11');

--
-- Dump dei dati per la tabella `utentelavoro`
--


INSERT INTO `utentelavoro` (`utente`, `lavoro`, `dataInizioLavoro`) VALUES
(1, 1, NULL),
(2, 2, '2020-12-12'),
(3, 15, '2021-04-10'),
(4, 7, '2019-11-14'),
(5, 9, '2021-01-02'),
(6, 11, '2021-05-17');

--
-- Dump dei dati per la tabella `descrizioneutente`
--

INSERT INTO `descrizioneutente` (`id`, `testo`, `foto`, `utente`, `created_at`, `updated_at`) VALUES
(1, 'Ciao a tutti mi chiamo Matteo Lambertucci e sono in cerca di Lavoro !!', '2021_05_20_19_21_16.jpg', 1, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(2, 'Ciao a tutti mi chiamo Oprea e sono un Cuoco Cinese.', '2021_05_13_11_14_14.jpg', 2, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(3, 'Ciao a tutti mi chiamo Michele Mammucari e sono un Poliziotto Cinese.', '2021_05_13_11_05_08.jpg', 3, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(4, NULL, NULL, 4, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(5, 'Bella regaaa io so er Devakk', '2021_05_13_11_12_22.jpeg', 5, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(6, 'Mi chiamo JIT e sono un Imprenditore Parigino', NULL, 6, '2021-05-20 17:59:11', '2021-05-20 17:59:11');

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id`, `testo`, `foto`, `utente`, `created_at`, `updated_at`) VALUES
(1, 'Ecco il mio Primo Post.', '2021_05_05_16_43_53.svg', 1, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(2, 'Forza Romaaa', '2021_05_15_15_07_34.png', 1, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(3, 'Buongiorno a tutti.', '2021_05_06_08_40_54.jpg', 2, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(4, 'Ecco la mia Foto di Profilo', '2021_05_14_23_29_51.jpg', 3, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(5, 'Opera del Futurismo.', '2021_05_06_08_38_27.jpg', 4, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(6, 'Opera del Futurismo.', '2021_05_11_18_19_57.jpg', 5, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(7, 'GITHUB.', '2021_05_17_21_23_34.png', 3, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(8, 'La mia Bici.', '2021_05_11_18_19_59.webp', 6, '2021-05-20 17:59:11', '2021-05-20 17:59:11');

--
-- Dump dei dati per la tabella `richiestaamicizia`
--

INSERT INTO `richiestaamicizia` (`id`, `utenteMittente`, `utenteRicevente`, `stato`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Accettata', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(2, 2, 1, 'Sospesa', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(3, 4, 2, 'Sospesa', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(4, 1, 6, 'Sospesa', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(5, 5, 1, 'Sospesa', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(6, 2, 6, 'Sospesa', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(7, 3, 5, 'Sospesa', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(8, 4, 1, 'Sospesa', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(9, 2, 5, 'Accettata', '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(10, 4, 6, 'Accettata', '2021-05-20 17:59:11', '2021-05-20 17:59:11');


--
-- Dump dei dati per la tabella `mipiace`
--

INSERT INTO `mipiace` (`id`, `post`, `utente`) VALUES
(1, 1, 1),
(3, 3, 2);


--
-- Limiti per la tabella `utentelavoro`
--
ALTER TABLE `utentelavoro`
    ADD CONSTRAINT `LavoroUtenteFK` FOREIGN KEY (`lavoro`) REFERENCES `lavoro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `UtenteLavoroFK` FOREIGN KEY (`utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

SHOW TABLES;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
