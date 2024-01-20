-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 02:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tqdum`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `user_id`, `contact_info`, `address`, `qualification`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, NULL, NULL, NULL, NULL, '2024-01-11 08:01:09', '2024-01-11 08:01:09', NULL),
(2, 8, NULL, NULL, NULL, NULL, '2024-01-12 14:12:48', '2024-01-12 14:12:48', NULL),
(3, 9, NULL, NULL, NULL, NULL, '2024-01-12 14:14:50', '2024-01-12 14:14:50', NULL),
(4, 11, NULL, NULL, NULL, NULL, '2024-01-12 17:16:42', '2024-01-12 17:16:42', NULL),
(5, 13, NULL, NULL, NULL, NULL, '2024-01-14 16:51:22', '2024-01-14 16:51:22', NULL),
(6, 14, NULL, NULL, NULL, NULL, '2024-01-15 13:39:22', '2024-01-15 13:39:22', NULL),
(7, 22, NULL, NULL, NULL, NULL, '2024-01-17 04:40:14', '2024-01-17 04:40:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`values`)),
  `status_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `program_id`, `applicant_id`, `values`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '{\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a\":\"\\u0627\\u062d\\u0645\\u062f \\u0639\\u0644\\u064a\",\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a 2\":\"\\u0628\\u0631\\u0646\\u0627\\u0645\\u062c \\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u0648\\u064a\\u0628\"}', 4, '2024-01-11 14:12:27', '2024-01-20 01:10:29', NULL),
