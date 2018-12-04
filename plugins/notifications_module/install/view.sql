-- notifications_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `notifications_view`
AS
SELECT n.*,nd.language_id,nd.title,nd.description FROM notifications n
LEFT JOIN notification_details nd ON nd.id=n.id;

-- user_notifications_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_notifications_view`
AS
SELECT n.*,nd.language_id,nd.title,nd.description,ntu.id AS user_notification_id,ntu.user_id,ntu.is_view FROM notifications n
LEFT JOIN notification_details nd ON nd.id=n.id
LEFT JOIN notification_to_users ntu ON ntu.notification_id=n.id;

-- user_devices_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_devices_view`
AS
SELECT ud.*,u.name AS user_name,u.image AS user_image FROM user_devices ud
LEFT JOIN users u ON u.id=ud.user_id;


-- notification_user_devices_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `notification_user_devices_view`
AS
SELECT ntu.*,ud.provider,ud.type,ud.code FROM notification_to_users ntu
LEFT JOIN user_devices ud ON ud.user_id=ntu.user_id;