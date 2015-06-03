<?php

namespace Innova\ActivityBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/06/02 03:26:12
 */
class Version20150602152612 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_media_type 
            ADD resource_id INT DEFAULT NULL, 
            DROP template
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_media_type 
            ADD CONSTRAINT FK_B20BD79489329D25 FOREIGN KEY (resource_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            CREATE INDEX IDX_B20BD79489329D25 ON innova_activity_prop_media_type (resource_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_media_type 
            DROP FOREIGN KEY FK_B20BD79489329D25
        ");
        $this->addSql("
            DROP INDEX IDX_B20BD79489329D25 ON innova_activity_prop_media_type
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_media_type 
            ADD template LONGTEXT NOT NULL COLLATE utf8_unicode_ci, 
            DROP resource_id
        ");
    }
}