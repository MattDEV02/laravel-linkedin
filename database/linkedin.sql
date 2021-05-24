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
-- Struttura della tabella `nazione`
--

CREATE TABLE IF NOT EXISTS Nazione (
   id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificativo Intero della Nazione',
   nome VARCHAR(35) NOT NULL UNIQUE COMMENT 'Nome in formato stringa della Nazione (identificativo)',
   CONSTRAINT NomeNazioneCheck CHECK(CHAR_LENGTH(nome) > 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Nazionalità dell\'Utente';

OPTIMIZE TABLE Nazione;

SHOW CREATE TABLE Nazione;

DESCRIBE Nazione;

-- --------------------------------------------------------

--
-- Struttura della tabella `citta`
--

CREATE TABLE IF NOT EXISTS Citta (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificativo Intero della Citta',
	nome VARCHAR(35) NOT NULL COMMENT 'Nome in formato stringa della Citta', -- Il Nome di una Citta' non è univoco. --
	nazione INT(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria di Nazione',
	CONSTRAINT NomeCittaCheck CHECK(CHAR_LENGTH(nome) > 2),
	CONSTRAINT NazioneCittaFK FOREIGN KEY(nazione) REFERENCES Nazione(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Citta dove risiede l\'Utente';


OPTIMIZE TABLE Citta;

SHOW CREATE TABLE Citta;

DESCRIBE Citta;

-- --------------------------------------------------------

--
-- Struttura della tabella `Lavoro`
--

CREATE TABLE IF NOT EXISTS Lavoro (
   id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificativo Intero del Lavoro',
   nome VARCHAR(35) NOT NULL UNIQUE COMMENT 'Nome in formato stringa del Lavoro dell''Utente',
   CONSTRAINT NomeLavoroCheck CHECK(CHAR_LENGTH(nome) > 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lavoro svolto dall''Utente';


-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--

CREATE TABLE IF NOT EXISTS Utente (  -- Relazione Principale --
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificativo Intero dell'' Utente',
    email VARCHAR(45) NOT NULL COMMENT 'Email dell'' Utente',
    password CHAR(60) NOT NULL UNIQUE COMMENT 'Password dell'' Utente', -- BCRYPT HASHING (10 round)--
    nome VARCHAR(35) NOT NULL COMMENT 'Nome anagrafico dell''Utente',
    cognome VARCHAR(35) NOT NULL COMMENT 'Cognome anagrafico dell''Utente',
    citta INT(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiave Primaria di Citta',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Data Creazione del Record',
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'Data Aggiornamento del Record',
	CONSTRAINT EmailUtenteCheck CHECK(CHAR_LENGTH(email) > 2),
	CONSTRAINT PasswordUtenteCheck CHECK(CHAR_LENGTH(password) > 2),
	CONSTRAINT NomeUtenteCheck CHECK(CHAR_LENGTH(nome) > 2),
    CONSTRAINT CognomeUtenteCheck CHECK(CHAR_LENGTH(cognome) > 2),
    CONSTRAINT UtenteCittaFK FOREIGN KEY(citta) REFERENCES Citta(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Profilo personale dell''Utente';

OPTIMIZE TABLE Utente;

SHOW CREATE TABLE Utente;

DESCRIBE Utente;

-- --------------------------------------------------------

--
-- Struttura della tabella `DescrizioneUtente`
--

CREATE TABLE IF NOT EXISTS DescrizioneUtente (  -- Profilo personale Utente --
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificativo Intero della Descrizione dell'' Utente',
	testo VARCHAR(255) DEFAULT NULL COMMENT 'Testo della Descrizione dell'' Utente',
	foto VARCHAR(25) DEFAULT NULL COMMENT 'Foto della Descrizione dell'' Utente (relative path del file)',
	utente INT(10) UNSIGNED NOT NULL UNIQUE COMMENT 'Riferimento alla Chiava Primaria di Utente',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Data Creazione del Record',
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'Data Aggiornamento del Record',
	CONSTRAINT UtenteDescrizioneFK FOREIGN KEY(utente) REFERENCES Utente(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Profilo personale dell''Utente';


OPTIMIZE TABLE DescrizioneUtente;

SHOW CREATE TABLE DescrizioneUtente;

DESCRIBE DescrizioneUtente;

-- --------------------------------------------------------

--
-- Struttura della tabella `Post`
--

CREATE TABLE IF NOT EXISTS Post (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificativo Intero del Post dell'' Utente',
	testo VARCHAR(255) NOT NULL COMMENT 'Testo del Post dell'' Utente',
	foto VARCHAR(25) NOT NULL COMMENT 'Foto del Post dell'' Utente (relativa path del file)',
	utente INT(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria di Utente',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Data Creazione del Record (consente di ottenere anche la di Pubblicazione del Post)',
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'Data Aggiornamento del Record',
	CONSTRAINT UtenteCreatedAt_UtentePost_UNIQUE UNIQUE(utente, created_at),
	CONSTRAINT TestoPostCheck CHECK(CHAR_LENGTH(testo) > 2),
	CONSTRAINT FotoPostCheck CHECK(CHAR_LENGTH(foto) > 2),
	CONSTRAINT UtentePostFK FOREIGN KEY (Utente) REFERENCES Utente(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Post pubblicati dagli Utenti';


OPTIMIZE TABLE Post;

SHOW CREATE TABLE Post;

DESCRIBE Post;


--
-- Struttura della tabella `MiPiace`
--

CREATE TABLE IF NOT EXISTS MiPiace (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Chiave Primaria della Tabella MiPiace',
    post INT(10) UNSIGNED NOT NULL COMMENT 'Post su cui è stato applicatto il Like' ,
    utente INT(10) UNSIGNED NOT NULL COMMENT 'Utente che ha messo il Like al Post',
    CONSTRAINT PostUtenteMiPiace_UNIQUE UNIQUE(post, utente),
    CONSTRAINT PostMiPiaceFK FOREIGN KEY (post) REFERENCES Post(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT PostUtenteFK FOREIGN KEY (utente) REFERENCES Utente(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Like degli Utenti ai Post';


OPTIMIZE TABLE MiPiace;

SHOW CREATE TABLE MiPiace;

DESCRIBE MiPiace;


-- --------------------------------------------------------

--
-- Struttura della tabella `richiestaamicizia`
--

CREATE TABLE IF NOT EXISTS RichiestaAmicizia (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificativo Intero della Richiesta di Amicizia degli Utenti',
	utenteMittente INT(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria dell'' Utente (mittente della richiesta di amicizia)',
	utenteRicevente INT(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiava Primaria dell'' Utente (ricevente della richiesta di amicizia)',
	stato ENUM('Sospesa','Accettata') NOT NULL DEFAULT 'Sospesa' COMMENT 'Stato della Richiesta di Amicizia (in sospeso, rifiutata, Accettata)',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Data Creazione del Record (consente di ottenere anche la data di Pubblicazione del Post)',
	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'Data Aggiornamento del Record',
	CONSTRAINT utenteMittenteRicevente_UNIQUE UNIQUE(utenteMittente, utenteRicevente),
	CONSTRAINT utenteRiceventeMittente_UNIQUE UNIQUE(utenteMittente, utenteRicevente),
	CONSTRAINT UtenteMittenteRichiestaAmiciziaFK FOREIGN KEY (utenteMittente) REFERENCES Utente(id) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT utenteRiceventeRichiestaAmiciziaFK FOREIGN KEY (utenteRicevente) REFERENCES Utente(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Richieste di Amicizia inviate da un Utente ad un altro';


OPTIMIZE TABLE MiPiace;

SHOW CREATE TABLE MiPiace;

DESCRIBE MiPiace;

-- --------------------------------------------------------

--
-- Struttura della tabella `UtenteLavoro`
--

CREATE TABLE IF NOT EXISTS UtenteLavoro (
	utente INT(10) UNSIGNED NOT NULL COMMENT 'Riferimento alla Chiave Primaria di Utente',
	lavoro INT(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Riferimento alla Chiave Primaria di Lavoro',
	dataInizioLavoro DATE DEFAULT NULL COMMENT 'Data inizio Lavoro dell'' Utente',
	PRIMARY KEY (Utente, Lavoro),
	CONSTRAINT UtenteLavoroFK FOREIGN KEY (utente) REFERENCES Utente(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT LavoroUtenteFK FOREIGN KEY (lavoro) REFERENCES Lavoro(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Relazione contenente le Chiavi Primarie della Relazione Utente e della Relazione Lavoro';

OPTIMIZE TABLE UtenteLavoro;

SHOW CREATE TABLE UtenteLavoro;

DESCRIBE UtenteLavoro;


--
-- Dump dei dati per la tabella `lavoro`
--

INSERT INTO Lavoro (id, nome) VALUES
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
-- Dump dei dati per la tabella `Nazione`
--

INSERT INTO Nazione (id,nome) VALUES
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
-- Dump dei dati per la tabella `Citta`
--

INSERT INTO Citta (id, nome, nazione) VALUES
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
-- Dump dei dati per la tabella `Utente`
--

INSERT INTO Utente (id, email, password, nome, cognome, citta, created_at, updated_at) VALUES
    (1, 'matteolambertucci3@gmail.com', '$2y$10$e90jbP8BXml6/4r3iqla5uyjBRItI9N/Er.vwO.DXPUoRfyJvFAKC', 'Matteo', 'Lambertucci', 1, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
    (2, 'opr@gmail.com', '$2y$10$J6qj1VDPCmHC4FnnMDD.QeeuTkXT/dy4Mvv/eW3yBLfc/VXtMMO5S', 'Alessandro', 'Oprea', 4, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
    (3, 'mich@gmail.com', '$2y$10$wgbYX07RN9ezScIIhYON.ujyFbEnYXY1JIO7lGBMtLEETyTkAKhia', 'Michele', 'Mammucari', 4, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
    (4, 'carol@libero.it', '$2y$10$BJKxsFbDzWbP7eqyABXFmOSWTUZYb79OG2Ij91CmA89AuoKErr1RW', 'Carol', 'Muscedere', 2, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
    (5, 'devak@yahoo.it', '$2y$10$drIHung.GZ2vEYiIHnMmDOpXk113YdGBksdLZHuWK9yPfaTgEf0/u', 'Devak', 'Ballins', 1, '2021-05-20 17:59:10', '2021-05-20 17:59:10'),
    (6, 'jitaru@alice.it', '$2y$10$8M7n2utt.Ybuh4cLBg1Oy.egspVwGQeEyvaAVTtTzxTlXlRKPnaPa', 'Gabriel', 'Jitaru', 9, '2021-05-20 17:59:11', '2021-05-20 17:59:11');

--
-- Dump dei dati per la tabella `UtenteLavoro`
--

INSERT INTO UtenteLavoro (utente, lavoro, dataInizioLavoro) VALUES
(1, 1, NULL),
(2, 2, '2020-12-12'),
(3, 15, '2021-04-10'),
(4, 7, '2019-11-14'),
(5, 9, '2021-01-02'),
(6, 11, '2021-05-17');

--
-- Dump dei dati per la tabella `DescrizioneUtente`
--

INSERT INTO DescrizioneUtente (id, testo, foto, utente, created_at, updated_at) VALUES
(1, 'Ciao a tutti mi chiamo Matteo Lambertucci e sono in cerca di Lavoro !!', '2021_05_20_19_21_16.jpg', 1, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(2, 'Ciao a tutti mi chiamo Oprea e sono un Cuoco Cinese.', '2021_05_13_11_14_14.jpg', 2, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(3, 'Ciao a tutti mi chiamo Michele Mammucari e sono un Poliziotto Cinese.', '2021_05_13_11_05_08.jpg', 3, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(4, NULL, NULL, 4, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(5, 'Bella regaaa io so er Devakk', '2021_05_13_11_12_22.jpeg', 5, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
(6, 'Mi chiamo JIT e sono un Imprenditore Parigino', NULL, 6, '2021-05-20 17:59:11', '2021-05-20 17:59:11');

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO Post (`id`, `testo`, `foto`, `utente`, `created_at`, `updated_at`) VALUES
    (1, 'Ecco il mio Primo Post.', '2021_05_05_16_43_53.svg', 1, '2021-05-20 17:59:11', '2021-05-20 17:59:11'),
    (2, 'Forza Romaaa', '2021_05_15_15_07_34.png', 1, '2021-05-20 17:59:12', '2021-05-20 17:59:11'),
    (3, 'Buongiorno a tutti.', '2021_05_06_08_40_54.jpg', 2, '2021-05-20 17:59:13', '2021-05-20 17:59:11'),
    (4, 'Ecco la mia Foto di Profilo', '2021_05_14_23_29_51.jpg', 3, '2021-05-20 17:59:14', '2021-05-20 17:59:11'),
    (5, 'Opera del Futurismo.', '2021_05_06_08_38_27.jpg', 4, '2021-05-20 17:59:15', '2021-05-20 17:59:11'),
    (6, 'Opera del Futurismo.', '2021_05_11_18_19_57.jpg', 5, '2021-05-20 17:59:16', '2021-05-20 17:59:11'),
    (7, 'GITHUB.', '2021_05_17_21_23_34.png', 3, '2021-05-20 17:59:17', '2021-05-20 17:59:11'),
    (8, 'La mia Bici.', '2021_05_11_18_19_59.webp', 6, '2021-05-20 17:59:18', '2021-05-20 17:59:11');

--
-- Dump dei dati per la tabella `Richiestaamicizia`
--

INSERT INTO RichiestaAmicizia (`id`, `utenteMittente`, `utenteRicevente`, `stato`, `created_at`, `updated_at`) VALUES
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

INSERT INTO MiPiace (id, post, utente) VALUES
    (1, 1, 1),
    (3, 3, 2);


COMMIT;

SHOW TABLES;

-- QUERY DI ESEMPIO --

SELECT
    p.id,
    p.utente AS utente_id,
    p.foto,
    p.testo,
    p.created_at,
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
        p.utente < 15
GROUP BY
    p.id
ORDER BY
    p.created_at DESC
LIMIT 25;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
