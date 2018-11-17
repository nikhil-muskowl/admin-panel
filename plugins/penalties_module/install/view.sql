-- penalty_reasons_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `penalty_reasons_view`
AS
SELECT t.*,td.language_id,td.title FROM penalty_reasons t
LEFT JOIN penalty_reason_details td ON td.id=t.id;


-- penalties_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `penalties_view`
AS
SELECT p.*,u.name AS user_name,prd.title AS penalty_reason FROM penalties p
LEFT JOIN users u ON u.id=p.user_id
LEFT JOIN penalty_reason_details prd ON prd.id=p.penalty_reason_id AND prd.language_id=p.language_id;