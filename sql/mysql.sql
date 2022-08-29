CREATE TABLE `xmstock_area` (
  `area_id`             smallint(5)  unsigned   NOT NULL AUTO_INCREMENT,
  `area_name`           varchar(255)        	NOT NULL DEFAULT '',
  `area_description`    text,
  `area_logo`           varchar(50)         	NOT NULL DEFAULT '',
  `area_color`    		varchar(7)          	NOT NULL DEFAULT '#ffffff',
  `area_location`       varchar(255)        	NOT NULL DEFAULT '',
  `area_weight`         smallint(5)  unsigned   NOT NULL DEFAULT '0',
  `area_status`         tinyint(1)	 unsigned	NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`area_id`),
  KEY `area_name` (`area_name`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_transfer` (
  `transfer_id`             int(11)	 	 unsigned   NOT NULL AUTO_INCREMENT,
  `transfer_description`    text,
  `transfer_articleid`      mediumint(8) unsigned   NOT NULL DEFAULT '0',
  `transfer_st_areaid`      mediumint(8) unsigned   NOT NULL DEFAULT '0',
  `transfer_ar_areaid`      mediumint(8) unsigned   NOT NULL DEFAULT '0',
  `transfer_outputid`     	smallint(5)  unsigned   NOT NULL DEFAULT '0',
  `transfer_outputuserid`   smallint(5)  unsigned   NOT NULL DEFAULT '0',
  `transfer_amount`         smallint(5)  unsigned   NOT NULL DEFAULT '0',
  `transfer_date`           int(10) 	 unsigned   NOT NULL DEFAULT '0',
  `transfer_userid`         smallint(5)  unsigned   NOT NULL DEFAULT '0',
  `transfer_type`           varchar(2)	 		    NOT NULL DEFAULT '',
  `transfer_ref`            varchar(255)        	NOT NULL DEFAULT '',
  `transfer_status`         tinyint(1) unsigned 	NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`transfer_id`),
  KEY `transfer_articleid` (`transfer_amount`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_stock` (
  `stock_id`            smallint(5)  unsigned    	NOT NULL AUTO_INCREMENT,
  `stock_areaid`      	smallint(5)  unsigned   	NOT NULL DEFAULT '0',
  `stock_articleid`     mediumint(8) unsigned    	NOT NULL DEFAULT '0',
  `stock_amount`      	smallint(5)  unsigned   	NOT NULL DEFAULT '0',
  
  PRIMARY KEY (`stock_id`),
  KEY `stock_areaid` (`stock_articleid`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_output` (
  `output_id`            smallint(5)  unsigned    	NOT NULL AUTO_INCREMENT,
  `output_name`          varchar(255)        		NOT NULL DEFAULT '',
  `output_description`   text,
  `output_userid`        smallint(5)  unsigned  	NOT NULL DEFAULT '0',
  `output_weight`        smallint(5)  unsigned      NOT NULL DEFAULT '0',
  `output_status`        tinyint(1)   unsigned 		NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`output_id`),
  KEY `output_name` (`output_userid`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_order` (
  `order_id`             int(11)     unsigned   NOT NULL AUTO_INCREMENT,
  `order_description`    text,
  `order_userid`         smallint(5) unsigned   NOT NULL DEFAULT '0',
  `order_areaid`     	 smallint(5) unsigned   NOT NULL DEFAULT '0',
  `order_ddesired`       int(10) 	 unsigned   NOT NULL DEFAULT '0',
  `order_dorder`         int(10) 	 unsigned   NOT NULL DEFAULT '0',
  `order_dvalidation`    int(10) 	 unsigned   NOT NULL DEFAULT '0',
  `order_ddelivery_v`    int(10) 	 unsigned   NOT NULL DEFAULT '0',
  `order_dready`    	 int(10) 	 unsigned   NOT NULL DEFAULT '0',
  `order_ddelivery_r`    int(10) 	 unsigned   NOT NULL DEFAULT '0',
  `order_dcancellation`  int(10) 	 unsigned   NOT NULL DEFAULT '0',
  `order_delivery`       tinyint(1)  unsigned   NOT NULL DEFAULT '1',
  `order_status`         tinyint(1)  unsigned 	NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`order_id`),
  KEY `order_userid` (`order_userid`)
) ENGINE=MyISAM;

CREATE TABLE `xmstock_itemorder` (
  `itemorder_id`          	int(11) 	 unsigned    	NOT NULL AUTO_INCREMENT,
  `itemorder_orderid`     	int(11) 	 unsigned    	NOT NULL DEFAULT '0', 
  `itemorder_articleid`   	mediumint(8) unsigned    	NOT NULL DEFAULT '0',
  `itemorder_areaid`      	smallint(5)  unsigned    	NOT NULL DEFAULT '0',
  `itemorder_amount`      	smallint(5)  unsigned    	NOT NULL DEFAULT '0',
  `itemorder_dvalidation`   int(10) 	 unsigned   	NOT NULL DEFAULT '0',
  `itemorder_ddelivery_v`   int(10) 	 unsigned   	NOT NULL DEFAULT '0',
  `itemorder_dready`    	int(10) 	 unsigned   	NOT NULL DEFAULT '0',
  `itemorder_ddelivery_r`   int(10) 	 unsigned   	NOT NULL DEFAULT '0',
  `itemorder_dcancellation` int(10) 	 unsigned   	NOT NULL DEFAULT '0',
  `itemorder_dvalidated`  	int(10) 	 unsigned    	NOT NULL DEFAULT '0',
  `itemorder_davailable`  	int(10) 	 unsigned    	NOT NULL DEFAULT '0',
  `itemorder_dwithdrawal` 	int(10) 	 unsigned    	NOT NULL DEFAULT '0',
  
  
  
  
  `itemorder_status`      tinyint(1)   unsigned 	NOT NULL DEFAULT '1',
  
  PRIMARY KEY (`itemorder_id`),
  KEY `itemorder_orderid` (`itemorder_articleid`)
) ENGINE=MyISAM;