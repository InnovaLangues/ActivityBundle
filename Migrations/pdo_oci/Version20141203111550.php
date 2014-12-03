<?php

namespace Innova\ActivityBundle\Migrations\pdo_oci;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/12/03 11:15:51
 */
class Version20141203111550 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_type_available_activity (
                activity_id NUMBER(10) NOT NULL, 
                type_id NUMBER(10) NOT NULL, 
                PRIMARY KEY(activity_id, type_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_BD23E5281C06096 ON innova_activity_type_available_activity (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_BD23E52C54C8C93 ON innova_activity_type_available_activity (type_id)
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_available (
                id NUMBER(10) NOT NULL, 
                name VARCHAR2(255) NOT NULL, 
                class VARCHAR2(100) NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            DECLARE constraints_Count NUMBER; BEGIN 
            SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count 
            FROM USER_CONSTRAINTS 
            WHERE TABLE_NAME = 'INNOVA_ACTIVITY_TYPE_AVAILABLE' 
            AND CONSTRAINT_TYPE = 'P'; IF constraints_Count = 0 
            OR constraints_Count = '' THEN EXECUTE IMMEDIATE 'ALTER TABLE INNOVA_ACTIVITY_TYPE_AVAILABLE ADD CONSTRAINT INNOVA_ACTIVITY_TYPE_AVAILABLE_AI_PK PRIMARY KEY (ID)'; END IF; END;
        ");
        $this->addSql("
            CREATE SEQUENCE INNOVA_ACTIVITY_TYPE_AVAILABLE_ID_SEQ START WITH 1 MINVALUE 1 INCREMENT BY 1
        ");
        $this->addSql("
            CREATE TRIGGER INNOVA_ACTIVITY_TYPE_AVAILABLE_AI_PK BEFORE INSERT ON INNOVA_ACTIVITY_TYPE_AVAILABLE FOR EACH ROW DECLARE last_Sequence NUMBER; last_InsertID NUMBER; BEGIN 
            SELECT INNOVA_ACTIVITY_TYPE_AVAILABLE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; IF (
                : NEW.ID IS NULL 
                OR : NEW.ID = 0
            ) THEN 
            SELECT INNOVA_ACTIVITY_TYPE_AVAILABLE_ID_SEQ.NEXTVAL INTO : NEW.ID 
            FROM DUAL; ELSE 
            SELECT NVL(Last_Number, 0) INTO last_Sequence 
            FROM User_Sequences 
            WHERE Sequence_Name = 'INNOVA_ACTIVITY_TYPE_AVAILABLE_ID_SEQ'; 
            SELECT : NEW.ID INTO last_InsertID 
            FROM DUAL; WHILE (last_InsertID > last_Sequence) LOOP 
            SELECT INNOVA_ACTIVITY_TYPE_AVAILABLE_ID_SEQ.NEXTVAL INTO last_Sequence 
            FROM DUAL; END LOOP; END IF; END;
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_available_activity 
            ADD CONSTRAINT FK_BD23E5281C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_available_activity 
            ADD CONSTRAINT FK_BD23E52C54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_type_available (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP (class)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_available_activity 
            DROP CONSTRAINT FK_BD23E52C54C8C93
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_available_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_available
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD (
                class VARCHAR2(255) NOT NULL
            )
        ");
    }
}