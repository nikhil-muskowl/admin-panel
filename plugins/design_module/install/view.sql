-- banners_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `banners_view`
AS
SELECT t.*,td.language_id,td.title,td.description,td.html FROM banners t
LEFT JOIN banner_details td ON td.id=t.id;