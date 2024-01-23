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

insert  into `tbl_audit_logs`(`id`,`record_id`,`user_id`,`action`,`operation`,`from`,`status`,`date_added`,`date_modified`,`custom_text`,`is_deleted`,`ip_address`) values ('',0,NULL,'Login','login_user','panel',1,'2024-01-19 13:43:55','2024-01-19 13:43:55','',NULL,'::1'),('17019414-2349-3064-34dd-372ecfd84827',0,NULL,'Login','login_user','panel',1,'2023-12-07 09:30:23','2023-12-07 09:30:23','',NULL,'::1'),('17019460-3785-8700-f8e4-aba9c0514168',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:47:17','2023-12-07 10:47:17','',1,'::1'),('17019461-9025-0046-0a56-c756253e4857',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:49:50','2023-12-07 10:49:50','',1,'::1'),('17019462-1690-3309-ded2-c7b829714932',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:50:16','2023-12-07 10:50:16','',1,'::1'),('17019462-3539-0562-b513-f999df2f4878',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:50:35','2023-12-07 10:50:35','',1,'::1'),('17019462-4899-9527-c3d4-fee88f6f4864',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:50:48','2023-12-07 10:50:48','',1,'::1'),('17019462-8327-9938-c2a8-5d04ea2946e4',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:51:23','2023-12-07 10:51:23','',1,'::1'),('17019462-9557-7593-3250-60a1716e42fd',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:51:35','2023-12-07 10:51:35','',1,'::1'),('17019463-9956-6317-99fb-5b2fee104b61',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:53:19','2023-12-07 10:53:19','',1,'::1'),('17019464-3804-8620-4eb2-885bb31b4134',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:53:58','2023-12-07 10:53:58','',1,'::1'),('17019464-5066-9517-67e2-3fe13dd64c6d',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:54:10','2023-12-07 10:54:10','',1,'::1'),('17019464-6804-4426-68da-08a912d34d81',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:54:28','2023-12-07 10:54:28','',1,'::1'),('17019464-9086-1046-c5a9-18ea87c54185',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:54:50','2023-12-07 10:54:50','',1,'::1'),('17019465-1485-4538-ff32-54ac7d054449',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:55:14','2023-12-07 10:55:14','',1,'::1'),('17019465-3989-7030-17ed-c37dd6514d6c',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:55:39','2023-12-07 10:55:39','',1,'::1'),('17019465-5631-5521-9676-ea1a62f94478',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:55:56','2023-12-07 10:55:56','',1,'::1'),('17019465-8042-1619-7228-c3ed1bb6499b',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:56:20','2023-12-07 10:56:20','',1,'::1'),('17019465-9519-5091-8a09-a897f64c442e',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:56:35','2023-12-07 10:56:35','',1,'::1'),('17019466-1875-7148-3c0d-353937094b5d',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:56:58','2023-12-07 10:56:58','',1,'::1'),('17019467-5547-4889-2831-e0e92fda4dcb',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:59:15','2023-12-07 10:59:15','',1,'::1'),('17019467-9958-4126-3f1b-8aebfc99441c',0,17019352,'Add','add_brand','panel',1,'2023-12-07 10:59:59','2023-12-07 10:59:59','',1,'::1'),('17019468-2384-0755-c67d-899424274820',0,17019352,'Add','add_brand','panel',1,'2023-12-07 11:00:23','2023-12-07 11:00:23','',1,'::1'),('17019468-5010-6936-1c66-62af5da14913',0,17019352,'Add','add_brand','panel',1,'2023-12-07 11:00:50','2023-12-07 11:00:50','',1,'::1'),('17019469-3606-2870-a2e0-98a2fa374a38',0,17019352,'Add','add_brand','panel',1,'2023-12-07 11:02:16','2023-12-07 11:02:16','',1,'::1'),('17019469-5180-3149-440e-3b39f8a546e7',0,17019352,'Add','add_brand','panel',1,'2023-12-07 11:02:31','2023-12-07 11:02:31','',1,'::1'),('17019474-8275-9452-5184-7084367c4d51',0,17019352,'Add','add_brand','panel',1,'2023-12-07 11:11:22','2023-12-07 11:11:22','',1,'::1'),('17019500-9012-2890-fd3c-4e6bc2d245b4',0,NULL,'Login','login_user','panel',1,'2023-12-07 11:54:50','2023-12-07 11:54:50','',NULL,'::1'),('17020109-0937-0056-68ee-e954743846cc',0,NULL,'Login','login_user','panel',1,'2023-12-08 04:48:29','2023-12-08 04:48:29','',NULL,'::1'),('17020179-7873-4434-4d08-3ee03f1e4eff',0,NULL,'Login','login_user','panel',1,'2023-12-08 06:46:18','2023-12-08 06:46:18','',NULL,'::1'),('17020261-9523-9042-707d-7f9d872e49ca',0,NULL,'Login','login_user','panel',1,'2023-12-08 09:03:15','2023-12-08 09:03:15','',NULL,'::1'),('17020279-0465-2961-6fae-da54c8394bd3',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 09:31:44','2023-12-08 09:31:44','',1,'::1'),('17020280-4814-4875-979b-c7ea416b4f3f',0,17019352,'Add','add_brand','panel',1,'2023-12-08 09:34:08','2023-12-08 09:34:08','',1,'::1'),('17020281-0202-8408-29ad-0059cf604145',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 09:35:02','2023-12-08 09:35:02','',1,'::1'),('17020281-3323-5595-da40-35ad7c424dda',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 09:35:33','2023-12-08 09:35:33','',1,'::1'),('17020282-9979-0515-03d5-d278bc5a4dee',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 09:38:19','2023-12-08 09:38:19','',1,'::1'),('17020283-5350-0654-0361-f36a200b47cd',0,17019352,'Add','add_brand','panel',1,'2023-12-08 09:39:13','2023-12-08 09:39:13','',1,'::1'),('17020283-6082-8907-9ede-e55d656e4c2a',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 09:39:20','2023-12-08 09:39:20','',1,'::1'),('17020299-5866-1346-99c5-fd2e2e084a37',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 10:05:58','2023-12-08 10:05:58','',1,'::1'),('17020313-9580-8772-eb2e-7dcfc98647d2',0,17019352,'Add','add_brand','panel',1,'2023-12-08 10:29:55','2023-12-08 10:29:55','',1,'::1'),('17020314-6189-2708-8ade-b374b3f7448d',0,17019352,'Add','add_brand','panel',1,'2023-12-08 10:31:01','2023-12-08 10:31:01','',1,'::1'),('17020316-3748-5595-f851-0bbf93af4cec',0,NULL,'Login','login_user','panel',1,'2023-12-08 10:33:57','2023-12-08 10:33:57','',NULL,'::1'),('17020316-5352-6523-cb4f-df0f028a499b',0,17019352,'Add','add_brand','panel',1,'2023-12-08 10:34:13','2023-12-08 10:34:13','',1,'::1'),('17020325-7055-0170-901a-badd882f49b5',0,17019352,'Add','add_brand','panel',1,'2023-12-08 10:49:30','2023-12-08 10:49:30','',1,'::1'),('17020325-7428-9144-b5ce-94cac9114d47',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 10:49:34','2023-12-08 10:49:34','',1,'::1'),('17020348-5008-4988-4371-b90e5bce4f4d',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 11:27:30','2023-12-08 11:27:30','',1,'::1'),('17020349-2406-1484-731f-ef7ab8564f7d',0,17019352,'Add','add_brand','panel',1,'2023-12-08 11:28:44','2023-12-08 11:28:44','',1,'::1'),('17020351-1625-1802-c260-abf0173a4ee1',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 11:31:56','2023-12-08 11:31:56','',1,'::1'),('17020351-2895-5531-c427-871b797b49d8',0,17019352,'Add','add_brand','panel',1,'2023-12-08 11:32:08','2023-12-08 11:32:08','',1,'::1'),('17020355-3833-8596-18a0-8f350bbd4bcc',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 11:38:58','2023-12-08 11:38:58','',1,'::1'),('17020355-5072-8072-f483-78fab65548aa',0,17019352,'Add','add_brand','panel',1,'2023-12-08 11:39:10','2023-12-08 11:39:10','',1,'::1'),('17020357-3833-2975-7cb5-6148d106430c',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 11:42:18','2023-12-08 11:42:18','',1,'::1'),('17020357-5137-2644-f59d-357021b6487b',0,17019352,'Add','add_brand','panel',1,'2023-12-08 11:42:31','2023-12-08 11:42:31','',1,'::1'),('17020365-6288-8672-8aeb-e187c2f048d9',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 11:56:02','2023-12-08 11:56:02','',1,'::1'),('17020365-8907-5379-0f47-ec7d39fb4c66',0,17019352,'Add','add_brand','panel',1,'2023-12-08 11:56:29','2023-12-08 11:56:29','',1,'::1'),('17020366-2672-8003-a4bd-60260ad14625',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 11:57:06','2023-12-08 11:57:06','',1,'::1'),('17020366-3873-6101-591f-bc7e6e2a414c',0,17019352,'Add','add_brand','panel',1,'2023-12-08 11:57:18','2023-12-08 11:57:18','',1,'::1'),('17020367-0976-7601-0414-7c3d52bf4628',0,17019352,'Delete','delete_record','panel',1,'2023-12-08 11:58:29','2023-12-08 11:58:29','',1,'::1'),('17020367-4579-7882-688e-0419de634a2a',0,17019352,'Add','add_brand','panel',1,'2023-12-08 11:59:05','2023-12-08 11:59:05','',1,'::1'),('17020370-6498-3363-ac8a-bdd66efe49b6',0,NULL,'Login','login_user','panel',1,'2023-12-08 12:04:24','2023-12-08 12:04:24','',NULL,'::1'),('17020999-8113-8169-fea8-a516a85142a8',0,NULL,'Login','login_user','panel',1,'2023-12-09 05:33:01','2023-12-09 05:33:01','',NULL,'::1'),('17021060-8599-0308-d612-087f21d74a2b',0,NULL,'Login','login_user','panel',1,'2023-12-09 07:14:45','2023-12-09 07:14:45','',NULL,'::1'),('17022702-8023-2242-70a5-d1d43b164990',0,NULL,'Login','login_user','panel',1,'2023-12-11 04:51:20','2023-12-11 04:51:20','',NULL,'::1'),('17022706-7234-9406-4e0d-4180fbf24758',0,NULL,'Login','login_user','panel',1,'2023-12-11 04:57:52','2023-12-11 04:57:52','',NULL,'::1'),('17022886-5592-0544-b3ec-43aad8024f3d',0,NULL,'Login','login_user','panel',1,'2023-12-11 09:57:35','2023-12-11 09:57:35','',NULL,'::1'),('17022887-3994-4433-f6cb-b1c2a0ff4563',0,17019352,'Add','add_news','panel',1,'2023-12-11 09:58:59','2023-12-11 09:58:59','',1,'::1'),('17022887-8660-9508-59ff-7c728eb747bc',0,17019352,'Add','add_news','panel',1,'2023-12-11 09:59:46','2023-12-11 09:59:46','',1,'::1'),('17023087-9492-2044-760e-b4784cd441f0',0,NULL,'Login','login_user','panel',1,'2023-12-11 15:33:14','2023-12-11 15:33:14','',NULL,'::1'),('17023093-7524-6298-d089-7073ba7846bf',0,NULL,'Login','login_user','panel',1,'2023-12-11 15:42:55','2023-12-11 15:42:55','',NULL,'::1'),('17023589-6409-5906-2b05-78766d464d71',0,NULL,'Login','login_user','panel',1,'2023-12-12 05:29:24','2023-12-12 05:29:24','',NULL,'::1'),('17023595-8175-2336-0f78-57a55c3943e7',0,17019352,'Delete','delete_record','panel',0,'2023-12-12 05:39:41','2023-12-12 05:39:41','',1,'::1'),('17023665-3193-7259-8c7e-ac5fde20429b',0,NULL,'Login','login_user','panel',1,'2023-12-12 07:35:31','2023-12-12 07:35:31','',NULL,'::1'),('17023673-3523-4442-ad82-2d37fcd747ce',0,NULL,'Login','login_user','panel',1,'2023-12-12 07:48:55','2023-12-12 07:48:55','',NULL,'::1'),('17025310-4684-6391-3e8c-53c0a11c4dd2',0,NULL,'Login','login_user','panel',1,'2023-12-14 05:17:26','2023-12-14 05:17:26','',NULL,'::1'),('17025547-9279-9388-38e8-24d039dd4f24',0,NULL,'Login','login_user','panel',1,'2023-12-14 11:53:12','2023-12-14 11:53:12','',NULL,'::1'),('17026555-0704-7415-b856-745e06cf48e8',0,NULL,'Login','login_user','panel',1,'2023-12-15 15:51:47','2023-12-15 15:51:47','',NULL,'::1'),('17027117-1577-3414-c0a8-ddaee99c4c2c',0,NULL,'Login','login_user','panel',1,'2023-12-16 07:28:35','2023-12-16 07:28:35','',NULL,'::1'),('17027162-3540-1586-d8a9-4574937b47f7',0,17019352,'Delete','delete_record','panel',1,'2023-12-16 08:43:55','2023-12-16 08:43:55','',1,'::1'),('17027162-3936-2279-e061-5e3653274465',0,17019352,'Delete','delete_all_record','panel',1,'2023-12-16 08:43:59','2023-12-16 08:43:59','',1,'::1'),('17027162-8798-3678-65c9-c2bf52754afc',0,17019352,'Add','add_news','panel',1,'2023-12-16 08:44:47','2023-12-16 08:44:47','',1,'::1'),('17027168-4766-4176-b555-5da4d7b24781',0,17019352,'Add','add_news','panel',1,'2023-12-16 08:54:07','2023-12-16 08:54:07','',1,'::1'),('17027170-4727-6705-c280-54727ce94e90',0,17019352,'Add','add_news','panel',1,'2023-12-16 08:57:27','2023-12-16 08:57:27','',1,'::1'),('17027174-6643-6817-f841-39699c57461e',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:04:26','2023-12-16 09:04:26','',1,'::1'),('17027174-8535-2046-2e8e-a0b241264d45',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:04:45','2023-12-16 09:04:45','',1,'::1'),('17027175-1196-4435-2e16-1c16b3dc4461',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:05:11','2023-12-16 09:05:11','',1,'::1'),('17027175-6722-4324-cdbf-59ace07e420a',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:06:07','2023-12-16 09:06:07','',1,'::1'),('17027176-3816-9502-b88b-c1a27e1f4b85',0,NULL,'Login','login_user','panel',1,'2023-12-16 09:07:18','2023-12-16 09:07:18','',NULL,'::1'),('17027179-0922-5445-b5a4-ca98fa2e4864',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:11:49','2023-12-16 09:11:49','',1,'::1'),('17027181-5270-8210-3e91-5f3c14d24c0c',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:15:52','2023-12-16 09:15:52','',1,'::1'),('17027183-0493-8203-498f-cf1671d949a6',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:18:24','2023-12-16 09:18:24','',1,'::1'),('17027183-7088-1106-5a16-54caaff14c7e',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:19:30','2023-12-16 09:19:30','',1,'::1'),('17027185-0555-2041-05cb-1d3b904f499c',0,17019352,'Add','add_news','panel',1,'2023-12-16 09:21:45','2023-12-16 09:21:45','',1,'::1'),('17041848-1629-8521-6918-bd7af04e4167',0,NULL,'Login','login_user','panel',1,'2024-01-02 08:40:16','2024-01-02 08:40:16','',NULL,'::1'),('17049618-6584-1887-3704-150cf68445f6',0,NULL,'Login','login_user','panel',1,'2024-01-11 08:31:05','2024-01-11 08:31:05','',NULL,'::1'),('17056523-1370-0444-6306-fe361ea44f7c',0,NULL,'Login','login_user','panel',1,'2024-01-19 08:18:33','2024-01-19 08:18:33','',NULL,'::1'),('17057323-1160-1139-61de-b5f56a56480b',0,NULL,'Login','login_user','panel',1,'2024-01-20 06:31:51','2024-01-20 06:31:51','',NULL,'::1'),('17057549-7656-1444-31fe-d690bb904a3f',0,NULL,'Login','login_user','panel',1,'2024-01-20 12:49:36','2024-01-20 12:49:36','',NULL,'::1'),('17058966-2893-6310-3881-745d4c7f42b8',0,NULL,'Login','login_user','panel',1,'2024-01-22 04:10:28','2024-01-22 04:10:28','',NULL,'::1');

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

