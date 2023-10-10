<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\OrganizationsShipsProvider;
use App\State\OrganizationsUsersProvider;

#[ApiResource(operations: [
  new Get(uriTemplate: '/organizations/{id}/ships', provider: OrganizationsShipsProvider::class),
  new Get(uriTemplate: '/organizations/{id}/users', provider: OrganizationsUsersProvider::class),

])]
class Organizations
{
  #[ApiProperty(identifier: true)]
  public int $id;
  // ...
}
