<?php

namespace Innova\ActivityBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/12/03 11:15:51
 */
class Version20141203111550 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_type_available_activity (
                activity_id INT NOT NULL, 
                type_id INT NOT NULL, 
                INDEX IDX_BD23E5281C06096 (activity_id), 
                UNIQUE INDEX UNIQ_BD23E52C54C8C93 (type_id), 
                PRIMARY KEY(activity_id, type_id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_available (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                class VARCHAR(100) NOT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_available_activity 
            ADD CONSTRAINT FK_BD23E5281C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_available_activity 
            ADD CONSTRAINT FK_BD23E52C54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_type_available (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP class
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_available_activity 
            DROP FOREIGN KEY FK_BD23E52C54C8C93
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_available_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_available
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD class VARCHAR(255) NOT NULL
        ");
    }
}