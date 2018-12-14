-- zones_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `zones_view`
AS
SELECT z.*,c.name AS country FROM zones z
LEFT JOIN countries c ON c.id=z.country_id;

-- addresses_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `addresses_view`
AS
SELECT a.*,u.name AS user,c.name AS country,z.name AS zone FROM addresses a
LEFT JOIN users u ON u.id=a.user_id
LEFT JOIN countries c ON c.id=a.country_id
LEFT JOIN zones z ON z.id=a.zone_id;