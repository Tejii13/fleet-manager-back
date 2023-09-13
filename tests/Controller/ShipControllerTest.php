<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ShipControllerTest extends WebTestCase
{
  private $client;

  protected function setUp(): void
  {
    parent::setUp();

    $this->client = static::createClient();
  }

  public function testAddShip()
  {

    // Mock the EntityManager
    $entityManager = $this->client->getContainer()->get('doctrine')->getManager();

    // Create a sample request data
    $requestData = [
      'ownerId' => 1,
      'name' => 'Sample Ship',
      'uniqueName' => 'UniqueName',
    ];

    // Send a POST request
    $this->client->request('POST', '/ship/add', [], [], [], json_encode($requestData));

    // Assert the response
    $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
  }
}