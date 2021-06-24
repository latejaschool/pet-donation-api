<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20210622211100 extends AbstractMigration
{
    private const TABLE_PET_TYPE = 'pet_type';

    public function getDescription(): string
    {
        return 'Adds/Removes new columns on petType table';
    }

    public function up(Schema $schema): void
    {
        $tablePetType = $schema->getTable(self::TABLE_PET_TYPE);

        $tablePetType->addColumn('created_at', Types::DATETIME_IMMUTABLE);
        $tablePetType->addColumn('updated_at', Types::DATETIME_MUTABLE);
        $tablePetType->addColumn('deleted_at', Types::DATETIME_MUTABLE, [
            'notnull' => false
        ]);
    }

    public function down(Schema $schema): void
    {
        $tablePetType = $schema->getTable(self::TABLE_PET_TYPE);

        $tablePetType->dropColumn('created_at');
        $tablePetType->dropColumn('updated_at');
        $tablePetType->dropColumn('deleted_at');
    }
} 