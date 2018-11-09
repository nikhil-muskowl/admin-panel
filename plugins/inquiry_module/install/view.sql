-- inquiry_types_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `inquiry_types_view`
AS
SELECT t.*,td.language_id,td.title FROM inquiry_types t
LEFT JOIN inquiry_type_details td ON td.id=t.id;