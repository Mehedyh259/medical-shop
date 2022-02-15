-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 02:57 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `picture`) VALUES
(3, 'creams', '1618331605_cream.png'),
(4, 'capsule', '1618501704_cap.png'),
(5, 'syrup', '1618331689_syrup.png'),
(6, 'tablet', '1618332533_tablet.png'),
(7, 'injection', '1618332895_injection.jpg'),
(8, 'syringe', '1618332988_syrunj.png'),
(9, 'lotion', '1618333037_lotion.png'),
(10, 'others', '1618502214_banner.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `itemGroup` varchar(50) NOT NULL,
  `itemCategory` varchar(50) NOT NULL,
  `itemCompany` varchar(50) NOT NULL,
  `itemUnit` varchar(50) NOT NULL,
  `itemQuantity` int(10) NOT NULL,
  `itemPrice` float NOT NULL,
  `itemDescription` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `itemName`, `itemGroup`, `itemCategory`, `itemCompany`, `itemUnit`, `itemQuantity`, `itemPrice`, `itemDescription`) VALUES
(2, 'ciprocin', 'ciprofloxacin', 'capsule', 'square', '500mg', 86, 16, 'this is an antibiotic'),
(3, 'fexo', 'fexofenadin', 'tablet', 'beximco', '100mg', 54, 7, 'This is for cold fever and caugh'),
(4, 'napa', 'peracitamol', 'tablet', 'square', '500mg', 95, 3, 'this is for fever');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `total_amount` float NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_name`, `total_amount`, `date`) VALUES
(5, 'Md. Mehedi Hasan', 235, '2021/11/28'),
(6, 'Shahadat Hossein', 23, '2021/11/29'),
(7, 'Roton Kumar Das', 126, '2021/12/01'),
(8, 'Rouf Rain', 213, '2021/12/02'),
(9, 'mehedy', 198, '2021/12/05');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `password`, `picture`) VALUES
(1, 'mehedyh259', 'mehedyh259@gmail.com', 'password', 'profile_user1.png');

-- --------------------------------------------------------

--
-- Table structure for table `sells_report`
--

CREATE TABLE `sells_report` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_price` float NOT NULL,
  `total` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` int(11) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sells_report`
--

INSERT INTO `sells_report` (`id`, `invoice_no`, `item_name`, `item_unit`, `item_quantity`, `item_price`, `total`, `customer_name`, `customer_phone`, `customer_address`, `date`) VALUES
(6, 5, 'ciprocin', '500mg', 7, 16, 112, 'Md. Mehedi Hasan', 1762125990, 'Durgapur, Rajshahi', '2021/11/28'),
(7, 5, 'fexo', '100mg', 12, 7, 84, 'Md. Mehedi Hasan', 1762125990, 'Durgapur, Rajshahi', '2021/11/28'),
(8, 5, 'napa', '500mg', 13, 3, 39, 'Md. Mehedi Hasan', 1762125990, 'Durgapur, Rajshahi', '2021/11/28'),
(9, 6, 'ciprocin', '500mg', 1, 16, 16, 'Shahadat Hossein', 2147483647, 'Cantonment, Rajshahi', '2021/11/29'),
(10, 6, 'fexo', '100mg', 1, 7, 7, 'Shahadat Hossein', 2147483647, 'Cantonment, Rajshahi', '2021/11/29'),
(11, 7, 'fexo', '100mg', 12, 7, 84, 'Roton Kumar Das', 1786446472, 'Rajshahi', '2021/12/01'),
(12, 7, 'napa', '500mg', 14, 3, 42, 'Roton Kumar Das', 1786446472, 'Rajshahi', '2021/12/01'),
(13, 8, 'ciprocin', '500mg', 12, 16, 192, 'Rouf Rain', 1675425362, 'Durgapur, Rajshi', '2021/12/02'),
(14, 8, 'napa', '500mg', 7, 3, 21, 'Rouf Rain', 1675425362, 'Durgapur, Rajshi', '2021/12/02'),
(15, 9, 'ciprocin', '500mg', 12, 16, 192, 'mehedy', 1762125990, 'durgapur, rajshahi', '2021/12/05'),
(16, 9, 'napa', '500mg', 2, 3, 6, 'mehedy', 1762125990, 'durgapur, rajshahi', '2021/12/05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sells_report`
--
ALTER TABLE `sells_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sells_report`
--
ALTER TABLE `sells_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
