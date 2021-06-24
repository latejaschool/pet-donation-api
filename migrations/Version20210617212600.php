<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20210617212600 extends AbstractMigration
{
    private const TABLE_BREED = 'breed';

    public function getDescription(): string
    {
        return 'Adds/Removes new columns on breed table';
    }

    public function up(Schema $schema): void
    {
        $tableBreed = $schema->getTable(self::TABLE_BREED);

        $tableBreed->addColumn('created_at', Types::DATETIME_IMMUTABLE);
        $tableBreed->addColumn('updated_at', Types::DATETIME_MUTABLE);
        $tableBreed->addColumn('deleted_at', Types::DATETIME_MUTABLE, [
            'notnull' => false
        ]);
    }

    public function down(Schema $schema): void
    {
        $tableBreed = $schema->getTable(self::TABLE_BREED);

        $tableBreed->dropColumn('created_at');
        $tableBreed->dropColumn('updated_at');
        $tableBreed->dropColumn('deleted_at');
    }
}