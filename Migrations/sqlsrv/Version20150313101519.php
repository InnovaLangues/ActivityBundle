<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/13 10:15:22
 */
class Version20150313101519 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            ADD randomlyOrdered BIT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            ADD randomlyOrdered BIT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            ADD randomlyOrdered BIT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP COLUMN randomlyOrdered
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD randomlyOrdered BIT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            DROP COLUMN randomlyOrdered
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            DROP COLUMN randomlyOrdered
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            DROP COLUMN randomlyOrdered
        ");
    }
}