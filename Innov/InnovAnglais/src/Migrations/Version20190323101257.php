<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190323101257 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE date');
        $this->addSql('ALTER TABLE obtenir CHANGE user_id user_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE abonnements_id abonnements_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE test CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vocabulaire CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE date (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE question');
        $this->addSql('ALTER TABLE obtenir CHANGE user_id user_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE abonnements_id abonnements_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE vocabulaire CHANGE user_id user_id INT DEFAULT NULL');
    }
}
