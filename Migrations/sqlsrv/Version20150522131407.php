<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/05/22 01:14:09
 */
class Version20150522131407 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD date_created DATETIME2(6) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            ADD numTries INT NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            DROP COLUMN date_created
        ");
        $this->addSql("
            ALTER TABLE innova_activity_sequence 
            DROP COLUMN numTries
        ");
    }
}