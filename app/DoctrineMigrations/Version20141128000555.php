<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;


class Version20141128000555 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('CREATE TABLE geekhub_details (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details (detail_id INT NOT NULL, neededTo_detail_id INT NOT NULL, INDEX IDX_72260B8AD8D003BB (detail_id), INDEX IDX_72260B8AD94F46D6 (neededTo_detail_id), PRIMARY KEY(detail_id, neededTo_detail_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AD8D003BB FOREIGN KEY (detail_id) REFERENCES geekhub_details (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AD94F46D6 FOREIGN KEY (neededTo_detail_id) REFERENCES geekhub_details (id)');
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8AD8D003BB');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8AD94F46D6');
        $this->addSql('DROP TABLE geekhub_details');
        $this->addSql('DROP TABLE details');
    }
}
