-- pets_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `pets_view`
AS
SELECT p.*,pd.language_id,pd.title,pd.description FROM pets p
LEFT JOIN pet_details pd ON pd.id=p.id;


-- user_pets_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_pets_view`
AS
SELECT up.*,
u.name AS user_name,
pd.language_id,pd.title AS pet_name,pd.description AS pet_description,pl.points AS pet_points,pl.image AS pet_image FROM user_pets up
LEFT JOIN users u ON u.id=up.user_id
LEFT JOIN pets p ON p.id=up.pet_id
LEFT JOIN pet_details pd ON pd.id=up.pet_id
LEFT JOIN pet_levels pl ON pl.pet_id=up.pet_id AND pl.level=up.level;


-- pet_levels_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `pet_levels_view`
AS
SELECT pl.*,pd.language_id,pd.title,pd.description FROM pet_levels pl
LEFT JOIN pets p ON p.id=pl.pet_id
LEFT JOIN pet_details pd ON pd.id=pl.pet_id;

-- user_pet_points_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_pet_points_view`
AS
SELECT upp.*,u.name AS user_name,u.image AS user_image,u.email AS user_email FROM user_pet_points upp
LEFT JOIN users u ON u.id=upp.user_id;