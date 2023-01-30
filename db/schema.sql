CREATE TABLE `demo_fshn`.`products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `price` INT NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `demo_fshn`.`orders` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` INT NULL,
    `date` DATE NOT NULL,
    PRIMARY KEY (`id`)
);


CREATE TABLE `demo_fshn`.`order_items` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `amount` int NOT NULL,
    `order_id` int,
    `product_id` int,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
);
