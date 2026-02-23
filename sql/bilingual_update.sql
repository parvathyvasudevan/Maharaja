-- Run these commands in phpMyAdmin to update your schema for EN/RO support

-- Update categories table
ALTER TABLE categories 
CHANGE COLUMN name name_en VARCHAR(100),
ADD COLUMN name_ro VARCHAR(100) AFTER name_en;

-- Update products table
ALTER TABLE products 
CHANGE COLUMN title title_en VARCHAR(255),
ADD COLUMN title_ro VARCHAR(255) AFTER title_en,
CHANGE COLUMN description description_en TEXT,
ADD COLUMN description_ro TEXT AFTER description_en;

-- Update customers table (to store preferred language)
ALTER TABLE customers 
ADD COLUMN preferred_lang ENUM('en', 'ro') DEFAULT 'en' AFTER phone;
