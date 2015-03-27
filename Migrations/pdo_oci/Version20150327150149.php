<?php

namespace Innova\ActivityBundle\Migrations\pdo_oci;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/27 03:01:54
 */
class Version20150327150149 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_prop_functional_instruction (
                id NUMBER(10) NOT NULL, 
                activity_id NUMBER(10) DEFAULT NULL NULL, 
                media CLOB NOT NULL, 
                position NUMBER(10) NOT NULL, 
                title VARCHAR2(255) DEFAULT NULL NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION ADD CONSTRAINT INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_PROP_FUNCTIONAL_INSTRUCTION_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            CREATE INDEX IDX_583F550D81C06096 ON innova_activity_prop_functional_instruction (activity_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_functional_instruction 
            ADD CONSTRAINT FK_583F550D81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_prop_functional_instruction
        ");
    }
}