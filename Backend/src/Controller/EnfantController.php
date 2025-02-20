<?php

namespace App\Controller;

use App\Entity\Enfant;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function PHPUnit\Framework\isNull;

final class EnfantController extends AbstractController
{
    public function __construct(
        private readonly JWTTokenManagerInterface $jwtManager,
    ) {
    }

    #[Route('/enfant/creation', name: 'app_creation_enfant')]
    public function creationEnfant(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $data = json_decode($request->getContent(), true);

        if (
            $data === null
            || !isset($data['nom'])
            || !isset($data['prenom'])
            || !isset($data['date_de_naissance'])
        ) {
            return new Response('Nom, prénom et date de naissance obligatoire', Response::HTTP_BAD_REQUEST);
        }
        if (!strtotime($data['date_de_naissance'])) {
            return new Response('Erreur dans le format de la date', Response::HTTP_BAD_REQUEST);
        }
        if (
            (isset($data['email_parent_1']) && !filter_var($data['email_parent_1'], FILTER_VALIDATE_EMAIL)) ||
            (isset($data['email_parent_2']) && !filter_var($data['email_parent_2'], FILTER_VALIDATE_EMAIL))
        ) {
            return new Response('Erreur dans le format d\'au moins un email', Response::HTTP_BAD_REQUEST);
        }

        $enfant = new Enfant();
        $enfant->setDateDeNaissance(new \DateTimeImmutable($data['date_de_naissance']));
        $enfant->setNom($data['nom']);
        $enfant->setPrenom($data['prenom']);
        $enfant->setEmailParent1($data['email_parent_1'] ?? null);
        $enfant->setEmailParent2($data['email_parent_2'] ?? null);

        $entityManager->persist($enfant);
        try {
            $entityManager->flush();
        } catch (\Exception $e) {
            return new Response('Une erreur est survenue lors de l\'enregistrement du nouvel enfant', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('Enfant créé avec succès', Response::HTTP_CREATED);
    }

    #[Route('/enfant/information', name: 'app_recuperation_enfant')]
    public function getEnfant(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        // recupère le header sans "Bearer "
        $token = $request->headers->get('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if (!$token) {
            return new Response('JWT token non trouvé', Response::HTTP_UNAUTHORIZED);
        }

        $decodedJwtToken = $this->jwtManager->parse($token);
        if (!$decodedJwtToken['username']) {
            return new Response('JWT token invalide', Response::HTTP_UNAUTHORIZED);
        }

        $enfant = $entityManager->getRepository(Enfant::class)->findBy(['email_parent_1' => $decodedJwtToken['username']]);
        if (!$enfant) {
            return new Response('Aucun enfant trouvé pour l\'utilisateur ' . $decodedJwtToken['username'], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'user'  => $decodedJwtToken['username'],
            'enfant' => $enfant,
            'message' => 'Information de l\'enfant récupéré'
        ], Response::HTTP_OK);
    }
}
