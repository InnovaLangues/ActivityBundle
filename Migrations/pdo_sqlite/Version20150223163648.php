<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/02/23 04:36:49
 */
class Version20150223163648 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            ADD COLUMN media CLOB NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_D14D3F56FCAFE5CF
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_instruction AS 
            SELECT id, 
            id_activity, 
            title 
            FROM innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_instruction
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_instruction (
                id INTEGER NOT NULL, 
                id_activity INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_D14D3F56FCAFE5CF FOREIGN KEY (id_activity) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_instruction (id, id_activity, title) 
            SELECT id, 
            id_activity, 
            title 
            FROM __temp__innova_activity_prop_instruction
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_instruction
        ");
        $this->addSql("
            CREATE INDEX IDX_D14D3F56FCAFE5CF ON innova_activity_prop_instruction (id_activity)
        ");
    }
}