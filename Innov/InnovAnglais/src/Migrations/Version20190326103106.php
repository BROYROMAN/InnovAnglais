<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326103106 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE obtenir CHANGE user_id user_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE abonnements_id abonnements_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE test CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choix ADD choix_id INT DEFAULT NULL, DROP choix, CHANGE question_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_4F488091D9144651 FOREIGN KEY (choix_id) REFERENCES vocabulaire (id)');
        $this->addSql('CREATE INDEX IDX_4F488091D9144651 ON choix (choix_id)');
        $this->addSql('ALTER TABLE vocabulaire CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE theme_id theme_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choix DROP FOREIGN KEY FK_4F488091D9144651');
        $this->addSql('DROP INDEX IDX_4F488091D9144651 ON choix');
        $this->addSql('ALTER TABLE choix ADD choix VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP choix_id, CHANGE question_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE obtenir CHANGE user_id user_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE theme_id theme_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE abonnements_id abonnements_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE vocabulaire CHANGE user_id user_id INT DEFAULT NULL');
    }
}
