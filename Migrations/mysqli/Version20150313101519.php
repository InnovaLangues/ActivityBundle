<?php

namespace Innova\ActivityBundle\Migrations\mysqli;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/13 10:15:21
 */
class Version20150313101519 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            ADD randomlyOrdered TINYINT(1) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            ADD randomlyOrdered TINYINT(1) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            ADD randomlyOrdered TINYINT(1) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            DROP randomlyOrdered
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice 
            ADD randomlyOrdered TINYINT(1) NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            DROP randomlyOrdered
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            DROP randomlyOrdered
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            DROP randomlyOrdered
        ");
    }
}