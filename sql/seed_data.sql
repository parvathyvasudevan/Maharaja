-- Seed Data for Maharaja Supermarket
-- Categories
INSERT INTO `categories` (`name_en`, `name_ro`, `slug`, `image`) VALUES
('Fresh Vegetables', 'Legume Proaspete', 'fresh-vegetables', 'FRESH-VEGETABLES_v=1747988196.png'),
('Fruits', 'Fructe', 'fruits', 'Fruits_v=1747988196.png'),
('Dairy & Eggs', 'Lactate și Ouă', 'dairy-eggs', 'amullogo2_v=1750158970.png'),
('Spices & Pickles', 'Condimente și Murături', 'spices-pickles', 'Indian-Breakfast_v=1750153834.jpg'),
('Grains & Pulses', 'Cereale și Leguminoase', 'grains-pulses', 'pulses-and-lentils_v=1750153680.jpg');

-- Products
INSERT INTO `products` (`category_id`, `title_en`, `title_ro`, `description_en`, `description_ro`, `price`, `image`, `stock`, `is_featured`, `sku`) VALUES
(1, 'Fresh Okra (250g)', 'Bamia Proaspătă (250g)', 'High quality fresh okra from local farms.', 'Bamia proaspătă de înaltă calitate de la ferme locale.', 6.49, 'FreshOkra_600x400_v=1728243454.jpg', 50, 1, 'OKRA-001'),
(1, 'Green Chilli (200g)', 'Ardei Iute Verde (200g)', 'Spicy fresh green chillies.', 'Ardei iuți verzi proaspeți și picanți.', 4.99, 'green-chilli-200-g-product-images_v=1747139257.webp', 100, 1, 'GCH-002'),
(4, 'Shan Memoni Biryani Masala', 'Shan Memoni Biryani Masala', 'Traditional biryani spice mix for authentic taste.', 'Amestec tradițional de condimente pentru biryani pentru un gust autentic.', 12.99, 'Shan_Memoni_Mutton_Biryani_Masala_v=1749653530.webp', 75, 1, 'SHAN-BIR-003'),
(4, 'Mother''s Tomato Pickle', 'Murături de Roșii de la Mama', 'Authentic Indian tomato pickle.', 'Murături autentice de roșii indiene.', 18.50, 'mothers_tomato_pickle_600x400_v=1765541169.webp', 30, 0, 'MP-TOM-004'),
(5, 'Amira Basmati Rice (1kg)', 'Orez Basmati Amira (1kg)', 'Long grain aromatic basmati rice.', 'Orez basmati aromat cu bob lung.', 22.00, 'Rice_AdobeStock_v=1750153126.jpg', 200, 1, 'AMIRA-BR-005'),
(3, 'Amul Butter (500g)', 'Unt Amul (500g)', 'Pure milk butter from Amul.', 'Unt de lapte pur de la Amul.', 35.00, 'amul500-removebg-preview_v=1750158971.png', 20, 1, 'AMUL-B-500');

-- Admins (password is 'admin123' hashed)
INSERT INTO `admins` (`username`, `password`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
