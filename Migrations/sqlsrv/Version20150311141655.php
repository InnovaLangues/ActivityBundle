<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/11 02:16:57
 */
class Version20150311141655 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_prop_media (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                media VARCHAR(MAX) NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_ED9D220B81C06096 ON innova_activity_prop_media (activity_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_media 
            ADD CONSTRAINT FK_ED9D220B81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_prop_media
        ");
    }
}