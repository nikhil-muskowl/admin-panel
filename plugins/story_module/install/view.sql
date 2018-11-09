-- story_types_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `story_types_view`
AS
SELECT t.*,td.language_id,td.title FROM story_types t
LEFT JOIN story_type_details td ON td.id=t.id;

-- stories_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `stories_view`
AS
SELECT t.*,td.language_id,td.title,td.description,td.html,
(SELECT SUM(sr.likes) FROM story_rankings sr WHERE sr.story_id=t.id) AS likes,
(SELECT SUM(sr.dislikes) FROM story_rankings sr WHERE sr.story_id=t.id) AS dislikes,
(SELECT SUM(sr.likes)-SUM(sr.dislikes) FROM story_rankings sr WHERE sr.story_id=t.id) AS totalLikes,
u.name AS user_name,u.image AS user_image
FROM stories t
LEFT JOIN story_details td ON td.id=t.id
LEFT JOIN users u ON u.id=t.user_id;

-- story_comments_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `story_comments_view`
AS
SELECT sc.*,u.name AS user_name,u.image AS user_image FROM story_comments sc
LEFT JOIN users u ON u.id=sc.user_id;

-- story_complains_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `story_complains_view`
AS
SELECT sc.*,u.name AS user_name,sd.title AS story_title,sm.comment FROM story_complains sc
LEFT JOIN stories s ON s.id=sc.story_id
LEFT JOIN story_details sd ON sd.id=sc.story_id
LEFT JOIN story_comments sm ON sm.id=sc.story_comment_id AND sm.story_id=sc.story_id AND sc.language_id=sc.language_id
LEFT JOIN users u ON u.id=sc.user_id;
