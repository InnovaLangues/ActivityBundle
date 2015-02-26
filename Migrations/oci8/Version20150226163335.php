<?php

namespace Innova\ActivityBundle\Migrations\oci8;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/02/26 04:33:37
 */
class Version20150226163335 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity (
                id NUMBER(10) NOT NULL, 
                type_id NUMBER(10) DEFAULT NULL, 
                description CLOB DEFAULT NULL, 
                resourceNode_id NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY ADD CONSTRAINT INNOVA_ACTIVITY_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FC54C8C93 ON innova_activity (type_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_4605013FB87FAB32 ON innova_activity (resourceNode_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple (
                id NUMBER(10) NOT NULL, 
                activity_id NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_TYPE_MULTIPLE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_TYPE_MULTIPLE ADD CONSTRAINT INNOVA_ACTIVITY_TYPE_MULTIPLE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_TYPE_MULTIPLE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_TYPE_MULTIPLE_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_TYPE_MULTIPLE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_TYPE_MULTIPLE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_TYPE_MULTIPLE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_TYPE_MULTIPLE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_TYPE_MULTIPLE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E19297AD81C06096 ON innova_activity_type_multiple (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple_choices (
                type_id NUMBER(10) NOT NULL, 
                choice_id NUMBER(10) NOT NULL, 
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
                id NUMBER(10) NOT NULL, 
                activity_id NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_TYPE_UNIQUE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_TYPE_UNIQUE ADD CONSTRAINT INNOVA_ACTIVITY_TYPE_UNIQUE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_TYPE_UNIQUE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_TYPE_UNIQUE_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_TYPE_UNIQUE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_TYPE_UNIQUE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_TYPE_UNIQUE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_TYPE_UNIQUE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_TYPE_UNIQUE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_215A48CD81C06096 ON innova_activity_type_unique (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique_choices (
                type_id NUMBER(10) NOT NULL, 
                choice_id NUMBER(10) NOT NULL, 
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
                id NUMBER(10) NOT NULL, 
                activity_id NUMBER(10) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_TYPE_BOOLEAN' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_TYPE_BOOLEAN ADD CONSTRAINT INNOVA_ACTIVITY_TYPE_BOOLEAN_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_TYPE_BOOLEAN_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_TYPE_BOOLEAN_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_TYPE_BOOLEAN FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_TYPE_BOOLEAN_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_TYPE_BOOLEAN_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_TYPE_BOOLEAN_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_TYPE_BOOLEAN_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_A1A02AE481C06096 ON innova_activity_type_boolean (activity_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean_choices (
                type_id NUMBER(10) NOT NULL, 
                choice_id NUMBER(10) NOT NULL, 
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
            CREATE TABLE innova_activity_prop_choice (
                id NUMBER(10) NOT NULL, 
                media CLOB NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_PROP_CHOICE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_PROP_CHOICE ADD CONSTRAINT INNOVA_ACTIVITY_PROP_CHOICE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_PROP_CHOICE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_PROP_CHOICE_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_PROP_CHOICE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_PROP_CHOICE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_PROP_CHOICE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_PROP_CHOICE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_PROP_CHOICE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id NUMBER(10) NOT NULL, 
                id_activity NUMBER(10) DEFAULT NULL, 
                media CLOB NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_PROP_INSTRUCTION' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_PROP_INSTRUCTION ADD CONSTRAINT INNOVA_ACTIVITY_PROP_INSTRUCTION_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_PROP_INSTRUCTION_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_PROP_INSTRUCTION_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_PROP_INSTRUCTION FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_PROP_INSTRUCTION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_PROP_INSTRUCTION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_PROP_INSTRUCTION_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_PROP_INSTRUCTION_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE INDEX IDX_D14D3F56FCAFE5CF ON innova_activity_prop_instruction (id_activity)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_info (
                id NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_PROP_INFO' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_PROP_INFO ADD CONSTRAINT INNOVA_ACTIVITY_PROP_INFO_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_PROP_INFO_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_PROP_INFO_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_PROP_INFO FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_PROP_INFO_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_PROP_INFO_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_PROP_INFO_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_PROP_INFO_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_object (
                id NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_PROP_OBJECT' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_PROP_OBJECT ADD CONSTRAINT INNOVA_ACTIVITY_PROP_OBJECT_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_PROP_OBJECT_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_PROP_OBJECT_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_PROP_OBJECT FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_PROP_OBJECT_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_PROP_OBJECT_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_PROP_OBJECT_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_PROP_OBJECT_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_question (
                id NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_PROP_QUESTION' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_PROP_QUESTION ADD CONSTRAINT INNOVA_ACTIVITY_PROP_QUESTION_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_PROP_QUESTION_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_PROP_QUESTION_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_PROP_QUESTION FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_PROP_QUESTION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_PROP_QUESTION_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_PROP_QUESTION_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_PROP_QUESTION_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_category (
                id NUMBER(10) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                icon VARCHAR2(50) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_AVAILABLE_CATEGORY' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_AVAILABLE_CATEGORY ADD CONSTRAINT INNOVA_ACTIVITY_AVAILABLE_CATEGORY_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_AVAILABLE_CATEGORY_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_AVAILABLE_CATEGORY_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_AVAILABLE_CATEGORY FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_AVAILABLE_CATEGORY_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_AVAILABLE_CATEGORY_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_AVAILABLE_CATEGORY_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_AVAILABLE_CATEGORY_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_type (
                id NUMBER(10) NOT NULL, 
                category_id NUMBER(10) DEFAULT NULL, 
                name VARCHAR2(255) NOT NULL, 
                class VARCHAR2(100) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_AVAILABLE_TYPE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_AVAILABLE_TYPE ADD CONSTRAINT INNOVA_ACTIVITY_AVAILABLE_TYPE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_AVAILABLE_TYPE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_AVAILABLE_TYPE_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_AVAILABLE_TYPE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_AVAILABLE_TYPE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_AVAILABLE_TYPE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_AVAILABLE_TYPE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_AVAILABLE_TYPE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE INDEX IDX_48C5FD2512469DE2 ON innova_activity_available_type (category_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FC54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_available_type (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
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
            ALTER TABLE innova_activity_prop_instruction 
            ADD CONSTRAINT FK_D14D3F56FCAFE5CF FOREIGN KEY (id_activity) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_available_type 
            ADD CONSTRAINT FK_48C5FD2512469DE2 FOREIGN KEY (category_id) 
            REFERENCES innova_activity_available_category (id)
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
            ALTER TABLE innova_activity_prop_instruction 
            DROP CONSTRAINT FK_D14D3F56FCAFE5CF
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
            ALTER TABLE innova_activity_available_type 
            DROP CONSTRAINT FK_48C5FD2512469DE2
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP CONSTRAINT FK_4605013FC54C8C93
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
            DROP TABLE innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_info
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_object
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_question
        ");
        $this->addSql("
            DROP TABLE innova_activity_available_category
        ");
        $this->addSql("
            DROP TABLE innova_activity_available_type
        ");
    }
}