-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 03, 2019 at 09:48 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `crazy-race-backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `answere_checkeds`
--

CREATE TABLE `answere_checkeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `challenge_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `answere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answere_checkeds`
--

INSERT INTO `answere_checkeds` (`id`, `challenge_id`, `user_id`, `answere`, `score`, `created_at`, `updated_at`) VALUES
(1, 62, 54, 'Nobis non odit quibusdam qui vel unde.', 3819, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(2, 68, 64, 'Nobis laborum fugiat dolore tempora molestiae distinctio.', 4970, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(3, 86, 19, 'Quis est in aut officia aut mollitia.', 17525, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(4, 71, 57, 'Repellendus eaque voluptatem explicabo culpa.', 24932, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(5, 71, 2, 'Et assumenda iusto maxime minima fugiat rerum quo totam.', 18452, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(6, 56, 26, 'Ratione at corporis laboriosam labore a reprehenderit qui.', 32351, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(7, 54, 3, 'Accusamus amet ipsum optio impedit sed.', 31922, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(8, 75, 54, 'Aut fugit illo odit distinctio illum dolores.', 28235, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(9, 68, 29, 'Voluptatum amet cum sed sequi error consequatur officia nihil.', 25428, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(10, 4, 35, 'Reprehenderit quis dolorem in quae.', 4992, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(11, 39, 54, 'Qui ullam inventore repudiandae autem.', 17830, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(12, 64, 8, 'Aliquid sed laborum et dolores facilis voluptas ipsa autem.', 32181, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(13, 4, 13, 'Exercitationem et itaque quia officia velit ab.', 9709, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(14, 82, 5, 'Autem architecto occaecati aut dolorum.', 5779, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(15, 40, 15, 'Ea vero veniam est aut maxime facilis quibusdam.', 23010, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(16, 72, 41, 'Assumenda aperiam tenetur veniam doloremque non ut.', 14162, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(17, 47, 23, 'Facilis dolorem autem modi sequi.', 30094, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(18, 42, 16, 'Alias rem quisquam animi temporibus.', 19286, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(19, 70, 25, 'Veritatis modi sed reiciendis molestias possimus consectetur quos libero.', 10775, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(20, 20, 56, 'In et at consequatur dolore deserunt.', 24070, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(21, 78, 34, 'Minima sint vel quidem id.', 8428, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(22, 35, 14, 'Aliquam voluptate et iure non fuga iusto autem rerum.', 5656, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(23, 81, 62, 'Esse debitis veritatis optio odit in.', 11726, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(24, 51, 15, 'Quod ea quasi et corrupti qui quia maxime.', 9136, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(25, 20, 52, 'Magni iste numquam asperiores sit quisquam eaque.', 22768, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(26, 2, 29, 'Sequi quisquam unde expedita a.', 688, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(27, 66, 62, 'Omnis dolores tempora delectus sed.', 9538, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(28, 59, 1, 'Quia possimus et quam.', 34481, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(29, 86, 13, 'Excepturi blanditiis beatae itaque ex officia sit.', 17605, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(30, 8, 43, 'Est et et et explicabo quo ut.', 20605, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(31, 31, 53, 'Labore voluptas doloribus sed quaerat.', 9236, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(32, 21, 35, 'Aperiam error id nihil dolor aperiam.', 4468, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(33, 16, 4, 'Corporis qui in eos quos unde.', 23755, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(34, 7, 62, 'Commodi soluta aspernatur vel veniam alias.', 3511, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(35, 79, 61, 'Et animi eum fugiat.', 18852, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(36, 53, 6, 'Exercitationem enim consequatur ut nihil exercitationem dolore nihil.', 18960, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(37, 73, 20, 'Culpa eligendi suscipit similique accusamus molestiae sed.', 28949, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(38, 42, 51, 'Vel commodi nulla quia quidem incidunt qui.', 25145, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(39, 35, 57, 'Laudantium temporibus ea rerum et velit laudantium ea.', 26199, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(40, 64, 39, 'Rerum sint quis maxime animi.', 6370, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(41, 78, 43, 'Saepe delectus eos maiores.', 34593, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(42, 78, 18, 'Rerum est repudiandae debitis et fugiat magnam ab.', 28335, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(43, 29, 24, 'Laudantium consequatur est assumenda perspiciatis voluptas ab nam repellat.', 3969, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(44, 58, 43, 'Eveniet dicta temporibus iste sed ut velit.', 26861, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(45, 28, 11, 'Nihil laborum exercitationem sed maiores.', 29206, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(46, 38, 11, 'Similique totam rerum omnis delectus voluptatem.', 6218, '2019-12-01 03:15:59', '2019-12-01 03:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `answere_uncheckeds`
--

CREATE TABLE `answere_uncheckeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `challenge_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `answere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answere_uncheckeds`
--

INSERT INTO `answere_uncheckeds` (`id`, `challenge_id`, `user_id`, `answere`, `score`, `created_at`, `updated_at`) VALUES
(1, 90, 39, 'Voluptates reprehenderit unde aut beatae architecto.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(2, 77, 37, 'Molestias non consequuntur alias quae.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(3, 83, 60, 'Exercitationem necessitatibus vel et dolor sapiente deleniti rerum.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(4, 26, 30, 'Omnis repudiandae dolorem non quia.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(5, 77, 4, 'Sequi suscipit ea et quam optio et.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(6, 39, 40, 'Illo laudantium consequatur accusamus ullam vel repudiandae voluptates quia.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(7, 76, 61, 'Eos architecto culpa a sapiente.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(8, 62, 47, 'Nihil non incidunt autem rerum facilis dolorem unde.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(9, 16, 49, 'Provident neque sit laudantium voluptatum non explicabo vero.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(10, 10, 52, 'Voluptate corporis consequuntur et aspernatur omnis ducimus.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(11, 61, 18, 'Illo ea est facere et.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(12, 73, 21, 'Sit pariatur expedita dolor qui.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(13, 3, 57, 'Et voluptas non delectus iusto et sed molestiae.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(14, 4, 44, 'Maiores ad architecto velit quaerat praesentium nesciunt.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(15, 89, 3, 'Velit dolore eum et ducimus ipsam ab aut.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(16, 49, 20, 'Aspernatur voluptatem et ipsum laudantium.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(17, 52, 14, 'Quos velit facere nulla a in quia iste ullam.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(18, 20, 52, 'Nesciunt eius molestias laudantium est placeat.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(19, 28, 27, 'Quia dolor cumque consequatur atque accusamus aspernatur dolores.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(20, 1, 55, 'Vitae cupiditate quis sed nulla odio est.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(21, 53, 12, 'Aperiam repellat dolor ut qui.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(22, 62, 36, 'Laudantium rerum consectetur quia quam aut aut.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(23, 52, 7, 'Repellendus illo delectus eligendi reprehenderit cumque maxime.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(24, 36, 52, 'Aut rerum voluptate qui excepturi.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(25, 57, 63, 'Sit porro vel rem quo.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(26, 75, 31, 'Numquam velit temporibus sed.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(27, 71, 55, 'Consequatur ratione dignissimos tempore sed vero voluptate explicabo.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(28, 83, 14, 'Ipsam nostrum molestias laboriosam qui rem vero voluptatem nam.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(29, 89, 4, 'Et aut officia blanditiis est laudantium expedita et.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(30, 4, 51, 'Vitae fugit sed autem possimus eveniet voluptas eius.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(31, 83, 60, 'Unde ad vel cupiditate temporibus.', NULL, '2019-12-01 03:15:59', '2019-12-01 03:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sort_order` int(11) NOT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `route_id` bigint(20) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `sort_order`, `city_id`, `route_id`, `type`, `game_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'media_upload', 28, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(2, 1, NULL, 16, 'media_upload', 4, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(3, 1, NULL, 27, 'media_upload', 21, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(4, 2, 1, NULL, 'media_upload', 25, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(5, 1, 4, NULL, 'media_upload', 10, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(6, 1, 8, NULL, 'media_upload', 5, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(7, 1, NULL, 61, 'media_upload', 21, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(8, 1, NULL, 49, 'media_upload', 28, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(9, 1, 5, NULL, 'media_upload', 30, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(10, 1, 3, NULL, 'media_upload', 30, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(11, 1, NULL, 35, 'media_upload', 11, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(12, 1, NULL, 47, 'media_upload', 25, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(13, 1, NULL, 39, 'media_upload', 2, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(14, 1, 7, NULL, 'media_upload', 16, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(15, 1, NULL, 18, 'media_upload', 15, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(16, 1, 6, NULL, 'media_upload', 10, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(17, 1, NULL, 9, 'media_upload', 16, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(18, 1, NULL, 50, 'media_upload', 12, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(19, 1, NULL, 25, 'media_upload', 28, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(20, 2, 5, NULL, 'media_upload', 10, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(21, 1, NULL, 54, 'media_upload', 12, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(22, 2, 8, NULL, 'media_upload', 25, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(23, 3, 1, NULL, 'media_upload', 5, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(24, 1, NULL, 53, 'media_upload', 11, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(25, 1, NULL, 43, 'media_upload', 28, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(26, 1, NULL, 65, 'media_upload', 25, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(27, 1, NULL, 23, 'media_upload', 30, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(28, 1, 2, NULL, 'media_upload', 15, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(29, 1, NULL, 12, 'media_upload', 3, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(30, 4, 1, NULL, 'media_upload', 1, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(31, 2, 7, NULL, 'media_upload', 20, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(32, 1, NULL, 9, 'multiple_choice', 19, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(33, 3, 7, NULL, 'media_upload', 12, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(34, 5, 1, NULL, 'multiple_choice', 5, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(35, 1, NULL, 63, 'multiple_choice', 23, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(36, 1, NULL, 41, 'multiple_choice', 6, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(37, 2, NULL, 35, 'multiple_choice', 26, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(38, 3, 8, NULL, 'media_upload', 24, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(39, 3, 5, NULL, 'media_upload', 19, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(40, 4, 7, NULL, 'media_upload', 19, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(41, 1, NULL, 28, 'multiple_choice', 2, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(42, 2, 3, NULL, 'multiple_choice', 22, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(43, 2, NULL, 50, 'multiple_choice', 1, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(44, 4, 5, NULL, 'media_upload', 29, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(45, 2, NULL, 53, 'multiple_choice', 13, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(46, 3, 3, NULL, 'multiple_choice', 17, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(47, 1, NULL, 55, 'multiple_choice', 3, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(48, 2, NULL, 41, 'multiple_choice', 9, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(49, 1, NULL, 59, 'multiple_choice', 7, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(50, 2, 4, NULL, 'multiple_choice', 11, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(51, 2, 6, NULL, 'media_upload', 18, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(52, 2, NULL, 54, 'multiple_choice', 8, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(53, 1, NULL, 22, 'multiple_choice', 3, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(54, 4, 3, NULL, 'multiple_choice', 7, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(55, 1, NULL, 58, 'multiple_choice', 2, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(56, 1, NULL, 11, 'multiple_choice', 25, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(57, 2, 2, NULL, 'multiple_choice', 27, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(58, 2, NULL, 12, 'multiple_choice', 4, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(59, 2, NULL, 55, 'multiple_choice', 25, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(60, 2, NULL, 16, 'multiple_choice', 19, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(61, 3, 6, NULL, 'media_upload', 3, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(62, 1, NULL, 62, 'text_answere', 1, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(63, 1, NULL, 57, 'text_answere', 29, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(64, 5, 5, NULL, 'text_answere', 15, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(65, 6, 5, NULL, 'text_answere', 29, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(66, 1, NULL, 13, 'text_answere', 21, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(67, 3, 4, NULL, 'text_answere', 1, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(68, 4, 4, NULL, 'text_answere', 29, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(69, 2, NULL, 23, 'text_answere', 4, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(70, 1, NULL, 24, 'text_answere', 25, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(71, 3, NULL, 41, 'text_answere', 16, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(72, 3, NULL, 16, 'text_answere', 25, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(73, 3, 2, NULL, 'text_answere', 11, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(74, 1, NULL, 34, 'text_answere', 4, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(75, 1, NULL, 60, 'text_answere', 11, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(76, 1, NULL, 48, 'text_answere', 23, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(77, 6, 1, NULL, 'text_answere', 10, '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(78, 5, 3, NULL, 'text_answere', 20, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(79, 1, NULL, 31, 'text_answere', 18, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(80, 6, 3, NULL, 'text_answere', 6, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(81, 4, 2, NULL, 'text_answere', 7, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(82, 2, NULL, 49, 'text_answere', 8, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(83, 2, NULL, 25, 'text_answere', 28, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(84, 2, NULL, 39, 'text_answere', 26, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(85, 1, NULL, 51, 'text_answere', 5, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(86, 2, NULL, 13, 'text_answere', 26, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(87, 1, NULL, 30, 'text_answere', 27, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(88, 1, NULL, 4, 'text_answere', 23, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(89, 1, NULL, 29, 'text_answere', 19, '2019-12-01 03:15:59', '2019-12-01 03:15:59'),
(90, 7, 1, NULL, 'text_answere', 13, '2019-12-01 03:15:59', '2019-12-01 03:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `short_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `short_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Vicentastad', 'Hilda Hettinger Jr.', '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(2, 'East Kaylahstad', 'Syble Rippin', '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(3, 'Hartmannborough', 'Henderson Anderson', '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(4, 'New Rafaela', 'Gustave Daniel', '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(5, 'Lindside', 'Sharon Gutmann', '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(6, 'Rafaelastad', 'Monserrate Bashirian', '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(7, 'Lake Jaleelberg', 'Reina Hayes V', '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(8, 'Felipaville', 'Kamryn Yost', '2019-12-01 03:15:56', '2019-12-01 03:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_media_uploads`
--

