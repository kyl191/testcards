<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Migration_Initial_tables extends Migration {

    public function up() {
        // From http://ellislab.com/forums/viewreply/978554/
        // CI doesn't support foreign keys, so we have to manually issue the query
        // Create the tests table first.
        // Note that we're referencing bf_users - if another prefix is used, this will fail
        $this->db->query('
CREATE TABLE `bf_tests` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
 `description` text NOT NULL,
 `owner` bigint(20) unsigned NOT NULL,
 `image` varchar(255) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `owner` (`owner`),
 CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `bf_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
        
        // Next, do the questions since that depends on the tests
        $this->db->query('
CREATE TABLE `bf_questions` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `parent_test` int(11) NOT NULL,
 `question` text NOT NULL,
 `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 KEY `parent_test` (`parent_test`),
 CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`parent_test`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
        
        // Finally, the answers, since it depends on the questions
        $this->db->query('
CREATE TABLE `bf_answers` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `answer` text NOT NULL,
 `correct` tinyint(1) NOT NULL,
 `parent_question` int(11) NOT NULL,
 `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 KEY `parent_question` (`parent_question`),
 CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`parent_question`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    }
    
    
    //--------------------------------------------------------------------
    
    public function down() 
    {
        $this->load->dbforge();
        
        $this->dbforge->drop_table('answers');
        $this->dbforge->drop_table('questions');
        $this->dbforge->drop_table('tests');
    }
    
    //--------------------------------------------------------------------
    
}
