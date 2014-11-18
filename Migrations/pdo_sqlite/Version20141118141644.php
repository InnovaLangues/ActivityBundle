<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/18 02:16:45
 */
class Version20141118141644 extends AbstractMigration
{
    public function up(Schema $schema)
    {
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
            DROP INDEX IDX_DA7D23D581C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_instruction AS 
            SELECT id, 
            title, 
            instructionType 
            FROM innova_instruction
        ");
        $this->addSql("
            DROP TABLE innova_instruction
        ");
        $this->addSql("
            CREATE TABLE innova_instruction (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                instructionType INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_instruction (id, title, instructionType) 
            SELECT id, 
            title, 
            instructionType 
            FROM __temp__innova_instruction
        ");
        $this->addSql("
            DROP TABLE __temp__innova_instruction
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activityQru AS 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM innova_activityQru
        ");
        $this->addSql("
            DROP TABLE innova_activityQru
        ");
        $this->addSql("
            CREATE TABLE innova_activityQru (
                id INTEGER NOT NULL, 
                author_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_E91F6477BF396750 FOREIGN KEY (id) 
                REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_E91F6477F675F31B FOREIGN KEY (author_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activityQru (
                id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activityQru
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activityQru
        ");
        $this->addSql("
            CREATE INDEX IDX_E91F6477F675F31B ON innova_activityQru (author_id)
        ");
        $this->addSql("
            DROP INDEX IDX_5C86412B81C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_question AS 
            SELECT id, 
            title 
            FROM innova_question
        ");
        $this->addSql("
            DROP TABLE innova_question
        ");
        $this->addSql("
            CREATE TABLE innova_question (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_question (id, title) 
            SELECT id, 
            title 
            FROM __temp__innova_question
        ");
        $this->addSql("
            DROP TABLE __temp__innova_question
        ");
        $this->addSql("
            DROP INDEX IDX_660A01D081C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_proposition AS 
            SELECT id, 
            title 
            FROM innova_proposition
        ");
        $this->addSql("
            DROP TABLE innova_proposition
        ");
        $this->addSql("
            CREATE TABLE innova_proposition (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_proposition (id, title) 
            SELECT id, 
            title 
            FROM __temp__innova_proposition
        ");
        $this->addSql("
            DROP TABLE __temp__innova_proposition
        ");
        $this->addSql("
            DROP INDEX IDX_88BEDA0081C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_information AS 
            SELECT id, 
            title 
            FROM innova_information
        ");
        $this->addSql("
            DROP TABLE innova_information
        ");
        $this->addSql("
            CREATE TABLE innova_information (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_information (id, title) 
            SELECT id, 
            title 
            FROM __temp__innova_information
        ");
        $this->addSql("
            DROP TABLE __temp__innova_information
        ");
        $this->addSql("
            DROP INDEX IDX_263070EFA76ED395
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activityVf AS 
            SELECT id, 
            user_id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM innova_activityVf
        ");
        $this->addSql("
            DROP TABLE innova_activityVf
        ");
        $this->addSql("
            CREATE TABLE innova_activityVf (
                id INTEGER NOT NULL, 
                author_id INTEGER DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_263070EFBF396750 FOREIGN KEY (id) 
                REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_263070EFF675F31B FOREIGN KEY (author_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activityVf (
                id, author_id, name, description, activity_order, 
                createdDate, updatedDate
            ) 
            SELECT id, 
            user_id, 
            name, 
            description, 
            activity_order, 
            createdDate, 
            updatedDate 
            FROM __temp__innova_activityVf
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activityVf
        ");
        $this->addSql("
            CREATE INDEX IDX_263070EFF675F31B ON innova_activityVf (author_id)
        ");
        $this->addSql("
            DROP INDEX IDX_3635428A81C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_object AS 
            SELECT id, 
            title 
            FROM innova_object
        ");
        $this->addSql("
            DROP TABLE innova_object
        ");
        $this->addSql("
            CREATE TABLE innova_object (
                id INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_object (id, title) 
            SELECT id, 
            title 
            FROM __temp__innova_object
        ");
        $this->addSql("
            DROP TABLE __temp__innova_object
        ");
    }

    public function down(Schema $schema)
    {
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
            DROP INDEX IDX_E91F6477F675F31B
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activityQru AS 
            SELECT id, 
            createdDate, 
            updatedDate, 
            name, 
            description, 
            activity_order 
            FROM innova_activityQru
        ");
        $this->addSql("
            DROP TABLE innova_activityQru
        ");
        $this->addSql("
            CREATE TABLE innova_activityQru (
                id INTEGER NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_activityQru (
                id, createdDate, updatedDate, name, 
                description, activity_order
            ) 
            SELECT id, 
            createdDate, 
            updatedDate, 
            name, 
            description, 
            activity_order 
            FROM __temp__innova_activityQru
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activityQru
        ");
        $this->addSql("
            DROP INDEX IDX_263070EFF675F31B
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activityVf AS 
            SELECT id, 
            author_id, 
            createdDate, 
            updatedDate, 
            name, 
            description, 
            activity_order 
            FROM innova_activityVf
        ");
        $this->addSql("
            DROP TABLE innova_activityVf
        ");
        $this->addSql("
            CREATE TABLE innova_activityVf (
                id INTEGER NOT NULL, 
                user_id INTEGER DEFAULT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order INTEGER NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_263070EFA76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activityVf (
                id, user_id, createdDate, updatedDate, 
                name, description, activity_order
            ) 
            SELECT id, 
            author_id, 
            createdDate, 
            updatedDate, 
            name, 
            description, 
            activity_order 
            FROM __temp__innova_activityVf
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activityVf
        ");
        $this->addSql("
            CREATE INDEX IDX_263070EFA76ED395 ON innova_activityVf (user_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_information AS 
            SELECT id, 
            title 
            FROM innova_information
        ");
        $this->addSql("
            DROP TABLE innova_information
        ");
        $this->addSql("
            CREATE TABLE innova_information (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_88BEDA0081C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_information (id, title) 
            SELECT id, 
            title 
            FROM __temp__innova_information
        ");
        $this->addSql("
            DROP TABLE __temp__innova_information
        ");
        $this->addSql("
            CREATE INDEX IDX_88BEDA0081C06096 ON innova_information (activity_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_instruction AS 
            SELECT id, 
            title, 
            instructionType 
            FROM innova_instruction
        ");
        $this->addSql("
            DROP TABLE innova_instruction
        ");
        $this->addSql("
            CREATE TABLE innova_instruction (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                instructionType INTEGER NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_DA7D23D581C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_instruction (id, title, instructionType) 
            SELECT id, 
            title, 
            instructionType 
            FROM __temp__innova_instruction
        ");
        $this->addSql("
            DROP TABLE __temp__innova_instruction
        ");
        $this->addSql("
            CREATE INDEX IDX_DA7D23D581C06096 ON innova_instruction (activity_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_object AS 
            SELECT id, 
            title 
            FROM innova_object
        ");
        $this->addSql("
            DROP TABLE innova_object
        ");
        $this->addSql("
            CREATE TABLE innova_object (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_3635428A81C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_object (id, title) 
            SELECT id, 
            title 
            FROM __temp__innova_object
        ");
        $this->addSql("
            DROP TABLE __temp__innova_object
        ");
        $this->addSql("
            CREATE INDEX IDX_3635428A81C06096 ON innova_object (activity_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_proposition AS 
            SELECT id, 
            title 
            FROM innova_proposition
        ");
        $this->addSql("
            DROP TABLE innova_proposition
        ");
        $this->addSql("
            CREATE TABLE innova_proposition (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_660A01D081C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_proposition (id, title) 
            SELECT id, 
            title 
            FROM __temp__innova_proposition
        ");
        $this->addSql("
            DROP TABLE __temp__innova_proposition
        ");
        $this->addSql("
            CREATE INDEX IDX_660A01D081C06096 ON innova_proposition (activity_id)
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_question AS 
            SELECT id, 
            title 
            FROM innova_question
        ");
        $this->addSql("
            DROP TABLE innova_question
        ");
        $this->addSql("
            CREATE TABLE innova_question (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_5C86412B81C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_question (id, title) 
            SELECT id, 
            title 
            FROM __temp__innova_question
        ");
        $this->addSql("
            DROP TABLE __temp__innova_question
        ");
        $this->addSql("
            CREATE INDEX IDX_5C86412B81C06096 ON innova_question (activity_id)
        ");
    }
}