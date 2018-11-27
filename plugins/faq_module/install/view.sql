-- faq_questions_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `faq_questions_view`
AS
SELECT t.*,td.language_id,td.text FROM faq_questions t
LEFT JOIN faq_question_details td ON td.id=t.id;


-- faq_answers_view
CREATE OR REPLACE ALGORITHM = UNDEFINED
VIEW `faq_answers_view`
AS
SELECT t.*,td.language_id,td.text,fqd.text AS question FROM faq_answers t
LEFT JOIN faq_answer_details td ON td.id=t.id
LEFT JOIN faq_question_details fqd ON fqd.id=t.question_id AND fqd.language_id=td.language_id;