SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: banners
#

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `banners` (`id`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'upload/images/08c36d761dc3ef60fdead45ca8e07e0a.jpg', 'upload/images/3134e6bf77e2aa115b699f90458a321f.jpg', 1, 0, 0, '2018-08-07 15:13:49', '2018-08-07 15:31:13');
INSERT INTO `banners` (`id`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'upload/images/3134e6bf77e2aa115b699f90458a321f_1.jpg', 'upload/images/868386b16cb26558136de91c80bbcf57.jpg', 1, 0, 0, '2018-08-07 15:33:11', '2018-08-08 09:39:19');


#
# TABLE STRUCTURE FOR: banner_details
#

DROP TABLE IF EXISTS `banner_details`;

CREATE TABLE `banner_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `banner_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `banners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `banner_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `banner_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '');
INSERT INTO `banner_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'Lorem Ipsum क्या है?', 'Lorem Ipsum प्रिंटिंग और टाइपसेटिंग उद्योग के बस डमी पाठ है। Lorem Ipsum 1500 के दशक के बाद से उद्योग के मानक डमी पाठ रहा है, जब एक अज्ञात प्रिंटर ने एक प्रकार की गैली ली और इसे एक प्रकार की नमूना किताब बनाने के लिए स्कैम्बल किया। यह न केवल पांच शताब्दियों तक जीवित रहा है, बल्कि इलेक्ट्रॉनिक टाइपसेटिंग में भी छलांग है, जो अनिवार्य रूप से अपरिवर्तित बनी हुई है। इसे 1 9 60 के दशक में लोरमेट इप्सम मार्गों वाले लेट्रसेट शीट्स के रिलीज के साथ लोकप्रिय किया गया था, और हाल ही में डेस्कटॉप प्रकाशन सॉफ्टवेयर जैसे एल्डस पेजमेकर के साथ लॉरम इप्सम के संस्करण भी शामिल थे।', '');
INSERT INTO `banner_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '');
INSERT INTO `banner_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'हम इसका उपयोग क्यों करते हैं?', 'यह एक लंबे समय से स्थापित तथ्य है कि एक पाठक अपने लेआउट को देखते समय किसी पृष्ठ की पठनीय सामग्री से विचलित हो जाएगा। लोरम इप्सम का उपयोग करने का मुद्दा यह है कि इसमें \'सामग्री यहां, यहां सामग्री\' का उपयोग करने के विरोध में अक्षरों का कम से कम सामान्य वितरण होता है, जो इसे पठनीय अंग्रेजी जैसा दिखता है। कई डेस्कटॉप प्रकाशन पैकेज और वेब पेज संपादक अब लोरम इप्सम का उपयोग अपने डिफ़ॉल्ट मॉडल टेक्स्ट के रूप में करते हैं, और \'लोरेम इप्सम\' की खोज से कई वेब साइटें अभी भी अपने बचपन में उजागर हो जाएंगी। कई संस्करण वर्षों से विकसित हुए हैं, कभी-कभी दुर्घटना से, कभी-कभी उद्देश्य (इंजेक्शन हास्य और इसी तरह) पर।', '');


SET foreign_key_checks = 1;
