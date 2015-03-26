<?php

namespace Innova\ActivityBundle\Migrations\pdo_pgsql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/26 09:21:27
 */
class Version20150326092122 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice ALTER correct_answer TYPE TEXT
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice ALTER correct_answer 
            DROP DEFAULT
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice ALTER correct_answer TYPE BOOLEAN
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_choice ALTER correct_answer 
            DROP DEFAULT
        ");
    }
}