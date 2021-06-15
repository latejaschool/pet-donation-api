<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Bridge\Doctrine\Types\UuidType;

final class Version20210615222949 extends AbstractMigration
{
    private const TABLE_ADDRESS = 'address';

    public function getDescription(): string
    {
        return 'Adds/Removes address table';
    }

    public function up(Schema $schema): void
    {
        $tableAddress = $schema->createTable(self::TABLE_ADDRESS);

        $tableAddress->addColumn('id', (new UuidType())->getName());
        $tableAddress->addColumn('street', Types::STRING, [
            'length' => 100,
        ]);
        $tableAddress->addColumn('number', Types::INTEGER, [
            'length' => 255,
            'notnull' => false,
        ]);
        $tableAddress->addColumn('district', Types::STRING, [
            'length' => 50,
        ]);
        $tableAddress->addColumn('complement', Types::STRING, [
            'length' => 255,
            'notnull' => false,
        ]);
        $tableAddress->addColumn('city', Types::STRING, [
            'length' => 100,
            'notnull' => false,
        ]);
        $tableAddress->addColumn('state', Types::STRING, [
            'length' => 2,
        ]);
        $tableAddress->addColumn('zipcode', Types::STRING, [
            'length' => 10,
        ]);
        $tableAddress->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_ADDRESS);
    }
}
