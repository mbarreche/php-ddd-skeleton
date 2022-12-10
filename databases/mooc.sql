CREATE TABLE `courses` (
  `id` CHAR(36) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `duration` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
    `id` CHAR(36) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` CHAR(60) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT user_email UNIQUE (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;