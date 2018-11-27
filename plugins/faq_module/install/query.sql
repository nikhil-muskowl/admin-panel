SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: faq_answers
#

DROP TABLE IF EXISTS `faq_answers`;

CREATE TABLE `faq_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `faq_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `faq_questions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `faq_answers` (`id`, `question_id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 1, 0, 0, '2018-11-27 10:05:09', '2018-11-27 10:05:09');
INSERT INTO `faq_answers` (`id`, `question_id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 2, 1, 0, 0, '2018-11-27 11:35:20', '2018-11-27 11:35:20');
INSERT INTO `faq_answers` (`id`, `question_id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 3, 1, 0, 0, '2018-11-27 11:35:31', '2018-11-27 11:35:31');
INSERT INTO `faq_answers` (`id`, `question_id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 4, 1, 0, 0, '2018-11-27 11:35:41', '2018-11-27 11:35:41');


#
# TABLE STRUCTURE FOR: faq_answer_details
#

DROP TABLE IF EXISTS `faq_answer_details`;

CREATE TABLE `faq_answer_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `faq_answer_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `faq_answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `faq_answer_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `faq_answer_details` (`id`, `language_id`, `text`) VALUES (1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
INSERT INTO `faq_answer_details` (`id`, `language_id`, `text`) VALUES (1, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
INSERT INTO `faq_answer_details` (`id`, `language_id`, `text`) VALUES (2, 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).');
INSERT INTO `faq_answer_details` (`id`, `language_id`, `text`) VALUES (2, 2, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).');
INSERT INTO `faq_answer_details` (`id`, `language_id`, `text`) VALUES (3, 1, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.');
INSERT INTO `faq_answer_details` (`id`, `language_id`, `text`) VALUES (3, 2, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.');
INSERT INTO `faq_answer_details` (`id`, `language_id`, `text`) VALUES (4, 1, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.');
INSERT INTO `faq_answer_details` (`id`, `language_id`, `text`) VALUES (4, 2, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.');


#
# TABLE STRUCTURE FOR: faq_questions
#

DROP TABLE IF EXISTS `faq_questions`;

CREATE TABLE `faq_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `faq_questions` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 0, 0, '2018-11-27 10:04:51', '2018-11-27 10:04:51');
INSERT INTO `faq_questions` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 0, 0, '2018-11-27 11:33:20', '2018-11-27 11:33:20');
INSERT INTO `faq_questions` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 1, 0, 0, '2018-11-27 11:33:28', '2018-11-27 11:33:28');
INSERT INTO `faq_questions` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 1, 0, 0, '2018-11-27 11:33:36', '2018-11-27 11:33:36');


#
# TABLE STRUCTURE FOR: faq_question_details
#

DROP TABLE IF EXISTS `faq_question_details`;

CREATE TABLE `faq_question_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `faq_question_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `faq_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `faq_question_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `faq_question_details` (`id`, `language_id`, `text`) VALUES (1, 1, 'What is Lorem Ipsum?');
INSERT INTO `faq_question_details` (`id`, `language_id`, `text`) VALUES (1, 2, 'What is Lorem Ipsum?');
INSERT INTO `faq_question_details` (`id`, `language_id`, `text`) VALUES (2, 1, 'Why do we use it?');
INSERT INTO `faq_question_details` (`id`, `language_id`, `text`) VALUES (2, 2, 'Why do we use it?');
INSERT INTO `faq_question_details` (`id`, `language_id`, `text`) VALUES (3, 1, 'Where does it come from?');
INSERT INTO `faq_question_details` (`id`, `language_id`, `text`) VALUES (3, 2, 'Where does it come from?');
INSERT INTO `faq_question_details` (`id`, `language_id`, `text`) VALUES (4, 1, 'Where can I get some?');
INSERT INTO `faq_question_details` (`id`, `language_id`, `text`) VALUES (4, 2, 'Where can I get some?');


SET foreign_key_checks = 1;
