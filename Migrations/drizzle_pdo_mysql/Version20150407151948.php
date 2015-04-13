<?php

namespace Innova\ActivityBundle\Migrations\drizzle_pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/04/07 03:19:49
 */
class Version20150407151948 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity (
                id INT AUTO_INCREMENT NOT NULL, 
                type_id INT DEFAULT NULL, 
                media_type_id INT DEFAULT NULL, 
                activity_sequence_id INT DEFAULT NULL, 
                description TEXT DEFAULT NULL, 
                question TEXT DEFAULT NULL, 
                activity_position INT NOT NULL, 
                date_created DATETIME NOT NULL, 
                date_updated DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_4605013FC54C8C93 (type_id), 
                INDEX IDX_4605013FA49B0ADA (media_type_id), 
                INDEX IDX_4605013F967573A2 (activity_sequence_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                randomlyOrdered BOOLEAN NOT NULL, 
                PRIMARY KEY(id), 
                UNIQUE INDEX UNIQ_E19297AD81C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple_choices (
                type_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY(type_id, choice_id), 
                INDEX IDX_2FBB948CC54C8C93 (type_id), 
                UNIQUE INDEX UNIQ_2FBB948C998666D1 (choice_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                randomlyOrdered BOOLEAN NOT NULL, 
                PRIMARY KEY(id), 
                UNIQUE INDEX UNIQ_215A48CD81C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique_choices (
                type_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY(type_id, choice_id), 
                INDEX IDX_B6753399C54C8C93 (type_id), 
                UNIQUE INDEX UNIQ_B6753399998666D1 (choice_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                randomlyOrdered BOOLEAN NOT NULL, 
                PRIMARY KEY(id), 
                UNIQUE INDEX UNIQ_A1A02AE481C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean_choices (
                type_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY(type_id, choice_id), 
                INDEX IDX_498A9DC5C54C8C93 (type_id), 
                UNIQUE INDEX UNIQ_498A9DC5998666D1 (choice_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_answer (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT DEFAULT NULL, 
                activity_id INT DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_C0062329A76ED395 (user_id), 
                INDEX IDX_C006232981C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_answer_choice (
                answer_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY(answer_id, choice_id), 
                INDEX IDX_1A88AD60AA334807 (answer_id), 
                INDEX IDX_1A88AD60998666D1 (choice_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_sequence (
                id INT AUTO_INCREMENT NOT NULL, 
                description TEXT DEFAULT NULL, 
                resourceNode_id INT DEFAULT NULL, 
                PRIMARY KEY(id), 
                UNIQUE INDEX UNIQ_CA5D5B00B87FAB32 (resourceNode_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_type (
                id INT AUTO_INCREMENT NOT NULL, 
                category_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                class VARCHAR(100) NOT NULL, 
                form VARCHAR(100) NOT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_48C5FD2512469DE2 (category_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_category (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                icon VARCHAR(50) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_functional_instruction (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                media TEXT NOT NULL, 
                `position` INT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_583F550D81C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_media_type (
                id INT AUTO_INCREMENT NOT NULL, 
                name TEXT NOT NULL, 
                description TEXT NOT NULL, 
                template TEXT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                media TEXT NOT NULL, 
                `position` INT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_D14D3F5681C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_content (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                media TEXT NOT NULL, 
                `position` INT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_C535F34581C06096 (activity_id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INT AUTO_INCREMENT NOT NULL, 
                media TEXT NOT NULL, 
                correct_answer TEXT NOT NULL, 
                `position` INT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FC54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_available_type (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FA49B0ADA FOREIGN KEY (media_type_id) 
            REFERENCES innova_activity_prop_media_type (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013F967573A2 FOREIGN KEY (activity_sequence_id) 
            REFERENCES innova_activity_sequence (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            ADD CONSTRAINT FK_E19297AD81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            ADD CONSTRAINT FK_2FBB948CC54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_type_multiple (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            ADD CONSTRAINT FK_2FBB948C998666D1 FOREIGN KEY (choice_id) 
            REFERENCES innova_activity_prop_choice (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            ADD CONSTRAINT FK_215A48CD81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            ADD CONSTRAINT FK_B6753399C54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_type_unique (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            ADD CONSTRAINT FK_B6753399998666D1 FOREIGN KEY (choice_id) 
            REFERENCES innova_activity_prop_choice (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            ADD CONSTRAINT FK_A1A02AE481C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            ADD CONSTRAINT FK_498A9DC5C54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_type_boolean (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            ADD CONSTRAINT FK_498A9DC5998666D1 FOREIGN KEY (choice_id) 
            REFERENCES innova_activity_prop_choice (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD CONSTRAINT FK_C0062329A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD CONSTRAINT FK_C006232981C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            ADD CONSTRAINT FK_1A88AD60AA334807 FOREIGN KEY (answer_id) 
            REFERENCES innova_activity_answer (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            ADD CONSTRAINT FK_1A88AD60998666D1 FOREIGN KEY (choice_id) 
            REFERENCES innova_activity_prop_choice (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            ADD CONSTRAINT FK_CA5D5B00B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE innova_activity_available_type 
            ADD CONSTRAINT FK_48C5FD2512469DE2 FOREIGN KEY (category_id) 
            REFERENCES innova_activity_available_category (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_functional_instruction 
            ADD CONSTRAINT FK_583F550D81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            ADD CONSTRAINT FK_D14D3F5681C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_content 
            ADD CONSTRAINT FK_C535F34581C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            DROP FOREIGN KEY FK_E19297AD81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            DROP FOREIGN KEY FK_215A48CD81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            DROP FOREIGN KEY FK_A1A02AE481C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            DROP FOREIGN KEY FK_C006232981C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_functional_instruction 
            DROP FOREIGN KEY FK_583F550D81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            DROP FOREIGN KEY FK_D14D3F5681C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_content 
            DROP FOREIGN KEY FK_C535F34581C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            DROP FOREIGN KEY FK_2FBB948CC54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            DROP FOREIGN KEY FK_B6753399C54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            DROP FOREIGN KEY FK_498A9DC5C54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            DROP FOREIGN KEY FK_1A88AD60AA334807
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP FOREIGN KEY FK_4605013F967573A2
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP FOREIGN KEY FK_4605013FC54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_available_type 
            DROP FOREIGN KEY FK_48C5FD2512469DE2
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP FOREIGN KEY FK_4605013FA49B0ADA
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            DROP FOREIGN KEY FK_2FBB948C998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            DROP FOREIGN KEY FK_B6753399998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            DROP FOREIGN KEY FK_498A9DC5998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            DROP FOREIGN KEY FK_1A88AD60998666D1
        ");
        $this->addSql("
            DROP TABLE innova_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_multiple
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_multiple_choices
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_unique
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_unique_choices
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_boolean
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_boolean_choices
        ");
        $this->addSql("
            DROP TABLE innova_activity_answer
        ");
        $this->addSql("
            DROP TABLE innova_activity_answer_choice
        ");
        $this->addSql("
            DROP TABLE innova_activity_sequence
        ");
        $this->addSql("
            DROP TABLE innova_activity_available_type
        ");
        $this->addSql("
            DROP TABLE innova_activity_available_category
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_functional_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_media_type
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_content
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_choice
        ");
    }
}