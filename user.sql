-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2026 at 05:14 PM
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
-- Database: `typing`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `enrollment` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `wpm` int(4) NOT NULL,
  `accuracy` int(4) NOT NULL,
  `typing_score` int(4) NOT NULL,
  `quiz_score` int(6) NOT NULL,
  `final_score` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`enrollment`, `name`, `mobile`, `email`, `status`, `wpm`, `accuracy`, `typing_score`, `quiz_score`, `final_score`) VALUES
('2025BCHR0105', 'Daksh bodariya', 9106865353, 'dakshbodariya73@gmail.com', 'approved', 0, 0, 0, 0, 0),
('224SBECE30070', 'DISha thanki', 9726724781, 'dishathanki2005@gmail.com', 'approved', 0, 0, 0, 0, 0),
('225SBECE30045', 'Shah divy manishkumar', 6352985415, 'divyshah2401@gmail.com', 'approved', 0, 0, 0, 0, 0),
('225SBECE30062', 'PRIYANSH VAGHESHWARI', 7383775682, 'priyanshvagheshwari@gmail.com', 'approved', 0, 0, 0, 0, 0),
('230130109059', 'Ranjit Shah', 7043604540, 'ranjitshah26622@gmail.com', 'pending', 0, 0, 0, 0, 0),
('230280116130', 'Harsh Rayja Navinkumar', 7990719693, 'harshrayja521@gmail.com', 'approved', 0, 0, 0, 0, 0),
('230801519', 'Het Rathod', 8200311740, 'hetatmiyaedu@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BCP077', 'AESHA Marakna', 6354762933, 'aeshapatel2512@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30009', 'BAMANIYA Dakshit Ramesh', 8469978721, 'dakshitbamaniya121@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23bece30018', 'Dhruv Bhalsod', 7016288248, 'dhruvbhalsod6@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30089', 'Jarsania Keshvi', 9328816431, 'keshvijarsania198@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30090', 'Ayushi Joddha', 8128367242, 'ayushijoddha@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30108', 'Kevat urmi', 9427969982, 'kevaturmi@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23bece30117', 'Hem kotadia', 9316725509, 'hem16872@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30133', 'Pratik Mesavaniya', 7698027727, 'mesavaniyapratik2006@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30157', 'Parmar Krunalsinh bharatsinh', 9723621008, 'Parmarkrunalsinh37@email.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30164', 'Patel Arya', 8128787496, 'aryapatel2550@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30237', 'Patel neel', 9672681026, 'neelpatel8422@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30252', 'Rahi patel', 9662326095, 'rahipatel191@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30254', 'Patel Rohan nimeshbhai', 9033211910, 'rohanpatel30112005@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23Bece30261', 'Sakshi Patel', 9712806073, 'sakshipatel9712@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30296', 'Prajapati Sumit Sureshbhai', 9875023644, 'sumitprajapati4456@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30303 ', 'Brijesh Rakholiya', 9773069019, 'brijeshrakholiya001@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30312', 'Raval janvi', 7284087402, 'Ravaljanvi2006@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30322', 'Abhishek Sangani', 9712130204, 'abhisheksangani5@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23bece30323', 'NEHANSHI SANGHANI', 9054791036, 'nehanshisanghani261@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30325', 'MANN SAVSANI', 7041864674, 'mannsavsani@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23bece30326', 'Neel savsani', 9712192640, 'neelsavsani7@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30331', 'Janvi Shah', 9016753443, 'shahjanvi2005@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30352', 'Jeel suchak', 7201015124, 'jeelsuchak1512@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30353 ', 'Preet sudani', 8849216742, 'Preetsudani17@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30440', 'Gami DevangKumar Nileshbhai', 8849852742, 'devangpatel5236@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30467', 'Kevadiya harsh Rakeshbhai', 7046950546, 'kevadiyaharsh1402@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30580', 'Aman Rabadiya', 9313734080, 'aman.rabadiya23@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30582', 'Deep Ramani', 9664737205, 'deepramani182@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30587', 'soham', 6352322326, 'soham.xo11@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BECE30627', 'Yadav Himanshu Kamlesh', 7984394048, 'yhimanshu7984@gmail.com', 'pending', 0, 0, 0, 0, 0),
('23BEIT30087 ', 'PARMAR NIKHILKUMAR MANJIBHAI', 9313578351, 'pn7638861@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BEIT30163', 'Yash patel', 8320476958, 'patelyashmahendrabhai@gmail.co', 'approved', 0, 0, 0, 0, 0),
('23Beit30172', 'Prajapati Manavkumar', 9924627094, 'manavprajapati1706@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23BEIT30174', 'Prajapati Yash Yogeshbhai', 9662321188, 'yashprajapati5151@gmail.com', 'approved', 0, 0, 0, 0, 0),
('23F2003807', 'Jash Mevada', 8154996971, 'jashmevada@gmail.com', 'pending', 0, 0, 0, 0, 0),
('240301290', 'Meet mendapra', 9875008253, 'mendaprameet10@email.com', 'approved', 0, 0, 0, 0, 0),
('24BECE30313', 'Ayush Prajapati', 7016367124, 'ayushpra36@gmail.com', 'approved', 0, 0, 0, 0, 0),
('24BECE30491', 'Manav patel', 6355833722, 'manavdadhaniya96@gmail.com', 'approved', 0, 0, 0, 0, 0),
('24bece54006', 'Pal donda', 9510723893, 'donda951072@gmail.com', 'approved', 0, 0, 0, 0, 0),
('24bece54039 ', 'JAYMEEN VAGHELA', 9601429218, 'jaymeenvaghela07@gmail.com', 'approved', 0, 0, 0, 0, 0),
('24BECE54041 ', 'Jeel Vekariya', 9726230239, 'vekariyajeel0@gmail.com', 'approved', 0, 0, 0, 0, 0),
('24becse54050', 'Vyas Jenil Nileshkumar', 9016158393, 'VYASJENIL0@GMAIL.COM', 'approved', 0, 0, 0, 0, 0),
('24BEIT30103', 'Dhruv Patel', 9601967127, 'dp046744@gmail.com', 'approved', 0, 0, 0, 0, 0),
('25BEEC30054', 'Rabadiya Vansh Manishbhai', 7359391797, 'vanshrabadiya4@gmail.com', 'approved', 0, 0, 0, 0, 0),
('25Beit30018', 'Delvadiya Bhavy Divyeshbhai', 7863857407, 'bhavydelvadiya12@gmail.com', 'approved', 0, 0, 0, 0, 0),
('25BEIT30019', 'karan der', 9512845484, 'karander.0777@gmail.com', 'approved', 0, 0, 0, 0, 0),
('25BeIt30050', 'MURAV ANJALI JAGDISHKUMAR', 7434945570, 'anjalimurav2226@gmail.com', 'approved', 0, 0, 0, 0, 0),
('Bed84324020050', 'Mehul Gosai', 6351889585, 'mehulgosai14@gmail.com', 'approved', 0, 0, 0, 0, 0),
('Bnurs40822165860', 'Gosai jaydip', 9316412190, 'mehulgosai3041987@gmail.com', 'approved', 0, 0, 0, 0, 0),
('L23beci30013', 'Solanki risi', 7433045549, 'solankirisi2006@gmail.com', 'approved', 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`enrollment`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
