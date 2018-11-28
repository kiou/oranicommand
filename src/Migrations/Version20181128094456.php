<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128094456 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, titre VARCHAR(255) NOT NULL, lien VARCHAR(255) DEFAULT NULL, destination TINYINT(1) NOT NULL, isActive TINYINT(1) NOT NULL, parent INT NOT NULL, poid INT NOT NULL, langue VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, referencement_id INT DEFAULT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(191) NOT NULL, contenu LONGTEXT NOT NULL, isActive TINYINT(1) NOT NULL, poid INT NOT NULL, langue VARCHAR(8) NOT NULL, UNIQUE INDEX UNIQ_140AB620989D9B62 (slug), UNIQUE INDEX UNIQ_140AB6209039D8F0 (referencement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referencement (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, ogtitle VARCHAR(255) DEFAULT NULL, ogdescription VARCHAR(255) DEFAULT NULL, ogurl VARCHAR(255) DEFAULT NULL, ogimage VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, nickname VARCHAR(191) NOT NULL, username VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(191) NOT NULL, isActive TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', avatar VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649A188FE64 (nickname), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_historique (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, contenu LONGTEXT NOT NULL, ip VARCHAR(255) NOT NULL, INDEX IDX_4AD81300FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_newsletter (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, email VARCHAR(255) NOT NULL, langue VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_reinitialisation (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, changed DATETIME DEFAULT NULL, email VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, isActive TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6209039D8F0 FOREIGN KEY (referencement_id) REFERENCES referencement (id)');
        $this->addSql('ALTER TABLE user_historique ADD CONSTRAINT FK_4AD81300FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6209039D8F0');
        $this->addSql('ALTER TABLE user_historique DROP FOREIGN KEY FK_4AD81300FB88E14F');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE referencement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE user_historique');
        $this->addSql('DROP TABLE user_newsletter');
        $this->addSql('DROP TABLE user_reinitialisation');
    }
}
