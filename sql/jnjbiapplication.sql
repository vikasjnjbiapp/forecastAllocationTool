-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2019 at 06:14 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jnjbiapplication`
--

-- --------------------------------------------------------

--
-- Table structure for table `jnj_actualsalesvalue`
--

CREATE TABLE `jnj_actualsalesvalue` (
  `id` int(7) NOT NULL,
  `customerWWID` int(7) NOT NULL,
  `countryId` int(5) NOT NULL,
  `type` varchar(11) NOT NULL,
  `busSelector` varchar(11) NOT NULL,
  `category` varchar(45) NOT NULL,
  `itemId` int(7) NOT NULL,
  `brandId` int(7) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `jan_fcast` int(11) DEFAULT NULL,
  `feb_fcast` int(11) DEFAULT NULL,
  `mar_fcast` int(11) DEFAULT NULL,
  `apr_fcast` int(11) DEFAULT NULL,
  `may_fcast` int(11) DEFAULT NULL,
  `jun_fcast` int(11) DEFAULT NULL,
  `jul_fcast` int(11) DEFAULT NULL,
  `aug_fcast` int(11) DEFAULT NULL,
  `sep_fcast` int(11) DEFAULT NULL,
  `oct_fcast` int(11) DEFAULT NULL,
  `nov_fcast` int(11) DEFAULT NULL,
  `dec_fcast` int(11) DEFAULT NULL,
  `sales` int(10) NOT NULL,
  `unitPrice` int(10) NOT NULL,
  `year` int(4) NOT NULL,
  `status` int(2) NOT NULL,
  `sapCode` int(10) NOT NULL,
  `divested` int(2) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_actualsalesvalue`
--

