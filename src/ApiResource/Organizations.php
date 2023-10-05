<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\OrganizationsShipsProvider;

#[ApiResource(operations: [
  new Get(uriTemplate: '/organizations/{id}/ships', provider: OrganizationsShipsProvider::class),
])]
class Organizations
{
  #[ApiProperty(identifier: true)]
  public int $id;
  // ...
}
