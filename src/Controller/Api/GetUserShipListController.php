<?php

namespace App\Controller\Api;

use App\Entity\Ship;
use App\Repository\ShipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetUserShipListController extends AbstractController
{
  #[Route('/api/ships/list', name: 'app_shipsList', methods: ['POST'])]
  public function getList(Request $request, ShipRepository $shipRepository): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $shipsList = $shipRepository->findBy(['owner' => $data['userId']]);

    return $this->json($shipsList);
  }
}
