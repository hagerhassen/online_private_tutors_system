
CREATE TABLE `materials` (
  `Uname` varchar(255) NOT NULL,
  `Teacher` varchar(255) NOT NULL,
  `subjectName` varchar(50) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `parent_mail` varchar(255) NOT NULL,
  `teacher_mail` varchar(255) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstName`, `lastName`, `email`, `pass`, `role`, `approved`) VALUES
('admin', 'admin', 'admin@admin.com', '$2y$12$TUC/mzLHBZAvREDVvB86uuqfFjlEEtQkbHwlOVmP/WnH534yM7iYu', 'admin', 0);
--- inserting our admin


ALTER TABLE `materials`
  ADD PRIMARY KEY (`Uname`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);



ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;


