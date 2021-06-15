<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Bridge\Doctrine\Types\UuidType;

final class Version20210615194734 extends AbstractMigration
{
    private const TABLE_PETTYPE = 'petType';

    public function getDescription(): string
    {
        return 'Adds/Removes petType table';
    }

    public function up(Schema $schema): void
    {
        $tablePetType = $schema->createTable(self::TABLE_PETTYPE);

        $tablePetType->addColumn('id', (new UuidType())->getName());
        $tablePetType->addColumn('name', Types::STRING, [
            'length' => 50,
        ]);
        $tablePetType->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_PETTYPE);
    }
}