-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Lis 2016, 09:35
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_polish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `message`
--

INSERT INTO `message` (`id`, `receiverID`, `senderID`, `text`, `date`) VALUES
(1, 28, 27, 'wiadomość testowa', '2016-11-25 00:00:00'),
(2, 26, 28, 'testowa wiadomosc', '2016-11-10 00:00:00'),
(3, 27, 28, 'fdsgagas', '2016-11-25 11:25:38'),
(4, 27, 28, 'testowa wiadomosc html1', '2016-11-25 11:25:53');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_polish_ci NOT NULL,
  `date` datetime NOT NULL,
  `insertUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `tweet`
--

INSERT INTO `tweet` (`id`, `userID`, `text`, `date`, `insertUser`) VALUES
(35, 25, 'czesc MArcin\r\n', '2016-11-24 11:00:55', 26),
(36, 26, 'hej', '2016-11-24 11:09:33', 26),
(37, 27, 'hejka', '2016-11-24 11:14:16', 27),
(38, 28, 'tttt', '2016-11-24 11:16:08', 28),
(39, 27, 'ttttttt', '2016-11-24 11:16:20', 28);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(65) COLLATE utf8mb4_polish_ci NOT NULL,
  `username` varchar(65) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(65) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(25, '1234@wp.pl', 'marcin1', '1234'),
(26, 'test@wp.pl', 'marcin12345', '12345'),
(27, 'daria@outlook.com', 'Daria', '123'),
(28, 'test@outlook.com', 'test', '123');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiverID` (`receiverID`),
  ADD KEY `senderID` (`senderID`);

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`receiverID`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
