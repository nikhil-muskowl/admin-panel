-- categories_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `categories_view`
AS
SELECT t.*,td.language_id,td.title,td.description,td.html,ua.keyword,ua.meta_title,ua.meta_keyword,ua.meta_description FROM categories t
LEFT JOIN category_details td ON td.id=t.id
LEFT JOIN url_alias ua ON ua.language_id=td.language_id AND ua.type_id=t.id AND ua.type='categories';

-- products_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `products_view`
AS
SELECT t.*,td.language_id,td.title,td.description,td.html,ua.keyword,ua.meta_title,ua.meta_keyword,ua.meta_description FROM products t
LEFT JOIN product_details td ON td.id=t.id
LEFT JOIN url_alias ua ON ua.language_id=td.language_id AND ua.type_id=t.id AND ua.type='products';

-- attribute_groups_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `attribute_groups_view`
AS
SELECT t.*,td.language_id,td.title FROM attribute_groups t
LEFT JOIN attribute_group_details td ON td.id=t.id;

-- attributes_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `attributes_view`
AS
SELECT t.*,td.language_id,td.title,agv.title AS group_name FROM attributes t
LEFT JOIN attribute_details td ON td.id=t.id
LEFT JOIN attribute_groups_view agv ON agv.id=t.group_id AND agv.language_id=td.language_id;



-- product_attributes_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `product_attributes_view`
AS
SELECT pa.*,a.group_id,a.sort_order AS attribute_sort_order,ad.title AS attribute,agd.title AS attribute_group,ag.sort_order AS attribute_group_sort_order FROM product_attributes pa
LEFT JOIN attributes a ON a.id=pa.attribute_id
LEFT JOIN attribute_details ad ON ad.id=a.id AND ad.language_id=pa.language_id
LEFT JOIN attribute_groups ag ON ag.id=a.group_id
LEFT JOIN attribute_group_details agd ON agd.id=ag.id AND agd.language_id=pa.language_id;

-- product_wishlists_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `product_wishlists_view`
AS
SELECT pw.*,pd.title AS product_name,pd.language_id,p.image AS product_image,p.banner AS product_banner,u.name AS user_name,u.image AS user_image FROM product_wishlists pw
LEFT JOIN products p ON p.id=pw.product_id
LEFT JOIN product_details pd ON pd.id=pw.product_id
LEFT JOIN users u ON u.id=pw.user_id;

-- product_ratings_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `product_ratings_view`
AS
SELECT t.*,td.language_id,td.title FROM product_ratings t
LEFT JOIN product_rating_details td ON td.id=t.id;

-- product_reviews_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `product_reviews_view`
AS
SELECT pr.*,pd.title AS product,prt.value rating,prtd.title AS rating_text FROM product_reviews pr
LEFT JOIN products p ON p.id=pr.product_id
LEFT JOIN product_details pd ON pd.id=p.id AND pd.language_id=pr.language_id
LEFT JOIN product_ratings prt ON prt.id=pr.rating_id
LEFT JOIN product_rating_details prtd ON prtd.id=prt.id;

