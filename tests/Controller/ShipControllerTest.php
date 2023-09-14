<?php

// tests/Controller/ShipControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShipControllerTest extends WebTestCase
{
  public function testAddShip(): void
  {
    $client = static::createClient();

    // Envoyer une requête POST simulée avec des données JSON
    $client->request(
      'POST',
      '/ship/add',
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      '{"ownerId": 1, "name": "Mon vaisseau", "uniqueName": "Mon nom unique"}'
    );

    // Vérifier que la réponse a un code de statut 201 (Created)
    $this->assertSame(201, $client->getResponse()->getStatusCode());

    // Vérifier que la réponse contient le message attendu
    $responseData = json_decode($client->getResponse()->getContent(), true);
    $this->assertSame(['code' => 201, 'Message' => 'Created a new ship Mon vaisseau named Mon nom unique'], $responseData);
  }
}