CREATE TABLE `game_media_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points_min` bigint(20) NOT NULL,
  `points_max` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_media_uploads`
--

INSERT INTO `game_media_uploads` (`id`, `title`, `content_media`, `content_text`, `media_type`, `correct_answere`, `points_min`, `points_max`, `created_at`, `updated_at`) VALUES
(1, 'Margarita Haag', 'https://lorempixel.com/640/640/?15726', 'Voluptas eius corporis maxime dignissimos quo eos exercitationem voluptate enim aperiam error ex porro in nihil ea illo dolorem dolore dolore nisi labore tenetur sequi minima assumenda magni est blanditiis aliquam sit rerum repudiandae voluptatibus quisquam facere vitae voluptatum voluptas nihil repellendus.', 'image', 'Maiores facilis voluptas doloremque consectetur.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(2, 'Marlen Stoltenberg', 'https://lorempixel.com/640/640/?68349', 'Quaerat quibusdam officia consequatur aut ex quia ullam cupiditate ut qui quidem vitae et est quam repellat tempore minus ad qui quis exercitationem non debitis est voluptates vitae maxime ut eos tempora minima ut eius ut maxime consequatur.', 'image', 'Laborum deserunt sit aut et earum commodi distinctio.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(3, 'Janick Pagac', 'https://lorempixel.com/640/640/?77283', 'Voluptatibus accusamus blanditiis tenetur minima aut ut dicta distinctio ratione delectus voluptate ex nihil et dolores perferendis aut non adipisci qui est fugiat ut ad.', 'image', 'Optio quasi maxime sint qui est consequatur ut.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(4, 'Vivienne Wilderman III', 'https://lorempixel.com/640/640/?93821', 'Vero non nulla possimus sed in ex vel officiis eius maxime sed adipisci deserunt qui eum est minus minus voluptatem dolor autem et quidem porro voluptatem fuga quidem doloribus sint architecto culpa.', 'image', 'Nam accusantium tempora aut ea eveniet.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(5, 'Prof. Brett McGlynn DDS', 'https://lorempixel.com/640/640/?32709', 'Sequi est sint ea deleniti libero aut ducimus possimus tempore omnis error rem cumque amet cum dolorum hic corrupti ut sed aspernatur qui voluptatem facere ut ut.', 'image', 'Velit veritatis debitis quam doloremque nam.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(6, 'Bo Schiller', 'https://lorempixel.com/640/640/?59240', 'In sed consequuntur autem expedita eos eligendi earum autem labore fugit fuga natus at non sed sed iusto enim reprehenderit in quo inventore explicabo magni aliquam aliquam repellat rem ut eum dolorem.', 'image', 'Error tempore rerum aut voluptatem provident.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(7, 'Ashley Konopelski', 'https://lorempixel.com/640/640/?61596', 'Enim vel porro ad repudiandae sit ea sit tempore et molestiae iusto totam atque quos dolores modi nostrum aut distinctio molestiae dolores consequatur dolor et enim quia dolore laborum eos nemo vel ab dicta.', 'image', 'Aspernatur et soluta sed quia ea culpa.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(8, 'Mr. Reagan Spencer', 'https://lorempixel.com/640/640/?41599', 'Et qui ab aut qui rerum nobis facilis pariatur voluptatum molestiae illum ut illum pariatur dicta qui et dicta similique consectetur ratione ut harum sed cupiditate est tenetur dolor ad maiores.', 'image', 'Earum at ut nobis.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(9, 'Ms. Mikayla Quigley', 'https://lorempixel.com/640/640/?22495', 'Dolor tempore aut laudantium repudiandae consequuntur suscipit possimus nesciunt maiores cum error velit harum velit nemo consequatur officiis officia dignissimos et aut nostrum necessitatibus libero.', 'image', 'Error amet autem qui blanditiis eum fuga voluptatum.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(10, 'Mrs. Joanie Parker Sr.', 'https://lorempixel.com/640/640/?57274', 'Non voluptas reiciendis quia sed vel rem possimus aut voluptas velit sed totam et explicabo impedit dolorem nulla hic ad et deleniti illo autem pariatur et accusamus sunt quia quis odio aliquid neque vitae debitis.', 'image', 'Consequuntur aliquam libero dolorem quod minus quia.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(11, 'Sarah Kuphal', 'https://lorempixel.com/640/640/?62776', 'Nihil qui ratione voluptates omnis dolorem totam facere voluptatem nostrum nostrum nam iusto quidem commodi illum nostrum temporibus rerum adipisci vero quas ut explicabo eum sit voluptatibus in nihil dolore necessitatibus inventore.', 'image', 'Voluptas vero pariatur illum dolorum reprehenderit sed optio.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(12, 'Miss Hilda Kutch V', 'https://lorempixel.com/640/640/?56271', 'Est asperiores neque deleniti qui vero quam voluptas illo repudiandae possimus in ratione labore vitae incidunt deleniti voluptate quaerat est natus molestiae et porro natus dolorum velit sunt excepturi ab quos quo quam aspernatur veniam eligendi illo.', 'image', 'Reiciendis unde maxime rerum exercitationem possimus.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(13, 'Fannie Hessel DDS', 'https://lorempixel.com/640/640/?57772', 'Aliquam error et ipsam est nobis quia rerum ea veritatis dolorem eveniet illo a est ut sit ut et adipisci sed ut velit quae reprehenderit explicabo voluptas saepe et neque omnis esse ut sapiente quae voluptates non eius alias eius voluptate sed.', 'image', 'Reiciendis laboriosam velit omnis ratione laboriosam reiciendis error.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(14, 'Uriah Bailey', 'https://lorempixel.com/640/640/?59088', 'Et hic quia ab dolorum asperiores quia error quis sed cupiditate et voluptates nisi corporis eum beatae qui delectus fugiat quia in sunt voluptas.', 'image', 'Mollitia autem qui et neque est.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(15, 'Mr. Austyn Runolfsson II', 'https://lorempixel.com/640/640/?78951', 'Aspernatur laboriosam temporibus quisquam atque et ab odit labore vel nam quae voluptates voluptas vero quia fugit vel in qui a libero sapiente nobis ut et sint sit quidem.', 'image', 'Vel ab magni harum et optio quidem voluptatum.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(16, 'Alf Littel', 'https://lorempixel.com/640/640/?40013', 'Quia incidunt at aut quasi quod qui soluta cum sit est minus ea voluptatum quaerat maxime et consequatur illum dolor voluptate est consequatur reprehenderit.', 'image', 'Nihil quis voluptatem ullam qui ut.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(17, 'Cheyenne Kerluke', 'https://lorempixel.com/640/640/?50774', 'Repellendus quia incidunt ut voluptatem magnam modi ipsa officia blanditiis est quisquam necessitatibus ad corrupti ad eum inventore et voluptates enim tenetur quo iusto fuga sint tempora sint nemo officia officia suscipit dolorem doloremque quam placeat rerum sint nemo.', 'image', 'Id fugit dolores laboriosam laboriosam.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(18, 'Jayne Corwin PhD', 'https://lorempixel.com/640/640/?81139', 'Inventore vel voluptas consequatur possimus sit laborum natus eveniet a fugiat autem omnis omnis est culpa velit iste deserunt sed rerum non explicabo recusandae perspiciatis voluptatem voluptatibus nihil ipsum similique et dolores voluptate voluptates magni ea qui aut quo cumque neque doloremque neque.', 'image', 'Et excepturi laudantium quis quidem exercitationem possimus.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(19, 'Ike Lang', 'https://lorempixel.com/640/640/?21343', 'Assumenda nobis facilis exercitationem ullam exercitationem officiis autem nisi ut odio velit consequuntur autem velit deleniti officia voluptatem aut est mollitia ut qui reprehenderit cumque ex neque quidem similique voluptatibus laboriosam voluptas dolorem libero ullam aut temporibus omnis maxime nihil hic iure qui sapiente sed.', 'image', 'Sit iure illum aut porro quis officia.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(20, 'Dr. Jannie Zemlak Sr.', 'https://lorempixel.com/640/640/?35767', 'Voluptatem eum quam id qui illo quos nihil autem dolorem eligendi et dolores deserunt ut delectus eum sequi qui provident unde officia repellat dolorem omnis delectus optio culpa consequuntur deleniti consectetur omnis ut porro animi sed tempore quaerat laboriosam magni eveniet iure et aut distinctio.', 'image', 'Quis quia debitis error voluptas eligendi asperiores.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(21, 'Floyd Kreiger III', 'https://lorempixel.com/640/640/?12887', 'Pariatur voluptas corporis in ex eveniet qui ad in asperiores sit totam rerum facere ratione sunt ullam eveniet qui minima.', 'image', 'Aut unde libero quibusdam reiciendis ullam ex optio.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(22, 'Prof. Justice McCullough', 'https://lorempixel.com/640/640/?73887', 'Facilis optio est omnis odio aut culpa omnis possimus quisquam perspiciatis accusamus quia et voluptatem qui eum perferendis et ipsam consectetur non reiciendis quia suscipit laborum nemo quasi enim harum expedita reiciendis cupiditate explicabo quo atque perferendis maiores quidem in.', 'image', 'Molestiae autem maxime enim aperiam recusandae soluta.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(23, 'Clyde Thompson', 'https://lorempixel.com/640/640/?12436', 'Perferendis veniam voluptatibus unde qui dolorem aut officia debitis praesentium molestias voluptatem mollitia sint maiores sed explicabo nesciunt corporis vero non non et enim corrupti et ea qui ut ad laudantium possimus consequuntur doloribus dignissimos quidem nostrum iusto maxime enim et occaecati iure.', 'image', 'Amet repellat fuga sit fugit est.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(24, 'Craig Hilpert Jr.', 'https://lorempixel.com/640/640/?35392', 'Quam eos suscipit quis aliquam quam doloremque fuga consequuntur aut magnam qui occaecati officia aut iure dolorem ut nemo sunt sed optio delectus sunt numquam consectetur corrupti at vel nisi rerum omnis et eius maiores qui non ab ut laborum dolores ratione qui molestias ipsam.', 'image', 'Optio ut amet est beatae quo ea similique.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(25, 'Mason Gislason', 'https://lorempixel.com/640/640/?28015', 'Fuga praesentium placeat occaecati voluptatem nostrum dolorum aut quia nesciunt ex amet quia ut at consequatur et sit vel saepe nulla omnis qui assumenda corporis voluptatem et culpa maiores iusto eum cumque deleniti quos soluta non tenetur dolorum ut aut.', 'image', 'Et et quidem modi praesentium molestiae nam.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(26, 'Josephine Sanford', 'https://lorempixel.com/640/640/?68197', 'Voluptas est quam deserunt accusantium earum dolore quisquam provident minima officiis ipsa aliquid mollitia quae aut sed quod et sit et vitae ducimus est enim corrupti commodi libero numquam dolorum aut qui qui ut beatae voluptatem voluptatem eos similique ex.', 'image', 'Fuga perspiciatis et voluptatem beatae.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(27, 'Maiya Hammes', 'https://lorempixel.com/640/640/?21412', 'Cumque perferendis sed magni voluptatem ut illo vero dicta ut aut praesentium animi occaecati autem a cumque praesentium non perferendis est quis voluptatem autem eos dolor laboriosam repellat vero dignissimos non sunt sed omnis minima magni et quo architecto sit saepe.', 'image', 'Ad labore officia dolor hic cupiditate quasi asperiores.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(28, 'Elsie O\'Connell III', 'https://lorempixel.com/640/640/?48153', 'Eveniet voluptas aut maxime et sed quia mollitia autem aut neque nostrum nisi minus laborum ut quo culpa mollitia eligendi distinctio eligendi nemo culpa in ad non dolore et omnis consequuntur possimus eos vitae esse.', 'image', 'Dolorem voluptas eum eaque non perferendis.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(29, 'Dr. Enrique Bogisich', 'https://lorempixel.com/640/640/?49706', 'In praesentium quo autem quos praesentium autem incidunt quo aut sed ipsum sint nihil in quo similique non non deleniti necessitatibus.', 'image', 'Tenetur cum nihil nihil excepturi.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(30, 'Lillian Ebert DVM', 'https://lorempixel.com/640/640/?78147', 'Praesentium laborum dicta praesentium dolorem corrupti est ducimus aliquam dolor fugit aperiam eligendi animi qui repellat rerum ut ex dolor quisquam doloremque dicta sunt quaerat culpa sint eveniet voluptatem dolores ut qui vero consequatur dolor voluptate suscipit alias sed non.', 'image', 'Eligendi repudiandae voluptas modi deleniti fugiat occaecati sed.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `game_multiple_choices`
--

CREATE TABLE `game_multiple_choices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points_min` bigint(20) NOT NULL,
  `points_max` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_multiple_choices`
