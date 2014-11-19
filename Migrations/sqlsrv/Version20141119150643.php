<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

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
            sp_RENAME 'AbstractActivity.activity_order', 
            '[order]', 
            'COLUMN'
        ");
        $this->addSql("
            ALTER TABLE AbstractActivity ALTER COLUMN [order] INT NOT NULL
        ");
        $this->addSql("
            sp_RENAME 'innova_activityQru.activity_order', 
            '[order]', 
            'COLUMN'
        ");
        $this->addSql("
            ALTER TABLE innova_activityQru ALTER COLUMN [order] INT NOT NULL
        ");
        $this->addSql("
            sp_RENAME 'innova_activityVf.activity_order', 
            '[order]', 
            'COLUMN'
        ");
        $this->addSql("
            ALTER TABLE innova_activityVf ALTER COLUMN [order] INT NOT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            sp_RENAME 'AbstractActivity.order', 
            'activity_order', 
            'COLUMN'
        ");
        $this->addSql("
            ALTER TABLE AbstractActivity ALTER COLUMN activity_order INT NOT NULL
        ");
        $this->addSql("
            sp_RENAME 'innova_activityQru.order', 
            'activity_order', 
            'COLUMN'
        ");
        $this->addSql("
            ALTER TABLE innova_activityQru ALTER COLUMN activity_order INT NOT NULL
        ");
        $this->addSql("
            sp_RENAME 'innova_activityVf.order', 
            'activity_order', 
            'COLUMN'
        ");
        $this->addSql("
            ALTER TABLE innova_activityVf ALTER COLUMN activity_order INT NOT NULL
        ");
    }
}