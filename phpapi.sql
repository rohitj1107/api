
CREATE TABLE `tbl_book` (
  `book_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `book_author` varchar(20) NOT NULL,
  `book_title` varchar(11) NOT NULL,
  `book_isbn` varchar(11) NOT NULL,
  `book_releasedate` varchar(11) NOT NULL
);
