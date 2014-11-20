<?php

namespace Innova\ActivityBundle\Migrations\pdo_mysql;

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
                id INT AUTO_INCREMENT NOT NULL, 
                description LONGTEXT DEFAULT NULL, 
                resourceNode_id INT DEFAULT NULL, 
                UNIQUE INDEX UNIQ_CA5D5B00B87FAB32 (resourceNode_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            ADD CONSTRAINT FK_CA5D5B00B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            DROP FOREIGN KEY FK_913DCE68BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            ADD CONSTRAINT FK_913DCE68BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activity_sequence (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            DROP FOREIGN KEY FK_353CDA7BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            ADD CONSTRAINT FK_353CDA7BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activity_sequence (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            DROP FOREIGN KEY FK_913DCE68BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            DROP FOREIGN KEY FK_353CDA7BF396750
        ");
        $this->addSql("
            DROP TABLE innova_activity_sequence
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            DROP FOREIGN KEY FK_913DCE68BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_qru 
            ADD CONSTRAINT FK_913DCE68BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activitySequence (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            DROP FOREIGN KEY FK_353CDA7BF396750
        ");
        $this->addSql("
            ALTER TABLE innova_activity_vf 
            ADD CONSTRAINT FK_353CDA7BF396750 FOREIGN KEY (id) 
            REFERENCES innova_activitySequence (id)
        ");
    }
}