insert  into `tbl_menumaster`(`id`,`menuname`,`pagename`) values ('17024612-6799-0841-dfbc-c6f078474330','Brand Master','manage_brand'),('17024613-1815-4677-e481-26bd85c4440c','Cars Master','manage_car'),('17024613-2381-8465-ffdf-d46967d64445','News Master','manage_news'),('17024613-2714-6516-4c0c-e0ea67124fe1','Settings','manage_setting'),('17056532-7595-5867-d06a-323a7a814371','Slider Master','manage_slider'),('17056533-1585-5565-f99d-3797fcca403d','Testimonial Master','manage_testimonial');

/*Table structure for table `tbl_news` */

DROP TABLE IF EXISTS `tbl_news`;

CREATE TABLE `tbl_news` (
  `id` varchar(50) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `news_date` varchar(50) DEFAULT NULL,
  `short_desc` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `main_image` varchar(300) DEFAULT NULL,
  `main_image_data` longtext DEFAULT NULL,
  `entry_uid` varchar(50) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `update_uid` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_news` */

insert  into `tbl_news`(`id`,`title`,`news_date`,`short_desc`,`description`,`main_image`,`main_image_data`,`entry_uid`,`entry_date`,`update_uid`,`update_date`) values ('17057482-1441-4929-c0b7-f848faf04147','Tesla Supercharger network: where can I charge in the UK?','01/01/2024','The Tesla Supercharger network is arguably the blueprint of EV charge point networks. Launch a car (or four - enter the Model S, Model X, Model 3 and Model Y), then give the people somewhere to charge and boom.','This is test description','upload/images/news/17057482-1441-4929-c0b7-f848faf04147/carn2.png','[{\"uuid\":\"e7364016-db7e-45f5-a8f3-59c38baf7f37\",\"name\":\"carn2.png\",\"filename\":\"carn2.png\",\"size\":220528,\"total\":220528,\"bytesSent\":220528,\"url\":\"upload/images/news/17057482-1441-4929-c0b7-f848faf04147/carn2.png\",\"upload\":{\"uuid\":\"e7364016-db7e-45f5-a8f3-59c38baf7f37\",\"name\":\"carn2.png\",\"filename\":\"carn2.png\",\"size\":220528,\"total\":220528,\"bytesSent\":220528,\"url\":\"upload/images/news/17057482-1441-4929-c0b7-f848faf04147/carn2.png\"}}]','17019352-1247-1172-9a37-27852d564b27','2024-01-20 16:26:54',NULL,NULL);

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

insert  into `tbl_slidermaster`(`id`,`title`,`description`,`btntext`,`orderno`,`isactive`,`entry_uid`,`entry_by`,`entry_date`,`update_date`,`update_by`,`update_uid`,`file`,`file_data`) values ('17056616-4318-4218-0eca-c48dd38444c2','Best Ev Car','This is test Description for best EV cars','Buy Now',1,1,'17019352-1247-1172-9a37-27852d564b27',NULL,'2024-01-19 16:24:03',NULL,NULL,NULL,'upload/images/slider/17056616-4318-4218-0eca-c48dd38444c2/bgimage1.png','[{\"uuid\":\"d3473fd9-5044-49ab-848d-7a8bb29993c9\",\"name\":\"bgimage1.png\",\"filename\":\"bgimage1.png\",\"size\":889552,\"total\":889552,\"bytesSent\":889552,\"url\":\"upload/images/slider/17056616-4318-4218-0eca-c48dd38444c2/bgimage1.png\",\"upload\":{\"uuid\":\"d3473fd9-5044-49ab-848d-7a8bb29993c9\",\"name\":\"bgimage1.png\",\"filename\":\"bgimage1.png\",\"size\":889552,\"total\":889552,\"bytesSent\":889552,\"url\":\"upload/images/slider/17056616-4318-4218-0eca-c48dd38444c2/bgimage1.png\"}}]');

/*Table structure for table `tbl_testimonialmaster` */

DROP TABLE IF EXISTS `tbl_testimonialmaster`;

CREATE TABLE `tbl_testimonialmaster` (
  `id` varchar(50) NOT NULL,
  `personname` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `tdate` varchar(50) DEFAULT NULL,
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

insert  into `tbl_testimonialmaster`(`id`,`personname`,`description`,`tdate`,`orderno`,`file`,`file_data`,`isactive`,`entry_uid`,`entry_date`,`update_uid`,`update_date`) values ('17057321-1188-6981-55fe-1b2996f847c5','Priyesh singh','Absolutely love TopShelfBC; affordable on any budget and such fast delivery, straight to my door! I recommend them to all my friends and family for their 420 needs.','20/01/2024',1,'upload/images/testimonial/17057321-1188-6981-55fe-1b2996f847c5/person1.png','[{\"uuid\":\"f4fad5e6-21ad-40f7-8cd0-236a02d6e491\",\"name\":\"person1.png\",\"filename\":\"person1.png\",\"size\":6062,\"total\":6062,\"bytesSent\":6062,\"url\":\"upload/images/testimonial/17057321-1188-6981-55fe-1b2996f847c5/person1.png\",\"upload\":{\"uuid\":\"f4fad5e6-21ad-40f7-8cd0-236a02d6e491\",\"name\":\"person1.png\",\"filename\":\"person1.png\",\"size\":6062,\"total\":6062,\"bytesSent\":6062,\"url\":\"upload/images/testimonial/17057321-1188-6981-55fe-1b2996f847c5/person1.png\"}}]',1,'17019352-1247-1172-9a37-27852d564b27','2024-01-20 11:58:31',NULL,NULL);

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

insert  into `tbl_users`(`id`,`name`,`username`,`password`,`role_id`,`last_logged_in`,`last_login_offset`,`insert_at`,`phone`,`email`,`token`,`otp`) values ('17019352-1247-1172-9a37-27852d564b27','Admin','a','0cc175b9c0f1b6a831c399e269772661','17019350-1059-3172-f8de-9c507e9e4901','2024-01-23 10:13:53','330','2023-02-01 11:49:50',NULL,'admin@admin.com','',386110);
