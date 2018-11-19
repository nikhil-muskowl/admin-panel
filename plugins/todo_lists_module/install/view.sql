-- todo_lists_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `todo_lists_view`
AS
SELECT tl.*,u.name AS user_name FROM todo_lists tl
LEFT JOIN users u ON u.id=tl.user_id;