<?php

namespace Innova\ActivityBundle\Migrations\pdo_oci;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/31 02:36:39
 */
class Version20150331143638 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice MODIFY (correct_answer CLOB DEFAULT NULL)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice MODIFY (
                correct_answer NUMBER(1) DEFAULT NULL
            )
        ");
    }
}