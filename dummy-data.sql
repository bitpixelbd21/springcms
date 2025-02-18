TRUNCATE TABLE river_faq;
TRUNCATE TABLE river_portfolios;
TRUNCATE TABLE river_testimonial;
TRUNCATE TABLE river_service;
TRUNCATE TABLE river_blog;



INSERT INTO river_faq (question, answer, sort_order, is_published, type, created_at, updated_at) VALUES
('What is the return policy?', 'Our return policy lasts 30 days.', 1, 1, 'general', NOW(), NOW()),
('How can I contact customer service?', 'You can reach us via email or phone.', 2, 1, 'general', NOW(), NOW()),
('Do you offer international shipping?', 'Yes, we ship worldwide.', 3, 1, 'shipping', NOW(), NOW()),
('What payment methods do you accept?', 'We accept Visa, MasterCard, and PayPal.', 4, 1, 'payment', NOW(), NOW()),
('Where can I track my order?', 'You can track your order in the “Order History” section.', 5, 1, 'tracking', NOW(), NOW()),
('Can I change my order after placing it?', 'You can change your order within 24 hours of purchase.', 6, 1, 'order', NOW(), NOW()),
('How do I return an item?', 'To return an item, visit the return page on our website.', 7, 1, 'returns', NOW(), NOW()),
('How do I cancel my order?', 'You can cancel your order before it is shipped.', 8, 1, 'order', NOW(), NOW()),
('What if I received a damaged item?', 'Please contact customer service and we will replace the item.', 9, 1, 'returns', NOW(), NOW()),
('Do you have a loyalty program?', 'Yes, we offer a loyalty program with discounts and rewards.', 10, 1, 'loyalty', NOW(), NOW());


INSERT INTO river_portfolios (title, slug, content, short_desc, icon, image, sort_order, is_published, created_at, updated_at) VALUES
('Portfolio 1', 'portfolio-1', 'Content for portfolio 1', 'Short description for portfolio 1', 'icon1.png', 'image1.jpg', 1, 1, NOW(), NOW()),
('Portfolio 2', 'portfolio-2', 'Content for portfolio 2', 'Short description for portfolio 2', 'icon2.png', 'image2.jpg', 2, 1, NOW(), NOW()),
('Portfolio 3', 'portfolio-3', 'Content for portfolio 3', 'Short description for portfolio 3', 'icon3.png', 'image3.jpg', 3, 1, NOW(), NOW()),
('Portfolio 4', 'portfolio-4', 'Content for portfolio 4', 'Short description for portfolio 4', 'icon4.png', 'image4.jpg', 4, 1, NOW(), NOW()),
('Portfolio 5', 'portfolio-5', 'Content for portfolio 5', 'Short description for portfolio 5', 'icon5.png', 'image5.jpg', 5, 1, NOW(), NOW()),
('Portfolio 6', 'portfolio-6', 'Content for portfolio 6', 'Short description for portfolio 6', 'icon6.png', 'image6.jpg', 6, 1, NOW(), NOW()),
('Portfolio 7', 'portfolio-7', 'Content for portfolio 7', 'Short description for portfolio 7', 'icon7.png', 'image7.jpg', 7, 1, NOW(), NOW()),
('Portfolio 8', 'portfolio-8', 'Content for portfolio 8', 'Short description for portfolio 8', 'icon8.png', 'image8.jpg', 8, 1, NOW(), NOW()),
('Portfolio 9', 'portfolio-9', 'Content for portfolio 9', 'Short description for portfolio 9', 'icon9.png', 'image9.jpg', 9, 1, NOW(), NOW()),
('Portfolio 10', 'portfolio-10', 'Content for portfolio 10', 'Short description for portfolio 10', 'icon10.png', 'image10.jpg', 10, 1, NOW(), NOW());

INSERT INTO river_testimonial (name, image, designation, message, sort_order, is_published, created_at, updated_at) VALUES
('John Doe', 'john.jpg', 'CEO', 'Great service, will use again!', 1, 1, NOW(), NOW()),
('Jane Smith', 'jane.jpg', 'Manager', 'Excellent quality of work and timely delivery.', 2, 1, NOW(), NOW()),
('Mike Johnson', 'mike.jpg', 'Developer', 'Highly recommend this service to others.', 3, 1, NOW(), NOW()),
('Emily Davis', 'emily.jpg', 'Designer', 'Very professional and excellent results.', 4, 1, NOW(), NOW()),
('Rachel Green', 'rachel.jpg', 'Content Creator', 'Amazing experience from start to finish.', 5, 1, NOW(), NOW()),
('Samuel Lee', 'samuel.jpg', 'Marketing Head', 'Fantastic work, will hire again.', 6, 1, NOW(), NOW()),
('Olivia Brown', 'olivia.jpg', 'Product Manager', 'Professional and reliable service.', 7, 1, NOW(), NOW()),
('James Wilson', 'james.jpg', 'Sales Executive', 'Great communication and excellent delivery.', 8, 1, NOW(), NOW()),
('Sarah Taylor', 'sarah.jpg', 'CTO', 'Fantastic results, I’m very satisfied with the work.', 9, 1, NOW(), NOW()),
('Daniel Garcia', 'daniel.jpg', 'Founder', 'The team was efficient, and the product was top-notch.', 10, 1, NOW(), NOW());

