<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/20 02:43:14
 */
class Version20141120144313 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_instruction (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                instructionType INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_qru (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_question (
                activity_id INTEGER NOT NULL, 
                question_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, question_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_E0B871E681C06096 ON innova_activityqru_question (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E0B871E61E27F6BF ON innova_activityqru_question (question_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_object (
                activity_id INTEGER NOT NULL, 
                object_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, object_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_EDAEE2B781C06096 ON innova_activityqru_object (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_EDAEE2B7232D562B ON innova_activityqru_object (object_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_proposition (
                activity_id INTEGER NOT NULL, 
                proposition_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, proposition_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_E15A2F2781C06096 ON innova_activityqru_proposition (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E15A2F27DB96F9E ON innova_activityqru_proposition (proposition_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_instruction (
                activity_id INTEGER NOT NULL, 
                instruction_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, instruction_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_5D2D0D2281C06096 ON innova_activityqru_instruction (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_5D2D0D2262A10F76 ON innova_activityqru_instruction (instruction_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_information (
                activity_id INTEGER NOT NULL, 
                information_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, information_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_FEEF4F781C06096 ON innova_activityqru_information (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_FEEF4F72EF03101 ON innova_activityqru_information (information_id)
        ");
        $this->addSql("
            CREATE TABLE innova_question (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_proposition (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_information (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activity_vf (
                id INTEGER NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_question (
                activity_id INTEGER NOT NULL, 
                question_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, question_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_2EE21F2A81C06096 ON innova_activityvf_question (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_2EE21F2A1E27F6BF ON innova_activityvf_question (question_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_object (
                activity_id INTEGER NOT NULL, 
                object_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, object_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_9DD5D9781C06096 ON innova_activityvf_object (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_9DD5D97232D562B ON innova_activityvf_object (object_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_proposition (
                activity_id INTEGER NOT NULL, 
                proposition_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, proposition_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_92FBE0E81C06096 ON innova_activityvf_proposition (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_92FBE0EDB96F9E ON innova_activityvf_proposition (proposition_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_instruction (
                activity_id INTEGER NOT NULL, 
                instruction_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, instruction_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_B5589C0B81C06096 ON innova_activityvf_instruction (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_B5589C0B62A10F76 ON innova_activityvf_instruction (instruction_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_information (
                activity_id INTEGER NOT NULL, 
                information_id INTEGER NOT NULL, 
                PRIMARY KEY(activity_id, information_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_E79B65DE81C06096 ON innova_activityvf_information (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E79B65DE2EF03101 ON innova_activityvf_information (information_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_object (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE TABLE innova_activitySequence (
                id INTEGER NOT NULL, 
                description CLOB DEFAULT NULL, 
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_D614C342B87FAB32 ON innova_activitySequence (resourceNode_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity_qru
        ");
        $this->addSql("
            DROP TABLE innova_activityqru_question
        ");
        $this->addSql("
            DROP TABLE innova_activityqru_object
        ");
        $this->addSql("
            DROP TABLE innova_activityqru_proposition
        ");
        $this->addSql("
            DROP TABLE innova_activityqru_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activityqru_information
        ");
        $this->addSql("
            DROP TABLE innova_question
        ");
        $this->addSql("
            DROP TABLE innova_activity_proposition
        ");
        $this->addSql("
            DROP TABLE innova_activity_information
        ");
        $this->addSql("
            DROP TABLE innova_activity_vf
        ");
        $this->addSql("
            DROP TABLE innova_activityvf_question
        ");
        $this->addSql("
            DROP TABLE innova_activityvf_object
        ");
        $this->addSql("
            DROP TABLE innova_activityvf_proposition
        ");
        $this->addSql("
            DROP TABLE innova_activityvf_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activityvf_information
        ");
        $this->addSql("
            DROP TABLE innova_activity_object
        ");
        $this->addSql("
            DROP TABLE innova_activitySequence
        ");
    }
}