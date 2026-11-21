CREATE TABLE IF NOT EXISTS web_order_stock (
 order_id BIGINT UNSIGNED NOT NULL,
 inventory_id INT NOT NULL,
 quantity INT NOT NULL,
 PRIMARY KEY(order_id,inventory_id),
 FOREIGN KEY(order_id) REFERENCES web_orders(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
