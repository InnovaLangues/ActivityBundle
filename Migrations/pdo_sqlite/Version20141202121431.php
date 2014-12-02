<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/12/02 12:14:31
 */
class Version20141202121431 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity (
                id INTEGER NOT NULL, 
                activity_sequence_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_position INTEGER NOT NULL, 
                date_created DATETIME NOT NULL, 
                date_updated DATETIME NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013F967573A2 ON innova_activity (activity_sequence_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_info (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_object (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_question (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_sequence (
                id INTEGER NOT NULL, 
                description CLOB DEFAULT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CA5D5B00B87FAB32 ON innova_activity_sequence (resourceNode_id)
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
            CREATE TABLE innova_activity_type_boolean_choices (
                type_id INTEGER NOT NULL, 
                choice_id INTEGER NOT NULL, 
                PRIMARY KEY(type_id, choice_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_498A9DC5C54C8C93 ON innova_activity_type_boolean_choices (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_498A9DC5998666D1 ON innova_activity_type_boolean_choices (choice_id)
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
            CREATE TABLE innova_activity_type_unique_choices (
                type_id INTEGER NOT NULL, 
                choice_id INTEGER NOT NULL, 
                PRIMARY KEY(type_id, choice_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_B6753399C54C8C93 ON innova_activity_type_unique_choices (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_B6753399998666D1 ON innova_activity_type_unique_choices (choice_id)
        ");
    }

    public function down(Schema $schema)
    {
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