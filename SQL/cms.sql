-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 10:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credantials`
--

CREATE TABLE `admin_credantials` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_credantials`
--

INSERT INTO `admin_credantials` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date`, `time`, `doctor_id`, `patient_id`, `status`) VALUES
(1, '2024-06-13', '19:02:00', 7, 9, 1),
(2, '2024-06-07', '05:48:00', 7, 9, 1),
(7, '2024-06-07', '15:50:00', 7, 13, 1),
(8, '2024-06-20', '08:00:00', 7, 14, 0),
(9, '2024-06-12', '09:30:00', 7, 16, 1),
(10, '2024-06-09', '23:11:00', 7, 9, 1),
(11, '2024-06-24', '22:12:00', 8, 9, 0),
(12, '2024-06-21', '17:30:00', 7, 9, 0),
(13, '2024-06-21', '17:00:00', 7, 9, 0),
(14, '2024-06-23', '17:52:00', 7, 9, 0),
(15, '2024-06-22', '20:00:00', 7, 9, 0),
(16, '2024-06-24', '20:00:00', 7, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `doc_fees` int(20) NOT NULL,
  `medicine` int(20) NOT NULL,
  `lab_test` int(20) NOT NULL,
  `total` int(50) NOT NULL,
  `patient_id` bigint(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `doc_fees`, `medicine`, `lab_test`, `total`, `patient_id`, `date`, `status`) VALUES
(2, 1200, 400, 300, 1900, 9, '2024-06-15', 0),
(3, 2000, 500, 700, 3200, 13, '2024-06-15', 1),
(4, 1500, 500, 1000, 3000, 14, '2024-06-15', 0),
(5, 1500, 500, 700, 2700, 16, '2024-06-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `posted_by` bigint(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `title`, `image`, `body`, `posted_by`, `date`) VALUES
(5, 'The Link Between Emotions and Heart Health', 'IMG_35943.jpeg', 'The connection between emotions and heart health is profound, with stress, anxiety, and depression significantly impacting cardiovascular well-being. Chronic stress increases heart rate and blood pressure, leading to hypertension and heart disease, while anxiety contributes to higher resting heart rates and atherosclerosis risk. Depression is linked with poorer heart health outcomes, promoting unhealthy behaviors and increased inflammation. Conversely, positive emotions like happiness.', 7, '2024-06-20 17:52:10'),
(6, 'Heart-Healthy Habits: Small Changes, Big Impact', 'IMG_73416.jpg', 'Taking steps towards a heart-healthy lifestyle doesn\'t always require drastic measures. By making small changes to daily habits, one can significantly impact heart health. Simple adjustments such as opting for whole grains over refined carbs, incorporating more fruits and vegetables into meals, and choosing lean proteins can lower cholesterol levels and reduce the risk of heart disease. Regular physical activity, even in modest amounts, strengthens the heart and improves circulation. Additionall', 7, '2024-06-21 14:21:49'),
(7, 'The Journey to a Stress-Free Dental Experience', 'IMG_80849.jpg', 'Embarking on a stress-free dental experience begins with open communication and trust between patient and dentist. Establishing a comfortable rapport allows for addressing concerns and understanding procedures, minimizing anxiety. Choosing a dental office that prioritizes patient comfort through amenities like soothing music or calming decor further eases apprehensions. Utilizing relaxation techniques such as deep breathing or visualization during treatments helps manage stress levels. Educating', 7, '2024-06-21 14:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(13, 'IMG_62844.jpg'),
(14, 'IMG_39029.webp'),
(15, 'IMG_43905.png'),
(16, 'IMG_98175.jpg'),
(17, 'IMG_22788.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `blog_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `timedate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `blog_id`, `user_id`, `comment`, `timedate`) VALUES
(1, 5, 9, 'Very informative post', '2024-06-25 09:59:28'),
(2, 5, 9, 'Nice , I,ll follow your instructions. Thank you so much for posting.', '2024-06-25 10:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gmap` varchar(150) NOT NULL,
  `pn1` bigint(50) NOT NULL,
  `pn2` bigint(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(50) NOT NULL,
  `insta` varchar(50) NOT NULL,
  `tw` varchar(50) NOT NULL,
  `iframe` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'ABC, Wijhianwala, Vehari, Punjab', 'https://maps.app.goo.gl/5PttkX9zhRbpNbGH6', 923046902667, 923430396715, 'huzaifa6715@gmail.com', 'https://facebook.com', 'https://www.instagram.com', 'https://twitter.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3449.0140999007203!2d72.215375!3d30.1795912!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393cbb2e69a50ca1:0x64ca44c4e9ded3ab!2sAdda wijhainwala!5e0!3m2!1sen!2s!4v1715407165046!5m2!1sen!2s');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `Specialization` varchar(100) NOT NULL,
  `pn` bigint(20) NOT NULL,
  `date_of_join` date NOT NULL DEFAULT current_timestamp(),
  `address` varchar(250) NOT NULL,
  `fees` int(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `email`, `image`, `Specialization`, `pn`, `date_of_join`, `address`, `fees`, `password`, `status`) VALUES
