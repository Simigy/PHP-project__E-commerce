-- Check if the role column exists, if not add it
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `role` VARCHAR(255) DEFAULT 'user' AFTER `email`;

-- Update a specific user to have the admin role
-- Replace 'admin@example.com' with the email of the user you want to make an admin
UPDATE `users` SET `role` = 'admin' WHERE `email` = 'admin@example.com';

-- If you want to update a user by ID instead, uncomment and use this line:
-- UPDATE `users` SET `role` = 'admin' WHERE `id` = 1;
