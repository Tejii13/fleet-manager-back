<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

const MEMBER_WITH_ID = 'Member with id ';

class MemberController extends AbstractController
{
    // Route to create new users
    #[Route('/member/new', name: 'create_member', methods: ['POST'])]
    public function CreateMember(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Extract data from the request // TODO Verify the incoming data
        $data = json_decode($request->getContent(), true);

        // Create a new member
        $member = new Member();
        $member->setName($data['name']);
        $member->setAuthToken($data['authToken']);
        $member->setIsAdmin($data['isAdmin']);

        // Persist and flush
        $entityManager->persist($member);
        $entityManager->flush();
        
        return $this->json(['code' => 201,
        'Message' => 'Registred the new member '.$member->getName().($member->isItAdmin() ? ' as admin ' :
        ' as member ').'with authentification token '.$member->getAuthToken().' and id '.$member->getId()]);
    }

    // Route to get an user by Id
    #[Route('member/get_{id}', name: 'get_member', methods: ['GET'])]
    public function getMember(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        // Find user in db
        $member = $entityManager->getRepository(Member::class)->find($id);

        // Verify if the user exists
        if (!$member) {
            return $this->json(['Code' => 404, 'Message' => MEMBER_WITH_ID . $id . ' was not found']);
        }

        // Return the data as JSON
        return $this->json([
            'id' => $member->getId(),
            'name' => $member->getName(),
            'isAdmin' => $member->isItAdmin(),
        ]);
    }

    // Route to delete an user by Id
    #[Route('/member/del_{id}', name: 'delete_member', methods: ['DELETE'])]
    public function deleteMember(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        // Find the user by id
        $member = $entityManager->getRepository(Member::class)->find($id);

        if (!$member) {
            // throw new NotFoundHttpException("There is no user with the id " . $id);
            return $this->json(['Code' => 404, 'Message' => MEMBER_WITH_ID . $id . ' was not found']);

        }

        // delete the user
        $entityManager->remove($member);
        $entityManager->flush();

        return $this->json(['Code' => 201, 'Message' => MEMBER_WITH_ID . $id . ' deleted']);
    }
}
