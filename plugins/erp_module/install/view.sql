-- user_authorities_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_authorities_view`
AS
SELECT ula.*,u.name AS user_name,u.email AS user_email,a.name AS author_name,a.email AS author_email FROM user_authorities ula
LEFT JOIN users u ON u.id=ula.user_id
LEFT JOIN users a ON a.id=ula.author_id;
