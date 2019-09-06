CREATE TABLE `xmstock_area` (
  `area_id`             int(11) unsigned    NOT NULL AUTO_INCREMENT,
  `area_name`           varchar(255)        NOT NULL DEFAULT '',
  `area_description`    text,
  `area_logo`           varchar(50)         NOT NULL DEFAULT '',
  `area_location`       varchar(255)        NOT NULL DEFAULT '',
  `area_weight`         int(5)             	NOT NULL DEFAULT '0',
  `area_status`         tinyint(1) unsigned NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`area_id`),
  KEY `area_name` (`area_name`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_transfer` (
  `transfer_id`             int(11) unsigned    	NOT NULL AUTO_INCREMENT,
  `transfer_description`    	text,
  `transfer_articleid`      int(11) unsigned    	NOT NULL,
  `transfer_st_areaid`      int(11) unsigned   		NOT NULL,
  `transfer_ar_areaid`      int(11) unsigned    	NOT NULL,
  `transfer_outputid`     	int(11) unsigned    	NOT NULL,
  `transfer_amount`         int(11) unsigned    	NOT NULL,
  `transfer_date`           int(10) unsigned    	NOT NULL DEFAULT '0',
  `transfer_userid`         mediumint(8) unsigned   NOT NULL default '0',
  `transfer_type`           varchar(2)	 		    NOT NULL DEFAULT '',
  `transfer_ref`            varchar(255)        	NOT NULL DEFAULT '',
  `transfer_status`         tinyint(1) unsigned 	NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`transfer_id`),
  KEY `transfer_articleid` (`transfer_amount`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_stock` (
  `stock_id`            int(11) unsigned    	NOT NULL AUTO_INCREMENT,
  `stock_areaid`      	int(11) unsigned   		NOT NULL,
  `stock_articleid`     int(11) unsigned    	NOT NULL,
  `stock_amount`      	int(11) unsigned   		NOT NULL,
  
  PRIMARY KEY (`stock_id`),
  KEY `stock_areaid` (`stock_articleid`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_output` (
  `output_id`            int(11) unsigned    	NOT NULL AUTO_INCREMENT,
  `output_name`          varchar(255)        	NOT NULL DEFAULT '',
  `output_description`   text,
  `output_userid`        mediumint(8) unsigned  NOT NULL default '0',
  `output_weight`        int(5)             	NOT NULL DEFAULT '0',
  `output_status`        tinyint(1) unsigned NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`output_id`),
  KEY `output_name` (`output_userid`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_order` (
  `order_id`             int(11) unsigned    	NOT NULL AUTO_INCREMENT,
  `order_description`    text,
  `order_userid`         smallint(5)  unsigned  NOT NULL default '0',
  `order_date`           int(10) unsigned    	NOT NULL DEFAULT '0',
  `order_status`         tinyint(1) unsigned 	NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`order_id`),
  KEY `order_date` (`order_date`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_itemorder` (
  `itemorder_id`          int(11) unsigned    	NOT NULL AUTO_INCREMENT,
  `itemorder_orderid`     int(11) unsigned    	NOT NULL, 
  `itemorder_articleid`   int(11) unsigned    	NOT NULL,
  `itemorder_areaid`      int(11) unsigned    	NOT NULL,
  `itemorder_amount`      int(11) unsigned    	NOT NULL,
  `itemorder_dvalidated`  int(10) unsigned    	NOT NULL DEFAULT '0',
  `itemorder_davailable`  int(10) unsigned    	NOT NULL DEFAULT '0',
  `itemorder_dwithdrawal` int(10) unsigned    	NOT NULL DEFAULT '0',
  `itemorder_status`      tinyint(1) unsigned 	NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`itemorder_id`),
  KEY `itemorder_orderid` (`itemorder_articleid`)
) ENGINE=MyISAM;