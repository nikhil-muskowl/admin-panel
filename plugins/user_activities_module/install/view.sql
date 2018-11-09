-- user_activities_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_activities_view`
AS
SELECT ua.*,u.name AS user_name,u.image user_image FROM user_activities ua
LEFT JOIN users u ON u.id=ua.user_id;
