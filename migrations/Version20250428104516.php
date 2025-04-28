<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250428104516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create review table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE review (
                id SERIAL NOT NULL,
                company_name VARCHAR(255) NOT NULL,
                rating INT NOT NULL,
                review_text TEXT NOT NULL,
                author_email VARCHAR(255) NOT NULL,
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                PRIMARY KEY(id)
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE review');
    }
}
