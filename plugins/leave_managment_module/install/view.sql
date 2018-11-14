-- user_leave_authorities_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_leave_authorities_view`
AS
SELECT ula.*,u.name AS user_name,u.email AS user_email,a.name AS author_name,a.email AS author_email FROM user_leave_authorities ula
LEFT JOIN users u ON u.id=ula.user_id
LEFT JOIN users a ON a.id=ula.author_id;

-- holidays_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `holidays_view`
AS
SELECT t.*,td.language_id,td.title FROM holidays t
LEFT JOIN holiday_details td ON td.id=t.id;

-- user_leaves_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `user_leaves_view`
AS
SELECT ul.*,u.name,u.email,u.contact,u.dob,ltd.language_id,ltd.title AS leave_type FROM user_leaves ul
LEFT JOIN users u ON u.id=ul.user_id
LEFT JOIN leave_type_details ltd ON ltd.id=ul.leave_type_id;

-- leave_applications_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `leave_applications_view`
AS
SELECT la.*,u.name AS user_name,lrd.title AS leave_reason,ltd.title AS leave_type,lt.type,lt.value,lt.file FROM leave_applications la
LEFT JOIN users u ON u.id=la.user_id
LEFT JOIN leave_reason_details lrd ON lrd.language_id=la.language_id AND lrd.id=la.leave_reason_id
LEFT JOIN leave_types lt ON lt.id=la.leave_type_id
LEFT JOIN leave_type_details ltd ON ltd.language_id=la.language_id AND ltd.id=la.leave_type_id;

-- leave_reasons_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `leave_reasons_view`
AS
SELECT t.*,td.language_id,td.title FROM leave_reasons t
LEFT JOIN leave_reason_details td ON td.id=t.id;

-- leave_types_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `leave_types_view`
AS
SELECT t.*,td.language_id,td.title FROM leave_types t
LEFT JOIN leave_type_details td ON td.id=t.id;

