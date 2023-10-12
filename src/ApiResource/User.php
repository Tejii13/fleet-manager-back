<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\State\UserShipsProvider;

#[ApiResource(operations: [
  new Get(uriTemplate: '/users/{id}/ships', provider: UserShipsProvider::class),
])]
class User
{
  #[ApiProperty(identifier: true)]
  public int $id;
  // ...
}
