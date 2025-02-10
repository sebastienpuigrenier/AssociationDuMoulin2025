<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

final class ApiLoginController extends AbstractController
{
    public function __construct(
        private readonly JWTTokenManagerInterface $JWTManager,
    )
    {
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function index(
        #[CurrentUser] ?Utilisateur $user
    ): Response
    {
        $token = $this->JWTManager->create($user);
        return $this->json([
            'user'  => $user->getUserIdentifier(),
            'token' => $token,
        ], Response::HTTP_OK);
    }
}
