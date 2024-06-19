-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 19. Jun 2024 um 14:48
-- Server-Version: 5.7.39
-- PHP-Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `EBEWD2_CR5_animal_adoption_IlianaMarquez`
--
CREATE DATABASE IF NOT EXISTS `EBEWD2_CR5_animal_adoption_IlianaMarquez` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `EBEWD2_CR5_animal_adoption_IlianaMarquez`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adoptions`
--

CREATE TABLE `adoptions` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_pet` int(11) NOT NULL,
  `adoption_date` date NOT NULL,
  `adoption_location` varchar(255) NOT NULL,
  `adoption_notes` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `adoptions`
--

INSERT INTO `adoptions` (`id`, `fk_user`, `fk_pet`, `adoption_date`, `adoption_location`, `adoption_notes`) VALUES
(1, 4, 1, '2024-06-19', 'Vienna, Austria', NULL),
(2, 5, 6, '2024-06-19', 'Vienna, Austria', NULL),
(3, 5, 5, '2024-06-19', 'Vienna, Austria', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `pet_age` int(3) NOT NULL,
  `pet_size` varchar(255) NOT NULL,
  `pet_gender` varchar(10) NOT NULL,
  `vaccines` tinyint(1) NOT NULL,
  `pet_location` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `pet_description` varchar(400) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `pets`
--

INSERT INTO `pets` (`id`, `pet_name`, `breed`, `pet_age`, `pet_size`, `pet_gender`, `vaccines`, `pet_location`, `status`, `pet_description`, `picture`) VALUES
(1, 'Chorreada', 'dog', 4, 'Medium', 'female', 1, '5th Avenue, New York, USA', 0, 'Always full of energy and loves to play fetch. Very loyal and protective of my family.', '6672ac5a88b15.jpg'),
(2, 'Gordito', 'cat', 5, 'Medium', 'male', 1, 'Mexico City, Mexico', 0, 'A bit on the chubby side, but that just means there&#039;s more to love. Loves lounging in sunny spots and getting belly rubs.', '66719289a2f61.jpg'),
(3, 'Snowflake', 'cat', 1, 'Small', 'female', 0, 'Moscow, Russia', 0, 'A little shy at first, but once warmep up, very affectionate and loves to play with her toys.', '6671933365be0.jpg'),
(4, 'Guaguis', 'dog', 6, 'Small', 'female', 1, 'Buenos Aires, Argentina', 0, 'Very friendly and loves meeting new people. Enjoys long walks and playing in the park.', '6671939aaba9e.jpg'),
(5, 'Juanita', 'iguana', 8, 'Medium', 'female', 0, 'Lima, Peru', 0, 'Enjoys basking in the sun and loves munching on fresh greens and exploring her habitat.', '6671944468b83.jpg'),
(6, 'Cozu', 'cat', 1, 'Small', 'male', 1, 'Tokio, Japan', 0, 'He&#039;s curious and loves to explore every corner of the house. He ejoys cuddling and purring in your lap.', '66719e925860f.jpg'),
(7, 'Sleepy', 'ferret', 3, 'Small', 'male', 1, 'Berlin, Germany', 0, 'Loves to nap in cozy places and when awake he´s very playful and mischievous.', '6671a13b5ab7e.jpg'),
(8, 'Ludmilla', 'pony', 10, 'Big', 'female', 1, 'Dublin, Ireland', 0, 'She&#039;s gentle and love being around people. Enjoys grazing in the fields and getting groomed.', '6671a39cb7257.jpg'),
(9, 'Thinker', 'cat', 9, 'Small', 'female', 1, 'London, UK', 0, 'She&#039;s very inteligent and loves solving puzzles. She enjoy quiet time and observing her surroundings.', '6671a4ab4329a.jpg'),
(10, 'Perron', 'dog', 8, 'Medium', 'male', 1, 'Cape Town, South Africa', 0, 'He&#039;s very brave and loves to protect his family. Also enjoys playing fetch and going on hikes.', '6671a70a5f05a.jpg'),
(11, 'Mausi', 'hamster', 2, 'Small', 'male', 0, 'Paris, France', 0, 'Small but full of energy. Loves running on his wheel and exploring his cage.', '6671a787870b5.jpg'),
(12, 'Parrotin', 'parrot', 5, 'Small', 'male', 0, 'Rio de Janeiro, Brazil', 0, 'Very talkative and loves mimicking sounds. Enjoys flying around and eating fruits.', '6671a963bca5f.jpg'),
(13, 'Loco', 'dog', 4, 'Big', 'male', 1, 'Sydney, Australia', 0, ' He&#039;s a bit of a wild one, always ready for an adventure. Loves running around and playing with other dogs.', '6671aa2851df9.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `date_of_birth`, `address`, `phone_number`, `picture`, `status`) VALUES
(3, 'Lola', 'Laloca', 'loca@loca.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '2000-07-10', 'Loca Str #45, Los Angeles, USA', '+453544113214', '667200b80235b.jpg', 'admn'),
(4, 'Iliana', 'Mar', 'ili@mar.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1970-09-10', 'Zollergasse 16, 1070 Vienna', '+43(1)5453114', '66723a58cb2b4.jpg', 'user'),
(5, 'Selma', 'Martens', 'jo@jo.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1995-02-10', 'La calle de los remedios 45, 1854 Madrid', '+3465468476865', '66720c9418610.jpg', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_pet` (`fk_pet`);

--
-- Indizes für die Tabelle `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `adoptions_ibfk_2` FOREIGN KEY (`fk_pet`) REFERENCES `pets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
