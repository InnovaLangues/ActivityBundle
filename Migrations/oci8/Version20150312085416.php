<?php

namespace Innova\ActivityBundle\Migrations\oci8;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/12 08:54:24
 */
class Version20150312085416 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            ADD (
                position NUMBER(10) NOT NULL
            )
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_content 
            ADD (
                position NUMBER(10) NOT NULL
            )
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_content 
            DROP (position)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            DROP (position)
        ");
    }
}