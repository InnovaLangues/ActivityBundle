<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/13 10:15:21
 */
class Version20150313101519 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            ADD COLUMN randomlyOrdered BOOLEAN NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            ADD COLUMN randomlyOrdered BOOLEAN NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            ADD COLUMN randomlyOrdered BOOLEAN NOT NULL
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_choice AS 
            SELECT id, 
            media, 
            title, 
            correct_answer, 
            position 
            FROM innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_choice
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INTEGER NOT NULL, 
                media CLOB NOT NULL COLLATE utf8_unicode_ci, 
                title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, 
                correct_answer BOOLEAN NOT NULL, 
                position INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_choice (
                id, media, title, correct_answer, position
            ) 
            SELECT id, 
            media, 
            title, 
            correct_answer, 
            position 
            FROM __temp__innova_activity_prop_choice
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_choice
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD COLUMN randomlyOrdered BOOLEAN NOT NULL
        ");
        $this->addSql("
            DROP INDEX UNIQ_A1A02AE481C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_type_boolean AS 
            SELECT id, 
            activity_id 
            FROM innova_activity_type_boolean
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_boolean
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_A1A02AE481C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_type_boolean (id, activity_id) 
            SELECT id, 
            activity_id 
            FROM __temp__innova_activity_type_boolean
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_type_boolean
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_A1A02AE481C06096 ON innova_activity_type_boolean (activity_id)
        ");
        $this->addSql("
            DROP INDEX UNIQ_E19297AD81C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_type_multiple AS 
            SELECT id, 
            activity_id 
            FROM innova_activity_type_multiple
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_multiple
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_E19297AD81C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_type_multiple (id, activity_id) 
            SELECT id, 
            activity_id 
            FROM __temp__innova_activity_type_multiple
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_type_multiple
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E19297AD81C06096 ON innova_activity_type_multiple (activity_id)
        ");
        $this->addSql("
            DROP INDEX UNIQ_215A48CD81C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_type_unique AS 
            SELECT id, 
            activity_id 
            FROM innova_activity_type_unique
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_unique
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_215A48CD81C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_type_unique (id, activity_id) 
            SELECT id, 
            activity_id 
            FROM __temp__innova_activity_type_unique
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_type_unique
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_215A48CD81C06096 ON innova_activity_type_unique (activity_id)
        ");
    }
}