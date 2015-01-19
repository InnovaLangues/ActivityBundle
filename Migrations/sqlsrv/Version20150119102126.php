<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

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
            ADD type_id INT
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
            DROP COLUMN type_id
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP CONSTRAINT FK_4605013FC54C8C93
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'IDX_4605013FC54C8C93'
            ) 
            ALTER TABLE innova_activity 
            DROP CONSTRAINT IDX_4605013FC54C8C93 ELSE 
            DROP INDEX IDX_4605013FC54C8C93 ON innova_activity
        ");
    }
}