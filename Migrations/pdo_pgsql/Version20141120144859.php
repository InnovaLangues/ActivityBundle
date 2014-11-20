<?php

namespace Innova\ActivityBundle\Migrations\pdo_pgsql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/20 02:49:00
 */
class Version20141120144859 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_sequence (
                id SERIAL NOT NULL, 
                description TEXT DEFAULT NULL, 
                resourceNode_id INT DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_CA5D5B00B87FAB32 ON innova_activity_sequence (resourceNode_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            ADD CONSTRAINT FK_CA5D5B00B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            DROP CONSTRAINT FK_913DCE68BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            ADD CONSTRAINT FK_913DCE68BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activity_sequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            DROP CONSTRAINT FK_353CDA7BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            ADD CONSTRAINT FK_353CDA7BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activity_sequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            DROP CONSTRAINT FK_913DCE68BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            DROP CONSTRAINT FK_353CDA7BF396750
        ");
        $this->addSql("
            DROP TABLE innova_activity_sequence
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            DROP CONSTRAINT FK_913DCE68BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            ADD CONSTRAINT FK_913DCE68BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            DROP CONSTRAINT FK_353CDA7BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            ADD CONSTRAINT FK_353CDA7BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activitySequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
    }
}