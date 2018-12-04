-- services_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `services_view`
AS
SELECT t.*,td.language_id,td.title,td.description,td.html,ua.keyword,ua.meta_title,ua.meta_keyword,ua.meta_description FROM services t
LEFT JOIN service_details td ON td.id=t.id
LEFT JOIN url_alias ua ON ua.language_id=td.language_id AND ua.type_id=t.id AND ua.type='services';