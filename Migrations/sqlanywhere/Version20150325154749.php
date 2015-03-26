<?php

namespace Innova\ActivityBundle\Migrations\sqlanywhere;

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
            ADD media_type_id INT DEFAULT NULL
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
            DROP FOREIGN KEY FK_5F487EB2A49B0ADA
        ");
        $this->addSql("
            DROP INDEX innova_activity_prop_choice.IDX_5F487EB2A49B0ADA
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP media_type_id
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP FOREIGN KEY FK_4605013FA49B0ADA
        ");
        $this->addSql("
            DROP INDEX innova_activity.IDX_4605013FA49B0ADA
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP media_type_id
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD media_type_id INT DEFAULT NULL
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