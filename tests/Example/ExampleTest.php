<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExampleTest extends KernelTestCase
{
    public function testIfOneIsEqualsOne(): void
    {
        $nome = 'Pandora';

        $n = 'Pandora';

        $this->assertEquals($nome, $n);
    }
}