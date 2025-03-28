<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250328165758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cria a tabela de pagamento';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE payment.payment (
                                id INT auto_increment NOT NULL,
                                user_id varchar(36) NOT NULL,
                                value DECIMAL(10, 2) NOT NULL,
                                currency_currency_code varchar(3) NOT NULL,
                                payment_method_payment_method varchar(255) NULL,
                                PRIMARY KEY (id)
                            )
                            ENGINE=InnoDB
                            DEFAULT CHARSET=utf8
                            COLLATE=utf8_general_ci;
                        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE payment.payment;');
    }
}
