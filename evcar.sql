/*Table structure for table `tbl_audit_logs` */

DROP TABLE IF EXISTS `tbl_audit_logs`;

CREATE TABLE `tbl_audit_logs` (
  `id` varchar(50) NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `operation` varchar(50) DEFAULT NULL,
  `from` varchar(10) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `custom_text` longtext DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_audit_logs` */

/*Table structure for table `tbl_brand` */

DROP TABLE IF EXISTS `tbl_brand`;

CREATE TABLE `tbl_brand` (
  `id` varchar(50) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `logo_data` longtext DEFAULT NULL,
  `entry_uid` varchar(50) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `update_uid` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_brand` */

insert  into `tbl_brand`(`id`,`brand`,`logo`,`logo_data`,`entry_uid`,`entry_date`,`update_uid`,`update_date`) values ('17057499-0881-5158-ea54-7919d6634c1d','TATA','upload/images/brand/17057499-0881-5158-ea54-7919d6634c1d/s1.png','[{\"uuid\":\"6bf42793-9c23-4bc0-889a-f5ddd0a0dc44\",\"name\":\"s1.png\",\"filename\":\"s1.png\",\"size\":4999,\"total\":4999,\"bytesSent\":4999,\"url\":\"upload/images/brand/17057499-0881-5158-ea54-7919d6634c1d/s1.png\",\"upload\":{\"uuid\":\"6bf42793-9c23-4bc0-889a-f5ddd0a0dc44\",\"name\":\"s1.png\",\"filename\":\"s1.png\",\"size\":4999,\"total\":4999,\"bytesSent\":4999,\"url\":\"upload/images/brand/17057499-0881-5158-ea54-7919d6634c1d/s1.png\"}}]','17019352-1247-1172-9a37-27852d564b27','2024-01-20 16:55:08',NULL,NULL),('17057500-5483-9309-3fb9-cf13655e4cb1','SUZUKI','upload/images/brand/17057500-5483-9309-3fb9-cf13655e4cb1/s2.png','[{\"uuid\":\"fd0653db-7cea-4896-bab3-8b3b265b2468\",\"name\":\"s2.png\",\"filename\":\"s2.png\",\"size\":6365,\"total\":6365,\"bytesSent\":6365,\"url\":\"upload/images/brand/17057500-5483-9309-3fb9-cf13655e4cb1/s2.png\",\"upload\":{\"uuid\":\"fd0653db-7cea-4896-bab3-8b3b265b2468\",\"name\":\"s2.png\",\"filename\":\"s2.png\",\"size\":6365,\"total\":6365,\"bytesSent\":6365,\"url\":\"upload/images/brand/17057500-5483-9309-3fb9-cf13655e4cb1/s2.png\"}}]','17019352-1247-1172-9a37-27852d564b27','2024-01-20 16:57:34',NULL,NULL),('17057500-7305-8563-0aed-7f54f7784f31','HYUNDAI','upload/images/brand/17057500-7305-8563-0aed-7f54f7784f31/s3.png','[{\"uuid\":\"217885d1-9ec1-4773-88d4-3030a6d82c28\",\"name\":\"s3.png\",\"filename\":\"s3.png\",\"size\":8483,\"total\":8483,\"bytesSent\":8483,\"url\":\"upload/images/brand/17057500-7305-8563-0aed-7f54f7784f31/s3.png\",\"upload\":{\"uuid\":\"217885d1-9ec1-4773-88d4-3030a6d82c28\",\"name\":\"s3.png\",\"filename\":\"s3.png\",\"size\":8483,\"total\":8483,\"bytesSent\":8483,\"url\":\"upload/images/brand/17057500-7305-8563-0aed-7f54f7784f31/s3.png\"}}]','17019352-1247-1172-9a37-27852d564b27','2024-01-20 16:57:53','17019352-1247-1172-9a37-27852d564b27','2024-01-20 16:58:18');

/*Table structure for table `tbl_car_type` */

DROP TABLE IF EXISTS `tbl_car_type`;

CREATE TABLE `tbl_car_type` (
  `id` varchar(50) NOT NULL,
  `car_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_car_type` */

insert  into `tbl_car_type`(`id`,`car_type`) values ('17021013-1662-0600-c9e4-02ef9ff84814','SUV'),('17021013-4901-3967-6e51-94b8a73a4621','Sedan'),('17021013-6340-3532-ea50-61ed2d634998','Hatchback');

/*Table structure for table `tbl_cars` */

DROP TABLE IF EXISTS `tbl_cars`;

CREATE TABLE `tbl_cars` (
  `id` varchar(50) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `brand_name` varchar(100) DEFAULT NULL,
  `price` VARCHAR(25) DEFAULT NULL,
  `fule_type` varchar(50) DEFAULT NULL,
  `fule_type_name` varchar(50) DEFAULT NULL,
  `engine` varchar(50) DEFAULT NULL,
  `comming_soon` TINYINT DEFAULT 0,
  `modal_year` VARCHAR(50) DEFAULT NULL,
  `transmision` varchar(50) DEFAULT NULL,
  `transmision_name` varchar(50) DEFAULT NULL,
  `seater` varchar(50) DEFAULT NULL,
  `car_type` varchar(50) DEFAULT NULL,
  `car_type_name` varchar(50) DEFAULT NULL,
  `mileage` VARCHAR(50) DEFAULT NULL,
  `ground_clearance` INT DEFAULT NULL,
  `warranty` VARCHAR(50) DEFAULT NULL,
  `fuel_tank` VARCHAR(150) DEFAULT NULL,
  `length` INT DEFAULT NULL,
  `width` INT DEFAULT NULL,
  `height` INT DEFAULT NULL,
  `img_360` VARCHAR(250) DEFAULT NULL
  `discontinued` TINYINT DEFAULT 0,
  `driving_range` VARCHAR(50) DEFAULT NULL,
  `battery_warranty` VARCHAR(50) DEFAULT NULL,
  `battery_capacity` VARCHAR(50) DEFAULT NULL,
  `ncap_rating` VARCHAR(50) DEFAULT NULL,
  `show_on_homepage` TINYINT DEFAULT 0,
  `description` longtext DEFAULT NULL,
  `file` longtext DEFAULT NULL,
  `file_data` longtext DEFAULT NULL,
  `brochure_file` LONGTEXT DEFAULT NULL,
  `brochure_file_data` LONGTEXT DEFAULT NULL,
  `gallery_file` LONGTEXT DEFAULT NULL,
  `gallery_file_data` LONGTEXT DEFAULT NULL,
  `interior_gallery_file` LONGTEXT DEFAULT NULL,
  `interior_gallery_file_data` LONGTEXT DEFAULT NULL,
  `color_data` longtext DEFAULT NULL,
  `verient_data` longtext DEFAULT NULL,
  `video_data` longtext DEFAULT NULL,
  `entry_uid` varchar(50) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `update_uid` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_cars` */

/*Table structure for table `tbl_cars_colors` */

DROP TABLE IF EXISTS `tbl_cars_colors`;

CREATE TABLE `tbl_cars_colors` (
  `id` varchar(50) NOT NULL,
  `car_id` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `file_url` longtext DEFAULT NULL,
  `file_data` longtext DEFAULT NULL,
  `entry_uid` varchar(50) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_cars_colors` */

/*Table structure for table `tbl_cars_verient` */

DROP TABLE IF EXISTS `tbl_cars_verient`;

CREATE TABLE `tbl_cars_verient` (
  `id` varchar(50) NOT NULL,
  `car_id` varchar(50) DEFAULT NULL,
  `verient_name` varchar(150) DEFAULT NULL,
  `fule_type` varchar(50) DEFAULT NULL,
  `fule_type_text` varchar(50) DEFAULT NULL,
  `transmision` varchar(50) DEFAULT NULL,
  `transmision_text` varchar(50) DEFAULT NULL,
  `engine` varchar(50) DEFAULT NULL,
  `price` VARCHAR(25) DEFAULT NULL,
  `entry_uid` varchar(50) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_cars_verient` */

/*Table structure for table `tbl_fules` */

DROP TABLE IF EXISTS `tbl_fules`;

CREATE TABLE `tbl_fules` (
  `id` varchar(50) NOT NULL,
  `fule` varchar(50) DEFAULT NULL,
  `entry_uid` varchar(50) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `update_uid` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_fules` */

insert  into `tbl_fules`(`id`,`fule`,`entry_uid`,`entry_date`,`update_uid`,`update_date`) values ('17019343-2268-6961-53fe-f6d5dd4a4874','Petrol','17019352-5850-2453-f4cf-e4563e754dab','2023-12-07 13:03:01',NULL,NULL),('17019343-5517-3281-669d-2389a2e54110','Diesel','17019352-5850-2453-f4cf-e4563e754dab','2023-12-07 13:03:04',NULL,NULL),('17019343-6793-5837-41fa-58623345468a','EV','17019352-5850-2453-f4cf-e4563e754dab','2023-12-07 13:03:06',NULL,NULL),('17019344-8280-6572-4ba7-193417104c31','Hybrid','17019352-5850-2453-f4cf-e4563e754dab','2023-12-07 13:04:37',NULL,NULL);

/*Table structure for table `tbl_menumaster` */

DROP TABLE IF EXISTS `tbl_menumaster`;

CREATE TABLE `tbl_menumaster` (
  `id` varchar(50) DEFAULT NULL,
  `menuname` varchar(50) DEFAULT NULL,
  `pagename` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_menumaster` */

insert  into `tbl_menumaster`(`id`,`menuname`,`pagename`) values ('17024612-6799-0841-dfbc-c6f078474330','Brand Master','manage_brand'),('17024613-1815-4677-e481-26bd85c4440c','Cars Master','manage_car'),('17024613-2381-8465-ffdf-d46967d64445','News Master','manage_news'),('17024613-2714-6516-4c0c-e0ea67124fe1','Settings','manage_setting'),('17056532-7595-5867-d06a-323a7a814371','Slider Master','manage_slider'),('17056533-1585-5565-f99d-3797fcca403d','Testimonial Master','manage_testimonial'),('17122969-5158-1450-3f30-e50069cb47f8', 'Home Manage', 'manage_home');

/*Table structure for table `tbl_news` */

DROP TABLE IF EXISTS `tbl_news`;

CREATE TABLE `tbl_news` (
  `id` varchar(50) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `sub_title` varchar(250) DEFAULT NULL,
  `news_date` varchar(50) DEFAULT NULL,
  `short_desc` longtext DEFAULT NULL,
  `show_on_homepage` TINYINT DEFAULT 0,
  `description` longtext DEFAULT NULL,
  `main_image` varchar(300) DEFAULT NULL,
  `main_image_data` longtext DEFAULT NULL,
  `tags` LONGTEXT DEFAULT NULL,
  `entry_uid` varchar(50) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `update_uid` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_news` */

/*Table structure for table `tbl_roles` */

DROP TABLE IF EXISTS `tbl_roles`;

CREATE TABLE `tbl_roles` (
  `id` varchar(50) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_roles` */

insert  into `tbl_roles`(`id`,`role`) values ('17019350-1059-3172-f8de-9c507e9e4901','Admin');

/*Table structure for table `tbl_settings` */

DROP TABLE IF EXISTS `tbl_settings`;

CREATE TABLE `tbl_settings` (
  `id` varchar(50) NOT NULL,
  `company_name` varchar(40) DEFAULT NULL,
  `company_email` varchar(25) DEFAULT NULL,
  `admin_email` varchar(25) DEFAULT NULL,
  `admin_email_password` varchar(30) DEFAULT NULL,
  `contact1` varchar(20) DEFAULT NULL,
  `contact2` varchar(20) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `show_gpay` int(11) DEFAULT 1,
  `pay_type` int(11) DEFAULT 0,
  `payment_script` varchar(150) DEFAULT NULL,
  `upi` varchar(50) DEFAULT NULL,
  `pixel` longtext DEFAULT NULL,
  `allowed_ip` longtext DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `attempt` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_settings` */

insert  into `tbl_settings`(`id`,`company_name`,`company_email`,`admin_email`,`admin_email_password`,`contact1`,`contact2`,`address`,`show_gpay`,`pay_type`,`payment_script`,`upi`,`pixel`,`allowed_ip`,`otp`,`attempt`) values ('17019352-5850-2453-f4cf-e4563e754dab','Online Payment','info@onlinepmt.com','ventureshop216@gmail.com','ukdlgamsyddodenw','+91 123456789','+91 123456789','test',0,0,'','','','',NULL,0);

/*Table structure for table `tbl_slidermaster` */

DROP TABLE IF EXISTS `tbl_slidermaster`;

CREATE TABLE `tbl_slidermaster` (
  `id` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `description` text DEFAULT NULL,
  `btntext` varchar(50) DEFAULT NULL,
  `orderno` int(11) NOT NULL,
  `isactive` int(11) DEFAULT 1,
  `entry_uid` varchar(50) NOT NULL,
  `entry_by` varchar(100) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_uid` varchar(50) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `file_data` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_by` (`entry_by`),
  KEY `entry_date` (`entry_date`),
  KEY `entry_uid` (`entry_uid`),
  KEY `isactive` (`isactive`),
  KEY `orderno` (`orderno`),
  KEY `title` (`title`(3072)),
  KEY `update_by` (`update_by`),
  KEY `update_date` (`update_date`),
  KEY `update_uid` (`update_uid`),
  KEY `btntext` (`btntext`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tbl_slidermaster` */

/*Table structure for table `tbl_testimonialmaster` */

DROP TABLE IF EXISTS `tbl_testimonialmaster`;

CREATE TABLE `tbl_testimonialmaster` (
  `id` varchar(50) NOT NULL,
  `personname` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `tdate` varchar(50) DEFAULT NULL,
  `rating` INT NULL,
  `orderno` int(11) NOT NULL,
  `file` text DEFAULT NULL,
  `file_data` text DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `entry_uid` varchar(50) NOT NULL,
  `entry_date` datetime NOT NULL,
  `update_uid` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cname` (`personname`),
  KEY `entry_date` (`entry_date`),
  KEY `entry_uid` (`entry_uid`),
  KEY `isactive` (`isactive`),
  KEY `orderno` (`orderno`),
  KEY `update_uid` (`update_uid`),
  KEY `img` (`file`(3072)),
  KEY `date` (`tdate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `tbl_testimonialmaster` */

/*Table structure for table `tbl_transmision` */

DROP TABLE IF EXISTS `tbl_transmision`;

CREATE TABLE `tbl_transmision` (
  `id` varchar(50) NOT NULL,
  `trans_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_transmision` */

insert  into `tbl_transmision`(`id`,`trans_type`) values ('17021016-4347-5698-dca4-0980be5b4903','Auto'),('17021016-5425-9542-b7f8-a6b261634144','Manual');

/*Table structure for table `tbl_user_cmp` */

DROP TABLE IF EXISTS `tbl_user_cmp`;

CREATE TABLE `tbl_user_cmp` (
  `id` varchar(50) NOT NULL,
  `userid` varchar(50) DEFAULT NULL,
  `cmpid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_user_cmp` */

/*Table structure for table `tbl_userrights` */

DROP TABLE IF EXISTS `tbl_userrights`;

CREATE TABLE `tbl_userrights` (
  `id` varchar(50) NOT NULL,
  `roleid` varchar(50) DEFAULT NULL,
  `personid` varchar(50) DEFAULT NULL,
  `menuid` varchar(50) DEFAULT NULL,
  `viewright` tinyint(4) DEFAULT 0,
  `addright` tinyint(4) DEFAULT 0,
  `editright` tinyint(4) DEFAULT 0,
  `deleteright` tinyint(4) DEFAULT 0,
  `entry_uid` varchar(50) DEFAULT NULL,
  `entry_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_userrights` */

/*Table structure for table `tbl_userrole` */

DROP TABLE IF EXISTS `tbl_userrole`;

CREATE TABLE `tbl_userrole` (
  `id` varchar(50) NOT NULL,
  `userid` varchar(50) DEFAULT NULL,
  `roleid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_userrole` */

insert  into `tbl_userrole`(`id`,`userid`,`roleid`) values ('17016828-1780-0914-937a-ab8435db4a4d','17019352-1247-1172-9a37-27852d564b27','92212996-3bce-4dc3-9a33-63b6490be21f');

/*Table structure for table `tbl_users` */

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `id` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role_id` varchar(50) DEFAULT NULL,
  `last_logged_in` datetime DEFAULT NULL,
  `last_login_offset` varchar(50) DEFAULT NULL,
  `insert_at` datetime DEFAULT current_timestamp(),
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_users` */

CREATE TABLE `tbl_home_manage`(  
  `id` VARCHAR(50) NOT NULL,
  `list_type` INT,
  `car_id` VARCHAR(50),
  `car_name` VARCHAR(250),
  `entry_uid` VARCHAR(50),
  `entry_date` DATETIME,
  `update_uid` VARCHAR(50),
  `update_date` DATETIME,
  PRIMARY KEY (`id`)
);

insert  into `tbl_users`(`id`,`name`,`username`,`password`,`role_id`,`last_logged_in`,`last_login_offset`,`insert_at`,`phone`,`email`,`token`,`otp`) values ('17019352-1247-1172-9a37-27852d564b27','Admin','a','0cc175b9c0f1b6a831c399e269772661','17019350-1059-3172-f8de-9c507e9e4901','2024-01-24 11:55:11','330','2023-02-01 11:49:50',NULL,'admin@admin.com','',386110);

CREATE
    VIEW `car_details` 
    AS
(SELECT id, '' AS main_car_id,`name`,brand,brand_name,price,fule_type,fule_type_name,`engine`,comming_soon,modal_year,transmision,transmision_name,seater,car_type,car_type_name,mileage,ground_clearance,warranty,fuel_tank,`length`,width,height,img_360,discontinued,driving_range,battery_warranty,battery_capacity,ncap_rating,show_on_homepage,description,`file`,file_data,brochure_file,brochure_file_data,gallery_file,gallery_file_data,interior_gallery_file,interior_gallery_file_data,color_data,verient_data,video_data 
FROM tbl_cars
UNION ALL
SELECT v.id, v.`car_id` AS main_car_id,CONCAT(c.name, ' ', v.verient_name),c.brand,c.brand_name,v.price,v.fule_type,v.fule_type_text,v.`engine`,c.comming_soon,c.modal_year,v.transmision,v.transmision_text,c.seater,c.car_type,c.car_type_name,c.mileage,c.ground_clearance,c.warranty,c.fuel_tank,c.length,c.width,c.height,c.img_360,c.discontinued,c.driving_range,c.battery_warranty,c.battery_capacity,c.ncap_rating,c.show_on_homepage,c.description,c.`file`,c.file_data,c.brochure_file,c.brochure_file_data,c.gallery_file,c.gallery_file_data,c.interior_gallery_file,c.interior_gallery_file_data,c.color_data,c.verient_data,c.video_data 
FROM `tbl_cars_verient` v INNER JOIN tbl_cars c ON c.`id` = v.`car_id`);

DELIMITER $$
CREATE
    FUNCTION `remove_spacialcharacter`(input_string VARCHAR(255))
    RETURNS VARCHAR(255)
    BEGIN
      DECLARE output_string VARCHAR(255);
      SET output_string = '';
      -- Remove special characters using regular expression
      SET output_string = REPLACE(LOWER(REGEXP_REPLACE(input_string, '[^a-zA-Z0-9 ]', '')),' ','-');

      RETURN output_string;
    END$$

DELIMITER ;