INSERT INTO river_service (title, slug, content, short_desc, meta_desc, category_id, author_id, icon, image, sort_order, is_published, created_at, updated_at) VALUES
('Service 1', 'service-1', 'Service 1 content', 'Short description of service 1', 'Meta description for service 1', '1', 'author1', 'icon1.png', 'service1.jpg', 1, 1, NOW(), NOW()),
('Service 2', 'service-2', 'Service 2 content', 'Short description of service 2', 'Meta description for service 2', '2', 'author2', 'icon2.png', 'service2.jpg', 2, 1, NOW(), NOW()),
('Service 3', 'service-3', 'Service 3 content', 'Short description of service 3', 'Meta description for service 3', '3', 'author3', 'icon3.png', 'service3.jpg', 3, 1, NOW(), NOW()),
('Service 4', 'service-4', 'Service 4 content', 'Short description of service 4', 'Meta description for service 4', '4', 'author4', 'icon4.png', 'service4.jpg', 4, 1, NOW(), NOW()),
('Service 5', 'service-5', 'Service 5 content', 'Short description of service 5', 'Meta description for service 5', '5', 'author5', 'icon5.png', 'service5.jpg', 5, 1, NOW(), NOW()),
('Service 6', 'service-6', 'Service 6 content', 'Short description of service 6', 'Meta description for service 6', '6', 'author6', 'icon6.png', 'service6.jpg', 6, 1, NOW(), NOW()),
('Service 7', 'service-7', 'Service 7 content', 'Short description of service 7', 'Meta description for service 7', '7', 'author7', 'icon7.png', 'service7.jpg', 7, 1, NOW(), NOW()),
('Service 8', 'service-8', 'Service 8 content', 'Short description of service 8', 'Meta description for service 8', '8', 'author8', 'icon8.png', 'service8.jpg', 8, 1, NOW(), NOW()),
('Service 9', 'service-9', 'Service 9 content', 'Short description of service 9', 'Meta description for service 9', '9', 'author9', 'icon9.png', 'service9.jpg', 9, 1, NOW(), NOW()),
('Service 10', 'service-10', 'Service 10 content', 'Short description of service 10', 'Meta description for service 10', '10', 'author10', 'icon10.png', 'service10.jpg', 10, 1, NOW(), NOW());

INSERT INTO river_blog (title, content, excerpt, slug, category_id, author_id, image, meta_description, meta_keywords, meta_title, meta_image, is_published, published_at, created_at, updated_at) VALUES
('Blog Post 1', 'Content of the first blog post', 'Excerpt for blog 1', 'blog-post-1', 1, 'author1', 'image1.jpg', 'Meta description for blog 1', 'meta1, blog', 'Meta title for blog 1', 'meta_image1.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 2', 'Content of the second blog post', 'Excerpt for blog 2', 'blog-post-2', 2, 'author2', 'image2.jpg', 'Meta description for blog 2', 'meta2, blog', 'Meta title for blog 2', 'meta_image2.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 3', 'Content of the third blog post', 'Excerpt for blog 3', 'blog-post-3', 3, 'author3', 'image3.jpg', 'Meta description for blog 3', 'meta3, blog', 'Meta title for blog 3', 'meta_image3.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 4', 'Content of the fourth blog post', 'Excerpt for blog 4', 'blog-post-4', 4, 'author4', 'image4.jpg', 'Meta description for blog 4', 'meta4, blog', 'Meta title for blog 4', 'meta_image4.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 5', 'Content of the fifth blog post', 'Excerpt for blog 5', 'blog-post-5', 5, 'author5', 'image5.jpg', 'Meta description for blog 5', 'meta5, blog', 'Meta title for blog 5', 'meta_image5.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 6', 'Content of the sixth blog post', 'Excerpt for blog 6', 'blog-post-6', 6, 'author6', 'image6.jpg', 'Meta description for blog 6', 'meta6, blog', 'Meta title for blog 6', 'meta_image6.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 7', 'Content of the seventh blog post', 'Excerpt for blog 7', 'blog-post-7', 7, 'author7', 'image7.jpg', 'Meta description for blog 7', 'meta7, blog', 'Meta title for blog 7', 'meta_image7.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 8', 'Content of the eighth blog post', 'Excerpt for blog 8', 'blog-post-8', 8, 'author8', 'image8.jpg', 'Meta description for blog 8', 'meta8, blog', 'Meta title for blog 8', 'meta_image8.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 9', 'Content of the ninth blog post', 'Excerpt for blog 9', 'blog-post-9', 9, 'author9', 'image9.jpg', 'Meta description for blog 9', 'meta9, blog', 'Meta title for blog 9', 'meta_image9.jpg', 1, NOW(), NOW(), NOW()),
('Blog Post 10', 'Content of the tenth blog post', 'Excerpt for blog 10', 'blog-post-10', 10, 'author10', 'image10.jpg', 'Meta description for blog 10', 'meta10, blog', 'Meta title for blog 10', 'meta_image10.jpg', 1, NOW(), NOW(), NOW());
