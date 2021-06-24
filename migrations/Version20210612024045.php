<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Bridge\Doctrine\Types\UuidType;

final class Version20210612024045 extends AbstractMigration
{
    private const TABLE_PET = 'pet';
    private const TABLE_BREED = 'breed';

    public function getDescription(): string
    {
        return 'Adds/Removes pet table';
    }

    public function up(Schema $schema): void
    {
        $tablePet = $schema->createTable(self::TABLE_PET);

        $tablePet->addColumn('id', (new UuidType())->getName());
        $tablePet->addColumn('name', Types::STRING, [
            'length' => 30,
        ]);
        $tablePet->addColumn('birth', Types::DATETIME_MUTABLE, [
            'notnull' => false,
        ]);
        $tablePet->addColumn('breed_id', (new UuidType())->getName());
        $tablePet->addColumn('photos', Types::ARRAY);
        $tablePet->addColumn('description', Types::STRING, [
            'length' => 255,
        ]);
        $tablePet->addColumn('available', Types::BOOLEAN);
        $tablePet->addColumn('diseases', Types::STRING);
        $tablePet->addColumn('vaccines', Types::STRING);
        $tablePet->addColumn('created_at', Types::DATETIME_IMMUTABLE);
        $tablePet->addColumn('updated_at', Types::DATETIME_MUTABLE, [
            'notnull' => false
        ]);
        $tablePet->addColumn('deleted_at', Types::DATETIME_MUTABLE, [
            'notnull' => false
        ]);
        $tablePet->setPrimaryKey(['id']);
        $tablePet->addForeignKeyConstraint(self::TABLE_BREED, ['breed_id'], ['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_PET);
    }
}
