<?php

namespace Innova\ActivityBundle\Migrations\mysqli;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/24 02:32:38
 */
class Version20141124143237 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_question (
                id INT AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_sequence (
                id INT AUTO_INCREMENT NOT NULL, 
                description LONGTEXT DEFAULT NULL, 
                resourceNode_id INT DEFAULT NULL, 
                UNIQUE INDEX UNIQ_CA5D5B00B87FAB32 (resourceNode_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_vf (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description LONGTEXT DEFAULT NULL, 
                activity_order INT NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_question (
                activity_id INT NOT NULL, 
                question_id INT NOT NULL, 
                INDEX IDX_2EE21F2A81C06096 (activity_id), 
                UNIQUE INDEX UNIQ_2EE21F2A1E27F6BF (question_id), 
                PRIMARY KEY(activity_id, question_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_object (
                activity_id INT NOT NULL, 
                object_id INT NOT NULL, 
                INDEX IDX_9DD5D9781C06096 (activity_id), 
                UNIQUE INDEX UNIQ_9DD5D97232D562B (object_id), 
                PRIMARY KEY(activity_id, object_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_proposition (
                activity_id INT NOT NULL, 
                proposition_id INT NOT NULL, 
                INDEX IDX_92FBE0E81C06096 (activity_id), 
                UNIQUE INDEX UNIQ_92FBE0EDB96F9E (proposition_id), 
                PRIMARY KEY(activity_id, proposition_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_instruction (
                activity_id INT NOT NULL, 
                instruction_id INT NOT NULL, 
                INDEX IDX_B5589C0B81C06096 (activity_id), 
                UNIQUE INDEX UNIQ_B5589C0B62A10F76 (instruction_id), 
                PRIMARY KEY(activity_id, instruction_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_information (
                activity_id INT NOT NULL, 
                information_id INT NOT NULL, 
                INDEX IDX_E79B65DE81C06096 (activity_id), 
                UNIQUE INDEX UNIQ_E79B65DE2EF03101 (information_id), 
                PRIMARY KEY(activity_id, information_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_proposition (
                id INT AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_object (
                id INT AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_information (
                id INT AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_qru (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                description LONGTEXT DEFAULT NULL, 
                activity_order INT NOT NULL, 
                createdDate DATETIME NOT NULL, 
                updatedDate DATETIME NOT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_question (
                activity_id INT NOT NULL, 
                question_id INT NOT NULL, 
                INDEX IDX_E0B871E681C06096 (activity_id), 
                UNIQUE INDEX UNIQ_E0B871E61E27F6BF (question_id), 
                PRIMARY KEY(activity_id, question_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_object (
                activity_id INT NOT NULL, 
                object_id INT NOT NULL, 
                INDEX IDX_EDAEE2B781C06096 (activity_id), 
                UNIQUE INDEX UNIQ_EDAEE2B7232D562B (object_id), 
                PRIMARY KEY(activity_id, object_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_proposition (
                activity_id INT NOT NULL, 
                proposition_id INT NOT NULL, 
                INDEX IDX_E15A2F2781C06096 (activity_id), 
                UNIQUE INDEX UNIQ_E15A2F27DB96F9E (proposition_id), 
                PRIMARY KEY(activity_id, proposition_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_instruction (
                activity_id INT NOT NULL, 
                instruction_id INT NOT NULL, 
                INDEX IDX_5D2D0D2281C06096 (activity_id), 
                UNIQUE INDEX UNIQ_5D2D0D2262A10F76 (instruction_id), 
                PRIMARY KEY(activity_id, instruction_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_information (
                activity_id INT NOT NULL, 
                information_id INT NOT NULL, 
                INDEX IDX_FEEF4F781C06096 (activity_id), 
                UNIQUE INDEX UNIQ_FEEF4F72EF03101 (information_id), 
                PRIMARY KEY(activity_id, information_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_instruction (
                id INT AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                instructionType INT NOT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            ADD CONSTRAINT FK_CA5D5B00B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            ADD CONSTRAINT FK_353CDA7BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activity_sequence (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_question 
            ADD CONSTRAINT FK_2EE21F2A81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_vf (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_question 
            ADD CONSTRAINT FK_2EE21F2A1E27F6BF FOREIGN KEY (question_id) 
            REFERENCES innova_activity_question (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_object 
            ADD CONSTRAINT FK_9DD5D9781C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_vf (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_object 
            ADD CONSTRAINT FK_9DD5D97232D562B FOREIGN KEY (object_id) 
            REFERENCES innova_activity_object (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_proposition 
            ADD CONSTRAINT FK_92FBE0E81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_vf (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_proposition 
            ADD CONSTRAINT FK_92FBE0EDB96F9E FOREIGN KEY (proposition_id) 
            REFERENCES innova_activity_proposition (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_instruction 
            ADD CONSTRAINT FK_B5589C0B81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_vf (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_instruction 
            ADD CONSTRAINT FK_B5589C0B62A10F76 FOREIGN KEY (instruction_id) 
            REFERENCES innova_activity_instruction (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_information 
            ADD CONSTRAINT FK_E79B65DE81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_vf (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_information 
            ADD CONSTRAINT FK_E79B65DE2EF03101 FOREIGN KEY (information_id) 
            REFERENCES innova_activity_information (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            ADD CONSTRAINT FK_913DCE68BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activity_sequence (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_question 
            ADD CONSTRAINT FK_E0B871E681C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_qru (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_question 
            ADD CONSTRAINT FK_E0B871E61E27F6BF FOREIGN KEY (question_id) 
            REFERENCES innova_activity_question (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_object 
            ADD CONSTRAINT FK_EDAEE2B781C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_qru (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_object 
            ADD CONSTRAINT FK_EDAEE2B7232D562B FOREIGN KEY (object_id) 
            REFERENCES innova_activity_object (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_proposition 
            ADD CONSTRAINT FK_E15A2F2781C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_qru (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_proposition 
            ADD CONSTRAINT FK_E15A2F27DB96F9E FOREIGN KEY (proposition_id) 
            REFERENCES innova_activity_proposition (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_instruction 
            ADD CONSTRAINT FK_5D2D0D2281C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_qru (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_instruction 
            ADD CONSTRAINT FK_5D2D0D2262A10F76 FOREIGN KEY (instruction_id) 
            REFERENCES innova_activity_instruction (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_information 
            ADD CONSTRAINT FK_FEEF4F781C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_qru (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_information 
            ADD CONSTRAINT FK_FEEF4F72EF03101 FOREIGN KEY (information_id) 
            REFERENCES innova_activity_information (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activityvf_question 
            DROP FOREIGN KEY FK_2EE21F2A1E27F6BF
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_question 
            DROP FOREIGN KEY FK_E0B871E61E27F6BF
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            DROP FOREIGN KEY FK_353CDA7BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            DROP FOREIGN KEY FK_913DCE68BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_question 
            DROP FOREIGN KEY FK_2EE21F2A81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_object 
            DROP FOREIGN KEY FK_9DD5D9781C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_proposition 
            DROP FOREIGN KEY FK_92FBE0E81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_instruction 
            DROP FOREIGN KEY FK_B5589C0B81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_information 
            DROP FOREIGN KEY FK_E79B65DE81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_proposition 
            DROP FOREIGN KEY FK_92FBE0EDB96F9E
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_proposition 
            DROP FOREIGN KEY FK_E15A2F27DB96F9E
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_object 
            DROP FOREIGN KEY FK_9DD5D97232D562B
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_object 
            DROP FOREIGN KEY FK_EDAEE2B7232D562B
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_information 
            DROP FOREIGN KEY FK_E79B65DE2EF03101
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_information 
            DROP FOREIGN KEY FK_FEEF4F72EF03101
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_question 
            DROP FOREIGN KEY FK_E0B871E681C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_object 
            DROP FOREIGN KEY FK_EDAEE2B781C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_proposition 
            DROP FOREIGN KEY FK_E15A2F2781C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_instruction 
            DROP FOREIGN KEY FK_5D2D0D2281C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_information 
            DROP FOREIGN KEY FK_FEEF4F781C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_instruction 
            DROP FOREIGN KEY FK_B5589C0B62A10F76
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_instruction 
            DROP FOREIGN KEY FK_5D2D0D2262A10F76
        ");
        $this->addSql("
            DROP TABLE innova_activity_question
        ");
        $this->addSql("
            DROP TABLE innova_activity_sequence
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
            DROP TABLE innova_activity_proposition
        ");
        $this->addSql("
            DROP TABLE innova_activity_object
        ");
        $this->addSql("
            DROP TABLE innova_activity_information
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
            DROP TABLE innova_activity_instruction
        ");
    }
}