--

INSERT INTO `game_multiple_choices` (`id`, `title`, `content_media`, `content_text`, `correct_answere`, `points_min`, `points_max`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Marguerite Littel DDS', 'https://lorempixel.com/640/640/?67505', 'In ex est eum illo sint corporis quam repudiandae aspernatur debitis ut consequuntur optio ducimus quibusdam ipsa qui aspernatur repellendus expedita quod voluptatum quisquam et praesentium deserunt doloribus nihil esse dolore magni suscipit enim ad.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(2, 'Jewell Bode', 'https://lorempixel.com/640/640/?17378', 'Facilis quaerat laudantium omnis et sed vel et et sed aut blanditiis ut asperiores eligendi ipsam fugiat quos vero dolorem architecto veniam deleniti modi quisquam asperiores quo quisquam aut quo fugit ea harum laboriosam sed cum ut.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(3, 'Lauryn Spencer II', 'https://lorempixel.com/640/640/?74875', 'Sit numquam sint iste a pariatur magni dolor quae voluptatem repellat nobis sunt quia impedit unde voluptas placeat dolores ut optio vel aperiam ea distinctio neque voluptatem qui pariatur eveniet amet libero.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(4, 'Wyman Bernhard', 'https://lorempixel.com/640/640/?15703', 'Eum quidem iste est tempora repudiandae necessitatibus porro quas vel nihil animi ipsam optio non est earum voluptatum suscipit saepe ut.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(5, 'Marcel Spinka I', 'https://lorempixel.com/640/640/?61387', 'Laborum possimus tenetur harum eius tenetur omnis veritatis et vel deleniti praesentium optio possimus cupiditate ut eum omnis aut laboriosam tempora magni consequatur et dolore aliquam laudantium quo sunt accusamus nobis esse fuga et quasi ad autem cupiditate omnis sed et magnam.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(6, 'Raquel Hermiston', 'https://lorempixel.com/640/640/?80992', 'Voluptatem ut quisquam molestiae nulla veritatis dolores temporibus est commodi repellendus libero magni quibusdam illum voluptas dolore aut nam error.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(7, 'Keshaun Roberts', 'https://lorempixel.com/640/640/?55796', 'Quis culpa voluptas quae autem unde libero voluptates voluptatem maiores nostrum cupiditate enim aut omnis illo in commodi quae minima et dolor laborum ab quo culpa quasi in illum et sunt pariatur consequatur consequuntur cupiditate.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(8, 'Miss Emily Schulist DVM', 'https://lorempixel.com/640/640/?21389', 'Porro vel nihil consequatur suscipit facere a laborum veritatis rerum aut voluptatibus in magnam quos cumque ut voluptatem quae blanditiis nostrum vel qui qui consequatur.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(9, 'Ibrahim Mann DVM', 'https://lorempixel.com/640/640/?53325', 'Nostrum sint quam accusamus necessitatibus et ea quod omnis deleniti aliquam consectetur aliquam cupiditate sunt dolorem excepturi quas enim est culpa esse incidunt ea repellendus repellat ut et occaecati excepturi est est quo deserunt.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(10, 'Brycen Larkin', 'https://lorempixel.com/640/640/?31101', 'Voluptatum veniam debitis aliquid rerum ut aut eum autem ut quas praesentium beatae tempore perferendis cumque quos doloribus omnis minus quibusdam veniam expedita non qui est dolor et temporibus excepturi.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(11, 'Rogelio O\'Reilly', 'https://lorempixel.com/640/640/?73511', 'Eaque quaerat omnis assumenda et qui sed eos velit animi at est perferendis eos accusantium dolor ut nihil quis vel nesciunt a ut provident.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(12, 'Elisa Hettinger', 'https://lorempixel.com/640/640/?75004', 'Repudiandae quo alias non ex dolor quidem et eos blanditiis veniam id aut mollitia molestiae esse laboriosam quis ut iste nemo accusantium a cumque veritatis illo dolor voluptates nisi.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(13, 'Liliana Kihn', 'https://lorempixel.com/640/640/?97876', 'Dolorum sit quia pariatur non est recusandae corporis aperiam maiores sunt tempore et nihil occaecati dignissimos voluptatum quis sint nam in modi sequi modi corrupti.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(14, 'Sage Zboncak', 'https://lorempixel.com/640/640/?33037', 'Vero consequatur laborum laudantium dolores at aperiam reprehenderit dolor delectus sed nesciunt dicta labore excepturi at alias architecto ea exercitationem natus sit ipsum omnis dicta aut nesciunt aperiam vero veritatis voluptatem et aliquid.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(15, 'Prof. Kattie Moore DVM', 'https://lorempixel.com/640/640/?66866', 'Sunt cumque delectus perferendis itaque ullam placeat voluptatem in pariatur sapiente similique ea inventore voluptatem quis numquam voluptatum facere sunt nam delectus odio quis impedit officia rerum quibusdam voluptatem aliquam eaque labore qui.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(16, 'Thaddeus Morar', 'https://lorempixel.com/640/640/?65808', 'Alias quis rem voluptate assumenda aut ut et et numquam veniam earum quia recusandae ullam ipsam officiis accusantium esse et est illum suscipit minima exercitationem reiciendis repellendus esse voluptas eum quia.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(17, 'Izabella Denesik', 'https://lorempixel.com/640/640/?39399', 'Magnam assumenda fugiat accusantium eum iusto harum beatae libero mollitia excepturi voluptate pariatur fuga rerum illum et consequatur praesentium assumenda voluptate facere dolorem impedit ea voluptatum porro qui dolorum et porro asperiores nesciunt nemo possimus qui dolorum aliquid provident consequatur unde aut velit velit.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(18, 'Mr. Xander Kuhic', 'https://lorempixel.com/640/640/?41655', 'Dolor iste accusantium velit cum nihil et ut eos quae quasi nostrum est et explicabo consequatur quos fuga quibusdam ut earum eveniet.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(19, 'Thurman Gorczany', 'https://lorempixel.com/640/640/?17620', 'Eum nulla cupiditate ut nesciunt ut quasi dolores deserunt sit quis ut laborum totam est quos maiores et saepe et hic qui consequatur eligendi expedita minima et est aperiam accusamus ea error minima voluptate.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(20, 'Lacey Jacobson Jr.', 'https://lorempixel.com/640/640/?62586', 'Dolores accusantium consequatur praesentium dolorem dolorum omnis quam voluptatem voluptatem autem et aut neque rerum ut sed et commodi fugit maiores rerum ut enim blanditiis in sit consequuntur iusto nemo officiis aliquam tempora odio autem qui voluptatem.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(21, 'Curtis Little', 'https://lorempixel.com/640/640/?77997', 'Fuga qui quam similique error provident quaerat et qui dolor aut rerum perspiciatis vero explicabo et ipsa delectus quis sit doloribus minus et et distinctio fugit voluptatibus repellendus minus quidem eaque qui nam ut pariatur aut dicta eligendi et aut ut.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(22, 'Prof. Augusta Langosh', 'https://lorempixel.com/640/640/?86601', 'Dolor ex sit enim id earum quod similique eius culpa dicta libero doloribus autem minus non aut mollitia dicta voluptatibus libero vero iste aut et ipsum at similique et asperiores fuga ipsum est est autem voluptatibus quae non veritatis.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(23, 'Mr. Jamey Kutch II', 'https://lorempixel.com/640/640/?90419', 'Iste et ipsam consequatur magni similique pariatur in est nihil non corrupti corporis itaque corrupti aliquam amet iste aspernatur nulla consequuntur voluptate quia quia ut ullam dolor quasi omnis molestiae modi ut.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(24, 'Ms. Ida Turcotte I', 'https://lorempixel.com/640/640/?81433', 'Ab iusto odit et ipsa incidunt explicabo non est odio dolores officia nostrum sit dolores enim facere assumenda qui et molestias aut aut et soluta temporibus eveniet nemo aliquam quasi sunt maxime occaecati impedit delectus ipsum velit non numquam ut voluptate excepturi sit.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(25, 'Estel Hill', 'https://lorempixel.com/640/640/?44541', 'Facilis corrupti fuga exercitationem dolor et et dolorum quis porro nesciunt architecto veritatis non culpa laborum qui numquam sunt beatae repudiandae animi suscipit cum vel nostrum sint excepturi eius.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(26, 'Frederic Fay', 'https://lorempixel.com/640/640/?12444', 'Voluptatem cumque aspernatur dolorem quo magni dolore sit voluptatem odio dicta officiis reprehenderit et officiis quia minima eum est nesciunt et reprehenderit est.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(27, 'Rene Jakubowski', 'https://lorempixel.com/640/640/?76444', 'Et iure laudantium labore sed eum labore exercitationem velit qui corporis totam veritatis sunt autem ipsa accusantium nemo unde sint ipsa sed sed atque ut corporis quo perspiciatis itaque repellat sed autem fugit iusto voluptatem nulla et non omnis perferendis ratione quia explicabo.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(28, 'Milo Morissette', 'https://lorempixel.com/640/640/?24019', 'Est dignissimos non dolor distinctio corporis inventore repellat maxime ea nihil harum nisi veniam aliquam quis in perferendis amet consequatur id eligendi itaque quae non consequatur blanditiis quae et culpa similique placeat est eos eos commodi unde deserunt consequatur omnis error soluta suscipit deleniti debitis.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(29, 'Mrs. Leilani Ortiz', 'https://lorempixel.com/640/640/?75899', 'Ex reiciendis eaque rerum sit magnam minus hic nihil earum deleniti voluptatem iure id asperiores et quibusdam doloremque et consectetur nesciunt modi voluptate mollitia soluta aut reprehenderit qui eligendi suscipit dolor nihil quia eos.', '2', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(30, 'Ms. Kristin Wilderman', 'https://lorempixel.com/640/640/?84347', 'Ad sed officia eveniet voluptatem et dignissimos culpa enim corrupti explicabo maiores et suscipit nihil natus optio nisi eos enim dicta odio omnis quia delectus quam pariatur aut rerum accusantium quas expedita doloribus quos est est unde exercitationem.', '1', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `game_multiple_choice_options`
--

CREATE TABLE `game_multiple_choice_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_multiple_choice_options`
--

INSERT INTO `game_multiple_choice_options` (`id`, `game_id`, `sort_order`, `text`, `created_at`, `updated_at`) VALUES
(1, 30, 1, 'Laborum ratione magnam impedit nam totam adipisci.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(2, 23, 1, 'Dolores sit ipsam voluptatibus fugit omnis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(3, 22, 1, 'Asperiores ab aut nisi quidem deleniti.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(4, 10, 1, 'Et quas nisi repellat.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(5, 24, 1, 'Dolorem inventore repellendus animi nam soluta est.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(6, 6, 1, 'Ea a quis non qui.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(7, 27, 1, 'Hic voluptas rem expedita aspernatur sint facilis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(8, 16, 1, 'Aut sit vel a eveniet magnam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(9, 23, 2, 'At pariatur illo rerum maiores.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(10, 13, 1, 'Ea doloremque ducimus dignissimos consectetur aut.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(11, 4, 1, 'Vel iste vel quae corrupti voluptatem illum.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(12, 30, 2, 'Esse nobis praesentium quae quaerat beatae placeat eligendi ut.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(13, 28, 1, 'Perspiciatis incidunt nihil aut doloremque alias optio.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(14, 26, 1, 'Nemo iure asperiores dolorem sit repellat ex sed.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(15, 25, 1, 'Tempore tempore sint placeat est commodi quas praesentium qui.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(16, 16, 2, 'Voluptatibus dolores porro aspernatur ut neque quidem.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(17, 4, 2, 'Alias sint rerum et.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(18, 14, 1, 'Aut aut et fugiat eum in est quisquam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(19, 11, 1, 'Dolor repudiandae iusto rerum culpa non excepturi facilis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(20, 7, 1, 'Recusandae debitis quod ut voluptas quas et eaque quia.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(21, 16, 3, 'Aspernatur odio nostrum quam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(22, 5, 1, 'Officia rerum et et et.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(23, 29, 1, 'Repudiandae voluptate et pariatur esse.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(24, 10, 2, 'Ut ipsa modi voluptatibus blanditiis facere aspernatur eveniet dolorem.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(25, 10, 3, 'Quia vitae dolorem aut dolorem.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(26, 29, 2, 'Explicabo itaque cum labore optio occaecati hic.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(27, 8, 1, 'Et sit esse eos qui natus.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(28, 19, 1, 'Reprehenderit ducimus adipisci sed distinctio perferendis deserunt a.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(29, 14, 2, 'Deleniti ullam tenetur sint repellat quia.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(30, 11, 2, 'Repellendus officia eum laudantium sed voluptas doloribus.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(31, 9, 1, 'Facilis temporibus sequi autem qui est.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(32, 19, 2, 'Aut enim animi ut maiores.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(33, 15, 1, 'Id fugit natus numquam ut vel debitis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(34, 21, 1, 'Aspernatur illo minus et debitis officiis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(35, 9, 2, 'Quis et aspernatur soluta quidem qui est.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(36, 2, 1, 'Voluptatem hic aut et rem unde aut non.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(37, 21, 2, 'Et neque facere aut numquam perferendis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(38, 28, 2, 'Ipsa quidem est in et nobis sit.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(39, 25, 2, 'Rerum magni sit assumenda ut commodi quae dignissimos.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(40, 3, 1, 'Ut nemo ut tempora aliquid.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(41, 3, 2, 'Sed ea dolores delectus rerum earum eos aut.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(42, 19, 3, 'Ea est voluptas error.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(43, 18, 1, 'Fugit dolor quod ut consectetur.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(44, 19, 4, 'Harum esse tenetur aut qui perferendis esse.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(45, 27, 2, 'Sed tempora maiores modi placeat soluta accusantium.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(46, 25, 3, 'Officiis possimus tempora dignissimos nulla.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(47, 15, 2, 'Necessitatibus quia cumque dignissimos eum.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(48, 12, 1, 'Aut qui reiciendis facere voluptas aspernatur mollitia.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(49, 18, 12, 'Sit libero atque rem vel rerum magni eum.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(50, 1, 1, 'Quaerat eaque magnam minima et.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(51, 27, 3, 'Ad et omnis et sunt provident quas iusto.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(52, 5, 2, 'Veniam possimus vel et et nihil quibusdam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(53, 12, 2, 'Earum debitis sint consequatur est ut ipsa.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(54, 15, 3, 'Animi quibusdam nam sit qui dolore repellendus voluptatem.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(55, 29, 3, 'Voluptas quod est aspernatur.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(56, 6, 2, 'Sit iste et et quasi numquam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(57, 20, 1, 'Aut perferendis libero tenetur necessitatibus aliquam accusamus ea.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(58, 11, 3, 'Esse distinctio possimus veniam officiis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(59, 17, 1, 'Qui magnam quibusdam molestiae libero.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(60, 22, 2, 'Et sunt quibusdam tempora voluptatum tempore nulla eum.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(61, 29, 4, 'Laborum aut quis occaecati magni.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(62, 20, 2, 'Enim doloremque quae saepe optio qui cumque et.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(63, 30, 3, 'Sunt excepturi repellendus voluptate non vitae.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(64, 19, 5, 'Modi eveniet accusamus id repudiandae ipsum id maiores.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(65, 2, 2, 'Placeat velit dolores et expedita et.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(66, 16, 4, 'Atque et tenetur earum in doloribus tenetur.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(67, 15, 4, 'Quasi blanditiis voluptatum eos molestiae voluptatum earum eos.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(68, 20, 3, 'Error perferendis molestiae rerum eligendi possimus eos tempore fugit.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(69, 24, 2, 'Omnis perspiciatis dignissimos autem veniam maiores esse explicabo.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(70, 6, 3, 'Autem voluptates error numquam consequatur ut at rerum ut.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(71, 2, 3, 'Nihil praesentium eligendi aut minima eos molestiae.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(72, 7, 2, 'Sed esse ea quidem est illo.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(73, 8, 2, 'Et soluta cum tempora dignissimos maxime excepturi qui.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(74, 18, 3, 'Deserunt porro voluptates est ea itaque provident magni libero.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(75, 7, 3, 'Aut neque sit eaque corrupti tempore tempora.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(76, 23, 3, 'Aut repudiandae eos iure nobis similique vero magnam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(77, 12, 3, 'Earum sint vitae soluta minus.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(78, 23, 4, 'Cumque et sed corrupti.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(79, 11, 4, 'Est aut adipisci esse voluptatem sunt ut quas perspiciatis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(80, 8, 3, 'Exercitationem reprehenderit molestiae velit molestiae ut.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(81, 27, 4, 'Qui ipsa itaque dolor incidunt nihil fugit est.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(82, 2, 4, 'Iusto ut tempora et.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(83, 13, 2, 'Vel eum quia ipsam necessitatibus est aliquid tempore.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(84, 24, 3, 'Ad qui sequi ipsum et accusamus.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(85, 12, 4, 'Neque accusantium nesciunt consequatur.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(86, 24, 4, 'Eligendi ullam sed quidem optio consequatur magni et.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(87, 15, 5, 'Dolore nemo necessitatibus nulla omnis iusto porro.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(88, 11, 5, 'Culpa dolores et est nihil minima necessitatibus illo.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(89, 28, 3, 'Et libero nobis at vitae et modi quod.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(90, 7, 4, 'Officia nulla ad ea dicta nesciunt.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(91, 5, 3, 'Sed corrupti at rem et aut dolorem qui autem.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(92, 1, 2, 'Et odit doloribus est dignissimos in enim aliquam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(93, 7, 5, 'Delectus tempore est repellat porro.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(94, 3, 3, 'Quis placeat occaecati ut ut enim voluptatem nihil est.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(95, 5, 4, 'Sit sequi placeat amet.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(96, 22, 3, 'Earum aut similique reiciendis commodi.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(97, 26, 2, 'Tempora earum quis molestiae explicabo unde illo itaque.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(98, 9, 3, 'Harum neque aut quo rerum.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(99, 8, 4, 'Quisquam magni temporibus qui consequatur quaerat omnis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(100, 13, 3, 'Error dicta ullam atque.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(101, 19, 6, 'Quidem qui laborum dignissimos veniam ex molestiae.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(102, 4, 3, 'Rem quaerat et debitis ut.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(103, 11, 6, 'Odio nulla eum repudiandae aliquid distinctio.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(104, 29, 5, 'Quasi voluptatem voluptate sunt sunt quam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(105, 24, 5, 'Quia consequuntur esse consectetur qui voluptatem.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(106, 30, 4, 'Consequatur numquam ad dignissimos eaque.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(107, 15, 6, 'Delectus magnam qui quo nemo reprehenderit sit natus.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(108, 22, 4, 'Qui ullam quam ipsa eveniet.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(109, 17, 2, 'Eligendi odio voluptatum et repellendus magni deleniti suscipit officiis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(110, 23, 5, 'Rerum itaque iste est et qui.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(111, 6, 4, 'Ipsa ipsam consequatur sit debitis explicabo odit.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(112, 24, 6, 'Sed culpa deleniti ut iure beatae veniam perspiciatis.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(113, 5, 5, 'Sint iusto consequatur dolorem fuga.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(114, 18, 4, 'Esse qui qui aliquam non assumenda.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(115, 30, 5, 'Occaecati ut sunt et et.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(116, 22, 5, 'Corporis et qui incidunt quaerat accusantium rerum qui.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(117, 28, 4, 'Cumque recusandae adipisci ab.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(118, 5, 6, 'Quod aut incidunt saepe aperiam.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(119, 7, 6, 'Et velit consequatur et inventore enim delectus.', '2019-12-01 03:15:58', '2019-12-01 03:15:58'),
(120, 24, 7, 'Nobis quia facere eum.', '2019-12-01 03:15:58', '2019-12-01 03:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `game_quizzes`
--

CREATE TABLE `game_quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_text_answeres`
--

CREATE TABLE `game_text_answeres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points_min` bigint(20) NOT NULL,
  `points_max` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_text_answeres`
--

INSERT INTO `game_text_answeres` (`id`, `title`, `content_media`, `content_text`, `correct_answere`, `points_min`, `points_max`, `created_at`, `updated_at`) VALUES
(1, 'Nettie Beier II', 'https://lorempixel.com/640/640/?63833', 'Sequi aliquam molestiae odit inventore id sed culpa rem ut autem nulla aperiam quisquam voluptatum aut ab consequatur quidem voluptas id qui laboriosam rerum voluptas dolor porro magnam similique incidunt soluta pariatur nostrum debitis molestiae possimus soluta.', 'Qui illo aut laudantium.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(2, 'Mrs. Cortney DuBuque III', 'https://lorempixel.com/640/640/?93864', 'Quod sed quibusdam minus aut aut quidem sapiente laborum quos pariatur ex cum voluptatem ad omnis numquam ullam illo natus consectetur sint cum voluptates ipsam quo omnis nostrum et ut libero dolores odit ut eos laborum assumenda.', 'Alias ad atque est.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(3, 'Laney Barrows', 'https://lorempixel.com/640/640/?68480', 'Sit ex nisi autem et eum dolorem quia ut ut quam est quia aut provident ducimus aperiam necessitatibus cum et et rerum blanditiis delectus illum at et iure quia harum vel a cumque harum consequatur expedita voluptatibus suscipit ipsam quis omnis eos.', 'Id aliquam odio voluptates officiis saepe asperiores.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(4, 'Claudie Steuber', 'https://lorempixel.com/640/640/?52584', 'Nulla commodi tenetur expedita similique non explicabo nulla ea veniam cupiditate molestias odio mollitia dolorum nobis quis quod ducimus qui ipsam et veniam quibusdam ratione eos dicta alias a voluptatem qui voluptatem sit illo aut ut voluptatum et ipsum enim necessitatibus voluptas soluta.', 'Consequatur ea rerum ratione debitis.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(5, 'Mrs. Savanna O\'Conner', 'https://lorempixel.com/640/640/?85514', 'Delectus voluptas fugit cum minima dolorem non tenetur asperiores et expedita quod cumque quia assumenda nobis veritatis error amet enim cupiditate sunt sit qui et quaerat harum est quia ut est voluptatem illum inventore minus sunt deleniti dolores cum rerum quos.', 'Quis odit eius blanditiis repellendus ducimus iure.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(6, 'Annamae Halvorson', 'https://lorempixel.com/640/640/?94835', 'Aperiam voluptatem assumenda iste quaerat numquam omnis ipsum numquam aliquid reprehenderit consequatur cum corporis saepe expedita eveniet soluta illum consectetur ut eos aspernatur rerum rerum non non.', 'Ab saepe velit maxime voluptatem.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(7, 'Angelita Kertzmann', 'https://lorempixel.com/640/640/?44039', 'Vel ab eligendi tenetur eligendi ut at in cupiditate ex eveniet in quis est minima vero aperiam minima omnis a omnis voluptas veritatis in vitae maxime necessitatibus nesciunt vel praesentium qui autem maxime accusantium et ipsa vel.', 'Quia quia ex magnam adipisci laudantium dolorum sequi expedita.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(8, 'Lilliana Heathcote I', 'https://lorempixel.com/640/640/?46475', 'Qui ut quibusdam facilis voluptatem dignissimos architecto qui est perspiciatis et et et assumenda necessitatibus quae facere a et molestiae iusto consectetur est suscipit in.', 'Dolor consectetur et exercitationem modi labore.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(9, 'Sedrick Strosin I', 'https://lorempixel.com/640/640/?22536', 'Ut vel qui et soluta animi et nihil adipisci qui quibusdam blanditiis reiciendis eos et in quos ut omnis et eius et quae consequatur qui qui cum aut corporis ea cupiditate et quis consequatur fuga libero unde ullam aperiam voluptatem sit sint.', 'Voluptas hic sint enim et.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(10, 'Ms. Kathryne D\'Amore I', 'https://lorempixel.com/640/640/?21171', 'Incidunt eveniet aut quos facere laboriosam velit cupiditate odio nobis repudiandae cupiditate ut omnis autem eum et enim repellat reiciendis ut aut qui veritatis saepe.', 'Est hic consequatur sunt qui similique nostrum.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(11, 'Leann Wilderman', 'https://lorempixel.com/640/640/?23626', 'Rem et aut explicabo nobis enim sed facere et magnam quisquam blanditiis assumenda explicabo autem eveniet eum non nostrum officiis rem non provident qui in cupiditate a quaerat.', 'Totam eligendi ducimus aut voluptatem.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(12, 'Annamae Vandervort', 'https://lorempixel.com/640/640/?39134', 'Nam et ipsum voluptatem aut necessitatibus ut dolor est laboriosam ad officia et laboriosam dolores sed autem tenetur voluptas debitis in perferendis cupiditate odio sint sequi beatae optio veniam veritatis voluptatibus nisi sit expedita sequi architecto nostrum aspernatur accusantium ipsa dolores aut praesentium.', 'Autem ratione tempora omnis dolor.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(13, 'Dr. Teresa Klocko', 'https://lorempixel.com/640/640/?56615', 'Et accusantium aspernatur et quia id temporibus rem vel inventore pariatur velit debitis et necessitatibus impedit excepturi magni laudantium harum dolor cumque ut sint suscipit neque vel autem consequatur molestiae error vitae animi atque laudantium qui.', 'Quo omnis quisquam vel.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(14, 'Mr. Fredy Kilback II', 'https://lorempixel.com/640/640/?24135', 'Perferendis voluptatibus qui natus esse placeat tempore est nostrum sint et aspernatur est et et eaque aspernatur aut rerum ipsum est accusantium eum cupiditate omnis fuga eius quisquam nulla quas temporibus minus maxime ea.', 'Rerum sapiente excepturi aspernatur maxime nisi quod omnis.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(15, 'Afton Dickens V', 'https://lorempixel.com/640/640/?46673', 'Sint consequuntur ipsum aut dolorum ducimus necessitatibus adipisci enim et cum sed cum explicabo laudantium rem architecto quis assumenda quia est reiciendis ratione fugit maiores assumenda consequatur harum praesentium enim et.', 'Ut in doloribus tempore molestiae distinctio aliquid.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(16, 'Laurie Gislason', 'https://lorempixel.com/640/640/?49971', 'Possimus harum architecto dolorum aut alias eos doloremque et doloremque facilis suscipit qui omnis est maxime ut modi quo nihil vero inventore veniam id laborum laboriosam maxime et iusto hic quae suscipit harum reiciendis est non magni aliquam placeat corrupti temporibus earum qui.', 'Non iusto inventore vel.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(17, 'Maggie Green', 'https://lorempixel.com/640/640/?22185', 'Enim libero veritatis numquam earum ea dicta voluptatibus magnam id aut dolores sed perspiciatis dolor nemo qui adipisci mollitia ut iste molestiae voluptatem ad expedita perspiciatis aliquam veniam accusantium omnis asperiores dolorem iste expedita ipsum ab unde dolor maxime nemo et reprehenderit ab sunt recusandae.', 'Magnam consequatur excepturi debitis incidunt nisi qui aut.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(18, 'Ora Schimmel', 'https://lorempixel.com/640/640/?93315', 'Quasi consectetur quo ducimus occaecati debitis aperiam est molestias ea labore dolores iste natus unde tenetur sit praesentium pariatur culpa magni laudantium ducimus qui odio qui consequatur officia placeat ut sed vero similique quisquam voluptas pariatur ea odio voluptatem autem quas porro facilis rerum.', 'Repudiandae sunt nulla voluptatem minus facere deserunt facilis.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(19, 'Dr. Cesar Macejkovic', 'https://lorempixel.com/640/640/?15139', 'Hic mollitia non non ad et voluptatem accusantium ratione eum at eum illo labore maxime vero harum vel error facilis inventore sed pariatur nesciunt accusantium cupiditate saepe explicabo sint et.', 'Eos qui voluptas eligendi possimus fugiat rerum.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(20, 'Raheem Kassulke', 'https://lorempixel.com/640/640/?83456', 'Repellendus dolor libero enim est quos facilis maiores nisi excepturi rerum ex consectetur dolores dolores non doloribus qui aliquam debitis deleniti ipsum cum veritatis fugiat qui autem consequatur et aut.', 'Autem quibusdam blanditiis veritatis a vitae.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(21, 'Nikolas Schoen', 'https://lorempixel.com/640/640/?28018', 'Et laudantium doloremque saepe minus perspiciatis ut earum saepe aperiam autem in laudantium numquam dolores ipsa pariatur eaque dignissimos architecto quia voluptatibus est est voluptatem unde natus sunt libero reiciendis sapiente et ipsam at magnam perferendis rerum ad atque magni dignissimos nemo enim.', 'Rerum numquam autem et culpa sint.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(22, 'Manuela McCullough', 'https://lorempixel.com/640/640/?59513', 'Provident sapiente sit laboriosam delectus unde sint in ut minus quia quis dolores libero qui ea deleniti similique dolor deserunt possimus autem ab et et et labore fugit voluptates molestiae perspiciatis similique nemo est veritatis rerum itaque deserunt voluptas voluptas illum qui iure odio.', 'Ut laudantium labore ut dolores animi fuga est blanditiis.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(23, 'Myles Marks', 'https://lorempixel.com/640/640/?88574', 'Molestias nobis quasi voluptate qui molestias velit ut qui similique ad dignissimos ex voluptatem minima et alias ducimus laboriosam consequatur ipsum dolorem in deleniti delectus dolorum doloribus autem eveniet totam itaque distinctio tenetur est non illo maxime et et quia nobis commodi magnam ea qui.', 'Id consequatur at eveniet nemo accusantium odio.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(24, 'Erik Haley', 'https://lorempixel.com/640/640/?27411', 'Atque quidem porro minus doloremque sed qui dolor eum iure quas quis et ipsa magnam tempora mollitia recusandae nemo voluptatem ut magni quaerat quod eum tenetur eum ad sed dolorum optio harum perspiciatis.', 'Odio neque minima explicabo rerum perspiciatis voluptas.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(25, 'Mr. Stewart Heller V', 'https://lorempixel.com/640/640/?83906', 'Ut incidunt pariatur reprehenderit sed aut possimus officiis tempora necessitatibus possimus qui qui molestias consequatur vitae a vitae labore atque natus qui omnis quos perspiciatis molestias quidem eveniet omnis modi deleniti.', 'Nesciunt excepturi eos quibusdam quia recusandae.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(26, 'Dr. Kacey D\'Amore', 'https://lorempixel.com/640/640/?30061', 'Aut ea non quae dolorem veniam magni qui est laudantium quis enim laudantium tenetur adipisci eos ipsum recusandae ea dicta ipsum nihil tenetur quo eligendi ipsum necessitatibus a dolore ut et sit sit ducimus non et asperiores magnam.', 'Est modi temporibus dolores modi.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(27, 'Mr. Broderick McGlynn', 'https://lorempixel.com/640/640/?55147', 'Voluptatibus sit est aut tempora eaque in praesentium vitae sequi autem ut modi quasi sit sed earum sint voluptas voluptate exercitationem commodi quis fugiat suscipit est.', 'Consequatur est ut provident suscipit.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(28, 'Raven Goodwin', 'https://lorempixel.com/640/640/?34643', 'Aliquid consequuntur incidunt nam explicabo et numquam magni cum amet eos officia quia veniam quis ut quia enim quae rerum earum voluptatum corrupti deleniti fugit ea ut eum earum commodi ea.', 'Dolorum voluptas quibusdam eveniet harum atque et dolores.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(29, 'Mr. Einar Rice V', 'https://lorempixel.com/640/640/?55579', 'Hic voluptatem et iste assumenda eligendi omnis voluptatibus voluptas esse qui similique quia numquam sapiente mollitia repellendus reiciendis est expedita dignissimos velit aliquam sunt ut.', 'Ut deserunt pariatur qui.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(30, 'Mr. Dedrick Gusikowski', 'https://lorempixel.com/640/640/?11976', 'Qui doloremque unde tempora ea adipisci optio et unde ut autem autem sint impedit possimus doloribus nihil quidem et aspernatur ducimus beatae asperiores rem facilis doloribus necessitatibus est molestiae.', 'Unde voluptatem voluptatum ratione nihil voluptatem.', 0, 35000, '2019-12-01 03:15:57', '2019-12-01 03:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE `itineraries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) NOT NULL,
  `step` int(11) NOT NULL,
  `duration` double(8,2) NOT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `transit_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itineraries`
--

INSERT INTO `itineraries` (`id`, `tour_id`, `step`, `duration`, `city_id`, `transit_id`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 40.85, NULL, 15, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(2, 3, 11, 34.18, 6, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(3, 2, 12, 30.86, 8, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(4, 1, 2, 55.45, NULL, 2, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(5, 1, 1, 56.46, 6, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(6, 3, 14, 53.98, NULL, 9, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(8, 2, 15, 64.98, 2, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(9, 3, 6, 43.81, NULL, 1, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(10, 3, 7, 30.32, 8, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(11, 2, 4, 29.40, NULL, 4, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(12, 2, 2, 53.83, NULL, 12, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(13, 1, 8, 48.74, NULL, 9, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(14, 2, 3, 62.28, 4, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(15, 3, 2, 30.07, NULL, 2, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(16, 2, 5, 39.15, 5, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(17, 2, 7, 50.62, NULL, 19, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(18, 3, 1, 25.54, 8, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(19, 2, 8, 67.13, 1, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(20, 3, 3, 51.97, 1, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(21, 3, 4, 52.55, NULL, 10, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(23, 2, 11, 68.07, NULL, 13, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(25, 2, 13, 31.70, NULL, 15, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(27, 2, 14, 63.26, NULL, 8, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(28, 3, 5, 68.89, 8, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(29, 1, 9, 52.07, 8, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(30, 1, 7, 28.23, 3, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(31, 1, 5, 62.25, 2, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(32, 3, 9, 66.83, 1, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(33, 3, 8, 65.83, NULL, 15, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(34, 3, 10, 69.19, NULL, 6, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(36, 3, 12, 63.76, NULL, 15, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(38, 1, 6, 43.17, NULL, 11, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(39, 2, 10, 50.97, 2, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(40, 1, 10, 32.90, NULL, 9, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(41, 2, 9, 53.09, NULL, 2, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(43, 1, 3, 24.09, 1, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(44, 3, 13, 55.44, 7, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(45, 3, 15, 50.43, NULL, 15, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(46, 1, 4, 29.41, NULL, 18, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(48, 2, 1, 42.41, 3, NULL, '2019-12-01 03:15:56', '2019-12-01 03:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '2019_12_01_065041_create_games_table', 2),
(129, '2014_10_12_000000_create_users_table', 3),
(130, '2014_10_12_100000_create_password_resets_table', 3),
(131, '2019_08_19_000000_create_failed_jobs_table', 3),
(132, '2019_11_29_125941_create_teams_table', 3),
(133, '2019_11_29_130133_create_trips_table', 3),
(134, '2019_11_29_130404_create_tours_table', 3),
(135, '2019_11_29_130720_create_itineraries_table', 3),
(136, '2019_11_29_131107_create_cities_table', 3),
(137, '2019_11_29_131202_create_transits_table', 3),
(138, '2019_11_29_131334_create_routes_table', 3),
(139, '2019_12_01_065246_create_game_multiple_choices_table', 3),
(140, '2019_12_01_065310_create_game_media_uploads_table', 3),
(141, '2019_12_01_065325_create_game_text_answeres_table', 3),
(142, '2019_12_01_065351_create_game_quizzes_table', 3),
(143, '2019_12_01_065437_create_game_multiple_choice_options_table', 3),
(144, '2019_12_01_065542_create_answere_checkeds_table', 3),
(145, '2019_12_01_065550_create_answere_uncheckeds_table', 3),
(146, '2019_12_01_092743_create_challenges_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transit_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maps_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kilometers` double(8,2) NOT NULL,
  `hours` double(8,2) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `nature` int(11) NOT NULL,
  `highway` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `transit_id`, `name`, `maps_url`, `kilometers`, `hours`, `difficulty`, `nature`, `highway`, `created_at`, `updated_at`) VALUES
(1, 1, 'Braeden Schuppe DDS', 'http://graham.net/', 237.45, 6.99, 80, 3, 74, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(2, 18, 'Brenda Feest', 'http://www.toy.org/sapiente-aliquam-voluptate-eius.html', 132.91, 12.23, 63, 25, 85, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(3, 19, 'Austin Stracke', 'http://leannon.com/ut-et-repellat-necessitatibus-ipsam-et', 292.25, 8.07, 64, 24, 74, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(4, 10, 'Glenda Parisian', 'http://douglas.com/', 83.76, 8.00, 78, 47, 76, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(5, 10, 'Zetta Renner', 'http://www.lang.com/', 63.77, 7.25, 35, 53, 45, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(6, 13, 'Gene Yost PhD', 'http://legros.com/laborum-qui-assumenda-necessitatibus-rerum-fugiat-repudiandae-enim-ipsam', 166.67, 4.11, 45, 81, 7, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(7, 5, 'Harmon Wiza', 'http://www.monahan.com/quaerat-deleniti-ut-corrupti-adipisci-autem', 224.14, 3.72, 29, 53, 29, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(8, 12, 'Norval Thompson', 'http://www.buckridge.info/nobis-consequatur-voluptas-dolores-eum-labore-quibusdam-non-placeat', 18.42, 7.35, 62, 43, 77, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(9, 18, 'Prof. Herbert Bartell', 'http://bradtke.com/enim-omnis-eveniet-dolorem-aut.html', 288.64, 0.87, 79, 69, 56, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(10, 17, 'Matt Ledner DVM', 'http://www.langosh.com/amet-numquam-deleniti-beatae-quas', 75.40, 4.64, 98, 80, 51, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(11, 4, 'Mrs. Sylvia Parisian PhD', 'https://www.schiller.biz/dolor-accusamus-similique-iusto-est-assumenda-aliquid-ab', 107.71, 1.29, 95, 30, 8, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(12, 17, 'Eldred Wolf PhD', 'http://kessler.com/', 296.09, 8.83, 39, 55, 26, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(13, 11, 'Alison Ruecker', 'https://www.stracke.com/voluptas-sunt-adipisci-cupiditate-voluptatum-beatae-aliquam', 25.73, 6.09, 58, 72, 13, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(14, 16, 'Zola Dibbert', 'https://www.koss.com/ratione-dolorum-aut-occaecati-sed-pariatur', 238.53, 6.48, 39, 67, 25, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(15, 8, 'Prof. Verlie Lynch', 'https://turner.com/expedita-doloremque-rerum-ut-sit-nulla.html', 243.98, 1.81, 24, 53, 95, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(16, 2, 'Mrs. Vita Wisoky PhD', 'http://rodriguez.com/itaque-eaque-necessitatibus-qui-harum-illum-delectus-itaque.html', 157.52, 11.32, 84, 18, 50, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(17, 11, 'Mrs. Genesis Klein PhD', 'http://www.waters.com/optio-et-ut-necessitatibus-nesciunt-deleniti-delectus-non', 159.63, 1.84, 32, 64, 51, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(18, 13, 'Susanna Stamm', 'http://www.terry.biz/non-et-voluptatem-eos-occaecati-porro-quae', 200.01, 11.88, 53, 99, 52, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(19, 13, 'Rodrigo Padberg MD', 'http://goyette.info/sint-nisi-possimus-animi', 138.81, 9.02, 49, 4, 32, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(20, 19, 'Jasmin Reynolds', 'http://toy.org/accusantium-aliquid-placeat-aperiam-tempora', 83.51, 10.09, 82, 5, 75, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(21, 13, 'Zakary Schimmel', 'http://www.glover.biz/facilis-accusamus-error-et-voluptas-sit-praesentium-sapiente-voluptas', 95.61, 8.01, 39, 50, 85, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(22, 14, 'Cicero Ferry V', 'http://gibson.com/dolores-tempore-dolor-velit-omnis-et-aut-reiciendis', 288.32, 3.35, 77, 35, 34, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(23, 10, 'Ms. Kelli Berge', 'http://www.botsford.org/deserunt-nihil-qui-reiciendis-at-sapiente', 135.16, 2.73, 37, 42, 67, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(24, 8, 'Nash Nikolaus I', 'http://stamm.biz/corporis-debitis-unde-ad-et-non-dolorum-magnam', 52.04, 12.56, 95, 91, 52, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(25, 17, 'Nicholas Williamson', 'https://www.predovic.info/sed-consequatur-laborum-quod-et-quasi-repellendus-et', 266.75, 5.29, 46, 96, 36, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(26, 3, 'Prof. Antonette Barrows V', 'https://www.kessler.net/eum-necessitatibus-provident-temporibus-sed-aut-nesciunt-ratione-similique', 15.70, 0.73, 96, 21, 44, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(27, 6, 'Emelie Schmidt', 'http://kirlin.org/qui-est-consequatur-dolor-placeat-consequatur', 59.19, 1.47, 22, 28, 43, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(28, 10, 'Prof. Damien Zboncak', 'http://www.douglas.com/error-voluptatibus-accusamus-voluptatem-quisquam-exercitationem-animi', 244.65, 10.81, 44, 70, 74, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(29, 18, 'Diego Rath', 'http://robel.info/et-voluptatem-dolor-enim-delectus', 40.96, 5.70, 69, 35, 80, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(30, 13, 'Aryanna Kihn DDS', 'http://padberg.com/consequatur-suscipit-dolores-fuga-ex-adipisci-iusto', 103.27, 4.59, 25, 12, 83, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(31, 10, 'Dr. William Hamill', 'https://www.johnston.com/officiis-omnis-totam-cumque-dolor-voluptas-aut', 127.77, 7.74, 65, 46, 86, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(32, 19, 'Ivy Lebsack', 'http://www.kub.com/quaerat-est-at-ut-quis.html', 20.99, 12.03, 43, 74, 86, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(33, 5, 'Fern Dibbert', 'http://www.schowalter.com/', 192.98, 10.82, 38, 16, 71, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(34, 5, 'Dulce Leuschke', 'http://www.kirlin.net/mollitia-ex-dolor-velit.html', 42.41, 5.59, 27, 95, 52, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(35, 6, 'Earlene Batz III', 'http://kris.org/', 137.47, 5.98, 32, 43, 62, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(36, 10, 'Dr. Shyann Beatty', 'http://www.sipes.com/suscipit-recusandae-minima-quo-voluptatibus', 53.21, 9.37, 18, 26, 5, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(37, 11, 'Margarette Russel', 'https://www.ruecker.biz/enim-tempore-quia-sapiente-illum-voluptates-necessitatibus', 220.31, 12.53, 26, 85, 11, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(38, 18, 'Elliot Maggio', 'http://www.mcdermott.com/', 201.91, 0.32, 77, 40, 26, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(39, 3, 'Mr. Kiley Breitenberg', 'http://www.lind.com/voluptas-natus-aliquid-magni-ratione-ut', 235.22, 10.64, 15, 73, 75, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(40, 18, 'Michaela Wehner', 'http://www.wilkinson.biz/', 103.94, 4.04, 64, 5, 94, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(41, 9, 'Demarcus Mills I', 'http://treutel.org/ut-est-labore-mollitia-porro', 243.87, 4.62, 20, 69, 70, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(42, 13, 'Ms. Cheyenne Emard Jr.', 'http://www.muller.com/nam-beatae-dolor-adipisci-et-pariatur-nam-quia.html', 37.72, 2.96, 12, 56, 96, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(43, 4, 'Carissa Hand', 'http://prosacco.com/', 230.65, 9.55, 100, 35, 17, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(44, 10, 'Bradly Kihn', 'http://wisoky.biz/sequi-esse-voluptatem-distinctio-aut-nulla-et-rerum', 276.93, 5.50, 5, 54, 92, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(45, 6, 'Emmanuelle Effertz', 'http://hoeger.com/reiciendis-quidem-labore-praesentium-fuga-aut-sit-temporibus', 4.68, 3.06, 56, 78, 82, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(46, 17, 'Dameon Aufderhar', 'http://www.lakin.com/temporibus-commodi-dignissimos-ut-perferendis-dolorem.html', 17.16, 6.00, 17, 38, 34, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(47, 12, 'Everardo Cartwright', 'http://okuneva.com/', 167.57, 0.48, 0, 44, 50, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(48, 4, 'Brayan Zboncak', 'http://gottlieb.com/omnis-et-et-aperiam-enim-ut-accusantium.html', 240.94, 12.25, 96, 10, 94, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(49, 10, 'Rita Hickle', 'http://www.hagenes.net/illum-eveniet-illo-accusantium-ab-laudantium-est-nisi-sit.html', 235.60, 7.96, 30, 82, 91, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(50, 11, 'Cameron Schmitt', 'http://ritchie.com/facilis-et-veniam-et-et-rerum-maxime-ullam.html', 292.14, 3.93, 5, 33, 25, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(51, 10, 'Prof. Maria Purdy MD', 'https://www.schroeder.com/eum-dolorem-ab-pariatur-et-rerum', 93.38, 8.86, 41, 18, 34, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(52, 6, 'Judge Kautzer', 'https://ankunding.com/pariatur-quia-sed-velit-est-ut-enim-et.html', 96.49, 2.03, 74, 4, 5, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(53, 11, 'Dr. Dallin Beatty MD', 'http://www.lindgren.com/', 141.01, 12.89, 45, 43, 6, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(54, 10, 'Deja Collier', 'http://bartell.com/', 214.31, 7.32, 37, 21, 8, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(55, 14, 'Miss Norma Funk', 'http://www.morar.net/', 78.88, 5.00, 42, 51, 46, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(56, 13, 'Dasia Abernathy DDS', 'https://okeefe.net/quasi-dolorum-dolorum-architecto-totam.html', 161.80, 8.50, 32, 38, 20, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(57, 3, 'Brenda Toy', 'https://www.welch.info/voluptatum-pariatur-quod-repudiandae-modi-voluptatem', 247.96, 0.65, 72, 100, 34, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(58, 9, 'Alessia Donnelly', 'http://gottlieb.com/maxime-nostrum-aut-placeat-molestias-atque-quia.html', 36.08, 11.35, 29, 29, 76, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(59, 1, 'Quentin Macejkovic', 'http://www.langosh.com/sed-laboriosam-mollitia-omnis-velit-quo-vel-laudantium-amet', 156.75, 10.01, 74, 45, 96, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(60, 4, 'Elta Daniel', 'https://weissnat.com/corrupti-esse-rerum-quos.html', 133.85, 2.80, 90, 27, 27, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(61, 14, 'Ms. Delphia Grant PhD', 'http://daniel.org/', 131.80, 5.70, 16, 85, 16, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(62, 11, 'Leonie Rath', 'http://cronin.com/ut-velit-et-earum-illo-nemo', 4.77, 7.97, 71, 44, 8, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(63, 11, 'Mr. Niko Ernser', 'http://schiller.com/', 5.54, 11.48, 21, 1, 82, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(64, 1, 'Esperanza Fahey', 'https://hoeger.info/odio-voluptatem-minima-fuga-ab-culpa-maiores-vel.html', 191.02, 1.32, 7, 73, 61, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(65, 1, 'Werner Walker', 'http://krajcik.com/aperiam-non-quo-consequatur-rem', 291.90, 2.79, 85, 23, 2, '2019-12-01 03:15:57', '2019-12-01 03:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `trip_id`, `name`, `color`, `badge`, `score`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mrs. Ozella Kris V', '#fd5d4e', 'https://lorempixel.com/640/640/?10203', 2821034, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(2, 1, 'Ms. Anais Shields MD', '#53719e', 'https://lorempixel.com/640/640/?52653', 7910924, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(3, 1, 'Jamarcus Wiegand', '#bb5356', 'https://lorempixel.com/640/640/?35829', 2166985, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(4, 1, 'Charley Mitchell', '#5ae0ea', 'https://lorempixel.com/640/640/?92650', 318283, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(5, 2, 'Mr. Henry Ebert DVM', '#c54cec', 'https://lorempixel.com/640/640/?15506', 6664655, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(6, 2, 'Ramiro Morar V', '#4ddf65', 'https://lorempixel.com/640/640/?64152', 6054742, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(7, 2, 'Kale Labadie', '#f43a2c', 'https://lorempixel.com/640/640/?44998', 6811905, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(8, 2, 'Melody Harber', '#d3c631', 'https://lorempixel.com/640/640/?72024', 3674724, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(9, 3, 'Susie Padberg', '#672692', 'https://lorempixel.com/640/640/?84127', 7239731, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(10, 3, 'Floy Harvey', '#95c9a9', 'https://lorempixel.com/640/640/?66855', 1838903, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(11, 3, 'Prof. Khalil Davis Sr.', '#de18b1', 'https://lorempixel.com/640/640/?43850', 2634637, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(12, 3, 'Zander Morar Jr.', '#e9b033', 'https://lorempixel.com/640/640/?97130', 1591021, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(13, 4, 'Jana Bernhard', '#0238b5', 'https://lorempixel.com/640/640/?51346', 7157518, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(14, 4, 'Moises Grant DVM', '#bbe9eb', 'https://lorempixel.com/640/640/?92989', 4072162, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(15, 4, 'Mr. Kristopher Bins', '#a819ba', 'https://lorempixel.com/640/640/?37585', 3524521, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(16, 4, 'Prof. Demarco Haag', '#759f3d', 'https://lorempixel.com/640/640/?99086', 2613723, '2019-12-01 03:15:57', '2019-12-01 03:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `name`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'Nakia Kshlerin PhD', 520.59, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(2, 'Miss Elmira Satterfield I', 640.61, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(3, 'Anissa Romaguera', 684.00, '2019-12-01 03:15:56', '2019-12-01 03:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `transits`
--

CREATE TABLE `transits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` bigint(20) NOT NULL,
  `to` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transits`
--

INSERT INTO `transits` (`id`, `name`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Myrtie Gottlieb', 4, 4, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(2, 'Dianna Schuppe', 8, 8, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(3, 'Torey Stiedemann', 2, 2, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(4, 'Danny Zemlak', 4, 6, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(5, 'Ms. Lucile Nienow', 8, 4, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(6, 'Prof. Heather Ortiz', 2, 8, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(7, 'Tiana Hyatt', 4, 1, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(8, 'Prof. Keely Nolan DDS', 8, 1, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(9, 'Christop Okuneva', 2, 2, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(10, 'Prof. Graham Maggio', 6, 5, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(11, 'Mr. Franco Kuhic', 1, 8, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(12, 'Dr. German Terry', 6, 2, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(13, 'Prof. Bernardo Fisher', 2, 5, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(14, 'Norris Olson', 2, 4, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(15, 'Miss Evie Stiedemann II', 7, 8, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(16, 'Nola Prohaska', 2, 8, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(17, 'Lennie Upton I', 7, 4, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(18, 'Alysha Hills', 8, 7, '2019-12-01 03:15:56', '2019-12-01 03:15:56'),
(19, 'Westley Greenholt', 1, 2, '2019-12-01 03:15:56', '2019-12-01 03:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date_time` datetime DEFAULT NULL,
  `score` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `tour_id`, `name`, `timezone`, `start_date_time`, `score`, `created_at`, `updated_at`) VALUES
(1, 1, 'Trip nr 1', 'GMT+7', '1996-04-22 08:50:47', 7458455, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(2, 1, 'Trip nr 2', 'GMT+7', '1981-09-05 21:44:35', 4441170, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(3, 3, 'Trip nr 3', 'GMT+7', '1981-09-05 21:44:35', 4441170, '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(4, 2, 'Trip nr 4', 'GMT+7', '1981-09-05 21:44:35', 4441170, '2019-12-01 03:15:57', '2019-12-01 03:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) NOT NULL,
  `trip_id` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` bigint(20) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `team_id`, `trip_id`, `email`, `phone`, `email_verified_at`, `password`, `first_name`, `family_name`, `age`, `gender`, `score`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'easter.will@example.net', '+4961825151008', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Keyon', 'Leuschke', 32, 'male', 3250782, 'UCmuSZ9fRc', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(2, 1, 2, 'aurelio.jacobson@example.org', '+8262400702650', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Burley', 'Nicolas', 23, 'male', 2617078, 'l2XqZJ2dfE', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(3, 1, 2, 'lueilwitz.marcia@example.org', '+4581174757907', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Priscilla', 'Reynolds', 32, 'female', 1000952, 'fevYn2djIP', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(4, 1, 2, 'ernestine.treutel@example.net', '+2359227145861', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Gladys', 'Walter', 28, 'female', 3825474, 'Ij5F4vnWLv', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(5, 2, 2, 'fdonnelly@example.com', '+2606924184151', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jayden', 'Purdy', 30, 'male', 4168384, 'jY5QknCdDz', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(6, 2, 2, 'lela.predovic@example.com', '+6881581878880', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rita', 'Kassulke', 35, 'female', 3584179, 'RyVwVos410', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(7, 2, 1, 'daphnee.spencer@example.net', '+4307319755227', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Branson', 'Conroy', 28, 'male', 3200161, '9pRDeq6i5v', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(8, 2, 1, 'yrussel@example.com', '+4587105082578', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Meaghan', 'Marks', 23, 'female', 3403140, 'VlE8uHInur', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(9, 3, 1, 'derdman@example.org', '+4622035255409', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Terrill', 'Nolan', 28, 'male', 812975, 'hiWhcmyMeI', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(10, 3, 1, 'annabel47@example.org', '+8703178781665', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ernesto', 'Funk', 20, 'male', 3625352, 'cWhsJ1aMnz', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(11, 3, 2, 'guiseppe.johnson@example.net', '+1464265761460', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rollin', 'D\'Amore', 27, 'male', 755700, 'NkGYZRfmAt', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(12, 3, 2, 'frenner@example.org', '+1786584713814', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Meaghan', 'Koelpin', 17, 'female', 533220, 'kolecjTllg', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(13, 4, 2, 'lueilwitz.fannie@example.com', '+9330754203740', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lia', 'Volkman', 19, 'female', 4173681, '7iNzFocfq6', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(14, 4, 2, 'carolyn.denesik@example.com', '+6010821309198', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rosario', 'Kulas', 33, 'male', 4142050, 'jaSvtAIJcA', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(15, 4, 2, 'keagan.keeling@example.org', '+4690047705421', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jason', 'Schimmel', 30, 'male', 3017933, 'iB2Yupeuw0', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(16, 4, 2, 'theodora.crooks@example.com', '+4541974913628', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Edgar', 'Okuneva', 30, 'male', 905908, 'cGbkSuUJPb', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(17, 5, 2, 'gillian60@example.net', '+5916772568626', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hulda', 'Dare', 28, 'female', 1408068, 'TgUGkFuDTE', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(18, 5, 2, 'xschuster@example.net', '+2991956231770', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Easton', 'Kassulke', 28, 'male', 2439027, '8m544Mh5fS', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(19, 5, 1, 'price.donnelly@example.com', '+4168251775118', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Warren', 'Abernathy', 16, 'male', 561956, 't3l6j3aLEY', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(20, 5, 1, 'cordell90@example.net', '+6218841303948', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Augustus', 'Strosin', 18, 'male', 2727382, 'BX4qzvF9Ot', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(21, 6, 2, 'zboncak.amani@example.com', '+2140789070142', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Narciso', 'Wisozk', 29, 'male', 1734789, '6Ij7G9Klxb', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(22, 6, 1, 'gracie.cartwright@example.net', '+4931469880514', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Emilia', 'Cummerata', 21, 'female', 149881, 'wmEk7HuqTn', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(23, 6, 2, 'dillon.breitenberg@example.com', '+6058831079526', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jackie', 'Walter', 36, 'female', 2151848, 'Y6lVs28Wms', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(24, 6, 1, 'ywintheiser@example.org', '+9577212435944', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Chaz', 'Aufderhar', 16, 'male', 428443, 'jwxoNdeIR7', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(25, 7, 2, 'maggie.turcotte@example.net', '+5426315736332', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kariane', 'Bahringer', 31, 'female', 4427894, 'TRAJu4gvjW', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(26, 7, 1, 'gusikowski.noe@example.com', '+4034853974306', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Santos', 'Mosciski', 25, 'male', 1093776, 'OjmCZ3xUFR', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(27, 7, 2, 'greenfelder.clark@example.com', '+1429458853131', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Shakira', 'Lockman', 37, 'female', 4105619, 'eg2I16ZYn4', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(28, 7, 1, 'harris.bridgette@example.org', '+8911765151845', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Greyson', 'Bechtelar', 29, 'male', 498431, '1Vz5HOedjA', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(29, 8, 2, 'ignacio.bartell@example.com', '+5228694479478', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Earline', 'Armstrong', 27, 'female', 4416447, 'Gg5pyFb49B', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(30, 8, 2, 'vwolf@example.org', '+8903161887595', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lavada', 'Wehner', 29, 'female', 791119, '1xpmkOznZ3', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(31, 8, 2, 'alysa.hettinger@example.org', '+7139784931312', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Julia', 'Gleason', 34, 'female', 4405859, 'iKidXoCNua', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(32, 8, 2, 'lherzog@example.net', '+4855977023864', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mac', 'Abshire', 36, 'male', 236908, 'xEiCGnrVyP', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(33, 9, 1, 'kturcotte@example.com', '+6172230859635', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Beverly', 'Waters', 26, 'female', 2659824, 'uwqfZWcIuR', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(34, 9, 2, 'homenick.wendell@example.com', '+8772220756749', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Michale', 'Grimes', 16, 'male', 1789209, 'xvnxOmbd1I', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(35, 9, 1, 'jeremie89@example.org', '+1295064788070', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kennedi', 'Braun', 21, 'male', 1969048, 'U58wArfsyo', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(36, 9, 2, 'alexanne85@example.org', '+9218176271350', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Robert', 'Kessler', 24, 'male', 1231967, 'VfS0IHW7Qs', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(37, 10, 1, 'susie.hudson@example.org', '+8226154482322', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Donnie', 'Goldner', 16, 'male', 1853129, '0Xn5rUdKSQ', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(38, 10, 1, 'onie16@example.org', '+7494509192763', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Annetta', 'Kassulke', 23, 'female', 3480935, 'iNnbntRKQa', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(39, 10, 1, 'alene.kozey@example.org', '+3805910243856', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Abdullah', 'Bruen', 26, 'male', 155833, 'SAeOSyjY7k', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(40, 10, 2, 'edison.kuhn@example.net', '+4908569058285', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rickey', 'Boyer', 22, 'male', 1729580, 'LoTt1DZnLg', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(41, 11, 2, 'donnie.schmidt@example.org', '+4547991852866', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Odessa', 'Harber', 28, 'female', 459528, 'BK0KjQPMvZ', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(42, 11, 2, 'jazlyn.beatty@example.org', '+3591591475856', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Pablo', 'Wunsch', 17, 'male', 4302293, 'la6APv9hrw', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(43, 11, 1, 'ila81@example.com', '+3326807104147', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mitchel', 'Wolff', 28, 'male', 3556381, 'TcL0DKAyl9', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(44, 11, 1, 'carleton.cremin@example.com', '+7638055040394', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mckenna', 'Krajcik', 26, 'male', 793829, 'qJMe5dYZkF', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(45, 12, 2, 'oaltenwerth@example.net', '+5565139269645', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Percival', 'Hartmann', 22, 'male', 2664317, 'cYjV9Yv7Vy', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(46, 12, 2, 'craig06@example.net', '+2810126556576', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sierra', 'Anderson', 22, 'female', 3426063, 'dP51MDfMbA', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(47, 12, 2, 'ezra12@example.com', '+1879448998607', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sage', 'Hirthe', 16, 'male', 1912443, 'oWCmmZ7sAA', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(48, 12, 1, 'isabel.miller@example.net', '+4453727631746', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Emery', 'Hackett', 35, 'male', 1565331, 'dnsGl9chkh', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(49, 13, 1, 'fletcher.west@example.com', '+2088428507997', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dulce', 'Schuppe', 28, 'female', 3531063, 'J80Req3vCa', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(50, 13, 2, 'wilfrid.kassulke@example.com', '+2822126994003', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Alexandria', 'Farrell', 36, 'female', 4277592, 'cFRvnLrnyX', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(51, 13, 1, 'anissa.heller@example.org', '+2675004892991', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Elwin', 'Torphy', 17, 'male', 2789959, 'CburMI6swU', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(52, 13, 2, 'pansy.herzog@example.org', '+1609189144999', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sydnie', 'Feest', 19, 'female', 76709, 'MxutK4BrbY', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(53, 14, 2, 'ashlee04@example.net', '+3053898110975', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Madisen', 'Douglas', 23, 'male', 2415399, 'EXhSFo66Px', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(54, 14, 2, 'brianne44@example.com', '+3337795618125', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Janick', 'Rosenbaum', 35, 'male', 2146046, 'YqsQJFq9sF', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(55, 14, 2, 'warren80@example.org', '+5372547105653', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Oral', 'Schaefer', 28, 'male', 1896958, 'hWWymbRWNw', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(56, 14, 2, 'daugherty.maynard@example.net', '+9303931250130', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Elyse', 'Schultz', 22, 'female', 327500, 'XwvcNOuJdE', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(57, 15, 2, 'igibson@example.net', '+2432071982156', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Shakira', 'Johnson', 20, 'female', 3980646, '9XxY75ZTwD', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(58, 15, 2, 'lvandervort@example.com', '+9508926826955', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lee', 'Hahn', 36, 'male', 2590657, 'eEvXVMOgME', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(59, 15, 2, 'moen.wilbert@example.com', '+6072776870878', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Devan', 'Carter', 38, 'male', 4481369, 'PmHZ5Qk6o9', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(60, 15, 2, 'vincenza80@example.com', '+3149787947744', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Marilyne', 'Lesch', 18, 'female', 135173, 'G83qPHVAzg', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(61, 16, 2, 'lisandro.crist@example.org', '+1064104033971', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Arlo', 'Gibson', 27, 'male', 295302, 'YbI8ZbuQ88', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(62, 16, 1, 'haylee72@example.com', '+7484427222062', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Meredith', 'Senger', 27, 'female', 3371501, 'TIHucqtlqy', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(63, 16, 1, 'dubuque.vernice@example.com', '+8349588155443', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ara', 'Torp', 21, 'female', 1857469, 'WazStI6JSV', '2019-12-01 03:15:57', '2019-12-01 03:15:57'),
(64, 16, 1, 'nelda.jast@example.com', '+5614513510178', '2019-12-01 03:15:57', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Tanner', 'Emmerich', 20, 'male', 484061, '2y0fFye2pA', '2019-12-01 03:15:57', '2019-12-01 03:15:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answere_checkeds`
--
ALTER TABLE `answere_checkeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answere_uncheckeds`
--
ALTER TABLE `answere_uncheckeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_media_uploads`
--
ALTER TABLE `game_media_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_multiple_choices`
--
ALTER TABLE `game_multiple_choices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_multiple_choice_options`
--
ALTER TABLE `game_multiple_choice_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_quizzes`
--
ALTER TABLE `game_quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_text_answeres`
--
ALTER TABLE `game_text_answeres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itineraries`
--
ALTER TABLE `itineraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transits`
--
ALTER TABLE `transits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answere_checkeds`
--
ALTER TABLE `answere_checkeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `answere_uncheckeds`
--
ALTER TABLE `answere_uncheckeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_media_uploads`
--
ALTER TABLE `game_media_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `game_multiple_choices`
--
ALTER TABLE `game_multiple_choices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `game_multiple_choice_options`
--
ALTER TABLE `game_multiple_choice_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `game_quizzes`
--
ALTER TABLE `game_quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_text_answeres`
--
ALTER TABLE `game_text_answeres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `itineraries`
--
ALTER TABLE `itineraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transits`
--
ALTER TABLE `transits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
