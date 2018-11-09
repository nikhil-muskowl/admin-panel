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