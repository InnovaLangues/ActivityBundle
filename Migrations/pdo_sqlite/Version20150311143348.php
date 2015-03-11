<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/11 02:33:49
 */
class Version20150311143348 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_ED9D220B81C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_media AS 
            SELECT id, 
            activity_id, 
            media, 
            title 
            FROM innova_activity_prop_media
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_media
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_media (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, 
                link CLOB NOT NULL, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_ED9D220B81C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_media (id, activity_id, link, title) 
            SELECT id, 
            activity_id, 
            media, 
            title 
            FROM __temp__innova_activity_prop_media
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_media
        ");
        $this->addSql("
            CREATE INDEX IDX_ED9D220B81C06096 ON innova_activity_prop_media (activity_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP INDEX IDX_ED9D220B81C06096
        ");
        $this->addSql("
            CREATE TEMPORARY TABLE __temp__innova_activity_prop_media AS 
            SELECT id, 
            activity_id, 
            link, 
            title 
            FROM innova_activity_prop_media
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_media
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_media (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                media CLOB NOT NULL COLLATE utf8_unicode_ci, 
                PRIMARY KEY(id), 
                CONSTRAINT FK_ED9D220B81C06096 FOREIGN KEY (activity_id) 
                REFERENCES innova_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE
            )
        ");
        $this->addSql("
            INSERT INTO innova_activity_prop_media (id, activity_id, media, title) 
            SELECT id, 
            activity_id, 
            link, 
            title 
            FROM __temp__innova_activity_prop_media
        ");
        $this->addSql("
            DROP TABLE __temp__innova_activity_prop_media
        ");
        $this->addSql("
            CREATE INDEX IDX_ED9D220B81C06096 ON innova_activity_prop_media (activity_id)
        ");
    }
}