<?php

declare(strict_types=1);

namespace App\Tests\Api\PetType;

use App\DataFixtures\PetTypeFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PetTypeApiTest extends WebTestCase
{
    public const BASE_URL = '/pet-types';

    public function testGetPetTypeCollection(): void
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, self::BASE_URL);

        $response = json_decode($client->getResponse()->getContent());

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertEquals(PetTypeFixtures::PETTYPE_QUANTITY_TOTAL, count($response));
    }

    public function testGetOnePetTypeFromCollection(): void
    {
        $client = static::createClient();

        $id = PetTypeFixtures::PETTYPE_CAT_ID;

        $client->request(Request::METHOD_GET, self::BASE_URL.'/'.$id);

        $response = json_decode($client->getResponse()->getContent());

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertIsObject($response);
        $this->assertEquals('Gato', $response->name);
    }

    public function testPatchOnePetTypeInCollection(): void
    {
        $client = static::createClient();

        $id = PetTypeFixtures::PETTYPE_CAT_ID;

        $data = [
            'name' => 'Gato felix',
        ];

        $client->request(
            Request::METHOD_PATCH,
            self::BASE_URL.'/'.$id,
            [],
            [],
            [],
            json_encode($data)
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);

        $client->request(Request::METHOD_GET, self::BASE_URL.'/'.$id);

        $response = json_decode($client->getResponse()->getContent());

        $this->assertIsObject($response);
        $this->assertEquals('Gato felix', $response->name);
    }

    public function testDeleteOnePetTypeFromCollection(): void
    {
        $client = static::createClient();

        $id = PetTypeFixtures::PETTYPE_CAT_ID;

        $client->request(Request::METHOD_DELETE, self::BASE_URL.'/'.$id);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);


        $client->request(Request::METHOD_GET, self::BASE_URL);

        $response = json_decode($client->getResponse()->getContent());
        $this->assertEquals(PetTypeFixtures::PETTYPE_QUANTITY_TOTAL - 1, count($response));
    }

    public function testPostOnePetTypeInCollection(): void
    {
        $client = static::createClient();

        $data = [
            'name' => 'Crocodilo',
        ];

        $client->request(
            Request::METHOD_POST,
            self::BASE_URL,
            [],
            [],
            [],
            json_encode($data)
        );

        $response = json_decode($client->getResponse()->getContent());

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertIsObject($response);
        $this->assertEquals('Crocodilo', $response->name);
    }
}