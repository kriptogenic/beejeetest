CREATE TABLE `tasks` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `text` TEXT NOT NULL,
    `status` TINYINT(4) NOT NULL DEFAULT '0',
    `edited` TINYINT(4) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`) USING BTREE
)
    COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
