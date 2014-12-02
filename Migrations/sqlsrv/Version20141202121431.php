<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/12/02 12:14:32
 */
class Version20141202121431 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity (
                id INT IDENTITY NOT NULL, 
                activity_sequence_id INT, 
                name NVARCHAR(255) NOT NULL, 
                description VARCHAR(MAX), 
                activity_position INT NOT NULL, 
                date_created DATETIME2(6) NOT NULL, 
                date_updated DATETIME2(6) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013F967573A2 ON innova_activity (activity_sequence_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_info (
                id INT IDENTITY NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_object (
                id INT IDENTITY NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INT IDENTITY NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_question (
                id INT IDENTITY NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id INT IDENTITY NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
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
            CREATE TABLE innova_activity_type_boolean (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
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
            CREATE TABLE innova_activity_type_unique (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
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
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013F967573A2 FOREIGN KEY (activity_sequence_id) 
            REFERENCES innova_activity_sequence (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            ADD CONSTRAINT FK_CA5D5B00B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
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
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            DROP CONSTRAINT FK_A1A02AE481C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            DROP CONSTRAINT FK_215A48CD81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            DROP CONSTRAINT FK_498A9DC5998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            DROP CONSTRAINT FK_B6753399998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP CONSTRAINT FK_4605013F967573A2
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            DROP CONSTRAINT FK_498A9DC5C54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            DROP CONSTRAINT FK_B6753399C54C8C93
        ");
        $this->addSql("
            DROP TABLE innova_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_info
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_object
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_question
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity_sequence
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_boolean
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_boolean_choices
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_unique
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_unique_choices
        ");
    }
}