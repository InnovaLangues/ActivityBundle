<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/05/18 04:11:43
 */
class Version20150518161142 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD COLUMN numTrial INTEGER NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_C0062329A76ED395
        ");
        $this->addSql("
            DROP INDEX IDX_C006232981C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_answer AS 
            SELECT id, 
            user_id, 
            activity_id 
            FROM innova_activity_answer
        ");
        $this->addSql("
            DROP TABLE innova_activity_answer
        ");
        $this->addSql("
            CREATE TABLE innova_activity_answer (
                id INTEGER NOT NULL, 
                user_id INTEGER DEFAULT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_C0062329A76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_C006232981C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_answer (id, user_id, activity_id) 
            SELECT id, 
            user_id, 
            activity_id 
            FROM __temp__innova_activity_answer
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_answer
        ");
        $this->addSql("
            CREATE INDEX IDX_C0062329A76ED395 ON innova_activity_answer (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_C006232981C06096 ON innova_activity_answer (activity_id)
        ");
    }
}