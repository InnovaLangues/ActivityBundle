<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlsrv;

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
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                media VARCHAR(MAX) NOT NULL, 
                position INT NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_583F550D81C06096 ON innova_activity_prop_functional_instruction (activity_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_functional_instruction 
            ADD CONSTRAINT FK_583F550D81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_prop_functional_instruction
        ");
    }
}