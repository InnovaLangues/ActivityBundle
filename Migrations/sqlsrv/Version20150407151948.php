<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/04/07 03:19:50
 */
class Version20150407151948 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity (
                id INT IDENTITY NOT NULL, 
                type_id INT, 
                media_type_id INT, 
                activity_sequence_id INT, 
                description VARCHAR(MAX), 
                question VARCHAR(MAX), 
                activity_position INT NOT NULL, 
                date_created DATETIME2(6) NOT NULL, 
                date_updated DATETIME2(6) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FC54C8C93 ON innova_activity (type_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FA49B0ADA ON innova_activity (media_type_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013F967573A2 ON innova_activity (activity_sequence_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                randomlyOrdered BIT NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E19297AD81C06096 ON innova_activity_type_multiple (activity_id) 
            WHERE activity_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple_choices (
                type_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY (type_id, choice_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_2FBB948CC54C8C93 ON innova_activity_type_multiple_choices (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_2FBB948C998666D1 ON innova_activity_type_multiple_choices (choice_id) 
            WHERE choice_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                randomlyOrdered BIT NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_215A48CD81C06096 ON innova_activity_type_unique (activity_id) 
            WHERE activity_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique_choices (
                type_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY (type_id, choice_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_B6753399C54C8C93 ON innova_activity_type_unique_choices (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_B6753399998666D1 ON innova_activity_type_unique_choices (choice_id) 
            WHERE choice_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                randomlyOrdered BIT NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_A1A02AE481C06096 ON innova_activity_type_boolean (activity_id) 
            WHERE activity_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean_choices (
                type_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY (type_id, choice_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_498A9DC5C54C8C93 ON innova_activity_type_boolean_choices (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_498A9DC5998666D1 ON innova_activity_type_boolean_choices (choice_id) 
            WHERE choice_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE innova_activity_answer (
                id INT IDENTITY NOT NULL, 
                user_id INT, 
                activity_id INT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_C0062329A76ED395 ON innova_activity_answer (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_C006232981C06096 ON innova_activity_answer (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_answer_choice (
                answer_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY (answer_id, choice_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_1A88AD60AA334807 ON innova_activity_answer_choice (answer_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_1A88AD60998666D1 ON innova_activity_answer_choice (choice_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_sequence (
                id INT IDENTITY NOT NULL, 
                description VARCHAR(MAX), 
                resourceNode_id INT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CA5D5B00B87FAB32 ON innova_activity_sequence (resourceNode_id) 
            WHERE resourceNode_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_type (
                id INT IDENTITY NOT NULL, 
                category_id INT, 
                name NVARCHAR(255) NOT NULL, 
                class NVARCHAR(100) NOT NULL, 
                form NVARCHAR(100) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_48C5FD2512469DE2 ON innova_activity_available_type (category_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_category (
                id INT IDENTITY NOT NULL, 
                name NVARCHAR(255) NOT NULL, 
                icon NVARCHAR(50) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_functional_instruction (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                media VARCHAR(MAX) NOT NULL, 
                position INT NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_583F550D81C06096 ON innova_activity_prop_functional_instruction (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_media_type (
                id INT IDENTITY NOT NULL, 
                name VARCHAR(MAX) NOT NULL, 
                description VARCHAR(MAX) NOT NULL, 
                template VARCHAR(MAX) NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                media VARCHAR(MAX) NOT NULL, 
                position INT NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_D14D3F5681C06096 ON innova_activity_prop_instruction (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_content (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                media VARCHAR(MAX) NOT NULL, 
                position INT NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_C535F34581C06096 ON innova_activity_prop_content (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INT IDENTITY NOT NULL, 
                media VARCHAR(MAX) NOT NULL, 
                correct_answer VARCHAR(MAX) NOT NULL, 
                position INT NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
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
            DROP CONSTRAINT FK_E19297AD81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            DROP CONSTRAINT FK_215A48CD81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            DROP CONSTRAINT FK_A1A02AE481C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            DROP CONSTRAINT FK_C006232981C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_functional_instruction 
            DROP CONSTRAINT FK_583F550D81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            DROP CONSTRAINT FK_D14D3F5681C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_content 
            DROP CONSTRAINT FK_C535F34581C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            DROP CONSTRAINT FK_2FBB948CC54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            DROP CONSTRAINT FK_B6753399C54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            DROP CONSTRAINT FK_498A9DC5C54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            DROP CONSTRAINT FK_1A88AD60AA334807
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP CONSTRAINT FK_4605013F967573A2
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP CONSTRAINT FK_4605013FC54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_available_type 
            DROP CONSTRAINT FK_48C5FD2512469DE2
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP CONSTRAINT FK_4605013FA49B0ADA
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            DROP CONSTRAINT FK_2FBB948C998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            DROP CONSTRAINT FK_B6753399998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            DROP CONSTRAINT FK_498A9DC5998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            DROP CONSTRAINT FK_1A88AD60998666D1
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