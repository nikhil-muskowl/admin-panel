-- events_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `events_view`
AS
SELECT t.*,td.language_id,td.title,u.name AS user_name,u.image AS user_image FROM events t
LEFT JOIN event_details td ON td.id=t.id
LEFT JOIN users u ON u.id=t.user_id;
