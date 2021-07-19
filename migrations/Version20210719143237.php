<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719143237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_stock (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, taux_tva NUMERIC(5, 2) NOT NULL, remise NUMERIC(5, 2) DEFAULT NULL, quantite INT NOT NULL, date_reception DATE DEFAULT NULL, date_commande DATE NOT NULL, INDEX IDX_3C8124717294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_stock_fournisseur (article_stock_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_204B18FB5825957B (article_stock_id), INDEX IDX_204B18FB670C757F (fournisseur_id), PRIMARY KEY(article_stock_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_stock ADD CONSTRAINT FK_3C8124717294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_stock_fournisseur ADD CONSTRAINT FK_204B18FB5825957B FOREIGN KEY (article_stock_id) REFERENCES article_stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_stock_fournisseur ADD CONSTRAINT FK_204B18FB670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_stock_fournisseur DROP FOREIGN KEY FK_204B18FB5825957B');
        $this->addSql('DROP TABLE article_stock');
        $this->addSql('DROP TABLE article_stock_fournisseur');
    }
}