(2, 1, 2, '{\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a\":\"\\u0639\\u0645\\u0631 \\u0639\\u0644\\u064a\",\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a 2\":\"\\u0628\\u0631\\u0646\\u0627\\u0645\\u062c \\u062a\\u0637\\u0648\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0648\\u0628\\u0627\\u064a\\u0644\"}', 2, '2024-01-12 14:13:51', '2024-01-14 13:50:20', NULL),
(3, 1, 3, '{\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a\":\"\\u0645\\u062d\\u0645\\u062f \\u0639\\u0644\\u064a\",\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a 2\":\"\\u062a\\u0635\\u064a\\u0645 \\u0648\\u0627\\u062c\\u0647\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628\"}', 3, '2024-01-12 14:15:27', '2024-01-17 08:31:21', NULL),
(4, 1, 4, '{\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a\":\"\\u0633\\u0639\\u064a\\u062f \\u0633\\u0627\\u0644\\u0645\",\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a 2\":\"\\u0628\\u0631\\u0646\\u0627\\u0645\\u062c \\u0627\\u0644\\u0648\\u064a\\u0628\",\"\\u062d\\u0642\\u0644 \\u0631\\u0641\\u0639 \\u0645\\u0644\\u0641\":\"form_files\\/T7iX4Tv1U2ZwSuQtuRkoSyJt59h1SyL8LZyQBZTW.png\"}', 2, '2024-01-12 17:18:22', '2024-01-20 03:12:18', NULL),
(6, 1, 6, '{\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a\":false,\"\\u062d\\u0642\\u0644 \\u0646\\u0635\\u064a 2\":null,\"\\u062d\\u0642\\u0644 \\u0631\\u0641\\u0639 \\u0645\\u0644\\u0641\":\"applicaiton test\",\"\\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u062d\\u0642\\u0648\\u0644 \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631\":false}', 2, '2024-01-17 04:41:45', '2024-01-17 13:49:06', NULL),
(7, 2, 5, '[]', 5, '2024-01-17 05:40:47', '2024-01-17 05:40:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `criterias`
--

CREATE TABLE `criterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criterias`
--

INSERT INTO `criterias` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'اللغة الانجليزية', '2024-01-12 06:52:12', '2024-01-15 16:17:50', NULL),
(2, 'مهارات البرمجة', '2024-01-12 07:25:52', '2024-01-12 07:25:52', NULL),
(3, 'مهارات الخوارزميات', '2024-01-12 14:44:31', '2024-01-12 14:44:31', NULL),
(4, 'المظهر', '2024-01-15 03:06:32', '2024-01-15 03:06:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_degree` varchar(255) NOT NULL,
  `exam_date` datetime NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `min_degree`, `exam_date`, `program_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '20', '2024-02-01 13:45:06', 1, '2024-01-13 07:43:19', '2024-01-13 08:12:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_degree` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `exam_degree`, `note`, `exam_id`, `application_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 1, NULL, '2024-01-13 07:43:19', '2024-01-13 07:43:19', NULL),
(2, '90', 'ممتاز', 1, 3, '2024-01-13 10:14:06', '2024-01-13 10:14:06', NULL),
(3, '80', 'جيد جدا', 1, 4, '2024-01-13 10:35:12', '2024-01-13 10:35:12', NULL),
(4, '50', 'جيد جدا', 1, 2, '2024-01-15 03:00:10', '2024-01-15 03:00:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_import_rows`
--

CREATE TABLE `failed_import_rows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `import_id` bigint(20) UNSIGNED NOT NULL,
  `validation_error` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '0fdabe1f-aa9d-44a2-86de-63a2ce716705', 'database', 'default', '{\"uuid\":\"0fdabe1f-aa9d-44a2-86de-63a2ce716705\",\"displayName\":\"App\\\\Mail\\\\notification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:21:\\\"App\\\\Mail\\\\notification\\\":4:{s:5:\\\"email\\\";a:1:{i:0;s:22:\\\"a3shater.dev@gmail.com\\\";}s:5:\\\"title\\\";s:34:\\\"برنامج تطوير الويب\\\";s:7:\\\"message\\\";a:1:{s:7:\\\"message\\\";s:135:\\\"<h2 dir=\\\"rtl\\\"><strong>برنامج تطوير الويب<\\/strong><\\/h2><p dir=\\\"rtl\\\">مرحبا احمد تم قبولك...مبروك<\\/p>\\\";}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 'TypeError: htmlspecialchars(): Argument #1 ($string) must be of type string, Illuminate\\Mail\\Message given in C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php:124\nStack trace:\n#0 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php(124): htmlspecialchars(Object(Illuminate\\Mail\\Message), 11, \'UTF-8\', true)\n#1 C:\\xampp\\htdocs\\tqdum-app\\storage\\framework\\views\\3005e68fdb80d7aca19f97224125ada8.php(1): e(Object(Illuminate\\Mail\\Message))\n#2 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(124): require(\'C:\\\\xampp\\\\htdocs...\')\n#3 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(125): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(58): Illuminate\\Filesystem\\Filesystem->getRequire(\'C:\\\\xampp\\\\htdocs...\', Array)\n#5 C:\\xampp\\htdocs\\tqdum-app\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(22): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#6 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(72): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#7 C:\\xampp\\htdocs\\tqdum-app\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(10): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#8 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(207): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#9 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(190): Illuminate\\View\\View->getContents()\n#10 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(159): Illuminate\\View\\View->renderContents()\n#11 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(433): Illuminate\\View\\View->render()\n#12 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(408): Illuminate\\Mail\\Mailer->renderView(\'mail\', Array)\n#13 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(320): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'mail\', NULL, NULL, Array)\n#14 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(205): Illuminate\\Mail\\Mailer->send(\'mail\', Array, Object(Closure))\n#15 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#16 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#17 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#18 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#19 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#20 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#21 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#22 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#23 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#24 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#25 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#27 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#28 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#29 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#30 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#31 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#32 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#33 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#34 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#35 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#36 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#37 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#38 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#39 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#40 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#41 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#42 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#43 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#44 C:\\xampp\\htdocs\\tqdum-app\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#45 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#46 C:\\xampp\\htdocs\\tqdum-app\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 C:\\xampp\\htdocs\\tqdum-app\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 C:\\xampp\\htdocs\\tqdum-app\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 C:\\xampp\\htdocs\\tqdum-app\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#51 {main}\n\nNext Illuminate\\View\\ViewException: htmlspecialchars(): Argument #1 ($string) must be of type string, Illuminate\\Mail\\Message given (View: C:\\xampp\\htdocs\\tqdum-app\\resources\\views\\mail.blade.php) in C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\helpers.php:124\nStack trace:\n#0 C:\\xampp\\htdocs\\tqdum-app\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(60): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(TypeError), 0)\n#1 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(60): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->handleViewException(Object(TypeError), 0)\n#2 C:\\xampp\\htdocs\\tqdum-app\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(22): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(72): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#4 C:\\xampp\\htdocs\\tqdum-app\\vendor\\livewire\\livewire\\src\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine.php(10): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#5 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(207): Livewire\\Mechanisms\\ExtendBlade\\ExtendedCompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#6 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(190): Illuminate\\View\\View->getContents()\n#7 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(159): Illuminate\\View\\View->renderContents()\n#8 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(433): Illuminate\\View\\View->render()\n#9 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(408): Illuminate\\Mail\\Mailer->renderView(\'mail\', Array)\n#10 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(320): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'mail\', NULL, NULL, Array)\n#11 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(205): Illuminate\\Mail\\Mailer->send(\'mail\', Array, Object(Closure))\n#12 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#13 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(198): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#14 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(83): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#15 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#16 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#17 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#18 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#19 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#20 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#21 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(144): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#25 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(144): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(119): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#28 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#29 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#30 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#32 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#35 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#37 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#38 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#39 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#40 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#41 C:\\xampp\\htdocs\\tqdum-app\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#42 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 C:\\xampp\\htdocs\\tqdum-app\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\xampp\\htdocs\\tqdum-app\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\xampp\\htdocs\\tqdum-app\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 C:\\xampp\\htdocs\\tqdum-app\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 C:\\xampp\\htdocs\\tqdum-app\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 {main}', '2024-01-13 13:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'كيف يمكنني التسجيل في التطبيق؟', ' يمكنك التسجيل في تقدُم بسهولة عن طريق الانتقال إلى صفحة التسجيل وملء النموذج البسيط. بمجرد تقديم المعلومات المطلوبة وتأكيد البريد الإلكتروني، ستكون جاهزًا للاستفادة من جميع البرامج التدريبية.\n                    ', '2024-01-16 06:11:56', '2024-01-16 06:21:45', NULL),
(2, 'هل يمكنني الوصول إلى البرامج التدريبية من أي مكان؟', 'نعم، يمكنك الوصول إلى تقدُم من أي مكان باستخدام أي جهاز ذكي متصل بالإنترنت. نحن ملتزمون بتقديم تجربة تعلم مرنة تتناسب مع جدولك الشخصي.', '2024-01-17 03:39:36', '2024-01-17 03:39:36', NULL),
(3, 'كيف يمكنني متابعة قبولي في البرنامج؟', 'بعد تقديم طلبك لبرنامج تدريبي، ستتلقى إشعارات فورية حول حالة طلبك. يمكنك أيضًا متابعة حالة قبولك من خلال لوحة التحكم الخاصة بك.', '2024-01-17 03:41:20', '2024-01-17 03:41:20', NULL),
(4, 'هل يمكنني التسجيل في أكثر من برنامج تدريبي؟', 'نعم، يُسمح لك بالتسجيل في أكثر من برنامج تدريبي في نفس الوقت. يمكنك اختيار البرامج التي تتناسب مع اهتماماتك وأهدافك المهنية.', '2024-01-17 03:42:00', '2024-01-17 03:42:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `importer` varchar(255) NOT NULL,
  `processed_rows` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total_rows` int(10) UNSIGNED NOT NULL,
  `successful_rows` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interviewers`
--

CREATE TABLE `interviewers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interviewers`
--

INSERT INTO `interviewers` (`id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '2024-01-12 03:05:45', '2024-01-12 03:05:45', NULL),
(2, 5, '2024-01-12 03:06:16', '2024-01-12 03:06:16', NULL),
(3, 6, '2024-01-12 05:38:36', '2024-01-12 05:38:36', NULL),
(4, 7, '2024-01-12 05:39:29', '2024-01-12 05:39:29', NULL),
(5, 10, '2024-01-12 14:44:06', '2024-01-12 14:44:06', NULL),
(6, 15, '2024-01-16 02:32:44', '2024-01-16 02:32:44', NULL),
(7, 16, '2024-01-16 02:35:08', '2024-01-16 02:35:08', NULL),
(8, 17, '2024-01-16 03:16:25', '2024-01-16 03:26:27', NULL),
(9, 21, '2024-01-16 04:43:18', '2024-01-16 04:43:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `interview_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`id`, `program_id`, `application_id`, `interview_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2024-01-17 09:00:00', '2024-01-12 07:26:02', '2024-01-12 07:26:02', NULL),
(2, 1, 1, '2024-01-10 20:50:45', '2024-01-12 14:49:43', '2024-01-12 14:49:43', NULL),
(3, 1, 3, '2024-01-12 20:50:45', '2024-01-12 14:49:43', '2024-01-12 14:49:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interview_results`
--

CREATE TABLE `interview_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `interviewer_id` bigint(20) UNSIGNED NOT NULL,
  `interview_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview_results`
--

INSERT INTO `interview_results` (`id`, `note`, `interviewer_id`, `interview_id`, `created_at`, `updated_at`) VALUES
(1, 'يرجى الاعتماد', 1, 1, '2024-01-12 07:26:03', '2024-01-14 03:17:07'),
(2, 'ممتاز', 2, 1, '2024-01-12 07:26:03', '2024-01-12 07:26:03'),
(3, 'جيد جدا', 3, 1, '2024-01-12 07:26:03', '2024-01-12 07:26:03'),
(4, NULL, 2, 2, '2024-01-12 14:49:43', '2024-01-12 14:49:43'),
(5, NULL, 2, 3, '2024-01-12 14:49:43', '2024-01-12 14:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_30_133327_create_permission_tables', 1),
(6, '2023_12_31_135104_create_jobs_table', 1),
(7, '2024_01_11_102030_create_faqs_table', 1),
(8, '2024_01_11_102031_create_applicants_table', 1),
(9, '2024_01_11_102032_create_programs_table', 1),
(10, '2024_01_11_102033_create_statuses_table', 1),
(11, '2024_01_11_102034_create_applications_table', 1),
(12, '2024_01_11_102035_create_interviewers_table', 1),
(13, '2024_01_11_102036_create_interviews_table', 1),
(14, '2024_01_11_102037_create_interview_results_table', 1),
(15, '2024_01_11_102038_create_reviewers_table', 1),
(16, '2024_01_11_102039_create_reviews_table', 1),
(17, '2024_01_11_102040_create_exams_table', 1),
(18, '2024_01_11_102041_create_exam_results_table', 1),
(19, '2024_01_11_102042_create_results_table', 1),
(20, '2024_01_11_102043_create_criterias_table', 1),
(21, '2024_01_14_111723_create_job_batches_table', 2),
(22, '2024_01_14_111731_create_notifications_table', 2),
(23, '2024_01_14_111739_create_imports_table', 2),
(24, '2024_01_14_111740_create_failed_import_rows_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(4, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 22);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `student_count` varchar(255) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fields`)),
  `interview_min_rate` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `description`, `image`, `start_date`, `end_date`, `student_count`, `is_published`, `fields`, `interview_min_rate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'برنامج تطوير الويب', 'برنامج تطوير الويب يقدم للمشاركين فرصة فريدة لاكتساب المهارات اللازمة لبناء وتطوير مواقع الويب الديناميكية. يشمل المحتوى الدوري والمشاريع العملية لتعزيز الفهم العملي للمشاركين.', '01HKW2T54TDVPRQGCZ860T4C4S.jpg', '2024-01-18 13:58:44', '2024-02-08 13:58:50', '40', 1, '\"[{\\\"type\\\":\\\"text\\\",\\\"required\\\":true,\\\"label\\\":\\\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0631\\u0628\\u0627\\u0639\\u064a\\\",\\\"className\\\":\\\"form-control\\\",\\\"name\\\":\\\"text-1704992983803-0\\\",\\\"access\\\":false,\\\"subtype\\\":\\\"text\\\"},{\\\"type\\\":\\\"text\\\",\\\"required\\\":true,\\\"label\\\":\\\"\\u0627\\u0644\\u062c\\u0627\\u0645\\u0639\\u0629\\\",\\\"className\\\":\\\"form-control\\\",\\\"name\\\":\\\"text-1704992981402-0\\\",\\\"access\\\":false,\\\"subtype\\\":\\\"text\\\"},{\\\"type\\\":\\\"file\\\",\\\"required\\\":true,\\\"label\\\":\\\"\\u0627\\u0644CV\\\",\\\"className\\\":\\\"form-control\\\",\\\"name\\\":\\\"file-1705090525378-0\\\",\\\"access\\\":false,\\\"multiple\\\":false},{\\\"type\\\":\\\"text\\\",\\\"required\\\":true,\\\"label\\\":\\\"\\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u0643\\u0627\\u062a \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639\\u064a\\u0629 \\u0627\\u0646 \\u0648\\u062c\\u062f\\u062a\\\",\\\"className\\\":\\\"form-control\\\",\\\"name\\\":\\\"text-1705298288938-0\\\",\\\"access\\\":false,\\\"subtype\\\":\\\"text\\\"},{\\\"type\\\":\\\"radio-group\\\",\\\"required\\\":true,\\\"label\\\":\\\"\\u0645\\u0633\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0644\\u063a\\u0629 \\u0627\\u0644\\u0627\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629\\\",\\\"inline\\\":false,\\\"name\\\":\\\"radio-group-1705511429961-0\\\",\\\"access\\\":false,\\\"other\\\":false,\\\"values\\\":[{\\\"label\\\":\\\"\\u062c\\u064a\\u062f\\\",\\\"value\\\":\\\"1\\\",\\\"selected\\\":false},{\\\"label\\\":\\\"\\u062c\\u064a\\u062f \\u062c\\u062f\\u0627\\\",\\\"value\\\":\\\"2\\\",\\\"selected\\\":false},{\\\"label\\\":\\\"\\u0645\\u0645\\u062a\\u0627\\u0632\\\",\\\"value\\\":\\\"3\\\",\\\"selected\\\":false}]},{\\\"type\\\":\\\"textarea\\\",\\\"required\\\":true,\\\"label\\\":\\\"\\u0627\\u0643\\u062a\\u0628 \\u0644\\u0645\\u0627\\u0630\\u0627 \\u0633\\u064a\\u062a\\u0645 \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631\\u0643\\\",\\\"className\\\":\\\"form-control\\\",\\\"name\\\":\\\"textarea-1705511502779-0\\\",\\\"access\\\":false,\\\"subtype\\\":\\\"textarea\\\"}]\"', NULL, '2024-01-11 07:59:13', '2024-01-17 14:12:13', NULL),
(2, 'برنامج تطوير تطبيقات الموبايل', 'هذا البرنامج يركز على تعلم كيفية تطوير تطبيقات الموبايل لأنظمة Android و iOS. يشمل المحتوى دروسًا تفاعلية ومشاريع عملية تساعد المشاركين على تحويل أفكارهم إلى تطبيقات واقعية.', '01HM4PQWTVCX23DX5RTAAX3JBY.jpg', '2024-02-08 22:21:00', '2024-02-21 22:21:07', '20', 1, NULL, NULL, '2024-01-14 16:21:26', '2024-01-20 03:11:31', NULL),
(3, 'برنامج الإشراف الهندسي', 'برنامج الإشراف الهندسي يقدم للمهندسين المحتملين والمحترفين الفرصة لاكتساب المهارات اللازمة لإدارة والإشراف على المشاريع الهندسية. يشمل المحتوى دروسًا حول التخطيط والمتابعة والتقييم الفعّال للمشاريع.', '01HMB3DSHJYTYVMKKJNRSF56GZ.jpg', '2024-02-07 09:52:10', '2024-07-25 09:52:19', '20', 0, NULL, NULL, '2024-01-17 03:58:33', '2024-01-17 13:46:58', NULL),
(4, 'برنامج أنظمة الطاقة الشمسية', 'برنامج أنظمة الطاقة الشمسية يقدم فهمًا عميقًا لكيفية تصميم وتنفيذ أنظمة الطاقة الشمسية المستدامة. يشمل المحتوى دروسًا نظرية وتجارب عملية لتمكين المشاركين من العمل في هذا المجال المبتكر.', '01HMB485T4BWS1Y4W30MDS23SS.jpg', '2024-02-15 10:12:30', '2024-06-13 10:12:46', '15', 0, NULL, NULL, '2024-01-17 04:12:57', '2024-01-17 04:12:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `result` varchar(255) DEFAULT NULL,
  `criteria_id` bigint(20) UNSIGNED NOT NULL,
  `interview_result_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `result`, `criteria_id`, `interview_result_id`, `created_at`, `updated_at`) VALUES
