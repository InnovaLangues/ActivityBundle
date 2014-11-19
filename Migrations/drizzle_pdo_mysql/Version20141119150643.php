<?php

namespace Innova\ActivityBundle\Migrations\drizzle_pdo_mysql;

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
            ALTER TABLE AbstractActivity CHANGE activity_order `order` INT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activityQru CHANGE activity_order `order` INT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activityVf CHANGE activity_order `order` INT NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE AbstractActivity CHANGE order activity_order INT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activityQru CHANGE order activity_order INT NOT NULL
        ");
        $this->addSql("
            ALTER TABLE innova_activityVf CHANGE order activity_order INT NOT NULL
        ");
    }
}