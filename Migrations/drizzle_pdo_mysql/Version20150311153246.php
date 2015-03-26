<?php

namespace Innova\ActivityBundle\Migrations\drizzle_pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/11 03:32:48
 */
class Version20150311153246 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity CHANGE question question TEXT DEFAULT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity CHANGE question question TEXT NOT NULL COLLATE utf8_unicode_ci
        ");
    }
}