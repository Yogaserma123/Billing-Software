-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 11:22 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `expenses_date` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `created_at`, `expenses_date`, `category`, `amount`, `description`, `reference`) VALUES
(4, '2024-06-10 06:55:51.251868', '2024-06-10', 'salary', '10000', 'none', 'none'),
(5, '2024-06-13 07:10:14.581125', '2024-06-13', 'others', '1250', 'For Transport and Bata For Labours', ''),
(6, '2024-06-18 06:18:22.297532', '2024-06-18', 'others', '500', 'petrol expenses', 'others'),
(7, '2024-06-18 06:37:00.262052', '2024-06-18', 'salary', '10000', 'others', 'others');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount_received` decimal(10,2) NOT NULL,
  `balance_amount` decimal(10,2) NOT NULL,
  `received_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `invoice_id`, `amount_received`, `balance_amount`, `received_date`, `created_at`) VALUES
(15, 4, '300000.00', '54885.00', '2024-06-07', '2024-06-17 05:58:19'),
(16, 4, '54885.00', '0.00', '2024-06-17', '2024-06-17 05:59:12'),
(17, 6, '80000.00', '8500.00', '2024-06-10', '2024-06-17 06:05:03'),
(18, 6, '8500.00', '0.00', '2024-06-17', '2024-06-17 06:05:39'),
(19, 7, '150000.00', '145000.00', '2024-06-18', '2024-06-18 06:17:39'),
(20, 8, '50000.00', '38500.00', '2024-06-18', '2024-06-18 06:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `invoice_date` date NOT NULL,
  `from_party_name` varchar(255) NOT NULL,
  `from_address` text NOT NULL,
  `from_gst` varchar(15) NOT NULL,
  `to_party_name` varchar(255) NOT NULL,
  `to_address` text NOT NULL,
  `to_gst` varchar(15) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `sgst` decimal(10,2) NOT NULL,
  `cgst` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `invoice_date`, `from_party_name`, `from_address`, `from_gst`, `to_party_name`, `to_address`, `to_gst`, `total_amount`, `sgst`, `cgst`, `grand_total`, `created_at`) VALUES
(4, '001', '2024-06-10', 'VIJAY', 'CHENNAI', '333VVV', 'PRABHAS', 'HYEDERABAD', '333PPP', '300750.00', '27067.50', '27067.50', '354885.00', '2024-06-10 06:47:52'),
(6, '002', '2024-06-08', 'SK', 'CHENNAI', '333SSS', 'NANI', 'HYDERABAD', '333NNN', '75000.00', '6750.00', '6750.00', '88500.00', '2024-06-10 07:05:15'),
(8, '56', '2024-06-18', 'Mugesh', 'tuty', '333mmm', 'vijay', 'Chennai', '1234xyz', '75000.00', '6750.00', '6750.00', '88500.00', '2024-06-18 06:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `hsn_code` varchar(50) NOT NULL,
  `gst` decimal(10,2) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `description`, `qty`, `unit`, `hsn_code`, `gst`, `unit_price`, `total_price`) VALUES
(7, 4, 'book', 5, 'nos', 'b15', '18.00', '150.00', '750.00'),
(8, 4, 'computer', 5, 'nos', 'c11', '18.00', '60000.00', '300000.00'),
(11, 6, 'mobile', 5, 'nos', 'm1', '18.00', '15000.00', '75000.00'),
(13, 8, 'bag', 50, 'nos', 'B1', '18.00', '1500.00', '75000.00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `purchase_bill_id` int(11) DEFAULT NULL,
  `description` text,
  `qty` decimal(10,2) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `hsn_code` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `purchase_bill_id`, `description`, `qty`, `unit`, `hsn_code`, `price`, `total_price`) VALUES
