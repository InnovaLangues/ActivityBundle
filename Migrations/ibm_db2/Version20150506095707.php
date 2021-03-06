<?php

namespace Innova\ActivityBundle\Migrations\ibm_db2;

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
                id INTEGER GENERATED BY DEFAULT AS IDENTITY NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                media CLOB(1M) NOT NULL, 
                \"position\" INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
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