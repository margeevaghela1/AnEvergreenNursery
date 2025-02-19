-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 02:04 PM
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
-- Database: `evergreen`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(4, 7, 'pawar', 'pawar@gmail.com', '7990761662', 'service is good!');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(3, 7, 'akash', '7990761662', 'akash@gmail.com', 'credit card', 'flat no. 21 hina flat memnagar ahmedabad gujarat india - 380052', 'Green Pea – Vatana Seeds ( 1 )', 50, '08-Mar-2024', 'completed'),
(4, 7, 'akash', '7990761662', 'akash@gmail.com', 'credit card', 'flat no. 21 hina flat memnagar ahmedabad gujarat india - 380052', 'aloe vera ( 1 )', 150, '08-Mar-2024', 'pending'),
(5, 7, 'akash', '799761662', 'akash@gmail.com', 'credit card', 'flat no. 21 hina flat memnagar ahmedabad gujarat india - 380052', 'Alocasia Macrorrhiza ( 1 )', 150, '09-Mar-2024', 'completed'),
(6, 7, 'pawar', '7990761662', 'admin01@gmail.com', 'cash on delivery', 'flat no. 21 hina flat memnagar ahmedabad gujarat india - 380052', 'Green Pea – Vatana Seeds ( 1 )', 50, '09-Mar-2024', 'pending'),
(7, 7, 'margee', '07990761662', 'margee20@gmail.com', 'cash on delivery', 'flat no. 21 paldi ahmedabad gujarat India - 380052', 'Alocasia Macrorrhiza ( 1 ), Cocopeat(1 Kg) ( 1 )', 299, '09-Mar-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(2, 'aloe vera', 'plants', 'abcdss', 150, 'aloe_vera.jpg'),
(8, 'Alocasia Macrorrhiza', 'plants', 'The Alocasia macrorrhiza plant is also known as the taro plant, and it’s one of the most popular ornamental plants in the world.Alocasia macrorrhiza, also known as Elephant Ear Plant, is a tropical plant that can grow up to six feet tall. The leaves are a deep green and resemble the leaves of an elephant’s ear. It is also a hardy plant that can grow in any type of soil and will thrive in most climates. The plant is a member of the Araceae family and is often found in the wild in areas such as In', 150, 'compressed_img_1659592506660.jpg'),
(9, 'Green Pea – Vatana Seeds', 'seeds', 'How to Sow Seeds?\r\nSTEP 1. Sow the seeds 0.5 cm deep in soil.\r\n\r\nSTEP 2. Water the seedling.\r\n\r\nSTEP 3. Put the pot in the sunshine.\r\n\r\nGermination will take place in 8-10 days.', 50, 'compressed_img_1660236184770.jpg'),
(10, 'golden Money Plant', 'plants', 'The Money Plant (Epipremnum aureum) is a versatile member of the Araceae family, meaning it belongs to the same family as the banana. This is one of the most commonly available houseplants—well, if not THE most commonly available houseplant—and it’s easy to grow! With a stunning variegated leaf and an extremely low maintenance requirement, money plants make great additions to any home or office space. It can be used as a ground cover in shady areas and makes for an excellent indoor decoration wh', 119, 'compressed_img_1659553066375.jpg'),
(11, 'Anthurium Red flower', 'flower', 'The Anthurium plant is a member of the Araceae family of plants. The Anthurium plant has lacy green leaves and flowers that come in a variety of colors. It grows in tropical regions including India, West Africa, Central America, South America and Southern Asia.There are many different varieties of the Anthurium plant including the purple-flowered type which can grow to be up to 30 inches tall or more. The Anthurium plant is a beautiful addition to any home.', 299, 'compressed_img_1659553072974.jpg'),
(12, 'Cocopeat(1 Kg)', 'fertilizer', 'aassasss', 149, 'Vermi compost Fertilizer.JPG'),
(13, 'Adenium Pink-White Double Petal', 'bonsai', 'Adenium plants can be grown from seed or cuttings. They prefer a soil that is well-drained but rich with organic matter, such as compost or mulch. You should also avoid using garden lime because it will kill the plant’s root system and make it difficult for it to survive through harsh winter seasons when temperatures drop below freezing levels.', 399, 'compressed_img_1660503958240-768x768.jpg'),
(14, 'Adenium Red Plant', 'bonsai', 'Adenium plants can be grown from seed or cuttings. They prefer a soil that is well-drained but rich with organic matter, such as compost or mulch. You should also avoid using garden lime because it will kill the plant’s root system and make it difficult for it to survive through harsh winter seasons when temperatures drop below freezing levels.', 349, 'compressed_img_1659552876768.jpg'),
(15, 'Adenium White Double Petal', 'bonsai', 'The flowers bloom from spring through early fall, which makes them a good choice for planting at home or in your yard. Adenium plants can be grown from seed or cuttings. They prefer a soil that is well-drained but rich with organic matter, such as compost or mulch. You should also avoid using garden lime because it will kill the plant’s root system and make it difficult for it to survive through harsh winter seasons when temperatures drop below freezing levels.', 299, 'compressed_img_1659551999517.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `card_number`, `expiration_date`, `cvv`, `transaction_date`) VALUES
(3, 'akash', '4558654', '10/12', '2252', '2024-03-08 19:29:53'),
(4, 'akash', '4555256852', '11/12', '122', '2024-03-08 19:47:36'),
(5, 'akash', '45666585', '10/12', '1222', '2024-03-09 07:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(1, 'Annu', 'annu@gmail.com', '1234', 'admin', 'Screenshot 2024-02-06 191007.png'),
(3, 'margee', 'margee20@gmail.com', '1234', 'user', 'IMG_20220719_232344_617.jpg'),
(7, 'pawar', 'pawar@gmail.com', '1234', 'user', 'marvels-iron-man-2023-games-marvel-comics-3840x2160-8773.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(27, 7, 2, 'aloe vera', 150, 'aloe_vera.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