(7, 'Mujahid Husain', 'mujahid8915@gmail.com', 'IMG_58105.png', 'Surgeon', 923000111589, '2024-05-02', 'Khanewal ,Punjab,Pakistan', 2000, '$2y$10$tM/BBqlXW7iNsKwW9OjqEOuS8MdiJx2GBHiglBhhMufPR.in4mDZS', 0),
(8, 'Hassan Qayyum', 'hassan@gmail.com', 'IMG_67231.png', 'Surgeon', 923464812370, '2024-05-03', 'Khanewal ,Punjab,Pakistan', 1500, '$2y$10$RHUg0qBSFudes/HS3tboOewlkdytywM6gqOjTqqXdVgvTyNPnR5cW', 1),
(10, 'Afzal Azad', 'afzal@gmail.com', 'IMG_64718.png', 'Cardiologist', 923244870778, '2024-06-21', 'Khanewal ,Punjab,Pakistan', 2500, '$2y$10$0lxdSSoEAvHho.0Or.Ehf.2.vd8R2YlXvT00ou7ze7EkiSkmGKmZW', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_patients`
--

CREATE TABLE `doctor_patients` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_patients`
--

INSERT INTO `doctor_patients` (`id`, `doctor_id`, `patient_id`) VALUES
(1, 7, 9),
(2, 8, 10),
(3, 7, 12),
(4, 7, 13),
(5, 7, 13),
(6, 7, 14),
(7, 7, 14),
(8, 7, 9),
(9, 7, 13),
(10, 7, 14),
(11, 7, 16),
(12, 7, 9),
(13, 7, 14);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(15, 'IMG_21698.svg', 'General Practitioners', 'General Practitioners diagnose and treat various health conditions, offering primary care and preventive medical services.'),
(16, 'IMG_35770.svg', 'Pregnancy Support', 'Pregnancy Support provides comprehensive prenatal, perinatal, and postnatal care, ensuring the health of mother and baby.'),
(17, 'IMG_19898.svg', 'Pharmaceutical Care', 'Pharmaceutical Care involves medication management, patient education, and optimizing drug therapy to achieve desired health outcomes.');

-- --------------------------------------------------------

--
-- Table structure for table `generals`
--

CREATE TABLE `generals` (
  `id` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `about_us` varchar(500) NOT NULL,
  `shutdown` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generals`
--

INSERT INTO `generals` (`id`, `site_title`, `about_us`, `shutdown`) VALUES
(1, 'Harmony Health Center', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `expiration_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `item_name`, `description`, `quantity`, `category`, `expiration_data`) VALUES
(1, 'Gloves', '(latex, nitrile, sterile)', 200, 'Medical Consumables', '2024-06-30'),
(2, 'Masks', '(surgical, N95)', 350, 'Medical Consumables', '2024-07-16'),
(4, 'Gauze pads and rolls', 'Wound dressing material.', 239, 'Medical Consumables', '2024-07-31'),
(5, 'Bandages', 'Various sizes for wounds', 145, 'Medical Consumables', '2024-10-31'),
(6, 'Syringes and needles', 'Delivery of medications', 500, 'Medical Consumables', '2024-07-16'),
(7, 'Blood pressure monitors', 'Vital sign assessment.', 5, 'Diagnostic Equipment', '0000-00-00'),
(8, 'Thermometers', 'Temperature measurement.', 50, 'Diagnostic Equipment', '2024-07-30'),
(9, 'Stethoscopes', 'Auscultation of heart sounds.', 12, 'Diagnostic Equipment', '0000-00-00'),
(10, 'Pulse oximeters', 'Oxygen saturation check.', 5, 'Diagnostic Equipment', '0000-00-00'),
(11, 'Glucometers', 'Blood sugar monitoring.', 4, 'Diagnostic Equipment', '0000-00-00'),
(12, 'Basic medications', 'Pain, relief and allergies.', 500, 'Medications and Vaccines', '0000-00-00'),
(13, 'Vaccines', 'Preventive healthcare.', 450, 'Medications and Vaccines', '2025-11-16'),
(14, 'Examination tables', 'Patient assessment.', 9, 'Medical Furniture', '0000-00-00'),
(15, 'Chairs', 'Patient, doctor, nurse seating.', 25, 'Medical Furniture', '0000-00-00'),
(16, 'Beds', 'Patient rest if required.', 4, 'Medical Furniture', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pn` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `email`, `pn`, `image`, `address`, `gender`, `dob`, `password`, `date`, `status`) VALUES
(9, 'Huzaifa Gulzar', 'huzaifa6715@gmail.com', 3046902667, 'IMG_75446.jpg', 'Khanewal ,Punjab,Pakistan', 'male', '2000-07-13', '$2y$10$AqQfu3.jNi/ajGwQM3Tm0OU09n20UfSsm07Bstp.jT0c1HsdEhkay', '2024-06-21', 1),
(13, 'Adnan Afzal', 'adnan@gmail.com', 3046902667, 'IMG_40982.png', 'Chak No 67/15.L vijhianwal,District khanewal,tehsil MianChannu', 'male', '2000-07-28', '$2y$10$KfLgV4s7aLV2/zfjFbulxOWZEVQHNfKGFXEIk5wUNRJGQ0aN14QDe', '2024-06-24', 1),
(14, 'Fatima Sheikh', 'fsheikh@gmail.com', 3454512345, 'IMG_48859.jpg', 'Khanewal ,Punjab,Pakistan', 'female', '2003-02-24', '$2y$10$9wRGo98.Esby4EurgZQdF.MDxvYEu5Osf0ubUO4zI/Erox4DigW2y', '2024-06-07', 1),
(15, 'Huma Noor', 'huma123@gmail.com', 3441212345, 'IMG_29527.jpg', 'Khanewal ,Punjab,Pakistan', 'female', '2000-07-13', '$2y$10$roeG/zm2dSNZdEBrv/jd9OPxW9GDbyoWI3KRJE8DE2uRK9jpj.VPO', '2024-06-24', 0),
(16, 'Ahmed Khan', 'ahmed.khan@example.com', 3011234567, 'IMG_66487.jpg', 'Khanewal ,Punjab,Pakistan', 'male', '2000-06-16', '$2y$10$sfdRxnko3oJ5GaZoz.y6g.r22erYfSaoBA9StXLAYfTlYcHyrT7E.', '2024-06-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `ratings_id` int(11) NOT NULL,
  `review` varchar(300) NOT NULL,
  `stars` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `patient_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `bp` float NOT NULL,
  `b_sugar` float NOT NULL,
  `temp` float NOT NULL,
  `pulse` float NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `chief_complaint` varchar(300) NOT NULL,
  `medical_prescription` varchar(300) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `bp`, `b_sugar`, `temp`, `pulse`, `height`, `weight`, `chief_complaint`, `medical_prescription`, `date`, `doctor_id`, `patient_id`) VALUES
(2, 123, 101, 97, 43, 5, 56, 'abcd', 'xyz', '2024-06-11', 7, 14),
(3, 130.2, 146, 97.56, 68.9, 5.4, 56, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum, ratione.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum, ratione.', '2024-06-11', 7, 14),
(4, 123.22, 78.64, 90.22, 67.98, 6, 69.5, 'Severe headache and dizziness.\nPersistent cough and chest congestion.\nSwelling and redness in the ankle.\nDifficulty breathing and wheezing.\nAbdominal pain and nausea after meals.', 'Take 500mg of ibuprofen every 6 hours for pain relief.\nApply antibiotic ointment to the affected area twice a day.\nTake 10mg of loratadine once daily for allergy symptoms.\nUse eye drops every 4 hours to relieve dry eyes.\n', '2024-06-11', 7, 9),
(5, 123.23, 123.45, 87.44, 66.78, 5.8, 59, 'Severe headache and dizziness.\r\nPersistent cough and chest congestion.\r\nSwelling and redness in the ankle.\r\nDifficulty breathing and wheezing.\r\nAbdominal pain and nausea after meals.', 'Take 500mg of ibuprofen every 6 hours for pain relief.\r\nApply antibiotic ointment to the affected area twice a day.\r\nTake 10mg of loratadine once daily for allergy symptoms.\r\nUse eye drops every 4 hours to relieve dry eyes.', '2024-06-12', 7, 13);

-- --------------------------------------------------------

--
-- Table structure for table `report_symptoms`
--

CREATE TABLE `report_symptoms` (
  `id` int(11) NOT NULL,
  `report_id` bigint(20) NOT NULL,
  `symptom_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_symptoms`
--

INSERT INTO `report_symptoms` (`id`, `report_id`, `symptom_id`) VALUES
(4, 2, 3),
(5, 2, 4),
(6, 2, 10),
(7, 3, 1),
(8, 3, 4),
(9, 3, 10),
(10, 4, 1),
(11, 4, 6),
(12, 4, 8),
(13, 5, 1),
(14, 5, 2),
(15, 5, 6),
(16, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `day` varchar(150) NOT NULL,
  `open` time NOT NULL,
  `close` time NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `day`, `open`, `close`, `status`) VALUES
(1, 'Monday_Thursday', '09:30:00', '18:30:00', 0),
(2, 'Friday', '00:00:00', '00:00:00', 1),
(3, 'Satureday_Sunday', '09:30:00', '14:30:00', 0),
(4, 'Personal_Meeting', '19:00:00', '21:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `pn` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `fb` varchar(150) NOT NULL,
  `insta` varchar(150) NOT NULL,
  `tw` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `image`, `role`, `pn`, `description`, `fb`, `insta`, `tw`, `address`) VALUES
(16, 'Dr Hassan Qayyum', 'IMG_52344.png', 'Pharmacist', 923464812370, 'A very Talented and Graduated Pharmacists with 5 years of experience.', 'https://web.facebook.com/profile.php?id=61550130473251', 'https://www.instagram.com/imhuzaifa.gulzar/', 'https://twitter.com/HuzaifaGul61378', 'Khanewal ,Punjab,Pakistan'),
(17, 'Saima Khan', 'IMG_31166.jpg', 'Nurse', 9231234567, 'Saima specializes in billing procedures, ensuring accurate and timely processing of financial matters for patients and the clinic.', 'https://web.facebook.com/profile.php?id=61550130473251', 'https://www.instagram.com/imhuzaifa.gulzar/', 'https://twitter.com/HuzaifaGul61378', 'Khanewal ,Punjab,Pakistan'),
(18, 'Dr. Aneela Mahmood', 'IMG_19436.jpg', 'Dispenser', 923456785411, 'Dr. Mahmood is our dedicated Dispenser, committed to optimizing medication therapy for each patient.', 'https://web.facebook.com/profile.php?id=61550130473251', 'https://www.instagram.com/imhuzaifa.gulzar/', 'https://twitter.com/HuzaifaGul61378', 'Khanewal ,Punjab,Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL,
  `symptom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `symptom`) VALUES
(1, 'Fever'),
(2, 'Headache'),
(3, 'Abdominal pain'),
(4, 'Chest pain'),
(5, 'Shortness of breath'),
(6, 'Cough'),
(7, 'Sore throat'),
(8, 'Muscle pain'),
(9, 'Joint pain'),
(10, 'Skin rash');

-- --------------------------------------------------------

--
-- Table structure for table `test_report`
--

CREATE TABLE `test_report` (
  `id` int(11) NOT NULL,
  `ex_type` varchar(50) NOT NULL,
  `probe` double NOT NULL,
  `reason` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `findings` varchar(255) NOT NULL,
  `recommendations` varchar(255) NOT NULL,
  `patient_id` bigint(20) NOT NULL,
  `doctor_id` bigint(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_report`
--

INSERT INTO `test_report` (`id`, `ex_type`, `probe`, `reason`, `image`, `findings`, `recommendations`, `patient_id`, `doctor_id`, `date`) VALUES
(1, 'Pelvic', 2.3, 'Patient presented with abdominal pain and bloating.', 'IMG_14306.jpg', 'The examination revealed a small gallstone in the gallbladder and mild hepatic steatosis.', 'Advise the patient to follow up with their primary care physician for further evaluation and management of the gallstone. Recommend lifestyle modifications to address hepatic steatosis, including dietary changes and regular exercise.', 9, 7, '2024-06-14'),
(2, 'Pelvic', 6.3, 'Patient presented with pelvic pain and irregular menstrual cycles.', 'IMG_85980.jpg', 'The examination revealed a small ovarian cyst on the right ovary measuring 2 cm in diameter. The endometrial lining appeared thickened, suggestive of endometrial hyperplasia.', 'Recommend follow-up imaging to monitor the ovarian cyst. Advise endometrial biopsy to evaluate the thickened endometrial lining for possible hyperplasia or malignancy.', 14, 7, '2024-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(17, 'Huzaifa Gulzar', 'huzaifa6715@gmail.com', 'In How many days I will get my report', 'In How many days I will get my reportIn How many days I will get my reportIn How many days I will get my reportIn How many days I will get my reportIn How many days I will get my reportIn How many days I will get my report', '2024-05-30', 1),
(18, 'Huzaifa Gulzar', 'huzaifa6715@gmail.com', 'when appointments will open', 'when appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will open', '2024-05-30', 0),
(19, 'Huzaifa Gulzar', 'huzaifa6715@gmail.com', 'when appointments will open', 'when appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will open', '2024-05-30', 0),
(20, 'Huzaifa Gulzar', 'huzaifa6715@gmail.com', 'when appointments will open', 'when appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will openwhen appointments will open', '2024-05-30', 0),
(21, 'Huzaifa Gulzar', 'hassab6715@gmail.com', 'Inquiry about Product X', 'Inquiry about Product X Inquiry about Product X Inquiry about Product X', '2024-05-30', 0),
(22, 'Huzaifa Gulzar', 'hassab6715@gmail.com', 'Inquiry about Product X', 'Inquiry about Product X Inquiry about Product X Inquiry about Product X', '2024-05-30', 1),
(25, 'Huzaifa Gulzar', 'hassab6715@gmail.com', 'Inquiry about Product X', 'Inquiry about Product X Inquiry about Product X Inquiry about Product X', '2024-05-30', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credantials`
--
ALTER TABLE `admin_credantials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_patients`
--
ALTER TABLE `doctor_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generals`
--
ALTER TABLE `generals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`ratings_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `report_symptoms`
--
ALTER TABLE `report_symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_report`
--
ALTER TABLE `test_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_credantials`
--
ALTER TABLE `admin_credantials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctor_patients`
--
ALTER TABLE `doctor_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `generals`
--
ALTER TABLE `generals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `ratings_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `report_symptoms`
--
ALTER TABLE `report_symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `test_report`
--
ALTER TABLE `test_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);

--
-- Constraints for table `doctor_patients`
--
ALTER TABLE `doctor_patients`
  ADD CONSTRAINT `doctor_patients_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
