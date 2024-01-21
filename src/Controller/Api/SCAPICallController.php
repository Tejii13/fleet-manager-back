<?php

namespace App\Controller\Api;

use App\Service\SCAPICall;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SCAPICallController extends AbstractController
{
    #[Route('/api/sc_api', name: 'app_api_sc_call', methods: ['GET'])]
    public function SCAPICall(SCAPICall $apiCall)
    {
        return $apiCall->CallSCAPI();
    }
}
