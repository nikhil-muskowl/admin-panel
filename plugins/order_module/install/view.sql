-- carts_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `carts_view`
AS
SELECT pw.*,
pd.title AS product_name,pd.language_id,p.image AS product_image,p.banner AS product_banner,
p.model,p.price,
u.name AS user_name,u.image AS user_image FROM carts pw
LEFT JOIN products p ON p.id=pw.product_id
LEFT JOIN product_details pd ON pd.id=pw.product_id
LEFT JOIN users u ON u.id=pw.user_id;