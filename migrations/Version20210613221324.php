<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Bridge\Doctrine\Types\UuidType;

final class Version20210613221324 extends AbstractMigration
{
    private const TABLE_USER = 'pet_user';

    public function getDescription(): string
    {
        return 'Adds/Removes user table';
    }

    public function up(Schema $schema): void
    {
        $tableUser = $schema->createTable(self::TABLE_USER);

        $tableUser->addColumn('id', (new UuidType())->getName());
        $tableUser->addColumn('name', Types::STRING, [
            'length' => 100,
        ]);
        $tableUser->addColumn('email', Types::STRING, [
            'length' => 100,
            'customSchemaOptions' => [
                'unique' => true
            ]
        ]);
        $tableUser->addColumn('phone', Types::STRING, [
            'length' => 50,
        ]);
        $tableUser->addColumn('password', Types::STRING, [
            'length' => 255,
        ]);
        $tableUser->addColumn('status', Types::BOOLEAN);
        $tableUser->addColumn('photo', Types::STRING);
        $tableUser->addColumn('roles', Types::JSON);
        $tableUser->addColumn('created_at', Types::DATETIME_IMMUTABLE);
        $tableUser->addColumn('updated_at', Types::DATETIME_MUTABLE);
        $tableUser->addColumn('deleted_at', Types::DATETIME_MUTABLE, [
            'notnull' => false,
        ]);

        $tableUser->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_USER);
    }
}
