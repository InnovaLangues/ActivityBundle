<?php

namespace Innova\ActivityBundle\Migrations\oci8;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/20 02:43:15
 */
class Version20141120144313 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_instruction (
                id NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                instructionType NUMBER(10) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_INSTRUCTION' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_INSTRUCTION ADD CONSTRAINT INNOVA_ACTIVITY_INSTRUCTION_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_INSTRUCTION_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_INSTRUCTION_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_INSTRUCTION FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_INSTRUCTION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_INSTRUCTION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_INSTRUCTION_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_INSTRUCTION_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_qru (
                id NUMBER(10) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order NUMBER(10) NOT NULL, 
                createdDate TIMESTAMP(0) NOT NULL, 
                updatedDate TIMESTAMP(0) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_QRU' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_QRU ADD CONSTRAINT INNOVA_ACTIVITY_QRU_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_QRU_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_QRU_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_QRU FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_QRU_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_QRU_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_QRU_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_QRU_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activityqru_question (
                activity_id NUMBER(10) NOT NULL, 
                question_id NUMBER(10) NOT NULL, 
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
                activity_id NUMBER(10) NOT NULL, 
                object_id NUMBER(10) NOT NULL, 
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
                activity_id NUMBER(10) NOT NULL, 
                proposition_id NUMBER(10) NOT NULL, 
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
                activity_id NUMBER(10) NOT NULL, 
                instruction_id NUMBER(10) NOT NULL, 
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
                activity_id NUMBER(10) NOT NULL, 
                information_id NUMBER(10) NOT NULL, 
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
                id NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_QUESTION' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_QUESTION ADD CONSTRAINT INNOVA_QUESTION_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_QUESTION_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_QUESTION_AI_PK BEFORE INSERT ON INNOVA_QUESTION FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_QUESTION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_QUESTION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_QUESTION_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_QUESTION_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_proposition (
                id NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_PROPOSITION' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_PROPOSITION ADD CONSTRAINT INNOVA_ACTIVITY_PROPOSITION_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_PROPOSITION_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_PROPOSITION_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_PROPOSITION FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_PROPOSITION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_PROPOSITION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_PROPOSITION_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_PROPOSITION_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_information (
                id NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_INFORMATION' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_INFORMATION ADD CONSTRAINT INNOVA_ACTIVITY_INFORMATION_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_INFORMATION_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_INFORMATION_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_INFORMATION FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_INFORMATION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_INFORMATION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_INFORMATION_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_INFORMATION_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_vf (
                id NUMBER(10) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                activity_order NUMBER(10) NOT NULL, 
                createdDate TIMESTAMP(0) NOT NULL, 
                updatedDate TIMESTAMP(0) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_VF' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_VF ADD CONSTRAINT INNOVA_ACTIVITY_VF_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_VF_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_VF_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_VF FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_VF_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_VF_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_VF_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_VF_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activityvf_question (
                activity_id NUMBER(10) NOT NULL, 
                question_id NUMBER(10) NOT NULL, 
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
                activity_id NUMBER(10) NOT NULL, 
                object_id NUMBER(10) NOT NULL, 
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
                activity_id NUMBER(10) NOT NULL, 
                proposition_id NUMBER(10) NOT NULL, 
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
                activity_id NUMBER(10) NOT NULL, 
                instruction_id NUMBER(10) NOT NULL, 
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
                activity_id NUMBER(10) NOT NULL, 
                information_id NUMBER(10) NOT NULL, 
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
                id NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_OBJECT' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_OBJECT ADD CONSTRAINT INNOVA_ACTIVITY_OBJECT_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_OBJECT_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_OBJECT_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_OBJECT FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_OBJECT_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_OBJECT_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_OBJECT_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_OBJECT_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activitySequence (
                id NUMBER(10) NOT NULL, 
                description CLOB DEFAULT NULL, 
                resourceNode_id NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITYSEQUENCE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITYSEQUENCE ADD CONSTRAINT INNOVA_ACTIVITYSEQUENCE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITYSEQUENCE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITYSEQUENCE_AI_PK BEFORE INSERT ON INNOVA_ACTIVITYSEQUENCE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITYSEQUENCE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITYSEQUENCE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITYSEQUENCE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITYSEQUENCE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_D614C342B87FAB32 ON innova_activitySequence (resourceNode_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            ADD CONSTRAINT FK_913DCE68BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activitySequence (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_question 
            ADD CONSTRAINT FK_E0B871E681C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_qru (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_question 
            ADD CONSTRAINT FK_E0B871E61E27F6BF FOREIGN KEY (question_id) 
            REFERENCES innova_question (id)
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
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            ADD CONSTRAINT FK_353CDA7BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activitySequence (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_question 
            ADD CONSTRAINT FK_2EE21F2A81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity_vf (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_question 
            ADD CONSTRAINT FK_2EE21F2A1E27F6BF FOREIGN KEY (question_id) 
            REFERENCES innova_question (id)
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
            ALTER TABLE innova_activitySequence 
            ADD CONSTRAINT FK_D614C342B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activityqru_instruction 
            DROP CONSTRAINT FK_5D2D0D2262A10F76
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_instruction 
            DROP CONSTRAINT FK_B5589C0B62A10F76
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_question 
            DROP CONSTRAINT FK_E0B871E681C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_object 
            DROP CONSTRAINT FK_EDAEE2B781C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_proposition 
            DROP CONSTRAINT FK_E15A2F2781C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_instruction 
            DROP CONSTRAINT FK_5D2D0D2281C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_information 
            DROP CONSTRAINT FK_FEEF4F781C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_question 
            DROP CONSTRAINT FK_E0B871E61E27F6BF
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_question 
            DROP CONSTRAINT FK_2EE21F2A1E27F6BF
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_proposition 
            DROP CONSTRAINT FK_E15A2F27DB96F9E
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_proposition 
            DROP CONSTRAINT FK_92FBE0EDB96F9E
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_information 
            DROP CONSTRAINT FK_FEEF4F72EF03101
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_information 
            DROP CONSTRAINT FK_E79B65DE2EF03101
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_question 
            DROP CONSTRAINT FK_2EE21F2A81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_object 
            DROP CONSTRAINT FK_9DD5D9781C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_proposition 
            DROP CONSTRAINT FK_92FBE0E81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_instruction 
            DROP CONSTRAINT FK_B5589C0B81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_information 
            DROP CONSTRAINT FK_E79B65DE81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activityqru_object 
            DROP CONSTRAINT FK_EDAEE2B7232D562B
        ");
        $this->addSql("
            ALTER TABLE innova_activityvf_object 
            DROP CONSTRAINT FK_9DD5D97232D562B
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            DROP CONSTRAINT FK_913DCE68BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            DROP CONSTRAINT FK_353CDA7BF396750
        ");
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