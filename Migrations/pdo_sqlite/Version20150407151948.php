<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

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
                id INTEGER NOT NULL, 
                type_id INTEGER DEFAULT NULL, 
                media_type_id INTEGER DEFAULT NULL, 
                activity_sequence_id INTEGER DEFAULT NULL, 
                description CLOB DEFAULT NULL, 
                question CLOB DEFAULT NULL, 
                activity_position INTEGER NOT NULL, 
                date_created DATETIME NOT NULL, 
                date_updated DATETIME NOT NULL, 
                PRIMARY KEY(id)
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
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                randomlyOrdered BOOLEAN NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E19297AD81C06096 ON innova_activity_type_multiple (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple_choices (
                type_id INTEGER NOT NULL, 
                choice_id INTEGER NOT NULL, 
                PRIMARY KEY(type_id, choice_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_2FBB948CC54C8C93 ON innova_activity_type_multiple_choices (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_2FBB948C998666D1 ON innova_activity_type_multiple_choices (choice_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                randomlyOrdered BOOLEAN NOT NULL, 
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
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                randomlyOrdered BOOLEAN NOT NULL, 
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
            CREATE TABLE innova_activity_answer (
                id INTEGER NOT NULL, 
                user_id INTEGER DEFAULT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
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
                answer_id INTEGER NOT NULL, 
                choice_id INTEGER NOT NULL, 
                PRIMARY KEY(answer_id, choice_id)
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
            CREATE TABLE innova_activity_available_type (
                id INTEGER NOT NULL, 
                category_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                class VARCHAR(100) NOT NULL, 
                form VARCHAR(100) NOT NULL, 
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
            CREATE TABLE innova_activity_prop_functional_instruction (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                media CLOB NOT NULL, 
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_583F550D81C06096 ON innova_activity_prop_functional_instruction (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_media_type (
                id INTEGER NOT NULL, 
                name CLOB NOT NULL, 
                description CLOB NOT NULL, 
                template CLOB NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                media CLOB NOT NULL, 
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_D14D3F5681C06096 ON innova_activity_prop_instruction (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_content (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                media CLOB NOT NULL, 
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_C535F34581C06096 ON innova_activity_prop_content (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INTEGER NOT NULL, 
                media CLOB NOT NULL, 
                correct_answer CLOB NOT NULL, 
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
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