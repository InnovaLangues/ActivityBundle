<?php

namespace Innova\ActivityBundle\Migrations\pdo_sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/03/04 02:28:42
 */
class Version20150304142840 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity_answer (
                id INT IDENTITY NOT NULL, 
                user_id INT, 
                activity_id INT, 
                resourceNode_id INT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_C0062329A76ED395 ON innova_activity_answer (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_C006232981C06096 ON innova_activity_answer (activity_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_C0062329B87FAB32 ON innova_activity_answer (resourceNode_id) 
            WHERE resourceNode_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE innova_activity_answer_choice (
                answer_id INT NOT NULL, 
                choice_id INT NOT NULL, 
                PRIMARY KEY (answer_id, choice_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_1A88AD60AA334807 ON innova_activity_answer_choice (answer_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_1A88AD60998666D1 ON innova_activity_answer_choice (choice_id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD CONSTRAINT FK_C0062329A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD CONSTRAINT FK_C006232981C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer 
            ADD CONSTRAINT FK_C0062329B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            ADD CONSTRAINT FK_1A88AD60AA334807 FOREIGN KEY (answer_id) 
            REFERENCES innova_activity_answer (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            ADD CONSTRAINT FK_1A88AD60998666D1 FOREIGN KEY (choice_id) 
            REFERENCES innova_activity_prop_choice (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_answer_choice 
            DROP CONSTRAINT FK_1A88AD60AA334807
        ");
        $this->addSql("
            DROP TABLE innova_activity_answer
        ");
        $this->addSql("
            DROP TABLE innova_activity_answer_choice
        ");
    }
}