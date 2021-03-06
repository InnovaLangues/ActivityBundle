<?php

namespace Innova\ActivityBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/05/05 03:14:15
 */
class Version20150505151414 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_prop_question (
                id INT IDENTITY NOT NULL, 
                activity_id INT, 
                media VARCHAR(MAX) NOT NULL, 
                position INT NOT NULL, 
                title NVARCHAR(255), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_1F7017DE81C06096 ON innova_activity_prop_question (activity_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_question 
            ADD CONSTRAINT FK_1F7017DE81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_activity_prop_question
        ");
    }
}