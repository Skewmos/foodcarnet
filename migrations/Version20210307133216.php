<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307133216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE IMAGE CHANGE IDRECIPE IDRECIPE INT DEFAULT NULL');
        $this->addSql('ALTER TABLE CONTAINS RENAME INDEX i_fk_contains_ingredient TO IDX_8EFA6A7E33342C5A');
        $this->addSql('ALTER TABLE CONTAINS RENAME INDEX i_fk_contains_recipe TO IDX_8EFA6A7E780680D7');
        $this->addSql('ALTER TABLE RECIPE CHANGE IDFIX IDFIX INT DEFAULT NULL, CHANGE IDCATEGORY IDCATEGORY INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE contains RENAME INDEX idx_8efa6a7e33342c5a TO I_FK_CONTAINS_INGREDIENT');
        $this->addSql('ALTER TABLE contains RENAME INDEX idx_8efa6a7e780680d7 TO I_FK_CONTAINS_RECIPE');
        $this->addSql('ALTER TABLE IMAGE CHANGE IDRECIPE IDRECIPE INT NOT NULL');
        $this->addSql('ALTER TABLE RECIPE CHANGE IDFIX IDFIX INT NOT NULL, CHANGE IDCATEGORY IDCATEGORY INT NOT NULL');
    }
}
