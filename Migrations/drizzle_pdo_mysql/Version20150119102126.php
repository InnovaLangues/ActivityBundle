<?php

namespace Innova\ActivityBundle\Migrations\drizzle_pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/01/19 10:21:28
 */
class Version20150119102126 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD type_id INT DEFAULT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FC54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_available_type (id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FC54C8C93 ON innova_activity (type_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP FOREIGN KEY FK_4605013FC54C8C93
        ");
        $this->addSql("
            DROP INDEX IDX_4605013FC54C8C93 ON innova_activity
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP type_id
        ");
    }
}