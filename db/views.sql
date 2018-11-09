-- genders_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `genders_view`
AS
SELECT t.*,td.language_id,td.title,td.description,td.html FROM genders t
LEFT JOIN gender_details td ON td.id=t.id;

-- followers_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `followers_view`
AS
SELECT fr.*,u.name AS user_name,u.image AS user_image,f.name AS current_user_name,f.image AS current_user_image FROM followers fr 
LEFT JOIN users u ON u.id=fr.user_id
LEFT JOIN users f ON f.id=fr.current_user_id;

-- user_groups_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_groups_view`
AS
SELECT t.*,td.language_id,td.title FROM user_groups t
LEFT JOIN user_group_details td ON td.id=t.id;

-- user_complains_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_complains_view`
AS
SELECT uc.*,u.name AS user_name,cmb.name AS complain_by_name FROM user_complains uc
LEFT JOIN users u ON u.id=uc.user_id
LEFT JOIN users cmb ON cmb.id=uc.complain_by;