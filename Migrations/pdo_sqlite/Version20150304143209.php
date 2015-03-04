<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/04 02:32:11
 */
class Version20150304143209 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            DROP INDEX UNIQ_C0062329B87FAB32
        ");
        $this->addSql("
            DROP INDEX IDX_C0062329A76ED395
        ");
        $this->addSql("
            DROP INDEX IDX_C006232981C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_answer AS 
            SELECT id, 
            activity_id, 
            user_id 
            FROM innova_activity_answer
        ");
        $this->addSql("
            DROP TABLE innova_activity_answer
        ");
        $this->addSql("
            CREATE TABLE innova_activity_answer (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                user_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_C006232981C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_C0062329A76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_answer (id, activity_id, user_id) 
            SELECT id, 
            activity_id, 
            user_id 
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
                resourceNode_id INTEGER DEFAULT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_C0062329A76ED395 FOREIGN KEY (user_id) 
                REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_C006232981C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, 
                CONSTRAINT FK_C0062329B87FAB32 FOREIGN KEY (resourceNode_id) 
                REFERENCES claro_resource_node (id) 
                ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
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
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_C0062329B87FAB32 ON innova_activity_answer (resourceNode_id)
        ");
    }
}