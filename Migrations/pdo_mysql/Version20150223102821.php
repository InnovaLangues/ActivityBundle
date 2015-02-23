<?php

namespace Innova\ActivityBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/02/23 10:28:22
 */
class Version20150223102821 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_activity (
                id INT AUTO_INCREMENT NOT NULL, 
                type_id INT DEFAULT NULL, 
                resourceNode_id INT DEFAULT NULL, 
                INDEX IDX_4605013FC54C8C93 (type_id), 
                UNIQUE INDEX UNIQ_4605013FB87FAB32 (resourceNode_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_multiple (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                UNIQUE INDEX UNIQ_E19297AD81C06096 (activity_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_unique (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                UNIQUE INDEX UNIQ_215A48CD81C06096 (activity_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_type_boolean (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                UNIQUE INDEX UNIQ_A1A02AE481C06096 (activity_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_type (
                id INT AUTO_INCREMENT NOT NULL, 
                category_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                class VARCHAR(100) NOT NULL, 
                INDEX IDX_48C5FD2512469DE2 (category_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_available_category (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                icon VARCHAR(50) NOT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE innova_activity_prop_choice (
                id INT AUTO_INCREMENT NOT NULL, 
                media LONGTEXT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FC54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_available_type (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            ADD CONSTRAINT FK_4605013FB87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            ADD CONSTRAINT FK_E19297AD81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            ADD CONSTRAINT FK_215A48CD81C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            ADD CONSTRAINT FK_A1A02AE481C06096 FOREIGN KEY (activity_id) 
            REFERENCES innova_activity (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_available_type 
            ADD CONSTRAINT FK_48C5FD2512469DE2 FOREIGN KEY (category_id) 
            REFERENCES innova_activity_available_category (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            ADD CONSTRAINT FK_2FBB948CC54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_type_multiple (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            ADD CONSTRAINT FK_2FBB948C998666D1 FOREIGN KEY (choice_id) 
            REFERENCES innova_activity_prop_choice (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            ADD CONSTRAINT FK_B6753399C54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_type_unique (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            ADD CONSTRAINT FK_B6753399998666D1 FOREIGN KEY (choice_id) 
            REFERENCES innova_activity_prop_choice (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            ADD CONSTRAINT FK_498A9DC5C54C8C93 FOREIGN KEY (type_id) 
            REFERENCES innova_activity_type_boolean (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            ADD CONSTRAINT FK_498A9DC5998666D1 FOREIGN KEY (choice_id) 
            REFERENCES innova_activity_prop_choice (id)
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            ADD CONSTRAINT FK_D14D3F56FCAFE5CF FOREIGN KEY (id_activity) 
            REFERENCES innova_activity (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple 
            DROP FOREIGN KEY FK_E19297AD81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique 
            DROP FOREIGN KEY FK_215A48CD81C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean 
            DROP FOREIGN KEY FK_A1A02AE481C06096
        ");
        $this->addSql("
            ALTER TABLE innova_activity_prop_instruction 
            DROP FOREIGN KEY FK_D14D3F56FCAFE5CF
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            DROP FOREIGN KEY FK_2FBB948CC54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            DROP FOREIGN KEY FK_B6753399C54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            DROP FOREIGN KEY FK_498A9DC5C54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity 
            DROP FOREIGN KEY FK_4605013FC54C8C93
        ");
        $this->addSql("
            ALTER TABLE innova_activity_available_type 
            DROP FOREIGN KEY FK_48C5FD2512469DE2
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_multiple_choices 
            DROP FOREIGN KEY FK_2FBB948C998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_unique_choices 
            DROP FOREIGN KEY FK_B6753399998666D1
        ");
        $this->addSql("
            ALTER TABLE innova_activity_type_boolean_choices 
            DROP FOREIGN KEY FK_498A9DC5998666D1
        ");
        $this->addSql("
            DROP TABLE innova_activity
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_multiple
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_unique
        ");
        $this->addSql("
            DROP TABLE innova_activity_type_boolean
        ");
        $this->addSql("
            DROP TABLE innova_activity_available_type
        ");
        $this->addSql("
            DROP TABLE innova_activity_available_category
        ");
        $this->addSql("
            DROP TABLE innova_activity_prop_choice
        ");
    }
}