CREATE TABLE `xmstock_area` (
  `area_id`             int(11) unsigned    NOT NULL AUTO_INCREMENT,
  `area_name`           varchar(255)        NOT NULL DEFAULT '',
  `area_description`    text,
  `area_logo`           varchar(50)         NOT NULL DEFAULT '',
  `area_location`       varchar(255)         NOT NULL DEFAULT '',
  `area_weight`         int(11)             NOT NULL DEFAULT '0',
  `area_status`         tinyint(1)          NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`area_id`),
  KEY `area_name` (`area_name`)
) ENGINE=MyISAM;