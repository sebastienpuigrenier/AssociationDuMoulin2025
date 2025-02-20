<?php

namespace App\Tests\Controller;

use App\Controller\UtilisateurController;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UtilisateurControllerTest extends TestCase
{
    public function testCreationUtilisateur_creationReussie()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com',
            'password' => 'securepassword'
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $controller = new UtilisateurController();
        $response = $controller->creationUtilisateur($entityManager, $request);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals('Utilisateur créé avec succès', $response->getContent());
    }

    public function testCreationUtilisateur_donneesVides()
    {
        $data = [
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $controller = new UtilisateurController();
        $response = $controller->creationUtilisateur($entityManager, $request);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Données invalides ou manquantes', $response->getContent());
    }

    public function testCreationUtilisateur_donneesIncompletes()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John'
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $controller = new UtilisateurController();
        $response = $controller->creationUtilisateur($entityManager, $request);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Données invalides ou manquantes', $response->getContent());
    }
    public function testCreationUtilisateur_mauvaisFormatEmail()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doeexample.com',
            'password' => 'securepassword'
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->never())->method('persist');
        $entityManager->expects($this->never())->method('flush');

        $controller = new UtilisateurController();
        $response = $controller->creationUtilisateur($entityManager, $request);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Email non valide', $response->getContent());
    }

    public function testCreationUtilisateur_flushException()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com',
            'password' => 'securepassword'
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush')->will($this->throwException(new \Exception()));

        $controller = new UtilisateurController();
        $response = $controller->creationUtilisateur($entityManager, $request);

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
        $this->assertEquals('Une erreur est survenue', $response->getContent());
    }
}