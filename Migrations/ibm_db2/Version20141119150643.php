<?php

namespace Innova\ActivityBundle\Migrations\ibm_db2;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/11/19 03:06:45
 */
class Version20141119150643 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE AbstractActivity RENAME activity_order TO \"order\"
        ");
        $this->addSql("
            ALTER TABLE innova_activityQru RENAME activity_order TO \"order\"
        ");
        $this->addSql("
            ALTER TABLE innova_activityVf RENAME activity_order TO \"order\"
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE AbstractActivity RENAME order TO activity_order
        ");
        $this->addSql("
            ALTER TABLE innova_activityQru RENAME order TO activity_order
        ");
        $this->addSql("
            ALTER TABLE innova_activityVf RENAME order TO activity_order
        ");
    }
}