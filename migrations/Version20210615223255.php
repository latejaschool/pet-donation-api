<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Bridge\Doctrine\Types\UuidType;

final class Version20210615223255 extends AbstractMigration
{
    private const TABLE_NGO = 'ngo';
    private const TABLE_ADDRESS = 'address';

    public function getDescription(): string
    {
        return 'Adds/Removes ngo table';
    }

    public function up(Schema $schema): void
    {
        $tableNgo = $schema->createTable(self::TABLE_NGO);

        $tableNgo->addColumn('id', (new UuidType())->getName());
        $tableNgo->addColumn('name', Types::STRING, [
            'length' => 100,
        ]);
        $tableNgo->addColumn('social_name', Types::STRING, [
            'length' => 100,
            'notnull' => false,
        ]);
        $tableNgo->addColumn('address_id', (new UuidType())->getName());
        $tableNgo->addColumn('fiscal_code', Types::STRING, [
            'length' => 20,
            'notnull' => false,
        ]);
        $tableNgo->addColumn('site', Types::STRING, [
            'notnull' => false
        ]);
        $tableNgo->addColumn('phone', Types::STRING, [
            'length' => 11
        ]);
        $tableNgo->addColumn('created_at', Types::DATETIME_IMMUTABLE);
        $tableNgo->addColumn('updated_at', Types::DATETIME_MUTABLE);
        $tableNgo->addColumn('deleted_at', Types::DATETIME_MUTABLE, [
            'notnull' => false
        ]);
        $tableNgo->setPrimaryKey(['id']);
        $tableNgo->addForeignKeyConstraint(self::TABLE_ADDRESS, ['address_id'], ['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_NGO);
    }
}