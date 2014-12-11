<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20141205104551 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('CREATE TABLE geekhub_posts (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, slug_title VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geekhub_tags (id INT AUTO_INCREMENT NOT NULL, tagName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts_tags (tag_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_D5ECAD9FBAD26311 (tag_id), INDEX IDX_D5ECAD9F4B89032C (post_id), PRIMARY KEY(tag_id, post_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geekhub_details (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details (detail_id INT NOT NULL, neededTo_detail_id INT NOT NULL, INDEX IDX_72260B8AD8D003BB (detail_id), INDEX IDX_72260B8AD94F46D6 (neededTo_detail_id), PRIMARY KEY(detail_id, neededTo_detail_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geekhub_comments (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_5B90B6984B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9FBAD26311 FOREIGN KEY (tag_id) REFERENCES geekhub_tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9F4B89032C FOREIGN KEY (post_id) REFERENCES geekhub_posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AD8D003BB FOREIGN KEY (detail_id) REFERENCES geekhub_details (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AD94F46D6 FOREIGN KEY (neededTo_detail_id) REFERENCES geekhub_details (id)');
        $this->addSql('ALTER TABLE geekhub_comments ADD CONSTRAINT FK_5B90B6984B89032C FOREIGN KEY (post_id) REFERENCES geekhub_posts (id)');
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE posts_tags DROP FOREIGN KEY FK_D5ECAD9F4B89032C');
        $this->addSql('ALTER TABLE geekhub_comments DROP FOREIGN KEY FK_5B90B6984B89032C');
        $this->addSql('ALTER TABLE posts_tags DROP FOREIGN KEY FK_D5ECAD9FBAD26311');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8AD8D003BB');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8AD94F46D6');
        $this->addSql('DROP TABLE geekhub_posts');
        $this->addSql('DROP TABLE geekhub_tags');
        $this->addSql('DROP TABLE posts_tags');
        $this->addSql('DROP TABLE geekhub_details');
        $this->addSql('DROP TABLE details');
        $this->addSql('DROP TABLE geekhub_comments');
    }
}
