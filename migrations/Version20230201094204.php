<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201094204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE custom_skill (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', id_theme BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(50) NOT NULL, INDEX IDX_9D301C1E79F0A638 (id_theme), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', id_user BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', date_eval DATE NOT NULL, INDEX IDX_1323A5756B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation_skill (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', id_skill BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', id_custom_skill BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', id_evaluation BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', skill_lvl INT DEFAULT NULL, appreciation_lvl INT DEFAULT NULL, expert TINYINT(1) NOT NULL, certified TINYINT(1) NOT NULL, speaker TINYINT(1) NOT NULL, former TINYINT(1) NOT NULL, concerned TINYINT(1) NOT NULL, INDEX IDX_9BCA9986B0B8A547 (id_skill), INDEX IDX_9BCA9986BEF1696C (id_custom_skill), INDEX IDX_9BCA9986B6A925A2 (id_evaluation), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', id_theme BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(50) NOT NULL, INDEX IDX_5E3DE47779F0A638 (id_theme), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(50) NOT NULL, ref_code VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE custom_skill ADD CONSTRAINT FK_9D301C1E79F0A638 FOREIGN KEY (id_theme) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5756B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evaluation_skill ADD CONSTRAINT FK_9BCA9986B0B8A547 FOREIGN KEY (id_skill) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE evaluation_skill ADD CONSTRAINT FK_9BCA9986BEF1696C FOREIGN KEY (id_custom_skill) REFERENCES custom_skill (id)');
        $this->addSql('ALTER TABLE evaluation_skill ADD CONSTRAINT FK_9BCA9986B6A925A2 FOREIGN KEY (id_evaluation) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47779F0A638 FOREIGN KEY (id_theme) REFERENCES theme (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom_skill DROP FOREIGN KEY FK_9D301C1E79F0A638');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5756B3CA4B');
        $this->addSql('ALTER TABLE evaluation_skill DROP FOREIGN KEY FK_9BCA9986B0B8A547');
        $this->addSql('ALTER TABLE evaluation_skill DROP FOREIGN KEY FK_9BCA9986BEF1696C');
        $this->addSql('ALTER TABLE evaluation_skill DROP FOREIGN KEY FK_9BCA9986B6A925A2');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47779F0A638');
        $this->addSql('DROP TABLE custom_skill');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE evaluation_skill');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