(1, '6', 1, 1, '2024-01-12 07:26:04', '2024-01-14 03:42:05'),
(2, '5', 2, 1, '2024-01-12 07:26:04', '2024-01-14 03:42:05'),
(3, '7', 1, 2, '2024-01-12 07:26:04', '2024-01-12 07:26:04'),
(4, '8', 2, 2, '2024-01-12 07:26:04', '2024-01-12 07:26:04'),
(5, '10', 1, 3, '2024-01-12 07:26:04', '2024-01-12 07:26:04'),
(6, '10', 2, 3, '2024-01-12 07:26:04', '2024-01-12 07:26:04'),
(7, NULL, 1, 4, '2024-01-12 14:49:43', '2024-01-12 14:49:43'),
(8, NULL, 1, 5, '2024-01-12 14:49:43', '2024-01-12 14:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `reviewers`
--

CREATE TABLE `reviewers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviewers`
--

INSERT INTO `reviewers` (`id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 12, '2024-01-14 11:37:47', '2024-01-16 04:34:16', NULL),
(2, 19, '2024-01-16 04:38:25', '2024-01-16 04:38:25', NULL),
(3, 20, '2024-01-16 04:41:21', '2024-01-16 04:41:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(255) NOT NULL,
  `is_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `reviewer_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `note`, `is_accepted`, `reviewer_id`, `application_id`, `created_at`, `updated_at`) VALUES
(1, 'تجربة ممتازة', 0, 1, 1, NULL, '2024-01-15 04:11:57'),
(2, 'ممتاز', 0, 1, 4, '2024-01-15 04:11:38', '2024-01-15 04:11:38'),
(3, 'اعتماد بلموافقة', 1, 1, 6, '2024-01-17 08:03:08', '2024-01-17 08:06:32'),
(4, 'الملفات صحيحة', 1, 1, 2, '2024-01-17 08:13:14', '2024-01-20 00:55:06'),
(5, 'جيد', 1, 1, 3, '2024-01-17 12:34:18', '2024-01-17 12:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', NULL, NULL),
(2, 'interviewer', 'web', NULL, NULL),
(3, 'reviewer', 'web', NULL, NULL),
(4, 'applicant', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'new', NULL, NULL, NULL),
(2, 'review', NULL, NULL, NULL),
(3, 'exam', NULL, NULL, NULL),
(4, 'interview', NULL, NULL, NULL),
(5, 'accept', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'احمد علي', 'ahmed@gmail.com', '2024-01-11 07:41:53', '$2y$12$JFKT9tnx4VI8fRsTfxBTpO3eAgy1KxaYTOINUKCxKu8pAayVl/.qm', 'fK7pK0rbbfCHh2Sxogv41fYuXezbXhwJLP94654FPTHXPOmVSiS1PoXusbZr', '2024-01-11 07:41:53', '2024-01-16 05:59:56'),
(2, 'سالم عمر', 'a3shater.dev@gmail.com', NULL, '$2y$12$LGpIQ4Hj2PAbNcRgg.tneOwvmadaXsa9tuOzY6zwjE65QCAaN2jci', NULL, '2024-01-11 08:01:09', '2024-01-16 06:02:01'),
(4, 'محسن سعيد', 'interviewer1@gmail.com', NULL, '$2y$12$uDRHX4ke3TJMiHh/ha8E0OBh/vS1CqBqgtxwNsBnU8A.rfDB.3.wG', NULL, '2024-01-12 03:05:44', '2024-01-12 03:05:44'),
(5, 'ماجد محمد', 'interviewer2@gmail.com', NULL, '$2y$12$6zMX4gBsv5yyZU5xPBIkfuJxC5fwoPeyqfRudTqL/12uNfBLa1p.6', NULL, '2024-01-12 03:06:15', '2024-01-12 03:06:15'),
(6, 'سالمين وحيد', 'interviewer3@gmail.com', NULL, '$2y$12$VBta7Hm8Wjb3BqHk/pjWEeIcxvP3bBPY9qjNGRQPnfQhPBbDcaUFq', NULL, '2024-01-12 05:38:36', '2024-01-12 05:38:36'),
(7, 'جمال محمد', 'interviewer4@gmail.com', NULL, '$2y$12$nIe8IeJQR4623XkNvaDdbeDxcrE2Oxr5BduqUMm.hi9lFlWMcVBl6', NULL, '2024-01-12 05:39:28', '2024-01-12 05:39:28'),
(8, 'زكريا جمال', 'a.3.shater@gmail.com', NULL, '$2y$12$s4oamsYNmNohrqSUO5Nid.Pe.IWt69CQwEm51PcdMvu4ZG21ETgPi', NULL, '2024-01-12 14:12:48', '2024-01-12 14:12:48'),
(9, 'سعيد فايز', 'applicant3@gmail.com', NULL, '$2y$12$q/LT3hIDbqRr7MJ/byyWKuJRbRuKKzVOGRXdpJrBeQLU7mSm2X2LW', NULL, '2024-01-12 14:14:50', '2024-01-12 14:14:50'),
(10, 'هيثم صبري', 'interviewer5@gmail.com', NULL, '$2y$12$xOYIO0UxC8OpqI.2WT8OAeBfy7afrYfcqNml68mksfqmtcma46ccu', NULL, '2024-01-12 14:44:06', '2024-01-12 14:44:06'),
(11, 'سعيد سالم', 'applicant4@gmail.com', NULL, '$2y$12$lqNtkVCYql1YoYCYgxamiuUTOC3TD7qMxucCxlzQs4b8zSlIvG9Dy', NULL, '2024-01-12 17:16:42', '2024-01-12 17:16:42'),
(12, 'سالم محمد', 'reviewer1@gmail.com', NULL, '$2y$12$0jdKoNDf70d6SPmWYkJTJOA6xPAgYlsblOWCkZpWBBWFR5sguTVay', NULL, '2024-01-14 11:37:47', '2024-01-16 04:33:20'),
(13, 'توفيق سعيد', 'applicant5@gmail.com', NULL, '$2y$12$ebsaBap0aLKpg/Pk/B1QDOq5ehWtodfUcBsLXwAqB8MVmPpLxCeH.', NULL, '2024-01-14 16:51:22', '2024-01-14 16:51:22'),
(14, 'سعيد جمال', 'applicant6@gmail.com', NULL, '$2y$12$hq/VIM8HMkMX2ZF23oqmMeimTrzg5PLbdrvZaqfGjvKuVM9zwR/Iy', NULL, '2024-01-15 13:39:21', '2024-01-15 13:39:21'),
(15, 'خالد صابر', 'interviewer6@gmail.com', NULL, '$2y$12$cNXk3tjpuoDTdjZVorNXEO4f/LClmMXChXCONeIwBZ.ABZ6GgdGY6', NULL, '2024-01-16 02:32:44', '2024-01-16 02:32:44'),
(16, 'مجدي خالد', 'interviewer7@outlook.com', NULL, '$2y$12$Dq.YmtJWMk0pwHABzr/GoO.BOGdUP0GYEt7PCOsJv4ebbVMX2/o5u', NULL, '2024-01-16 02:35:07', '2024-01-16 03:14:28'),
(17, 'احمد سامي', 'interviewer8@gmail.com', NULL, '$2y$12$Ky9DPsDhT46/Xk1iBC7X6eg6zPFFqzC/RKuAOyE6TcJAy7bqYCthy', NULL, '2024-01-16 03:16:24', '2024-01-16 04:27:32'),
(19, 'سالم محمد', 'reviewer2@gmail.com', NULL, '$2y$12$FE/8FtKwLJL6hL5b1V77o.qCa5za9t5ZKOqS1ig4M1XsQEEjNwyPS', NULL, '2024-01-16 04:38:25', '2024-01-16 04:38:25'),
(20, 'سالم سالمين', 'reviewer3@gmail.com', NULL, '$2y$12$B3qSgDweYZ3rnglkVn0XI.v11xEo8zd7YtaD5jxe4YpuU1eBoXzQO', NULL, '2024-01-16 04:41:21', '2024-01-16 04:41:21'),
(21, 'ياسر عمر ', 'interviewer9@gmail.com', NULL, '$2y$12$rfucCVUC69pVvLoc9Wyjw.NM5HJAin/8heIieZPEa2YNc0K4VdyfC', NULL, '2024-01-16 04:43:18', '2024-01-16 04:43:18'),
(22, 'محمد صالح', 'applicanttest@gmail.com', NULL, '$2y$12$JkEkwvtZhR.Tq5IxD44Qw.TVwfUM/lLLSFa/Y8GL6miOEgABwZr0m', NULL, '2024-01-17 04:40:14', '2024-01-17 04:40:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicants_user_id_foreign` (`user_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applications_program_id_applicant_id_unique` (`program_id`,`applicant_id`);

--
-- Indexes for table `criterias`
--
ALTER TABLE `criterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_results_application_id_foreign` (`application_id`);

--
-- Indexes for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `failed_import_rows_import_id_foreign` (`import_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imports_user_id_foreign` (`user_id`);

--
-- Indexes for table `interviewers`
--
ALTER TABLE `interviewers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interviewers_user_id_foreign` (`user_id`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interviews_application_id_foreign` (`application_id`);

--
-- Indexes for table `interview_results`
--
ALTER TABLE `interview_results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `interview_results_interviewer_id_interview_id_unique` (`interviewer_id`,`interview_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `results_criteria_id_interview_result_id_unique` (`criteria_id`,`interview_result_id`);

--
-- Indexes for table `reviewers`
--
ALTER TABLE `reviewers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewers_user_id_foreign` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_reviewer_id_application_id_unique` (`reviewer_id`,`application_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
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
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `criterias`
--
ALTER TABLE `criterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interviewers`
--
ALTER TABLE `interviewers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `interview_results`
--
ALTER TABLE `interview_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviewers`
--
ALTER TABLE `reviewers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`);

--
-- Constraints for table `failed_import_rows`
--
ALTER TABLE `failed_import_rows`
  ADD CONSTRAINT `failed_import_rows_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `imports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `imports`
--
ALTER TABLE `imports`
  ADD CONSTRAINT `imports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interviewers`
--
ALTER TABLE `interviewers`
  ADD CONSTRAINT `interviewers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `interviews`
--
ALTER TABLE `interviews`
  ADD CONSTRAINT `interviews_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviewers`
--
ALTER TABLE `reviewers`
  ADD CONSTRAINT `reviewers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
