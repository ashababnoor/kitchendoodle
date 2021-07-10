-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 03:02 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kitchendoodle_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `customer_id` int(10) NOT NULL,
  `street_no` int(10) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `house_no` varchar(20) DEFAULT NULL,
  `apartment_no` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  `postal_code` int(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(32) NOT NULL,
  `join_date` date NOT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `height` double DEFAULT NULL,
  `weight` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `dob`, `email`, `password`, `phone`, `join_date`, `gender`, `height`, `weight`) VALUES
(1, 'Shabab', 'Noor', '1990-01-01', 'shabab@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01xxxxxxxxx', '2021-05-01', 'male', 165, 80);

-- --------------------------------------------------------

--
-- Table structure for table `customers_health_condition`
--

CREATE TABLE `customers_health_condition` (
  `customer_id` int(10) NOT NULL,
  `disease_id` int(10) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `name`) VALUES
(6, 'High Blood Pressure'),
(8, 'Low Blood Pressure'),
(9, 'Migraine'),
(10, 'Skin Disease'),
(13, 'Allergy');

-- --------------------------------------------------------

--
-- Table structure for table `diseasewise_restricted_ingredients`
--

CREATE TABLE `diseasewise_restricted_ingredients` (
  `disease_id` int(10) NOT NULL,
  `food_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diseasewise_restricted_ingredients`
--

INSERT INTO `diseasewise_restricted_ingredients` (`disease_id`, `food_id`) VALUES
(13, 16);

-- --------------------------------------------------------

--
-- Table structure for table `drafts`
--

CREATE TABLE `drafts` (
  `customer_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `drafts_recipes`
--

CREATE TABLE `drafts_recipes` (
  `draft_id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL,
  `date` date DEFAULT NULL,
  `serving_size` int(2) DEFAULT NULL,
  `meal_time` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `salary` float NOT NULL,
  `job_title` varchar(30) NOT NULL,
  `department_id` varchar(10) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `start_date`, `end_date`, `salary`, `job_title`, `department_id`, `email`, `password`) VALUES
(1, 'Shabab', 'Noor', '2021-05-01', NULL, 10000, 'admin', '10', 'shabab@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `calories` double NOT NULL,
  `carbs` double NOT NULL,
  `fat` double NOT NULL,
  `protein` double NOT NULL,
  `measurement_unit` varchar(20) NOT NULL,
  `measurement_amount` double NOT NULL,
  `current_amount` double DEFAULT NULL,
  `current_amount_unit` varchar(30) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `calories`, `carbs`, `fat`, `protein`, `measurement_unit`, `measurement_amount`, `current_amount`, `current_amount_unit`, `price`) VALUES
(1, 'White Rice', 130, 28.8, 0.35, 2.8, 'gram', 100, 110, 'kilo-gram', 10),
(3, 'Onion - Desi', 40, 9, 0, 1, 'gram', 100, 100, 'kilo-gram', 5),
(4, 'Salt', 0, 0, 0, 0, 'gram', 10, 50, 'kilo-gram', 0.5),
(6, 'Chicken Thigh - Boneless', 164, 0, 7.7, 24, 'gram', 100, 30, 'kilo-gram', 55),
(10, 'Chicken Breast - Boneless', 165, 0, 3.6, 31, 'gram', 100, 30, 'kilo-gram', 50),
(13, 'Beef', 291, 0, 20, 26, 'gram', 100, 75, 'kilo-gram', 70),
(15, 'Flour - All Purpose', 364, 76, 1, 10.4, 'gram', 100, 120, 'kilo-gram', 5),
(16, 'Prawn - Medium', 60, 0.8, 0.9, 11, 'gram', 50, 50, 'kilo-gram', 45),
(20, 'Egg (1 Medium - 50gram)', 72, 0.4, 4.8, 6.3, 'gram', 50, 100, 'kilo-gram', 8.5),
(21, 'Sugar (1tsp. - 5gram)', 33, 8.4, 0, 0, 'gram', 10, 70, 'kilo-gram', 1),
(22, 'Apple (1 Medium - 185gram)', 96, 25.5, 0.3, 0.5, 'gram', 185, 50, 'kilo-gram', 38),
(23, 'Banana (1 Medium - 118gram)', 105, 27, 0.4, 1.3, 'gram', 118, 20, 'kilo-gram', 12),
(24, 'Mango (1 Large - 335gram)', 201, 50.2, 1.3, 2.7, 'gram', 335, 50, 'kilo-gram', 25),
(25, 'Tomato (1 Medium - 120gram)', 22, 4.7, 0.2, 1.1, 'gram', 120, 30, 'kilo-gram', 7.5),
(26, 'Soy Sauce (1tbsp. - 16gram)', 8.5, 0.8, 0.1, 1.3, 'gram', 16, 5, 'kilo-gram', 4.5),
(27, 'Milk (1 Cup - 245gram)', 125, 12, 4.7, 8.5, 'gram', 245, 20, 'kilo-gram', 17),
(28, 'Sesame Seeds', 57.6, 2.6, 5, 1.7, 'gram', 10, 3, 'kilo-gram', 5),
(29, 'Spring Onion (1 Medium - 30gram)', 9.6, 2.2, 0.1, 0.5, 'gram', 30, 10, 'kilo-gram', 5),
(30, 'Cashew Nut (1 Pc - 1.6gram)', 9, 0.5, 0.7, 0.2, 'gram', 1.6, 2, 'kilo-gram', 4.5),
(31, 'Paneer (1 cup - 122gram)', 365, 3.6, 29, 22, 'gram', 122, 10, 'kilo-gram', 60),
(32, 'Butter (1tbsp - 14g)', 102, 0, 12, 0.1, 'gram', 14, 10, 'kilo-gram', 8),
(33, 'Ginger Paste', 7, 0.9, 1.1, 0.15, 'tsp.', 1, 500, 'gram', 5),
(34, 'Garlic Paste', 27, 1.2, 2.5, 0.2, 'tsp.', 1, 2, 'kilo-gram', 5),
(35, 'Yeast (1tsp - 4gram)', 13, 1.6, 0.3, 1.6, 'gram', 4, 2, 'kilo-gram', 5),
(36, 'Mozarella', 300, 2.2, 22, 22, 'gram', 100, 5, 'kilo-gram', 80);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_attributes`
--

CREATE TABLE `ingredient_attributes` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredient_attributes`
--

INSERT INTO `ingredient_attributes` (`id`, `name`) VALUES
(1, 'Saturated Fat'),
(2, 'Trans Fat'),
(3, 'Polyunsaturated Fat'),
(4, 'Monounsaturated Fat'),
(5, 'Cholesterol'),
(6, 'Sodium'),
(7, 'Potassium'),
(8, 'Dietary Fiber'),
(9, 'Sugars'),
(10, 'Vitamin A'),
(11, 'Vitamin C'),
(12, 'Calcium'),
(13, 'Iron');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_attributes_info`
--

CREATE TABLE `ingredient_attributes_info` (
  `ingredient_id` int(10) NOT NULL,
  `attribute_id` int(10) NOT NULL,
  `amount` double DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredient_attributes_info`
--

INSERT INTO `ingredient_attributes_info` (`ingredient_id`, `attribute_id`, `amount`, `unit`) VALUES
(1, 1, 0.1, 'gram'),
(1, 3, 0.1, 'gram'),
(1, 4, 0.1, 'gram'),
(1, 5, 0, 'milligram'),
(1, 6, 1, 'milligram'),
(1, 7, 34.6, 'milligram'),
(1, 8, 0.4, 'gram'),
(1, 9, 0.1, 'gram'),
(1, 10, 0, '%'),
(1, 11, 0, '%'),
(1, 12, 0.8, '%'),
(1, 13, 6.9, '%'),
(3, 7, 10, 'milligram');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `draft_id` int(10) NOT NULL,
  `delivery_man_id` int(10) NOT NULL,
  `payment_id` int(10) NOT NULL,
  `ordering_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivery_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cost` double NOT NULL,
  `recipient_phone_no` varchar(32) NOT NULL,
  `delivery_address` varchar(1024) NOT NULL,
  `order_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `method` varchar(5) NOT NULL,
  `invoice_no` varchar(30) NOT NULL,
  `card_no` varchar(16) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `customer_id` int(10) NOT NULL,
  `preference_id` int(10) NOT NULL,
  `preferred_calorie` double DEFAULT NULL,
  `diet_type` varchar(30) DEFAULT NULL,
  `protein_amount` double DEFAULT NULL,
  `fat_amount` double DEFAULT NULL,
  `carb_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`customer_id`, `preference_id`, `preferred_calorie`, `diet_type`, `protein_amount`, `fat_amount`, `carb_amount`) VALUES
