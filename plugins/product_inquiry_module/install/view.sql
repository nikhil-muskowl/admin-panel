-- p_inquiry_types_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `p_inquiry_types_view`
AS
SELECT t.*,td.language_id,td.title FROM p_inquiry_types t
LEFT JOIN p_inquiry_type_details td ON td.id=t.id;



-- p_inquiries_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `p_inquiries_view`
AS
SELECT pi.*,p.title AS product FROM p_inquiries pi
LEFT JOIN products_view p ON p.id=pi.product_id;