-- DATABASE CREATION SQL

# Only Order and Order_Details tables are not created using Migrations but created directly on phpmyadmin since Migrations do not support DEFAULT_TIMESTAMP, the error message is pasted below */
/* Order Table  !!:not created via migration, cause DEFAULT CURRENT_TIMESTAMP not supported
[error: Caused by:
[mysqli_sql_exception]
 */
 /* Order_Details Table  !!:not created via migration, cause DEFAULT CURRENT_TIMESTAMP not supported
[error: Caused by:
[mysqli_sql_exception]
 */

-- Order Table
CREATE TABLE `Order` (
  `order_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `table_number` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT 'Pending',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `composite_key` (`user_id`,`table_number`,`created_at`),
  CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
)

-- Order_Details Table
CREATE TABLE `Order_Details` (
  `order_details_id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `table_number` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int unsigned NOT NULL,
  PRIMARY KEY (`order_details_id`),
  KEY `user_id` (`user_id`,`table_number`,`created_at`),
  KEY `menu_item_id` (`menu_item_id`),
  CONSTRAINT `Order_Details_ibfk_1` FOREIGN KEY (`user_id`, `table_number`, `created_at`) REFERENCES `Order` (`user_id`, `table_number`, `created_at`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Order_Details_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `Menu_Item` (`menu_item_id`) ON DELETE CASCADE ON UPDATE CASCADE
)
