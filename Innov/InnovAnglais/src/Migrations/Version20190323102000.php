<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190323102000 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE obtenir CHANGE user_id user_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE abonnements_id abonnements_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE test CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vocabulaire CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD test_id INT DEFAULT NULL, CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E1E5D0459 ON question (test_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE obtenir CHANGE user_id user_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E1E5D0459');
        $this->addSql('DROP INDEX IDX_B6F7494E1E5D0459 ON question');
        $this->addSql('ALTER TABLE question DROP test_id, CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE abonnements_id abonnements_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE vocabulaire CHANGE user_id user_id INT DEFAULT NULL');
    }
}
