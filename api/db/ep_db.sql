-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 25. dec 2017 ob 23.11
-- Različica strežnika: 10.1.29-MariaDB
-- Različica PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `ep_db`
--

-- --------------------------------------------------------

--
-- Struktura tabele `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `picture` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `price` FLOAT(10,2) NOT NULL,
  `description` varchar(1000) COLLATE utf8_slovenian_ci NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `contact_data`
--

CREATE TABLE `contact_data` (
  `user_id` int(11) NOT NULL,
  `street` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `street_number` int(11) NOT NULL,
  `city` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `contact_data`
--

INSERT INTO `contact_data` (`user_id`, `street`, `street_number`, `city`, `postal_code`, `phone`) VALUES
(1, 'Sezamova ulica', 32, 'Sezamovica', 3311, '090333123');

-- --------------------------------------------------------

--
-- Struktura tabele `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `order_article`
--

CREATE TABLE `order_article` (
  `order_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `role` varchar(60) COLLATE utf8_slovenian_ci NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `activated`) VALUES
(0, 'Admin', 'Administratovic', 'admin@admin.com', '$2y$10$r1VoxoLkcICFyui1VaEKru43QEfLAd9xO6wSnc8/0tYXAZc2Tjxj2', 'admin', 1),
(1, 'Ep', 'Testa', 'ep@gmail.com', '$2y$10$VGoGIk7qOkvMx39lB/MbEeunFbctpIH6kmtwPCnwpwDtZYbMwOZje', 'customer', 1),
(2, 'Prodajalec', 'Ep', 'pe@gmail.com', '$2y$10$VGoGIk7qOkvMx39lB/MbEeunFbctpIH6kmtwPCnwpwDtZYbMwOZje', 'salesman', 1);

INSERT INTO article VALUES(0, "Paper Craft" , "cover.png", 12.55, "This is a description of the product.", 1);
INSERT INTO article VALUES(1, "As I Descended" , "as-i-descended.jpg", 24.37, "Maria Lyon and Lily Boiten are their school’s ultimate power couple—even if no one knows it but them. Only one thing stands between them and their perfect future: campus superstar Delilah Dufrey.", 1);
INSERT INTO article VALUES(2, "Game of Thrones" , "GameOfThrones1.jpg", 19.99, "A Game of Thrones is the first novel in A Song of Ice and Fire, a series of fantasy novels by American author George R. R. Martin.", 1);
INSERT INTO article VALUES(3, "Enceladus" , "enceladus.jpg", 31.99, "Hard science fiction by Brandon Q. Morris.", 1);
INSERT INTO article VALUES(4, "The Price of Dawn" , "priceofdawn.jpg", 20.41, "The adventures of Staff Sergeant Max Mayhem, now available as a perk for people who donate to the Harry Potter Alliance's Equality FTW 2013 fundraiser!", 1);
INSERT INTO article VALUES(5, "Beast" , "beast-design-leo-nickolls.jpg", 18.68, "Tall, meaty, muscle-bound, and hairier than most throw rugs, Dylan doesn’t look like your average fifteen-year-old, so high school has not been kind to him.", 1);
INSERT INTO article VALUES(6, "The Witching Hour" , "thewitchinghour.jpg", 26.72, "Witching Hour, The, by Augustus M. Thomas (1907). Jack Brookfield, a professional gambler, in whose rooms the play opens, is believed by his friends to be possessed of an extraordinary personal magnetism.", 1);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeksi tabele `contact_data`
--
ALTER TABLE `contact_data`
  ADD KEY `user_id` (`user_id`);

--
-- Indeksi tabele `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksi tabele `order_article`
--
ALTER TABLE `order_article`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `contact_data`
--
ALTER TABLE `contact_data`
  ADD CONSTRAINT `contact_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omejitve za tabelo `order_article`
--
ALTER TABLE `order_article`
  ADD CONSTRAINT `order_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_article_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