(1, 1, 2100, NULL, 19, 75, 6);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `amount` double NOT NULL,
  `unit` varchar(30) NOT NULL,
  `total_calorie` double NOT NULL,
  `yt_link` varchar(100) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `total_fat` double DEFAULT NULL,
  `total_carb` double DEFAULT NULL,
  `total_protein` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `amount`, `unit`, `total_calorie`, `yt_link`, `total_price`, `total_fat`, `total_carb`, `total_protein`) VALUES
(9, 'Simple Egg Fried Rice', '1. Beat eggs well with pinch of salt and slice green onions. Set aside.\r\n2. Heat a wok or a skillet over high heat; add 1 tbsp cooking oil and swirl to coat. Pour beaten eggs into the wok and scramble. \r\n3. When the eggs are cooked 3/4 way, add remaining 2 tbsp cooking oil and cold jasmine rice.\r\n4. A day old cold jasmine rice is my absolute favorite to make fried rice. It has beautiful aroma and fluffy texture that can hold the shape well while frying.\r\n5. Breakdown rice and mix it with the eggs. \r\n6. Add soy sauce around the edge of the wok, so it will burn slightly for the smoky umami flavor. Add salt to your taste and mix everything well. Reduce heat to low if you need to.\r\n7. Turn off the heat, stir in green onions.\r\n8. Garnish with sesame seeds if you’d like to!\r\n\r\nEnjoy with any other dishes you decided to serve with!', 200, 'gram', 306.1, 'https://www.youtube.com/embed/qH__o17xHls', 52.8, 10.16, 35.3, 19.15),
(15, 'Fruit Custard', '1. Take 2.5 cups milk in a thick bottomed pan or sauce pan and keep it on the stove top. Bring the milk to a gentle heat or simmer.\r\n2. Whilst the milk is getting heated, in a small bowl, take 3 tbsp warm milk or milk at room temperature. You can take the 3 tbsp warm milk from the milk which is getting heated up or warm 3 tbsp milk separately in a microwave oven or on the stove top. Add 1 whole egg yolk.\r\n3. With a whisk stir very well to make a smooth paste without any lumps.\r\n4. When the milk has come to a gentle heat, add 5 tbsp sugar or as required. stir very well so that the sugar dissolves.\r\n5. Keep the flame on a low and then add the custard paste in parts.\r\n6. As soon as you add the custard mixture, stir quickly so that lumps are not formed. Finish of all the custard paste this way.\r\n7. Keep on stirring often while the custard is cooking, so that lumps are not formed. Cook for about 5 to 6 minutes on a low flame.\r\n8. The mixture will thicken slowly and the raw taste of the corn starch also goes away. For a thicker custard, cook for a few more minutes. allow the custard to cool at room temperature. Also keep in mind, that as the custard cools, it will thicken more. You can also keep the custard in fridge to chill it before adding the fruits.\r\n9. Chop the fruits. Once the custard has cooled, add the mixed fruits.', 200, 'gram', 728.5, 'https://www.youtube.com/embed/cvmIdvWuztA', 117.91, 15.48, 128.78, 26.31),
(17, 'Paneer Butter Masala', '1. Soak 18 to 20 cashews in 1/3 cup hot water for 20 to 30 minutes.\r\n2. When the cashews are soaking, you can prep the other ingredients like chopping tomatoes, chopping and preparing the ginger-garlic paste, slicing paneer etc.\r\n3. Crush 1-inch ginger + 3 to 4 medium-sized garlic to a paste in a mortar pestle to a semi-fine or fine paste. Keep aside. Don’t add any water while crushing ginger & garlic.\r\n4. After 20 to 30 minutes, drain the water and add the soaked cashews in a blender or mixer-grinder. Also, add 2 to 3 tablespoons fresh water or as required.\r\n5. Blend to a smooth paste without any tiny bits or chunks of cashews. Remove the cashew paste in a bowl and set aside.\r\n6. In the same blender add 2 cups of diced or roughly chopped tomatoes. No need to blanch the tomatoes before blending.\r\n7. Blend to a smooth tomato puree. Set aside. Don’t add any water while blending the tomatoes.\r\n8. Heat a thick bottomed pan or a heavy pan. Keep the flame to a low or medium-low. Add 2 tablespoons butter OR 1 tablespoon oil + 1 or 2 tbsp butter in a pan.\r\n9. Keep the flame to a low. Add 1 medium-sized tej patta (Indian bay leaf). Fry for 2 to 3 seconds or till the oil becomes fragrant from the aroma of the tej patta.\r\n10. Add the prepared crushed ginger-garlic or 1 teaspoon ready ginger-garlic paste.\r\n11. Fry for some seconds till the raw aroma of the ginger-garlic disappears.\r\n12. Pour the prepared tomato puree. Be careful while adding the puree as it may splutter.\r\n13. Mix it very well with the butter.\r\n14. Begin to cook the tomato puree on a low to medium-low flame. Stir at intervals.\r\n15. The tomato puree mixture will start simmering.\r\n16. In case the tomato puree splutters too much while cooking then cover the pan partly with a lid or cover fully with a splatter lid (channi lid). the tomato puree might splutter if there is more water content in the tomatoes. Stir at intervals and simmer the pure for 5-6 minutes.\r\n17. Then add 1 teaspoon Kashmiri red chilli powder or deghi mirch. You can even add 1/2 teaspoon Kashmiri red chilli powder or 1/4 to 1/2 teaspoon of cayenne pepper or paprika or any other variety of red chilli powder.\r\n18. Mix well and continue to stir and saute the tomato puree.\r\n19. Sauté till the butter starts leaving the sides of the pan and the entire tomato puree mixture comes together as a whole.\r\n20. Add the cashew paste and mix it well with the puree. Saute till the cashew paste is cooked and oil will start to split. \r\n21. Add 1.5 cups of water well with the masala and break any lumps. Let the curry simmer and cool. \r\n22. After 2 to 3 mins, add ginger julienne (about 1-inch ginger – cut in julienne (thin matchstick-like strips). Reserve a few for garnishing. The curry will also begin to thicken.\r\n23. Add some green chilies, salt and sugar to taste. Don\'t add too much sugar when cream is used. \r\n24. Finally, add the paneer cubes and gently mix them and switch off the heat after a little while. \r\n\r\nServe Paneer Butter Masala hot garnished with 1 to 2 tablespoons of chopped coriander leaves (cilantro) and the remaining ginger julienne. You can also drizzle some cream or dot with butter while serving.', 150, 'gram', 670.02, 'https://www.youtube.com/embed/B3C0m8QvESQ', 145.69, 63.28, 21.28, 14.41),
(18, 'Meat Lovers Pizza', '1. For your dough: get the water to the right temperature to bloom the yeast.\r\nThe water should be between 105F and 110F. It should be warm enough to dissolve and activate the yeast, but not too hot, or it might kill it. It\'s a tricky balance and the best way to make sure you have the right temperature is to use a food thermometer. If you don\'t own one, however, you can just feel the water it shouldn\'t feel hot or cold to the touch, but should be at body temperature.\r\n\r\n2. Make sure your yeast is alive and reacting.\r\nA few minutes after you dissolve it in the water, it should start bubbling and foaming. If you don\'t see any reaction, it could mean your yeast was too old, or that the water wasn\'t the right temperature. Start again with some fresh yeast until you get a reaction.\r\n\r\n3. When it comes to kneading the dough, don\'t be lazy — and really take the time to do it.\r\nA good tip to make sure you spend enough time on this is to set a 10-minute timer on your phone and knead the dough until the alarm goes off.\r\n\r\n4. To know when you\'re done kneading, press the dough with your finger. If it springs back right away, it\'s ready.\r\n\r\n5. Coat the bowl where the dough will rise with olive oil — and coat the top of the dough, too.\r\n\r\n6. After the dough has risen, knead for another minute or two to even out the dough and release some of the air bubbles.\r\n\r\n7. Once you\'ve shaped each ball of dough, cover them with a bit of flour and a towel and let them rise for another hour.\r\n\r\n8. There are several techniques you can use to stretch the dough, but if you want to play it safe, just use your hands to gently stretch it.\r\n\r\n9. Assemble the pizza on a turned-over baking sheet sprinkled with a bit of semolina. \r\n\r\n10. Time to assemble your pizza with all the toppings you can dream of. Just make sure you act fast.\r\n\r\n11. Time to pop it into the oven! It should take about 12 to 15 minutes.\r\n\r\nServe!', 200, 'gram', 829.3, 'https://youtube.com/embed/sv3TXMSv6Lw', 121, 19.7, 114.72, 46.78),
(19, 'Test Recipe', 'Test Recipe', 200, 'gram', 238.5, 'https://www.youtube.com/embed/dQw4w9WgXcQ', 40.7, 2.22, 34.56, 18.86);

