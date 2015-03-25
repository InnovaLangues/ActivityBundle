<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/25 03:47:55
 */
class Version20150325154749 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD media_type_id INT
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FA49B0ADA FOREIGN KEY (media_type_id) 
            REFERENCES innova_activity_prop_media_type (id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4605013FA49B0ADA ON innova_activity (media_type_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP CONSTRAINT FK_5F487EB2A49B0ADA
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'IDX_5F487EB2A49B0ADA'
            ) 
            ALTER TABLE innova_activity_prop_choice 
            DROP CONSTRAINT IDX_5F487EB2A49B0ADA ELSE 
            DROP INDEX IDX_5F487EB2A49B0ADA ON innova_activity_prop_choice
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP COLUMN media_type_id
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP CONSTRAINT FK_4605013FA49B0ADA
        ");
        $this->addSql("
            IF EXISTS (
                SELECT * 
                FROM sysobjects 
                WHERE name = 'IDX_4605013FA49B0ADA'
            ) 
            ALTER TABLE innova_activity 
            DROP CONSTRAINT IDX_4605013FA49B0ADA ELSE 
            DROP INDEX IDX_4605013FA49B0ADA ON innova_activity
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP COLUMN media_type_id
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD media_type_id INT
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD CONSTRAINT FK_5F487EB2A49B0ADA FOREIGN KEY (media_type_id) 
            REFERENCES innova_activity_prop_media_type (id)
        ");
        $this->addSql("
            CREATE INDEX IDX_5F487EB2A49B0ADA ON innova_activity_prop_choice (media_type_id)
        ");
    }
}