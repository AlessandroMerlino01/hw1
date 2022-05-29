-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 28, 2022 alle 19:44
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `testo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Struttura della tabella `contenents`
--

CREATE TABLE `contenents` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `contenents`
--

INSERT INTO `contenents` (`id`, `foto`, `titolo`, `descrizione`) VALUES
(1, './images/day-date.jpg', 'Day-date', 'Indossato negli anni da personalità politiche, dirigenti e visionari del mondo intero, il Day‑Date è immediatamente riconoscibile al polso, in particolare per l’emblematico bracciale President. Il destino era nel nome, perché data la statura degli uomini che l’hanno indossato, il Day‑Date è stato soprannominato “l’orologio dei presidenti”.'),
(2, './images/submariner.jpg', 'Submariner', 'Presentato nel 1953, il Submariner è il primo orologio da polso subacqueo impermeabile fino a 100 metri di profondità. Questo modello rappresenta un eccezionale progresso tecnico in termini di impermeabilità, la seconda rivoluzione in quest’ambito dopo la creazione dell’Oyster, il primo orologio da polso impermeabile della storia, nel 1926. Il Submariner ha costituito una svolta storica nel mondo dell’orologeria, diventando l’archetipo degli orologi subacquei. Oggi il Submariner è impermeabile fino a una profondità di 300 metri.'),
(3, './images/gmt.jpg', 'GMT_MASTER II', 'Progettato per indicare l’ora di due fusi orari simultaneamente, il GMT‑Master, lanciato nel 1955, è nato come strumento di navigazione per i professionisti che girano il mondo.  Il GMT‑Master II, erede del modello originale, è stato presentato nel 1982, con un nuovo movimento facile da utilizzare. Ben presto ha conquistato un gran numero di viaggiatori con la sua impareggiabile funzionalità, la sua robustezza e la sua estetica immediatamente riconoscibile.');

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `contenent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`) VALUES
(1, 'main', 'main', 'main', 'main', 'main');


--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `contenents`
--
ALTER TABLE `contenents`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`,`contenent`),
  ADD KEY `contenent` (`contenent`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `contenents`
--
ALTER TABLE `contenents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`contenent`) REFERENCES `contenents` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