(15, 10, 'book', '10.00', 'nos', 'B12', '100.00', '1000.00'),
(16, 10, 'computer', '10.00', 'nos', 'c11', '50000.00', '500000.00'),
(18, 12, 'mobile', '10.00', 'nos', 'M1', '10000.00', '100000.00'),
(22, 14, 'Egg', '100.00', 'nos', 'E12', '5.00', '500.00'),
(24, 16, 'bag', '100.00', 'nos', 'B1', '1000.00', '100000.00'),
(25, 16, 'can', '100.00', 'nos', 'C1', '50.00', '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gst` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `name`, `address`, `gst`) VALUES
(3, 'Nani', 'Hyderabad', '323ABC'),
(4, 'leo', 'chennai', '222QQQ444'),
(5, 'xyz', 'tuty', '333AAA908');

-- --------------------------------------------------------

--
-- Table structure for table `party_details`
--

CREATE TABLE `party_details` (
  `id` int(11) NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gst` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party_details`
--

INSERT INTO `party_details` (`id`, `party_name`, `address`, `gst`) VALUES
(1, 'Mugesh', 'Anna Nagar', '3333zzzzz'),
(2, 'Vijay', 'Chennai', '1234xyz'),
(3, 'ysg', 'tuty', '0987');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `balance_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `amount_paid`, `balance_amount`, `payment_date`, `created_at`) VALUES
(7, 10, '500000.00', '91180.00', '2024-06-15', '2024-06-17 05:20:33'),
(8, 10, '91000.00', '180.00', '2024-06-16', '2024-06-17 05:21:02'),
(9, 10, '180.00', '0.00', '2024-06-17', '2024-06-17 05:24:05'),
(10, 16, '100000.00', '23900.00', '2024-06-18', '2024-06-18 06:28:43'),
(11, 16, '23000.00', '900.00', '2024-06-05', '2024-06-18 06:33:06'),
(12, 16, '900.00', '0.00', '2024-06-21', '2024-06-18 06:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bills`
--

CREATE TABLE `purchase_bills` (
  `id` int(11) NOT NULL,
  `purchase_bill_no` varchar(255) DEFAULT NULL,
  `supplier_invoice_no` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `party_name` varchar(255) DEFAULT NULL,
  `party_address` text,
  `party_gst` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `total_cgst` decimal(10,2) DEFAULT NULL,
  `total_sgst` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_bills`
--

INSERT INTO `purchase_bills` (`id`, `purchase_bill_no`, `supplier_invoice_no`, `purchase_date`, `party_name`, `party_address`, `party_gst`, `total_amount`, `total_cgst`, `total_sgst`, `grand_total`) VALUES
(10, '001', '001', '2024-06-10', 'ysg', 'thoothukudi', '333yyy', '501000.00', '45090.00', '45090.00', '591180.00'),
(12, '002', '002', '2024-06-08', 'mugesh', 'tuty', '333MMM', '100000.00', '9000.00', '9000.00', '118000.00'),
(14, '199', '199', '2024-06-14', 'nani', 'Hyderabad', '323ABC', '500.00', '25.00', '25.00', '550.00'),
(16, '678', '876', '2024-06-18', 'xyz', 'tuty', '333AAA908', '105000.00', '9450.00', '9450.00', '123900.00');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `purchase_bill_id` int(11) DEFAULT NULL,
  `cgst` decimal(10,2) DEFAULT NULL,
  `cgst_value` decimal(10,2) DEFAULT NULL,
  `sgst` decimal(10,2) DEFAULT NULL,
  `sgst_value` decimal(10,2) DEFAULT NULL,
  `total_value` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `purchase_bill_id`, `cgst`, `cgst_value`, `sgst`, `sgst_value`, `total_value`) VALUES
(15, 10, '9.00', '45000.00', '9.00', '45000.00', '90000.00'),
(16, 10, '9.00', '90.00', '9.00', '90.00', '180.00'),
(18, 12, '9.00', '9000.00', '9.00', '9000.00', '18000.00'),
(22, 14, '2.50', '25.00', '2.50', '25.00', '50.00'),
(24, 16, '9.00', '9000.00', '9.00', '9000.00', '18000.00'),
(25, 16, '9.00', '450.00', '9.00', '450.00', '900.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_bill_id` (`purchase_bill_id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`);

--
-- Indexes for table `party_details`
--
ALTER TABLE `party_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_bill_id` (`purchase_bill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `party_details`
--
ALTER TABLE `party_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`);

--
-- Constraints for table `taxes`
--
ALTER TABLE `taxes`
  ADD CONSTRAINT `taxes_ibfk_1` FOREIGN KEY (`purchase_bill_id`) REFERENCES `purchase_bills` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
