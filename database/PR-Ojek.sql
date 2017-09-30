-- Database PR-Ojek

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
	`user_id`     INT         NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(50) NOT NULL,
	`email`       VARCHAR(50) NOT NULL,
	`phone`       VARCHAR(20) NOT NULL,
    `username`    VARCHAR(50) NOT NULL,
    `password`    VARCHAR(20) NOT NULL,
    `status`      VARCHAR(10) NOT NULL,
	`pict`        MEDIUMBLOB  DEFAULT NULL,

	PRIMARY KEY (`user_id`)
);

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
	`driver_id`     INT             NOT NULL,
	`total_score`   DOUBLE(50,1)    NOT NULL,
	`votes`         DOUBLE(50,1)    NOT NULL,

	PRIMARY KEY (`driver_id`),
	CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `user` (`user_id`)
);

DROP TABLE IF EXISTS `driver_prefloc`;
CREATE TABLE IF NOT EXISTS `driver_prefloc` (
	`driver_id`   INT         NOT NULL,
    `pref_loc`    VARCHAR(50) NOT NULL,

	PRIMARY KEY (`driver_id`),
	CONSTRAINT `driver_prefloc_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`)
);

CREATE TABLE IF NOT EXISTS `order` (
	`order_id`       INT             NOT NULL,
	`dest_city`     VARCHAR(50)     NOT NULL,
	`pick_city`     VARCHAR(50)     NOT NULL,
    `score`         DOUBLE(50,1)    NOT NULL,
    `comment`       VARCHAR(140)    NOT NULL,
    `driver_id`     INT             NOT NULL,
    `cust_id`       INT             NOT NULL,
    `date`          DATE            NOT NULL,

	PRIMARY KEY (`order_id`),
	CONSTRAINT `order_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `user` (`user_id`),
    CONSTRAINT `order_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`)
);
