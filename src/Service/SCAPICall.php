<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class SCAPICall
{
  public function __construct(
    private HttpClientInterface $client,
  ) {
  }

  public function CallSCAPI()
  {
    $response = $this->client->request(
      'GET',
      'https://api.starcitizen-api.com/a57fe0c2188cdf13bcd164354d591d3b/cache/ships'
    );

    $statusCode = $response->getStatusCode();
    $content = $response->getContent();

    return new JsonResponse($content, $statusCode, [], true);
  }
}