-- --------------------------------------------------------

--
-- Table structure for table `recipes_ingredients`
--

CREATE TABLE `recipes_ingredients` (
  `recipe_id` int(10) NOT NULL,
  `ingredient_id` int(10) NOT NULL,
  `amount` double NOT NULL,
  `unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes_ingredients`
--

INSERT INTO `recipes_ingredients` (`recipe_id`, `ingredient_id`, `amount`, `unit`) VALUES
(9, 1, 100, 'gram'),
(9, 3, 20, 'gram'),
(9, 6, 30, 'gram'),
(9, 20, 50, 'gram'),
(9, 26, 16, 'gram'),
(9, 28, 5, 'gram'),
(9, 29, 30, 'gram'),
(15, 20, 50, 'gram'),
(15, 21, 35, 'gram'),
(15, 22, 185, 'gram'),
(15, 23, 118, 'gram'),
(15, 24, 150, 'gram'),
(15, 27, 490, 'gram'),
(17, 25, 240, 'gram'),
(17, 30, 16, 'gram'),
(17, 31, 50, 'gram'),
(17, 32, 40, 'gram'),
(17, 33, 2, 'tsp.'),
(17, 34, 3, 'tsp.'),
(18, 10, 50, 'gram'),
(18, 15, 120, 'gram'),
(18, 21, 10, 'gram'),
(18, 25, 240, 'gram'),
(18, 34, 1, 'tsp.'),
(18, 35, 8, 'gram'),
(18, 36, 60, 'gram'),
(19, 1, 120, 'gram'),
(19, 10, 50, 'gram');

-- --------------------------------------------------------

--
-- Table structure for table `recipes_rating`
--

CREATE TABLE `recipes_rating` (
  `customer_id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL,
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `customer_id` int(10) NOT NULL,
  `recipe_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`customer_id`, `recipe_id`) VALUES
(1, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD KEY `FKaddress189340` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customers_health_condition`
--
ALTER TABLE `customers_health_condition`
  ADD PRIMARY KEY (`customer_id`,`disease_id`),
  ADD KEY `FKcustomers_617236` (`customer_id`),
  ADD KEY `FKcustomers_444951` (`disease_id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diseasewise_restricted_ingredients`
--
ALTER TABLE `diseasewise_restricted_ingredients`
  ADD PRIMARY KEY (`disease_id`,`food_id`),
  ADD KEY `FKdiseasewis654371` (`disease_id`),
  ADD KEY `FKdiseasewis856043` (`food_id`);

--
-- Indexes for table `drafts`
--
ALTER TABLE `drafts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKdrafts276814` (`customer_id`);

--
-- Indexes for table `drafts_recipes`
--
ALTER TABLE `drafts_recipes`
  ADD PRIMARY KEY (`draft_id`,`recipe_id`),
  ADD KEY `FKdrafts_rec876603` (`draft_id`),
  ADD KEY `FKdrafts_rec704702` (`recipe_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_attributes`
--
ALTER TABLE `ingredient_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_attributes_info`
--
ALTER TABLE `ingredient_attributes_info`
  ADD PRIMARY KEY (`ingredient_id`,`attribute_id`),
  ADD KEY `FKingredient166512` (`ingredient_id`),
  ADD KEY `FKingredient345941` (`attribute_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKorders954603` (`delivery_man_id`),
  ADD KEY `FKorders778187` (`draft_id`),
  ADD KEY `FKorders805987` (`payment_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`preference_id`),
  ADD KEY `FKpreference366953` (`customer_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes_ingredients`
--
ALTER TABLE `recipes_ingredients`
  ADD PRIMARY KEY (`recipe_id`,`ingredient_id`),
  ADD KEY `FKrecipes_in857892` (`recipe_id`),
  ADD KEY `FKrecipes_in328480` (`ingredient_id`);

--
-- Indexes for table `recipes_rating`
--
ALTER TABLE `recipes_rating`
  ADD PRIMARY KEY (`customer_id`,`recipe_id`),
  ADD KEY `FKrecipes_ra530385` (`customer_id`),
  ADD KEY `FKrecipes_ra567430` (`recipe_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`customer_id`,`recipe_id`),
  ADD KEY `FKwishlists598497` (`customer_id`),
  ADD KEY `FKwishlists275277` (`recipe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `drafts`
--
ALTER TABLE `drafts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `ingredient_attributes`
--
ALTER TABLE `ingredient_attributes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `preference_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FKaddress189340` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `customers_health_condition`
--
ALTER TABLE `customers_health_condition`
  ADD CONSTRAINT `FKcustomers_444951` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`),
  ADD CONSTRAINT `FKcustomers_617236` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `diseasewise_restricted_ingredients`
--
ALTER TABLE `diseasewise_restricted_ingredients`
  ADD CONSTRAINT `FKdiseasewis654371` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`),
  ADD CONSTRAINT `FKdiseasewis856043` FOREIGN KEY (`food_id`) REFERENCES `ingredients` (`id`);

--
-- Constraints for table `drafts`
--
ALTER TABLE `drafts`
  ADD CONSTRAINT `FKdrafts276814` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `drafts_recipes`
--
ALTER TABLE `drafts_recipes`
  ADD CONSTRAINT `FKdrafts_rec704702` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `FKdrafts_rec876603` FOREIGN KEY (`draft_id`) REFERENCES `drafts` (`id`);

--
-- Constraints for table `ingredient_attributes_info`
--
ALTER TABLE `ingredient_attributes_info`
  ADD CONSTRAINT `FKingredient166512` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `FKingredient345941` FOREIGN KEY (`attribute_id`) REFERENCES `ingredient_attributes` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKorders778187` FOREIGN KEY (`draft_id`) REFERENCES `drafts` (`id`),
  ADD CONSTRAINT `FKorders805987` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `FKorders954603` FOREIGN KEY (`delivery_man_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `FKpreference366953` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `recipes_ingredients`
--
ALTER TABLE `recipes_ingredients`
  ADD CONSTRAINT `FKrecipes_in328480` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `FKrecipes_in857892` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Constraints for table `recipes_rating`
--
ALTER TABLE `recipes_rating`
  ADD CONSTRAINT `FKrecipes_ra530385` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `FKrecipes_ra567430` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `FKwishlists275277` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `FKwishlists598497` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
