-- user_complains_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_complains_view`
AS
SELECT uc.*,u.name AS user_name,cmb.name AS complain_by_name FROM user_complains uc
LEFT JOIN users u ON u.id=uc.user_id
LEFT JOIN users cmb ON cmb.id=uc.complain_by;