INSERT INTO `jnj_actualsalesvalue` (`id`, `customerWWID`, `countryId`, `type`, `busSelector`, `category`, `itemId`, `brandId`, `unit`, `jan_fcast`, `feb_fcast`, `mar_fcast`, `apr_fcast`, `may_fcast`, `jun_fcast`, `jul_fcast`, `aug_fcast`, `sep_fcast`, `oct_fcast`, `nov_fcast`, `dec_fcast`, `sales`, `unitPrice`, `year`, `status`, `sapCode`, `divested`, `createdDate`, `modifiedDate`) VALUES
(1, 54806, 5, 'Private', 'DPO', 'Hosp.', 2, 1, 'MB & RP', 0, 10, 0, 1, 14, 4, 70, 105, NULL, NULL, NULL, NULL, 0, 512, 2019, 0, 418612, 0, '0000-00-00 00:00:00', '0000-00-00'),
(2, 54806, 5, 'Private', 'DPO', 'Hosp.', 7, 4, 'MB & RP', 55, 100, 82, 100, 100, 50, 121, 190, NULL, NULL, NULL, NULL, 0, 3, 2019, 0, 418612, 0, '0000-00-00 00:00:00', '0000-00-00'),
(3, 54847, 1, 'Private', 'DPO', 'Hosp.', 85, 33, 'CNS', 3792, 3603, 3792, 1896, 379, 8532, 100, 0, NULL, NULL, NULL, NULL, 20, 190, 2019, 0, 416567, 0, '0000-00-00 00:00:00', '0000-00-00'),
(4, 54847, 1, 'MOH', 'TND', 'Ministry Of Health', 50, 19, 'CNS', 5679, 35866, 0, 35866, 17036, 313824, 200, 0, NULL, NULL, NULL, NULL, 30, 299, 2019, 0, 414738, 0, '0000-00-00 00:00:00', '0000-00-00'),
(5, 54847, 1, 'Private', 'DPO', 'Pharmacy', 85, 33, 'CNS', 1896, 3792, 948, 948, 569, 5688, 300, 0, NULL, NULL, NULL, NULL, 1050, 190, 2019, 0, 416567, 0, '0000-00-00 00:00:00', '0000-00-00'),
(6, 54847, 1, 'Private', 'DPO', 'Pharmacy', 50, 19, 'CNS', 0, 2989, 897, 1494, 14944, 897, 400, 0, NULL, NULL, NULL, NULL, 1000, 299, 2019, 0, 414738, 0, '0000-00-00 00:00:00', '0000-00-00'),
(7, 54847, 1, 'MOH', 'TND', 'Ministry Of Health', 51, 19, 'CNS', 54247, -75112, 75112, 54247, 41729, 0, 500, 0, NULL, NULL, NULL, NULL, 1500, 348, 2019, 0, 414739, 0, '0000-00-00 00:00:00', '0000-00-00'),
(8, 54847, 1, 'Private', 'DPO', 'Pharmacy', 52, 19, 'CNS', 0, -1121, 0, 374, 561, -561, 600, 0, NULL, NULL, NULL, NULL, 700, 187, 2019, 0, 414736, 0, '0000-00-00 00:00:00', '0000-00-00'),
(9, 54847, 1, 'Private', 'DPO', 'Hosp.', 52, 19, 'CNS', 934, 1869, 0, 0, 1869, 0, 700, 0, NULL, NULL, NULL, NULL, 10, 187, 2019, 0, 414736, 0, '0000-00-00 00:00:00', '0000-00-00'),
(10, 54847, 1, 'Private', 'DPO', 'Hosp.', 54, 20, 'MB & RP', 335, 1341, 335, 168, 335, 503, 800, 0, NULL, NULL, NULL, NULL, 100, 34, 2019, 0, 414921, 0, '0000-00-00 00:00:00', '0000-00-00'),
(11, 54847, 1, 'Private', 'DPO', 'Hosp.', 55, 20, 'MB & RP', 603, -603, 168, 0, 168, 168, 1000, 0, NULL, NULL, NULL, NULL, 100, 34, 2019, 0, 414922, 0, '0000-00-00 00:00:00', '0000-00-00'),
(12, 59051, 1, 'Institution', 'TND', 'Other Institution', 2, 1, 'MB & RP', 210, 0, 10, 20, 96, 79, 500, 125, NULL, NULL, NULL, NULL, 210, 563, 2019, 0, 414434, 0, '0000-00-00 00:00:00', '0000-00-00'),
(13, 59051, 1, 'Institution', 'TND', 'Other Institution', 3, 2, 'MB & RP', 17, 360, 192, 96, 200, 96, 542, 152, NULL, NULL, NULL, NULL, 360, 24, 2019, 0, 377568, 0, '0000-00-00 00:00:00', '0000-00-00'),
(14, 59051, 1, 'Institution', 'DPO', 'Other Institution', 5, 2, 'MB & RP', 800, 240, 120, 0, 168, 0, 300, 155, NULL, NULL, NULL, NULL, 800, 33, 2019, 0, 377567, 0, '0000-00-00 00:00:00', '0000-00-00'),
(15, 59051, 1, 'Institution', 'DPO', 'Other Institution', 7, 4, 'MB & RP', 900, 0, 250, 1000, 600, 4000, 690, 8000, NULL, NULL, NULL, NULL, 4000, 3, 2019, 0, 32230, 0, '0000-00-00 00:00:00', '0000-00-00'),
(16, 54817, 1, 'MOH', 'TND', 'Ministry Of Health', 2, 1, 'MB & RP', 150, 100, 70, 15360, 60, 25, 25, 12, NULL, NULL, NULL, NULL, 1000, 3, 2019, 0, 418610, 0, '0000-00-00 00:00:00', '0000-00-00'),
(17, 54817, 1, 'Institution', 'DPO', 'Other Institution', 7, 4, 'MB & RP', 100, 20, 80, 25, 60, 10, 25, 90, NULL, NULL, NULL, NULL, 0, 3, 2019, 0, 418610, 0, '0000-00-00 00:00:00', '0000-00-00'),
(18, 54824, 1, 'MOH', 'TND', 'Ministry Of Health', 51, 19, 'CNS', 0, 0, 574448, 0, 0, 0, 900, 1000, NULL, NULL, NULL, NULL, 892, 644, 2019, 0, 418657, 0, '0000-00-00 00:00:00', '0000-00-00'),
(19, 54824, 1, 'Private', 'DPO', 'Hosp.', 54, 20, 'MB & RP', 0, 0, 990, 495, 297, 495, 200, 800, NULL, NULL, NULL, NULL, 1350, 50, 2019, 0, 414907, 0, '0000-00-00 00:00:00', '0000-00-00'),
(20, 54824, 1, 'Private', 'DPO', 'Hosp.', 55, 20, 'MB & RP', 0, 0, 1089, 495, 148, 1485, 1520, 450, NULL, NULL, NULL, NULL, 300, 50, 2019, 0, 414908, 0, '0000-00-00 00:00:00', '0000-00-00'),
(21, 54806, 5, 'Private', 'DPO', 'Hosp.', 8, 5, 'MB & RP', 10, 200, 200, 100, 200, 100, 101, 101, NULL, NULL, NULL, NULL, 0, 2, 2019, 0, 418606, 0, '0000-00-00 00:00:00', '0000-00-00'),
(22, 54806, 5, 'Private', 'DPO', 'Hosp.', 9, 6, 'MB & RP', 100, 50, 50, 50, 100, 50, 60, 60, NULL, NULL, NULL, NULL, 0, 3, 2019, 0, 418611, 0, '0000-00-00 00:00:00', '0000-00-00'),
(23, 54817, 1, 'Private', 'DPO', 'Hosp.', 8, 5, 'MB & RP', 5, 3, 20, 20, 20, 60, 15, 15, NULL, NULL, NULL, NULL, 0, 2, 2019, 0, 418606, 0, '0000-00-00 00:00:00', '0000-00-00'),
(24, 54817, 1, 'Private', 'DPO', 'Hosp.', 9, 6, 'MB & RP', 315, 100, 400, 300, 110, 111, 118, 50, NULL, NULL, NULL, NULL, 0, 3, 2019, 0, 418611, 0, '0000-00-00 00:00:00', '0000-00-00'),
(25, 54824, 2, 'Private', 'DPO', 'Hosp.', 60, 22, 'MB & RP', 430, 100, 100, 100, 125, 100, 100, 400, NULL, NULL, NULL, NULL, 320, 3, 2019, 0, 418515, 0, '0000-00-00 00:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `jnj_brand`
--

CREATE TABLE `jnj_brand` (
  `id` int(5) NOT NULL,
  `brandName` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_brand`
--

INSERT INTO `jnj_brand` (`id`, `brandName`) VALUES
(1, 'Apalutamide'),
(2, 'Caelyx'),
(3, 'Concerta'),
(4, 'Dak.O.Gel'),
(5, 'Daktacort'),
(6, 'Daktarin'),
(7, 'Darzalex'),
(8, 'Durogesic'),
(9, 'Eprex'),
(10, 'Evra'),
(11, 'Fentanyl'),
(12, 'Guselkumab'),
(13, 'Gyno Pevaryl'),
(14, 'Gyno.Daktarin'),
(15, 'Haldol'),
(16, 'Imbruvica'),
(17, 'Intelence'),
(18, 'Invega'),
(19, 'Invega Sustenna'),
(20, 'Invokana'),
(21, 'Jurnista'),
(22, 'Leustatin'),
(23, 'Motilium'),
(24, 'Nizoral'),
(25, 'Pariet'),
(26, 'Pevaryl'),
(27, 'Pevisone'),
(28, 'Prezista'),
(29, 'Remicade'),
(30, 'Resolor'),
(31, 'Rezolsta'),
(32, 'Risperdal Oral'),
(33, 'Risperdal Consta'),
(34, 'Simponi'),
(35, 'Sporanox'),
(36, 'Stelara'),
(37, 'Stugeron'),
(38, 'Sufenta'),
(39, 'Symtuza'),
(40, 'Topamax Oral'),
(41, 'Trevicta'),
(42, 'Velcade'),
(43, 'Vermox'),
(44, 'Yondelis'),
(45, 'Zytiga');

-- --------------------------------------------------------

--
-- Table structure for table `jnj_country`
--

CREATE TABLE `jnj_country` (
  `id` int(4) NOT NULL,
  `countryName` varchar(25) NOT NULL,
  `countryCode` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_country`
--

INSERT INTO `jnj_country` (`id`, `countryName`, `countryCode`) VALUES
(1, 'Saudi Arabia', 'SA'),
(2, 'Kuwait', 'KW'),
(3, 'Bahrain', 'BH'),
(4, 'Qatar', 'QA'),
(5, 'United Arab Emirates', 'UAE'),
(6, 'Oman', 'OM');

-- --------------------------------------------------------

--
-- Table structure for table `jnj_customer`
--

CREATE TABLE `jnj_customer` (
  `id` int(4) NOT NULL,
  `customerWWID` int(6) NOT NULL,
  `customerName` varchar(60) NOT NULL,
  `countryCode` varchar(6) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_customer`
--

INSERT INTO `jnj_customer` (`id`, `customerWWID`, `customerName`, `countryCode`, `status`) VALUES
(1, 54806, 'CITY PHARMACY CO.', 'AE', 1),
(2, 54808, 'MODERN PHARMACEUTICAL CO.', 'AE', 1),
(3, 54817, 'WAEL PHARMACY CO. LLC', 'BH', 1),
(4, 54819, 'AL HAMER TRADING EST.', 'BH', 1),
(5, 54824, 'AL MOJIL DRUG CO', 'KW', 1),
(6, 54825, 'WARBA MEDICAL SUPPLIES CO.', 'KW', 1),
(7, 54827, 'WALEED PHARMACY', 'OM', 1),
(8, 54829, 'MUSCAT PHARMACY', 'OM', 1),
(9, 54831, 'Ebn Sina Medical', 'QA', 1),
(10, 54835, 'Unipharm Trading LLC', 'QA', 1),
(11, 54843, 'Al Haya Medical Company (PVT)', 'SA', 1),
(12, 54845, 'ABDUL REHMAN AL GOSAIBI GTB', 'SA', 1),
(13, 54847, 'FAROUK MAAMOUN TAMER & CO', 'SA', 1),
(14, 59051, 'Cigalah Trading Establishment', 'SA', 1),
(15, 59630, 'ALGHANIM HEALTHCARE GENERAL TRAD. C', 'KW', 1),
(16, 41957, 'HAMAD MEDICAL CORPORATION', 'QA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jnj_dataentry`
--

CREATE TABLE `jnj_dataentry` (
  `id` int(4) NOT NULL,
  `customerName` int(6) NOT NULL,
  `countryId` varchar(5) NOT NULL,
  `type` varchar(30) NOT NULL,
  `busSelector` varchar(7) NOT NULL,
  `itemId` int(4) NOT NULL,
  `brandId` int(4) NOT NULL,
  `fcast_jan` int(4) NOT NULL,
  `fcast_feb` int(4) NOT NULL,
  `fcast_mar` int(4) NOT NULL,
  `fcast_apr` int(4) NOT NULL,
  `fcast_may` int(4) NOT NULL,
  `fcast_jun` int(4) NOT NULL,
  `fcast_jul` int(4) NOT NULL,
  `fcast_aug` int(4) NOT NULL,
  `fcast_sep` int(4) NOT NULL,
  `fcast_oct` int(4) NOT NULL,
  `fcast_nov` int(4) NOT NULL,
  `fcast_dec` int(4) NOT NULL,
  `focs_jan` int(4) NOT NULL,
  `focs_feb` int(4) NOT NULL,
  `focs_mar` int(4) NOT NULL,
  `focs_apr` int(4) NOT NULL,
  `focs_may` int(4) NOT NULL,
  `focs_jun` int(4) NOT NULL,
  `focs_jul` int(4) NOT NULL,
  `focs_aug` int(4) NOT NULL,
  `focs_sep` int(4) NOT NULL,
  `focs_oct` int(4) NOT NULL,
  `focs_nov` int(4) NOT NULL,
  `focs_dec` int(4) NOT NULL,
  `year` int(4) NOT NULL,
  `createDate` date NOT NULL,
  `ModifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jnj_downsidetable`
--

CREATE TABLE `jnj_downsidetable` (
  `id` int(11) NOT NULL,
  `customerWWID` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `downSideValue` int(11) NOT NULL,
  `monthValue` int(11) NOT NULL,
  `yearValue` int(11) NOT NULL,
  `status` int(4) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jnj_downsidetable`
--

INSERT INTO `jnj_downsidetable` (`id`, `customerWWID`, `itemId`, `downSideValue`, `monthValue`, `yearValue`, `status`, `createdDate`, `modifiedDate`) VALUES
(1, 54817, 2, 12, 1, 2019, 1, '2019-10-05 18:55:59', '2019-10-05'),
(2, 54817, 7, 10, 1, 2019, 1, '2019-10-05 19:07:22', '2019-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `jnj_item`
--

CREATE TABLE `jnj_item` (
  `id` int(5) NOT NULL,
  `itemName` varchar(225) NOT NULL,
  `skuCode` int(10) NOT NULL,
  `countryId` int(4) NOT NULL,
  `brandId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_item`
--

INSERT INTO `jnj_item` (`id`, `itemName`, `skuCode`, `countryId`, `brandId`) VALUES
(1, 'Apalutamide', 0, 1, 1),
(2, 'Caelyx 20 mg', 0, 1, 2),
(3, 'Concerta 18 mg 30 Tab', 0, 1, 3),
(4, 'Concerta 27 mg 30 Tab', 0, 1, 3),
(5, 'Concerta 36 mg 30 Tab', 0, 1, 3),
(6, 'Concerta 54 mg 30 Tab', 0, 1, 3),
(7, 'Dak.O.Gel.', 0, 1, 4),
(8, 'Daktacort Cr.', 0, 1, 5),
(9, 'Daktarin Cr.', 0, 1, 6),
(10, 'Daktarin Cr. 15 mg.', 0, 1, 6),
(11, 'Daktarin Powder', 0, 0, 6),
(12, 'Daktarin Tincture', 0, 0, 6),
(13, 'Darzalex 100 mg.', 0, 0, 7),
(14, 'Darzalex 400 mg.', 0, 0, 7),
(15, 'Durogesic 100 mcg', 0, 0, 8),
(16, 'Durogesic 12 mcg', 0, 0, 8),
(17, 'Durogesic 25 mcg', 0, 0, 8),
(18, 'Durogesic 50 mcg', 0, 0, 8),
(19, 'Durogesic 75 mcg', 0, 0, 8),
(20, 'Eprex 1000 IU', 0, 0, 9),
(21, 'Eprex 10000 IU', 0, 0, 9),
(22, 'Eprex 2000 IU', 0, 0, 9),
(23, 'Eprex 3000 IU', 0, 0, 9),
(24, 'Eprex 4000 IU', 0, 0, 9),
(25, 'Eprex 40000 IU', 0, 0, 9),
(26, 'Evra', 0, 0, 10),
(27, 'Fentanyl 0.05 ml 50 * 10 ml Amp.', 0, 0, 11),
(28, 'Fentanyl 0.05 ml 50 * 2 ml Amp.', 0, 0, 11),
(29, 'Guselkumab', 0, 0, 12),
(30, 'Gyno Pevaryl Cr.', 0, 0, 13),
(31, 'Gyno Pevaryl Dep Ov.', 0, 0, 13),
(32, 'Gyno Pevaryl Supp.', 0, 0, 13),
(33, 'Gyno. Dak. Cr.', 0, 0, 14),
(34, 'Gyno. Dak. Ov. 1200 mg.', 0, 0, 14),
(35, 'Gyno. Dak. Ov. 200 mg.', 0, 0, 14),
(36, 'Gyno. Dak. Ov. 400 mg.', 0, 0, 14),
(37, 'Haldol 10 mg 20 Tab.', 0, 0, 15),
(38, 'Haldol 5 mg. / 5 Amp.', 0, 0, 15),
(39, 'Haldol 5 mg. 1000 Tab.', 0, 0, 15),
(40, 'Haldol 5 mg. 25 Tab.', 0, 0, 15),
(41, 'Haldol Decanoace 100 mg. 1 Amp.', 0, 0, 15),
(42, 'Haldol Decanoace 50 mg.1 Amp.', 0, 0, 15),
(43, 'Haldol Decanoace 50 mg.5 Amp.', 0, 0, 15),
(44, 'Haldol Oral Drops 2 mg/ml,30 ml', 0, 0, 15),
(45, 'Imbruvica', 0, 0, 16),
(46, 'Intelence 100 mg.', 0, 0, 17),
(47, 'Invega 3 mg.', 0, 0, 18),
(48, 'Invega 6 mg.', 0, 0, 18),
(49, 'Invega 9 mg.', 0, 0, 18),
(50, 'Invega Sustenna 100 mg', 0, 0, 19),
(51, 'Invega Sustenna 150 mg', 0, 0, 19),
(52, 'Invega Sustenna 50 mg', 0, 0, 19),
(53, 'Invega Sustenna 75 mg', 0, 0, 19),
(54, 'Invokana 100 mg 30 Tab', 0, 0, 20),
(55, 'Invokana 300 mg 30 Tab', 0, 0, 20),
(56, 'Jurnista 16 mg', 0, 0, 21),
(57, 'Jurnista 32 mg', 0, 0, 21),
(58, 'Jurnista 8 mg', 0, 0, 21),
(59, 'Leustatin', 0, 0, 22),
(60, 'Motilium Susp.', 0, 0, 23),
(61, 'Motilium Susp. 100 ml', 0, 0, 23),
(62, 'Motilium Tab.', 0, 0, 23),
(63, 'Motilium Tab. 100''s', 0, 0, 23),
(64, 'Nizoral Cr.', 0, 0, 24),
(65, 'Pariet 20 mg.', 0, 0, 25),
(66, 'Pariet 20 mg. 28''S', 0, 0, 25),
(67, 'Pevaryl Cr.', 0, 0, 26),
(68, 'Pevisone Cr.', 0, 0, 27),
(69, 'Prezista 400 mg.', 0, 0, 28),
(70, 'Prezista 600 mg.', 0, 0, 28),
(71, 'Remicade', 0, 0, 29),
(72, 'Resolor 1 mg tab 28''s', 0, 0, 30),
(73, 'Resolor 2 mg tab 28''s', 0, 0, 30),
(74, 'Rezolsta', 0, 0, 30),
(75, 'Risperdal 1 mg.', 0, 0, 31),
(76, 'Risperdal 1 mg. 20 Tab', 0, 0, 31),
(77, 'Risperdal 1mg/ml ?Soul. Oral 100 ml', 0, 0, 31),
(78, 'Risperdal 2 mg.', 0, 0, 31),
(79, 'Risperdal 2 mg. 20 Tab.', 0, 0, 31),
(80, 'Risperdal 3 mg. 20 Tab.', 0, 0, 31),
(81, 'Risperdal 4 mg.', 0, 0, 31),
(82, 'Risperdal 4 mg. 20 Tab', 0, 0, 31),
(83, 'Risperdal Consta 25 mg.', 0, 0, 31),
(84, 'Risperdal Consta 37.5 mg.', 0, 0, 31),
(85, 'Risperdal Consta 50 mg.', 0, 0, 31),
(86, 'Simponi', 0, 0, 32),
(87, 'Simponi 100 mg', 0, 0, 32),
(88, 'Sporanox 1% 150ML. Oral Sol.', 0, 0, 33),
(89, 'Sporanox 15 Cap.', 0, 0, 33),
(90, 'Sporanox 4 Cap.', 0, 0, 33),
(91, 'Sporanox Inj', 0, 0, 33),
(92, 'Stelara 130 mg.', 0, 0, 34),
(93, 'Stelara 45 mg.', 0, 0, 34),
(94, 'Stelara 90 mg.', 0, 0, 34),
(95, 'Stugeron 25 mg', 0, 0, 35),
(96, 'Sufenta 50 mg./ 1ml. 5 ml', 0, 0, 36),
(97, 'Symtuza', 0, 0, 37),
(98, 'Topamax 100 mg 60Tab.', 0, 0, 38),
(99, 'Topamax 15 mg Sprinkle', 0, 0, 38),
(100, 'Topamax 200 mg 60Tab.', 0, 0, 38),
(101, 'Topamax 25 mg 60 Tab.', 0, 0, 38),
(102, 'Topamax 50 mg Sprinkle', 0, 0, 38),
(103, 'Topamax 50 mg Tab.', 0, 0, 38),
(104, 'Trevicta 175 mg.', 0, 0, 39),
(105, 'Trevicta 263 mg.', 0, 0, 39),
(106, 'Trevicta 350 mg.', 0, 0, 39),
(107, 'Trevicta 525 mg.', 0, 0, 39),
(108, 'Velcade', 0, 0, 40),
(109, 'Vermox Susp.', 0, 0, 41),
(110, 'Vermox Tab.', 0, 0, 41),
(111, 'Vermox Tab.500 mg.', 0, 0, 41),
(112, 'Yondelis', 0, 0, 42),
(113, 'Zytiga', 0, 0, 43);

-- --------------------------------------------------------

--
-- Table structure for table `jnj_registration`
--

CREATE TABLE `jnj_registration` (
  `id` int(9) NOT NULL,
  `customerName` int(6) NOT NULL,
  `password` varchar(225) NOT NULL,
  `confpassword` varchar(225) NOT NULL,
  `email` varchar(60) NOT NULL,
  `userRole` int(4) DEFAULT '9',
  `assignCustomes` text NOT NULL,
  `assignItems` text NOT NULL,
  `countryName` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `userStatus` int(2) NOT NULL DEFAULT '2',
  `createDate` date NOT NULL,
  `modifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_registration`
--

INSERT INTO `jnj_registration` (`id`, `customerName`, `password`, `confpassword`, `email`, `userRole`, `assignCustomes`, `assignItems`, `countryName`, `month`, `year`, `userStatus`, `createDate`, `modifiedDate`) VALUES
(1, 1, 'YWRtaW4sMjAxOQ==', 'YWRtaW4sMjAxOQ==', 'admin@jnj.com', 0, '', '', 1, 8, 2019, 1, '2019-08-03', '2019-08-03'),
(2, 54847, 'YWJAMTIzLDIwMTk=', 'YWJAMTIzLDIwMTk=', '54847tal@jnj.com', 2, '54824', '50,51,52,54,55,85', 1, 8, 2019, 1, '2019-08-03', '2019-08-03'),
(3, 54817, 'YWJAMTIzLDIwMTk=', 'YWJAMTIzLDIwMTk=', '54808cvtl@jnj.com', 3, '', '2,7,8,9', 1, 8, 2019, 1, '2019-08-12', '2019-08-12'),
(4, 59051, 'YWJAMTIzLDIwMTk=', 'YWJAMTIzLDIwMTk=', '54817tal@jnj.com', 2, '54817', '2,3,5,7', 1, 8, 2019, 1, '2019-08-12', '2019-08-12'),
(5, 54824, 'YWJAMTIzLDIwMTk=', 'YWJAMTIzLDIwMTk=', '12345@jnj.com', 3, '', '51,54,55,60', 1, 8, 2019, 1, '2019-08-18', '2019-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `jnj_temp_cvtl_dataentry`
--

CREATE TABLE `jnj_temp_cvtl_dataentry` (
  `cvtlId` int(5) NOT NULL,
  `customerName` int(7) NOT NULL,
  `countryId` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `busSelector` varchar(5) NOT NULL,
  `itemId` int(5) NOT NULL,
  `brandId` int(5) NOT NULL,
  `jan_fcast` int(5) NOT NULL,
  `jan_fcast_Act` int(2) NOT NULL,
  `feb_fcast` int(5) NOT NULL,
  `feb_fcast_Act` int(2) NOT NULL,
  `mar_fcast` int(5) NOT NULL,
  `mar_fcast_Act` int(2) NOT NULL,
  `apr_fcast` int(5) NOT NULL,
  `apr_fcast_Act` int(2) NOT NULL,
  `may_fcast` int(5) NOT NULL,
  `may_fcast_Act` int(2) NOT NULL,
  `jun_fcast` int(5) NOT NULL,
  `jun_fcast_Act` int(2) NOT NULL,
  `jul_fcast` int(5) NOT NULL,
  `jul_fcast_Act` int(2) NOT NULL,
  `aug_fcast` int(5) NOT NULL,
  `aug_fcast_Act` int(2) NOT NULL,
  `sep_fcast` int(5) NOT NULL,
  `sep_fcast_Act` int(2) NOT NULL,
  `oct_fcast` int(5) NOT NULL,
  `oct_fcast_Act` int(2) NOT NULL,
  `nov_fcast` int(5) NOT NULL,
  `nov_fcast_Act` int(2) NOT NULL,
  `dec_fcast` int(5) NOT NULL,
  `dec_fcast_Act` int(2) NOT NULL,
  `totalSalesTarget_fcast` int(5) NOT NULL,
  `lastRollingForecast_fcast` int(5) NOT NULL,
  `totalForecast_fcast` int(5) NOT NULL,
  `varient_fcast` int(5) NOT NULL,
  `ytd_fcast` int(5) NOT NULL,
  `yearToGo_fcast` int(5) NOT NULL,
  `financialPlan_fcast` int(5) NOT NULL,
  `jan_focs` int(5) NOT NULL,
  `feb_focs` int(5) NOT NULL,
  `mar_focs` int(5) NOT NULL,
  `apr_focs` int(5) NOT NULL,
  `may_focs` int(5) NOT NULL,
  `jun_focs` int(5) NOT NULL,
  `jul_focs` int(5) NOT NULL,
  `aug_focs` int(5) NOT NULL,
  `sep_focs` int(5) NOT NULL,
  `oct_focs` int(5) NOT NULL,
  `nov_focs` int(5) NOT NULL,
  `dec_focs` int(5) NOT NULL,
  `totalSalesTarget_focs` int(5) NOT NULL,
  `lastRollingForecast_focs` int(5) NOT NULL,
  `totalForecast_focs` int(5) NOT NULL,
  `varient_focs` int(5) NOT NULL,
  `ytd_focs` int(5) NOT NULL,
  `yearToGo_focs` int(5) NOT NULL,
  `financialPlan_focs` int(5) NOT NULL,
  `year` int(4) NOT NULL,
  `createDate` date NOT NULL,
  `ModifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jnj_temp_dataentry`
--

CREATE TABLE `jnj_temp_dataentry` (
  `tempid` int(4) NOT NULL,
  `customerName` int(6) NOT NULL,
  `countryId` int(4) NOT NULL,
  `tempforecast` int(5) NOT NULL,
  `tempfocs` int(5) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `approveStatus` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jnj_temp_tal_dataentry`
--

CREATE TABLE `jnj_temp_tal_dataentry` (
  `talId` int(5) NOT NULL,
  `customerWWID` int(7) NOT NULL,
  `countryId` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `busSelector` varchar(5) NOT NULL,
  `itemId` int(5) NOT NULL,
  `brandId` int(5) NOT NULL,
  `jan_fcast` int(11) NOT NULL,
  `feb_fcast` int(11) NOT NULL,
  `mar_fcast` int(11) NOT NULL,
  `apr_fcast` int(11) NOT NULL,
  `may_fcast` int(11) NOT NULL,
  `jun_fcast` int(11) NOT NULL,
  `jul_fcast` int(11) NOT NULL,
  `aug_fcast` int(11) NOT NULL,
  `sep_fcast` int(11) NOT NULL,
  `oct_fcast` int(11) NOT NULL,
  `nov_fcast` int(11) NOT NULL,
  `dec_fcast` int(11) NOT NULL,
  `totalSalesTarget_fcast` int(11) NOT NULL,
  `lastRollingForecast_fcast` int(11) NOT NULL,
  `totalForecast_fcast` int(11) NOT NULL,
  `varient_fcast` int(11) NOT NULL,
  `ytd_fcast` int(11) NOT NULL,
  `yearToGo_fcast` int(11) NOT NULL,
  `financialPlan_fcast` int(11) NOT NULL,
  `jan_focs` int(11) NOT NULL,
  `feb_focs` int(11) NOT NULL,
  `mar_focs` int(11) NOT NULL,
  `apr_focs` int(11) NOT NULL,
  `may_focs` int(11) NOT NULL,
  `jun_focs` int(11) NOT NULL,
  `jul_focs` int(11) NOT NULL,
  `aug_focs` int(11) NOT NULL,
  `sep_focs` int(11) NOT NULL,
  `oct_focs` int(11) NOT NULL,
  `nov_focs` int(11) NOT NULL,
  `dec_focs` int(11) NOT NULL,
  `totalSalesTarget_focs` int(11) NOT NULL,
  `lastRollingForecast_focs` int(11) NOT NULL,
  `totalForecast_focs` int(11) NOT NULL,
  `varient_focs` int(11) NOT NULL,
  `ytd_focs` int(11) NOT NULL,
  `yearToGo_focs` int(11) NOT NULL,
  `financialPlan_focs` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `createDate` datetime NOT NULL,
  `ModifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jnj_totalrollingforecast`
--

CREATE TABLE `jnj_totalrollingforecast` (
  `id` int(4) NOT NULL,
  `customerWWID` int(7) NOT NULL,
  `itemId` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `rollingForecast` float NOT NULL,
  `rollingForecastFocs` float NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_totalrollingforecast`
--

INSERT INTO `jnj_totalrollingforecast` (`id`, `customerWWID`, `itemId`, `month`, `year`, `rollingForecast`, `rollingForecastFocs`, `createdDate`, `modifiedDate`) VALUES
(1, 54806, 2, 9, 2019, 204, 0, '2019-09-25 11:57:06', '2019-09-25'),
(2, 54806, 7, 9, 2019, 798, 0, '2019-09-25 11:57:06', '2019-09-25'),
(3, 54806, 8, 9, 2019, 1012, 0, '2019-09-25 11:57:06', '2019-09-25'),
(4, 54806, 9, 9, 2019, 520, 0, '2019-09-25 11:57:06', '2019-09-25'),
(5, 54817, 2, 9, 2019, 15397, 0, '2019-09-25 11:57:06', '2019-09-25'),
(6, 54817, 7, 9, 2019, 410, 0, '2019-09-25 11:57:06', '2019-09-25'),
(7, 54817, 8, 9, 2019, 158, 0, '2019-09-25 11:57:06', '2019-09-25'),
(8, 54817, 9, 9, 2019, 1504, 0, '2019-09-25 11:57:06', '2019-09-25'),
(9, 54824, 51, 9, 2019, 576348, 0, '2019-09-25 11:57:06', '2019-09-25'),
(10, 54824, 54, 9, 2019, 3277, 0, '2019-09-25 11:57:06', '2019-09-25'),
(11, 54824, 55, 9, 2019, 5187, 0, '2019-09-25 11:57:06', '2019-09-25'),
(12, 54824, 60, 9, 2019, 1455, 0, '2019-09-25 11:57:06', '2019-09-25'),
(13, 54824, 60, 9, 2019, 1455, 0, '2019-09-26 00:18:01', '2019-09-26'),
(14, 54824, 55, 9, 2019, 5187, 0, '2019-09-26 00:18:01', '2019-09-26'),
(15, 54824, 54, 9, 2019, 3277, 0, '2019-09-26 00:18:01', '2019-09-26'),
(16, 54824, 51, 9, 2019, 576348, 0, '2019-09-26 00:18:01', '2019-09-26'),
(17, 54824, 60, 9, 2019, 1455, 0, '2019-09-26 00:22:24', '2019-09-26'),
(18, 54824, 55, 9, 2019, 5187, 0, '2019-09-26 00:22:24', '2019-09-26'),
(19, 54824, 54, 9, 2019, 3277, 0, '2019-09-26 00:22:24', '2019-09-26'),
(20, 54824, 51, 9, 2019, 576348, 0, '2019-09-26 00:22:24', '2019-09-26'),
(21, 54824, 60, 9, 2019, 1455, 0, '2019-09-26 00:23:33', '2019-09-26'),
(22, 54824, 55, 9, 2019, 5187, 0, '2019-09-26 00:23:33', '2019-09-26'),
(23, 54824, 54, 9, 2019, 3277, 0, '2019-09-26 00:23:33', '2019-09-26'),
(24, 54824, 51, 9, 2019, 576348, 0, '2019-09-26 00:23:33', '2019-09-26'),
(25, 54824, 60, 9, 2019, 1455, 0, '2019-09-26 01:12:25', '2019-09-26'),
(26, 54824, 55, 9, 2019, 5187, 0, '2019-09-26 01:12:25', '2019-09-26'),
(27, 54824, 54, 9, 2019, 3277, 0, '2019-09-26 01:12:25', '2019-09-26'),
(28, 54824, 51, 9, 2019, 576348, 0, '2019-09-26 01:12:25', '2019-09-26'),
(29, 54824, 60, 9, 2019, 1455, 0, '2019-09-26 01:15:16', '2019-09-26'),
(30, 54824, 55, 9, 2019, 5187, 0, '2019-09-26 01:15:16', '2019-09-26'),
(31, 54824, 54, 9, 2019, 3277, 0, '2019-09-26 01:15:16', '2019-09-26'),
(32, 54824, 51, 9, 2019, 576348, 0, '2019-09-26 01:15:16', '2019-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `jnj_totalrollingforecast_cvt`
--

CREATE TABLE `jnj_totalrollingforecast_cvt` (
  `id` int(4) NOT NULL,
  `customerWWID` int(7) NOT NULL,
  `itemId` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `rollingForecast` float NOT NULL,
  `rollingForecastFocs` float NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_totalrollingforecast_cvt`
--

INSERT INTO `jnj_totalrollingforecast_cvt` (`id`, `customerWWID`, `itemId`, `month`, `year`, `rollingForecast`, `rollingForecastFocs`, `createdDate`, `modifiedDate`) VALUES
(1, 54847, 85, 8, 2019, 36235, 0, '2019-09-25 11:52:36', '2019-09-25'),
(2, 54847, 50, 8, 2019, 430092, 0, '2019-09-25 11:52:36', '2019-09-25'),
(3, 54847, 51, 8, 2019, 150723, 0, '2019-09-25 11:52:36', '2019-09-25'),
(4, 54847, 52, 8, 2019, 5225, 0, '2019-09-25 11:52:36', '2019-09-25'),
(5, 54847, 54, 8, 2019, 3817, 0, '2019-09-25 11:52:36', '2019-09-25'),
(6, 54847, 55, 8, 2019, 1504, 0, '2019-09-25 11:52:36', '2019-09-25'),
(7, 59051, 2, 8, 2019, 1040, 0, '2019-09-25 11:52:36', '2019-09-25'),
(8, 59051, 3, 8, 2019, 1655, 0, '2019-09-25 11:52:36', '2019-09-25'),
(9, 59051, 5, 8, 2019, 1783, 0, '2019-09-25 11:52:36', '2019-09-25'),
(10, 59051, 7, 8, 2019, 15440, 0, '2019-09-25 11:52:36', '2019-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `jnj_totalsalestarget`
--

CREATE TABLE `jnj_totalsalestarget` (
  `id` int(5) NOT NULL,
  `customerName` int(6) NOT NULL,
  `countryId` int(5) NOT NULL,
  `itemName` int(60) NOT NULL,
  `acumulatedMonth` int(3) NOT NULL,
  `year` int(4) NOT NULL,
  `ffTarget` int(10) NOT NULL,
  `createdDate` date NOT NULL,
  `modifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jnj_totalsalestarget`
--

INSERT INTO `jnj_totalsalestarget` (`id`, `customerName`, `countryId`, `itemName`, `acumulatedMonth`, `year`, `ffTarget`, `createdDate`, `modifiedDate`) VALUES
(1, 0, 0, 0, 0, 0, 0, '2019-09-25', '2019-09-25'),
(2, 54806, 5, 2, 12, 2019, 390, '2019-09-25', '2019-09-25'),
(3, 54806, 5, 7, 12, 2019, 63000, '2019-09-25', '2019-09-25'),
(4, 54806, 5, 8, 12, 2019, 165000, '2019-09-25', '2019-09-25'),
(5, 54806, 5, 9, 12, 2019, 55000, '2019-09-25', '2019-09-25'),
(6, 54847, 1, 85, 12, 2019, 46851, '2019-09-25', '2019-09-25'),
(7, 54847, 1, 50, 12, 2019, 23312, '2019-09-25', '2019-09-25'),
(8, 54847, 1, 51, 12, 2019, 22201, '2019-09-25', '2019-09-25'),
(9, 54847, 1, 52, 12, 2019, 80, '2019-09-25', '2019-09-25'),
(10, 54847, 1, 54, 12, 2019, 50100, '2019-09-25', '2019-09-25'),
(11, 54847, 1, 55, 12, 2019, 3290, '2019-09-25', '2019-09-25'),
(12, 59051, 1, 2, 12, 2019, 0, '2019-09-25', '2019-09-25'),
(13, 59051, 1, 3, 12, 2019, 27818, '2019-09-25', '2019-09-25'),
(14, 59051, 1, 5, 12, 2019, 9840, '2019-09-25', '2019-09-25'),
(15, 59051, 1, 7, 12, 2019, 304500, '2019-09-25', '2019-09-25'),
(16, 54817, 1, 2, 12, 2019, 50, '2019-09-25', '2019-09-25'),
(17, 54817, 1, 7, 12, 2019, 6100, '2019-09-25', '2019-09-25'),
(18, 54817, 1, 8, 12, 2019, 14400, '2019-09-25', '2019-09-25'),
(19, 54817, 1, 9, 12, 2019, 10200, '2019-09-25', '2019-09-25'),
(20, 54824, 1, 51, 12, 2019, 2629, '2019-09-25', '2019-09-25'),
(21, 54824, 1, 54, 12, 2019, 27000, '2019-09-25', '2019-09-25'),
(22, 54824, 1, 55, 12, 2019, 10000, '2019-09-25', '2019-09-25'),
(23, 54824, 1, 60, 12, 2019, 13500, '2019-09-25', '2019-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `jnj_upsidetable`
--

CREATE TABLE `jnj_upsidetable` (
  `id` int(11) NOT NULL,
  `customerWWID` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `upSideValue` int(11) NOT NULL,
  `monthValue` int(11) NOT NULL,
  `yearValue` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jnj_upsidetable`
--

INSERT INTO `jnj_upsidetable` (`id`, `customerWWID`, `itemId`, `upSideValue`, `monthValue`, `yearValue`, `status`, `createdDate`, `modifiedDate`) VALUES
(1, 54817, 2, 102, 1, 2019, 1, '2019-10-05 18:51:09', '2019-10-05'),
(2, 54817, 7, 225, 1, 2019, 1, '2019-10-05 19:06:10', '2019-10-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jnj_actualsalesvalue`
--
ALTER TABLE `jnj_actualsalesvalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_brand`
--
ALTER TABLE `jnj_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_country`
--
ALTER TABLE `jnj_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_customer`
--
ALTER TABLE `jnj_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_dataentry`
--
ALTER TABLE `jnj_dataentry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_downsidetable`
--
ALTER TABLE `jnj_downsidetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_item`
--
ALTER TABLE `jnj_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_registration`
--
ALTER TABLE `jnj_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_temp_cvtl_dataentry`
--
ALTER TABLE `jnj_temp_cvtl_dataentry`
  ADD PRIMARY KEY (`cvtlId`);

--
-- Indexes for table `jnj_temp_dataentry`
--
ALTER TABLE `jnj_temp_dataentry`
  ADD PRIMARY KEY (`tempid`);

--
-- Indexes for table `jnj_temp_tal_dataentry`
--
ALTER TABLE `jnj_temp_tal_dataentry`
  ADD PRIMARY KEY (`talId`);

--
-- Indexes for table `jnj_totalrollingforecast`
--
ALTER TABLE `jnj_totalrollingforecast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_totalrollingforecast_cvt`
--
ALTER TABLE `jnj_totalrollingforecast_cvt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_totalsalestarget`
--
ALTER TABLE `jnj_totalsalestarget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jnj_upsidetable`
--
ALTER TABLE `jnj_upsidetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jnj_actualsalesvalue`
--
ALTER TABLE `jnj_actualsalesvalue`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `jnj_brand`
--
ALTER TABLE `jnj_brand`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `jnj_country`
--
ALTER TABLE `jnj_country`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jnj_customer`
--
ALTER TABLE `jnj_customer`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `jnj_dataentry`
--
ALTER TABLE `jnj_dataentry`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jnj_downsidetable`
--
ALTER TABLE `jnj_downsidetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jnj_item`
--
ALTER TABLE `jnj_item`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `jnj_registration`
--
ALTER TABLE `jnj_registration`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jnj_temp_cvtl_dataentry`
--
ALTER TABLE `jnj_temp_cvtl_dataentry`
  MODIFY `cvtlId` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jnj_temp_dataentry`
--
ALTER TABLE `jnj_temp_dataentry`
  MODIFY `tempid` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jnj_temp_tal_dataentry`
--
ALTER TABLE `jnj_temp_tal_dataentry`
  MODIFY `talId` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jnj_totalrollingforecast`
--
ALTER TABLE `jnj_totalrollingforecast`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `jnj_totalrollingforecast_cvt`
--
ALTER TABLE `jnj_totalrollingforecast_cvt`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jnj_totalsalestarget`
--
ALTER TABLE `jnj_totalsalestarget`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `jnj_upsidetable`
--
ALTER TABLE `jnj_upsidetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
