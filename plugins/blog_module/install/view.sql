-- blog_types_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `blog_types_view`
AS
SELECT t.*,td.language_id,td.title FROM blog_types t
LEFT JOIN blog_type_details td ON td.id=t.id;

-- blogs_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `blogs_view`
AS
SELECT t.*,td.language_id,td.title,td.description,td.html,u.name AS user_name,u.image AS user_image,ua.keyword,ua.meta_title,ua.meta_keyword,ua.meta_description FROM blogs t
LEFT JOIN blog_details td ON td.id=t.id
LEFT JOIN users u ON u.id=t.user_id
LEFT JOIN url_alias ua ON ua.language_id=td.language_id AND ua.type_id=t.id AND ua.type='blogs';