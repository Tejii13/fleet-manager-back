<?php
// api/src/Entity/Book.php
namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\CreateBookPublication;
use App\State\OrganizationsShipsProvider;
use phpDocumentor\Reflection\Types\Integer;

#[ApiResource(types: ['https://schema.org/Book'], operations: [
  new Get(uriTemplate: '/organizations/{id}/ships', provider: OrganizationsShipsProvider::class),
])]
class OrganizationsShips
{
  #[ApiProperty(identifier: true)]
  public int $id;
  // ...
}
