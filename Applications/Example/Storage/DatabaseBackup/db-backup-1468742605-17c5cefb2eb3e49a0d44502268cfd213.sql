DROP TABLE IF EXISTS database_example_table;

CREATE TABLE `database_example_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO database_example_table VALUES("1", "29603", "5792578b3b", "4697578b3b669c806");
INSERT INTO database_example_table VALUES("2", "77105", "9983578b3b", "31948578b3b66c9f10");
INSERT INTO database_example_table VALUES("3", "31509", "32298578b3", "13339578b3b6701131");
INSERT INTO database_example_table VALUES("4", "65845", "13201578b3", "21238578b3b672cb64");
INSERT INTO database_example_table VALUES("5", "30455", "6500578b3b", "30669578b3b6754141");
INSERT INTO database_example_table VALUES("6", "10370", "2963578b3b", "26576578b3b677b930");
INSERT INTO database_example_table VALUES("7", "17353", "19150578b3", "19951578b3b67a4c54");
INSERT INTO database_example_table VALUES("8", "12540", "21381578b3", "17882578b3b6bb18e6");
INSERT INTO database_example_table VALUES("9", "23051", "24808578b3", "8961578b3b6bdfed4");
INSERT INTO database_example_table VALUES("10", "26022", "3047578b3b", "9108578b3b6c12211");
INSERT INTO database_example_table VALUES("11", "28221", "13874578b3", "32643578b3b6c3c4c9");



