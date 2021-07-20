<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719143520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, categorie_id INT NOT NULL, auteur_id INT DEFAULT NULL, isbn VARCHAR(60) NOT NULL, titre VARCHAR(70) NOT NULL, description LONGTEXT DEFAULT NULL, date_parution DATE DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_23A0E66C54C8C93 (type_id), INDEX IDX_23A0E66BCF5E72D (categorie_id), INDEX IDX_23A0E6660BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_stock (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, taux_tva NUMERIC(5, 2) NOT NULL, remise NUMERIC(5, 2) DEFAULT NULL, quantite INT NOT NULL, date_reception DATE DEFAULT NULL, date_commande DATE NOT NULL, INDEX IDX_3C8124717294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_stock_fournisseur (article_stock_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_204B18FB5825957B (article_stock_id), INDEX IDX_204B18FB670C757F (fournisseur_id), PRIMARY KEY(article_stock_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) NOT NULL, prenom VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) NOT NULL, tva VARCHAR(20) NOT NULL, contact VARCHAR(80) NOT NULL, telephone VARCHAR(15) NOT NULL, email VARCHAR(50) NOT NULL, adresse_web VARCHAR(150) NOT NULL, identifiant VARCHAR(40) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_article (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C54C8C93 FOREIGN KEY (type_id) REFERENCES type_article (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6660BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id)');
        $this->addSql('ALTER TABLE article_stock ADD CONSTRAINT FK_3C8124717294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_stock_fournisseur ADD CONSTRAINT FK_204B18FB5825957B FOREIGN KEY (article_stock_id) REFERENCES article_stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_stock_fournisseur ADD CONSTRAINT FK_204B18FB670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_stock DROP FOREIGN KEY FK_3C8124717294869C');
        $this->addSql('ALTER TABLE article_stock_fournisseur DROP FOREIGN KEY FK_204B18FB5825957B');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6660BB6FE6');
        $this->addSql('ALTER TABLE article_stock_fournisseur DROP FOREIGN KEY FK_204B18FB670C757F');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C54C8C93');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_stock');
        $this->addSql('DROP TABLE article_stock_fournisseur');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE type_article');
    }
}
