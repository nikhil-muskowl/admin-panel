-- advertisement_types_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `advertisement_types_view`
AS
SELECT t.*,td.language_id,td.title FROM advertisement_types t
LEFT JOIN advertisement_type_details td ON td.id=t.id;

-- advertisements_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `advertisements_view`
AS
SELECT t.*,td.language_id,td.title,td.description,td.html,u.name AS user_name,u.image AS user_image,ua.keyword,ua.meta_title,ua.meta_keyword,ua.meta_description FROM advertisements t
LEFT JOIN advertisement_details td ON td.id=t.id
LEFT JOIN users u ON u.id=t.user_id
LEFT JOIN url_alias ua ON ua.language_id=td.language_id AND ua.type_id=t.id AND ua.type='advertisements';