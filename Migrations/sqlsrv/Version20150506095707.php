<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/05/06 09:57:09
 */
class Version20150506095707 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_prop_complementary_info (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                media VARCHAR(MAX) NOT NULL, 
                position INT NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_426EAE1581C06096 ON innova_activity_prop_complementary_info (activity_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_complementary_info 
            ADD CONSTRAINT FK_426EAE1581C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_prop_complementary_info
        ");
    }
}