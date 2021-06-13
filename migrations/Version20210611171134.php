<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Bridge\Doctrine\Types\UuidType;

final class Version20210611171134 extends AbstractMigration
{
    private const TABLE_BREED = 'breed';

    public function getDescription(): string
    {
        return 'Adds/Removes breed table';
    }

    public function up(Schema $schema): void
    {
        $tableBreed = $schema->createTable(self::TABLE_BREED);

        $tableBreed->addColumn('id', (new UuidType())->getName());
        $tableBreed->addColumn('name', Types::STRING, [
            'length' => 50,
        ]);
        $tableBreed->addColumn('description', Types::STRING, [
            'length' => 255,
        ]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_BREED);
    }
}