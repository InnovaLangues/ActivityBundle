<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/02/23 10:28:22
 */
class Version20150223102821 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity (
                id INTEGER NOT NULL, 
                type_id INTEGER DEFAULT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FC54C8C93 ON innova_activity (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_4605013FB87FAB32 ON innova_activity (resourceNode_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E19297AD81C06096 ON innova_activity_type_multiple (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_215A48CD81C06096 ON innova_activity_type_unique (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_A1A02AE481C06096 ON innova_activity_type_boolean (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_type (
                id INTEGER NOT NULL, 
                category_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                class VARCHAR(100) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_48C5FD2512469DE2 ON innova_activity_available_type (category_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_category (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                icon VARCHAR(50) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INTEGER NOT NULL, 
                media CLOB NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DROP INDEX UNIQ_2FBB948C998666D1
        ");
        $this->addSql("
            DROP INDEX IDX_2FBB948CC54C8C93
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_type_multiple_choices AS 
            SELECT type_id, 
            choice_id 
            FROM innova_activity_type_multiple_choices
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_multiple_choices
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple_choices (
                type_id INTEGER NOT NULL, 
                choice_id INTEGER NOT NULL, 
                PRIMARY KEY(type_id, choice_id), 
                CONSTRAINT FK_2FBB948CC54C8C93 FOREIGN KEY (type_id) 
                REFERENCES innova_activity_type_multiple (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_2FBB948C998666D1 FOREIGN KEY (choice_id) 
                REFERENCES innova_activity_prop_choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_type_multiple_choices (type_id, choice_id) 
            SELECT type_id, 
            choice_id 
            FROM __temp__innova_activity_type_multiple_choices
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_type_multiple_choices
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_2FBB948C998666D1 ON innova_activity_type_multiple_choices (choice_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_2FBB948CC54C8C93 ON innova_activity_type_multiple_choices (type_id)
        ");
        $this->addSql("
            DROP INDEX UNIQ_B6753399998666D1
        ");
        $this->addSql("
            DROP INDEX IDX_B6753399C54C8C93
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_type_unique_choices AS 
            SELECT type_id, 
            choice_id 
            FROM innova_activity_type_unique_choices
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_unique_choices
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique_choices (
                type_id INTEGER NOT NULL, 
                choice_id INTEGER NOT NULL, 
                PRIMARY KEY(type_id, choice_id), 
                CONSTRAINT FK_B6753399C54C8C93 FOREIGN KEY (type_id) 
                REFERENCES innova_activity_type_unique (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_B6753399998666D1 FOREIGN KEY (choice_id) 
                REFERENCES innova_activity_prop_choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_type_unique_choices (type_id, choice_id) 
            SELECT type_id, 
            choice_id 
            FROM __temp__innova_activity_type_unique_choices
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_type_unique_choices
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_B6753399998666D1 ON innova_activity_type_unique_choices (choice_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_B6753399C54C8C93 ON innova_activity_type_unique_choices (type_id)
        ");
        $this->addSql("
            DROP INDEX UNIQ_498A9DC5998666D1
        ");
        $this->addSql("
            DROP INDEX IDX_498A9DC5C54C8C93
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_type_boolean_choices AS 
            SELECT type_id, 
            choice_id 
            FROM innova_activity_type_boolean_choices
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_boolean_choices
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean_choices (
                type_id INTEGER NOT NULL, 
                choice_id INTEGER NOT NULL, 
                PRIMARY KEY(type_id, choice_id), 
                CONSTRAINT FK_498A9DC5C54C8C93 FOREIGN KEY (type_id) 
                REFERENCES innova_activity_type_boolean (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_498A9DC5998666D1 FOREIGN KEY (choice_id) 
                REFERENCES innova_activity_prop_choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_type_boolean_choices (type_id, choice_id) 
            SELECT type_id, 
            choice_id 
            FROM __temp__innova_activity_type_boolean_choices
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_type_boolean_choices
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_498A9DC5998666D1 ON innova_activity_type_boolean_choices (choice_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_498A9DC5C54C8C93 ON innova_activity_type_boolean_choices (type_id)
        ");
        $this->addSql("
            DROP INDEX IDX_D14D3F56FCAFE5CF
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_instruction AS 
            SELECT id, 
            id_activity, 
            title 
            FROM innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_instruction
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id INTEGER NOT NULL, 
                id_activity INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_D14D3F56FCAFE5CF FOREIGN KEY (id_activity) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_instruction (id, id_activity, title) 
            SELECT id, 
            id_activity, 
            title 
            FROM __temp__innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_instruction
        ");
        $this->addSql("
            CREATE INDEX IDX_D14D3F56FCAFE5CF ON innova_activity_prop_instruction (id_activity)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_multiple
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_unique
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_boolean
        ");
        $this->addSql("
            DROP TABLE innova_activity_available_type
        ");
        $this->addSql("
            DROP TABLE innova_activity_available_category
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_choice
        ");
    }
}