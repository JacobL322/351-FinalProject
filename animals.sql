-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2024 at 12:37 AM
-- Server version: 8.0.39
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animals`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `scientific_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `habitat` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `diet` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `conservation_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fun_fact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `name`, `scientific_name`, `habitat`, `diet`, `conservation_status`, `fun_fact`) VALUES
(1, 'African Wild Dog', 'Lycaon pictus', 'Savannas and Woodlands of Africa', 'Antelopes, Small Mammals, Birds', 'Endangered', 'We have an 80% success rate when hunting!'),
(2, 'American Bison', 'Bison bison', 'Grasslands and Prairies of North America', 'Grass, Weeds, Plants', 'Near Threatened', 'We are the largest land mammal in North America!'),
(3, 'American Paddlefish', 'Polyodon spathula', 'Rivers and Lakes of North America', 'Plankton', 'Vulnerable', 'We are the largest fish in West Virginia, reaching up to five feet!'),
(4, 'Amur Leopard', 'Panthera pardus orientalis', 'Forests and Mountains of China and Russia', 'Deer, Boar, Rodents', 'Critically Endangered', 'We are one of the rarest cats in the world!'),
(5, 'Arctic Fox', 'Vulpes lagopus', 'Tundra and Forests of North America.', 'Rodents, Birds, Carrion', 'Least Concern', 'Our dens can be over 300 years old!'),
(6, 'Axolotl', 'Ambystoma mexicanum', 'Lakes of Mexico', 'Worms, Insects, Fish', 'Critically Endangered', 'We can regenerate limbs!'),
(7, 'Barred Owl', 'Strix varia', 'Forests and Swamps of North America', 'Rodents, Birds, Snakes', 'Least Concern', 'We can rotate our heads 270 degrees!'),
(8, 'Bongo', 'Tragelaphus eurycerus', 'Rainforests of Africa', 'Leaves, Fruits, Twigs', 'Near Threatened', 'We are known to eat burnt wood after thunderstorms to get salt into our diet!'),
(9, 'Boomslang', 'Dispholidus typus', 'Savannas and Forests of Africa', 'Frogs, Birds, Eggs', 'Least Concern', 'Our name is known in Afrikaans as \"tree snake\".'),
(10, 'California Sea Lion', 'Zalophus californianus', 'Shores of California and the Pacific Ocean', 'Fish, Squid', 'Least Concern', 'We can dive up to 900 feet underwater!'),
(11, 'California Sheephead', 'Semicossyphus pulcher', 'Reefs and Kelp Forests off the Coast of California', 'Sea Urchins, Crabs, Mollusks', 'Vulnerable', 'We are all born female, with some later changing into males!'),
(12, 'Cape Porcupine', 'Hystrix africaeaustralis', 'Grasslands of Africa', 'Fruits, Roots, Bark', 'Least Concern', 'We are the largest rodent in Africa, weighing up to 65 pounds!'),
(13, 'Common Loon', 'Gavia immer', 'Lakes and Forests of North America', 'Fish, Mollusks, Frogs', 'Least Concern', 'We have solid bones, unlike most birds!'),
(14, 'Crested Caracara', 'Caracara plancus', 'Grasslands of North and Central America', 'Rodents, Carrion, Insects', 'Least Concern', 'We are the only falcon species that finds materials to make a nest!'),
(15, 'Electric Eel', 'Electrophorus electricus', 'Rivers of South America', 'Fish, Crustaceans, Amphibians', 'Least Concern', 'We can generate up to 800 volts of electricity!'),
(16, 'Emperor Tamarin', 'Saguinus imperator', 'Rainforests of South America', 'Flowers, Fruits, Nectar', 'Least Concern', 'We are named after German Emperor Wilhelm II, who had a similar mustache. '),
(17, 'Ethiopian Wolf', 'Canis simensis', 'Grasslands of Africa', 'Small Mammals, Rodents', 'Endangered', 'Unlike most wolves, we are solitary hunters!'),
(18, 'Fennec Fox', 'Vulpes zerda', 'Deserts of Africa and Arabia', 'Insects, Rodents, Birds', 'Least Concern', 'We have the largest ears of any fox species, with them as long as half of our body!'),
(19, 'Fly River Turtle', 'Carettochelys insculpta', 'Rivers and Lakes of Australia', 'Fruits, Leaves, Fish', 'Endangered', 'We are also known as the pig-nosed turtle due to our squished face!'),
(20, 'Fossa', 'Cryptoprocta ferox', 'Forests of Madagascar', 'Lemurs, Birds', 'Vulnerable', 'We are the largest carnivore in Madagascar!'),
(21, 'Giant Pacific Octopus', 'Cryptoprocta ferox', 'North Pacific Ocean', 'Fish, Crustaceans', 'Least Concern', 'We can be as long as 30 feet and weigh up to 50 pounds!'),
(22, 'Gila Monster', 'Heloderma suspectum', 'Deserts of North America', 'Small Mammals, Birds, Eggs', 'Near Threatened', 'We are one of the only venomous lizards in the world!'),
(23, 'Goliath Frog', 'Conraua goliath', 'Rainforests of Africa', 'Insects, Amphibians, Crustaceans', 'Endangered', 'At 7 pounds, we are the largest frog in the world!'),
(24, 'Harpy Eagle', 'Harpia harpyja', 'Rainforests of Central and South America', 'Sloths, Monkeys, Birds', 'Near Threatened', 'We have talons that are the same size as a grizzly bear!'),
(25, 'Japanese Spider Crab', 'Macrocheira kaempferi', 'North Pacific Ocean', 'Algae, Mollusks, Fish', 'Not Evaluated', 'At 12 feet from claw to claw, we are the largest crab in the world!'),
(26, 'Kirk\'s Dik Dik', 'Madoqua kirkii', 'Savannas and Shrublands of Africa', 'Leaves, Fruits', 'Least Concern', 'We earned our name due to our warning call, which sounds like \"dik-dik\"!'),
(27, 'Komodo Dragon', 'Varanus komodoensis', 'Forests of Indonesia', 'Deer, Pigs, Carrion', 'Endangered', 'We have a special sensory organ that allows us to smell prey up to five miles away!'),
(28, 'Maned Wolf', 'Chrysocyon brachyurus', 'Savannas and Grasslands of South America', 'Fruits, Birds, Rodents', 'Near Threatened', 'We can run up to 50 miles per hour!'),
(29, 'Mantis Shrimp', ' Odontodactylus scyllarus', 'Indo-Pacific Ocean', 'Small Fish, Mollusks, Crustaceans', 'Not Evaluated', 'Our punch is 50 times faster than the blink of an eye and can shatter glass!'),
(30, 'Marine Iguana', 'Amblyrhynchus cristatus', 'Galápagos Islands', 'Algae', 'Vulnerable', 'We are the only lizard in the world that lives in the ocean!'),
(31, 'Masai Giraffe', 'Giraffa camelopardalis tippelskirchi', 'Savannas and Woodlands of Africa', 'Leaves, Flowers, Fruits', 'Endangered', 'We wander over 50 miles in a day to search for food!'),
(32, 'Okapi', 'Okapia johnstoni', 'Rainforests of Africa', 'Leaves, Fruit, Fungi', 'Endangered', 'We eat up to 65 pounds of food every day!'),
(33, 'Pacman Frog', 'Ceratophrys ornata', 'Rainforests and Grasslands of South America', 'Insects, Rodents', 'Least Concern', 'We are named after the video game character Pac-Man due to our round shape and large mouths!'),
(34, 'Peacock Bass', ' Cichla ocellaris', 'Rivers and Lakes of South America', 'Fish, Insects, Crustaceans', 'Not Evaluated', 'We were introduced to Florida in the 1980s as a form of pest control!'),
(35, 'Polar Bear', 'Ursus maritimus', 'Tundra of North America, Russia, and Greenland', 'Seals', 'Vulnerable', 'We have transparent fur which reflects light!'),
(36, 'Proboscis Monkey', 'Nasalis larvatus', 'Swamps and Forests of Indonesia', 'Leaves, Seeds, Fruits', 'Endangered', 'Males have large and droopy noses which are used to make loud calls!'),
(37, 'Red Panda', 'Ailurus fulgens', 'Forests of Asia', 'Bamboo, Fruits, Small Mammals', 'Endangered', 'We have modified wrist bones which act as pseudo-thumbs!'),
(38, 'Resplendent Quetzal', 'Pharomachrus mocinno', 'Forests of Central America', 'Fruits, Rodents, Insects', 'Near Threatened', 'We are the national bird of Guatemala!'),
(39, 'Rhinoceros Hornbill', 'Buceros rhinoceros', 'Rainforests of Asia', 'Fruits, Insects, Reptiles', 'Near Threatened', 'We have large and hollow horns on our head which act as megaphones for our calls!'),
(40, 'Ringtail', 'Bassariscus astutus', 'Forests and Deserts of North and Central America', 'Fruits, Insects, Eggs', 'Least Concern', 'We are known as ringtail cats, but are actually in the raccoon family!'),
(41, 'Sandbar Shark', 'Carcharhinus plumbeus', 'Semi-pelagic waters of the Atlantic and Pacific Ocean', 'Fish, Crustaceans, Mollusks', 'Vulnerable', 'We give birth to live young!'),
(42, 'Secretary Bird', 'Sagittarius serpentarius', 'Savannas and Grasslands of Africa', 'Snakes, Lizards, Insects', 'Endangered', 'We are known for stomping our prey with our long legs!'),
(43, 'Shoebill', 'Balaeniceps rex', 'Swamps of Africa', 'Fish, reptiles, small mammals', 'Vulnerable', 'We have a unique call that sounds similar to gunfire!'),
(44, 'Siberian Tiger', 'Panthera tigris altaica', 'Forests of Asia', 'Deer, Boar, Salmon', 'Endangered', 'We are the largest cat in the world, weighing up to 660 pounds!'),
(45, 'Sockeye Salmon', 'Oncorhynchus nerka', 'Rivers and Lakes of North America', 'Plankton, Crustaceans, Fish', 'Least Concern', 'We swim upriver to the Pacific Ocean to feed!'),
(46, 'Sun Bear', 'Helarctos malayanus', 'Rainforests of Asia', 'Insects, Fruits, Honey', 'Vulnerable', 'We are the smallest bear species in the world!'),
(47, 'Tanuki', 'Nyctereutes procyonoides', 'Forests of Asia', 'Birds, Insects, Nuts', 'Least Concern', 'We are also known as the raccoon dog!'),
(48, 'Tufted Puffin', 'Fratercula cirrhata', 'Shores of the Pacific Ocean', 'Squid, Fish', 'Least Concern', 'We are known as the sea parrot due to our behavior and sounds!'),
(49, 'Victoria Crowned Pigeon', 'Goura victoria', 'Rainforests of Indonesia', 'Fruits, Seeds, Plants', 'Near Threatened', 'We are named after British Monarch Queen Victoria!'),
(50, 'White Sturgeon', 'Acipenser transmontanus', 'Rivers of North America', 'Invertebrates, Crustaceans, Fish', 'Least Concern', 'We are the largest freshwater fish in North America, growing up to 20 feet and 1,800 pounds!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'jacob', '$2y$10$17cr9Yzy7wOl7fb0elyBNegloNr2VUHrQgbrMzvvsIAlfQMri7Yme', '2024-11-17 20:21:12'),
(3, 'root', '$2y$10$/khYrrg51pGGf4Y0PxRkIubGM7JUhniDmGgJVOZ8tzW.aGtkpIegy', '2024-12-05 17:58:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
