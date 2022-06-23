-- -------------------------------------------------------------
-- TablePlus 4.6.8(424)
--
-- https://tableplus.com/
--
-- Database: egzaminas
-- Generation Time: 2022-06-23 13:44:21.2880
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `istaigos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pavadinimas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nuotrauka` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `kategorija` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pavadinimas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `knygu_istaigos_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategorija_knygu_istaigos_id_foreign` (`knygu_istaigos_id`),
  CONSTRAINT `kategorija_knygu_istaigos_id_foreign` FOREIGN KEY (`knygu_istaigos_id`) REFERENCES `istaigos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `knygos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `knygos_pavadinimas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `knygos_kaina` double(8,2) NOT NULL,
  `knygos_aprasymas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategorija_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `knygos_kategorija_id_foreign` (`kategorija_id`),
  CONSTRAINT `knygos_kategorija_id_foreign` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vartotojas',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `uzsakymai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `knygos_id` bigint unsigned NOT NULL,
  `kiekis` int NOT NULL,
  `vartotojo_id` bigint unsigned NOT NULL,
  `busena` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vykdoma',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uzsakymai_knygos_id_foreign` (`knygos_id`),
  KEY `uzsakymai_vartotojo_id_foreign` (`vartotojo_id`),
  CONSTRAINT `uzsakymai_knygos_id_foreign` FOREIGN KEY (`knygos_id`) REFERENCES `knygos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `uzsakymai_vartotojo_id_foreign` FOREIGN KEY (`vartotojo_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `istaigos` (`id`, `pavadinimas`, `kodas`, `adresas`, `nuotrauka`, `created_at`, `updated_at`) VALUES
(1, 'Pegasas', '1', 'Kareiviu 12', '1655977951.jpg', '2022-06-23 09:52:31', '2022-06-23 09:52:31'),
(2, 'Isgalvotas Knygynas', '2', 'Zirmunu g. 12', '1655978056.jpg', '2022-06-23 09:54:16', '2022-06-23 09:54:16'),
(3, 'Knygos Knygos Knygos', '3', 'Siaures 44-2a', '1655978103.jpg', '2022-06-23 09:55:03', '2022-06-23 09:55:03');

INSERT INTO `kategorija` (`id`, `pavadinimas`, `knygu_istaigos_id`, `created_at`, `updated_at`) VALUES
(1, 'Drama', 1, '2022-06-23 09:55:18', '2022-06-23 09:55:18'),
(2, 'Siaubas', 1, '2022-06-23 09:55:27', '2022-06-23 09:55:27'),
(3, 'Autobiografika', 1, '2022-06-23 09:55:38', '2022-06-23 09:55:38'),
(4, 'Romantika', 2, '2022-06-23 09:55:47', '2022-06-23 09:55:47'),
(5, 'Drama', 2, '2022-06-23 09:55:54', '2022-06-23 09:55:54'),
(6, 'Mokslinė literatūra', 2, '2022-06-23 09:56:07', '2022-06-23 09:56:07'),
(7, 'Mokslas', 3, '2022-06-23 09:56:14', '2022-06-23 09:56:14'),
(8, 'Istorija', 3, '2022-06-23 09:56:22', '2022-06-23 09:56:22'),
(9, 'IT technologijos', 3, '2022-06-23 09:56:31', '2022-06-23 09:56:31');

INSERT INTO `knygos` (`id`, `knygos_pavadinimas`, `knygos_kaina`, `knygos_aprasymas`, `kategorija_id`, `created_at`, `updated_at`) VALUES
(1, 'PHP by Rasmus', 1.00, 'Idomi', 9, '2022-06-23 09:57:03', '2022-06-23 09:57:03'),
(2, 'Meiles istorijos', 2.00, 'Knyga', 1, '2022-06-23 09:57:21', '2022-06-23 09:57:21'),
(3, 'Siaubo istorijos', 33.00, 'Siaubo', 2, '2022-06-23 09:57:46', '2022-06-23 09:57:46'),
(4, 'Idomi knyga', 3.00, 'Idomi', 4, '2022-06-23 09:58:01', '2022-06-23 09:58:01'),
(5, 'Mes by Rasmus Lerdorf', 55.00, 'Knyga', 3, '2022-06-23 09:58:44', '2022-06-23 09:58:44');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_08_131010_create_istaigos_table', 1),
(6, '2022_06_09_120114_create_kategorija_table', 1),
(7, '2022_06_09_172037_create_knygos_table', 1),
(8, '2022_06_12_112427_create_uzsakymai_table', 1);

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'labas', 'labas@gmail.com', NULL, '$2y$10$KuG7uVYAPdonnjr2VJnFDe3j5kkfFLxM1dN6Szau9Y1.POzZvc0Ie', NULL, '2022-06-23 09:34:11', '2022-06-23 09:34:11', 'vartotojas'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$10$HsXp3lhMsy.0PKgZScKye.iitHSHAlKnaNALhDzc0xKIuWyHhZaHi', NULL, '2022-06-23 10:16:13', '2022-06-23 10:16:13', 'administratorius');

INSERT INTO `uzsakymai` (`id`, `knygos_id`, `kiekis`, `vartotojo_id`, `busena`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 1, 'paruoštas', '2022-06-23 10:06:23', '2022-06-23 10:10:07'),
(2, 2, 1, 1, 'vykdoma', '2022-06-23 10:39:27', '2022-06-23 10:39:27');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;