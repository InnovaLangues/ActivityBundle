<?php

namespace Innova\ActivityBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/05/27 01:24:04
 */
class Version20150527132403 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD resource_id INT DEFAULT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD CONSTRAINT FK_5F487EB289329D25 FOREIGN KEY (resource_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            CREATE INDEX IDX_5F487EB289329D25 ON innova_activity_prop_choice (resource_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP FOREIGN KEY FK_5F487EB289329D25
        ");
        $this->addSql("
            DROP INDEX IDX_5F487EB289329D25 ON innova_activity_prop_choice
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP resource_id
        ");
    }
}