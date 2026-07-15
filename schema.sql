-- Consolidated schema for Wallpaper Website.
-- Originally three separate local databases (login, contactform, paymentdb);
-- merged into one here since most free hosting tiers only offer a single
-- database instance. Historical test data from all three original dumps is
-- preserved as-is.

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'Zac', '$2y$10$C0P/iQZ.UTbGTKPmGNhWwOICRcMDI6lHKLp6wBrQDWumA1kTfqNHO', '2022-11-28 17:56:57'),
(2, 'pratham', '$2y$10$yzpT1VPUULnBJNdd.LNR8uXXOkpjB8/cmBIz8MuAQaypHR8gEw86O', '2022-11-28 18:26:08'),
(3, 'manavpaliwal97', '$2y$10$pDggUTF6Mgjw3XxbQ/tNNOs4V2H.gricQH5ajjD5E7ex7I4pAMNuK', '2022-11-28 23:41:23'),
(4, 'suruj', '$2y$10$/b.7OjE.O09wCRkzkeSeN.5hEcsheyaVl1.h.64P513q/BeO9r1H6', '2022-11-29 00:40:15'),
(5, 'Zacker300', '$2y$10$Lhl5.tMcoSUs73y1pVdvM.2w0yP.uGil1VBdWWNm7IVHppT14MzIa', '2022-11-30 21:01:30'),
(6, 'Dishant', '$2y$10$FsN/C0fGAAW1Rr1G0SSMqeHBT3v0mKmSc8sB1swZT6uE8J0JdNIqy', '2022-12-01 01:15:46'),
(7, 'balls', '$2y$10$ajb659hDzNoP3bmbwaBADOZHmUgp1azbO//4hWMXAZTAnqETDMObi', '2022-12-04 18:01:32');

CREATE TABLE `contact-data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(55) NOT NULL,
  `messages` text NOT NULL,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `contact-data` (`id`, `firstname`, `lastname`, `phone`, `email`, `messages`, `file`) VALUES
(1, 'Rick', 'Astley', '9694201135', 'abc@gmail.com', 'Mic testing', ''),
(2, 'abc', 'def', '123456', 'abc@gmail.com', '123', ''),
(3, 'unknown', 'abc', '7817822000', 'devmodi30@gmail.com', 'any message', '');

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `cname` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `cnumber` bigint NOT NULL,
  `city` varchar(20) NOT NULL,
  `exp` varchar(10) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` int(50) NOT NULL,
  `year` int(50) NOT NULL,
  `cvv` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `payment` (`id`, `fname`, `email`, `cname`, `address`, `cnumber`, `city`, `exp`, `state`, `zipcode`, `year`, `cvv`) VALUES
(1, 'ada', 'adad@gmal.com', 'adadad', 'adad', 2147483647, 'asdasd', 'asdas', 'asd', 123456, 1111, 2222),
(2, 'Dishant Modi', 'devmodi30@gmail.com', 'Dishant Modi', 'i dunno', 2147483647, 'Surat', 'November', 'Gujarat', 395017, 2026, 6969),
(3, 'majju', 'majju@gmail.com', 'pratham', 'asjkdjkasd', 2147483647, 'pune', 'november', 'maharastra', 12345, 1999, 6969),
(4, 'abc', 'ajdjabd@gmail.com', 'akjda', 'asdk', 2147483647, 'kanskd', 'november', 'knaskd', 154664, 2002, 3245),
(5, 'pratham', 'prathammajethia@gmail.com', 'Prtaham Majethia', 'abcderd', 2147483647, 'pune', 'november', 'maharastra', 123456, 2025, 3551),
(6, 'asda', 'asdasd@gmail.com', 'asdasd', 'asdasdas', 2147483647, 'asdasd', 'asdasd', 'asda', 123456, 2222, 1234);
