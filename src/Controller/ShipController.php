<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Ship;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Doctrine\ORM\EntityManagerInterface;


class ShipController extends AbstractController
{
    // Add ship to user fleet //FIXME Error 500
    #[Route('/ship/add', name: 'add_ship', methods: ['POST'])]
    public function addShip(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Extract data from the request
        $data = json_decode($request->getContent(), true);

        // Get the owner ID as an object
        $ownerId = $request->get('ownerId');

        // Create a new Ship
        $ship = new Ship();
        $ship->setOwner($ownerId);
        $ship->setName($data['name']);
        if ($data['uniqueName']) {
            $ship->setUniqueName($data['uniqueName']);
            
        }

        // Persist and flush
        $entityManager->persist($ship);
        $entityManager->flush();

        return $this->json(['code'=>201,'Message'=>'Created a new ship '.$ship->getName().$data['uniqueName']?'named '.$ship->getUniqueName():null]);
    }

    // Update uniqueName //FIXME Doesn't work
    #[Route('/ship/update', name: 'update_ship', methods: ['PUT'])]
    public function changeuniqueName(Request $request, EntityManagerinterface $entityManager): JsonResponse
    {
        // Extract data from the request
        $data = json_decode($request->getContent(), true);

        $shipId = $data['shipId'];

        $newUniqueName = $data['newUniqueName'];

        $ship = $entityManager->getRepository(Ship::class)->find($shipId);

        $ship->setUniqueName($newUniqueName);

        $entityManager->persist($ship);
        $entityManager->flush();

        return $this->json(['Code'=>200, 'Message'=>'Ship name changed to ' . $newUniqueName]);
    }

    // Delete ship from fleet //FIXME Doesn't work
    #[Route('/ship/delete', name: 'delete_ship', methods: ['DELETE'])]
    public function deleteShip(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $shipId = $data['shipId'];

        $ship = $entityManager->getRepository(Ship::class)->find($shipId);

        $entityManager->remove($ship);
        $entityManager->flush();

        return $this->json(['Code'=>200,'Message'=>'Ship deleted successfully']);
    }

    // Get ship information
    #[Route('/ship/info', name: 'get_ship', methods: ['GET'])]
    public function getShipInformation(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $ship = $entityManager->getRepository(Ship::class)->find($data['shipId']);

        return $this->json($ship);
    }
}
