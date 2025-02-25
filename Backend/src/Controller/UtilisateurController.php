<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_creation_utilisateur')]
    public function creationUtilisateur(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $data = json_decode($request->getContent(), true);

        if (
            $data === null
            || !isset($data['nom'])
            || !isset($data['prenom'])
            || !isset($data['email'])
            || !isset($data['password'])
        ) {
            return new Response('Données invalides ou manquantes', Response::HTTP_BAD_REQUEST);
        }

        if (
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            return new Response('Email non valide', Response::HTTP_BAD_REQUEST);
        }

        $utilisateur = new Utilisateur();
        $utilisateur->setNom($data['nom']);
        $utilisateur->setPrenom($data['prenom']);
        $utilisateur->setEmail($data['email']);
        $utilisateur->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));

        $entityManager->persist($utilisateur);
        try {
            $entityManager->flush();
        } catch (\Exception $e) {
            return new Response('Une erreur est survenue', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('Utilisateur créé avec succès', Response::HTTP_CREATED);

    }
}
