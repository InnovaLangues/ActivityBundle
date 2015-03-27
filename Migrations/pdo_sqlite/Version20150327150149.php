<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/27 03:01:54
 */
class Version20150327150149 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_prop_functional_instruction (
                id INTEGER NOT NULL, 
                activity_id INTEGER DEFAULT NULL, 
                media CLOB NOT NULL, 
                position INTEGER NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_583F550D81C06096 ON innova_activity_prop_functional_instruction (activity_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_prop_functional_instruction
        ");
    }
}