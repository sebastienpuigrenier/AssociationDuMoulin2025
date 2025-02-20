<?php

namespace App\Tests\Controller;

use App\Controller\EnfantController;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class EnfantControllerTest extends TestCase
{
    public function testCreationEnfant_creationReussie()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'date_de_naissance' => '2010-01-01',
            'email_parent_1' => 'parent1@example.com',
            'email_parent_2' => 'parent2@example.com'
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $controller = new EnfantController($this->createMock(JWTTokenManagerInterface::class));
        $response = $controller->creationEnfant($entityManager, $request);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals('Enfant créé avec succès', $response->getContent());
    }

    public function testCreationEnfant_donneesVides()
    {
        $data = [
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $controller = new EnfantController($this->createMock(JWTTokenManagerInterface::class));
        $response = $controller->creationEnfant($entityManager, $request);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Nom, prénom et date de naissance obligatoire', $response->getContent());
    }

    public function testCreationEnfant_mauvaisFormatDate()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'date_de_naissance' => 'invalid-date'
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $controller = new EnfantController($this->createMock(JWTTokenManagerInterface::class));
        $response = $controller->creationEnfant($entityManager, $request);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Erreur dans le format de la date', $response->getContent());
    }

    public function testCreationEnfant_mauvaisFormatEmail1()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'date_de_naissance' => '2010-01-01',
            'email_parent_1' => 'parent1example.com',
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $controller = new EnfantController($this->createMock(JWTTokenManagerInterface::class));
        $response = $controller->creationEnfant($entityManager, $request);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Erreur dans le format d\'au moins un email', $response->getContent());
    }

    public function testCreationEnfant_mauvaisFormatEmail2()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'date_de_naissance' => '2010-01-01',
            'email_parent_2' => 'parent1example.com',
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $controller = new EnfantController($this->createMock(JWTTokenManagerInterface::class));
        $response = $controller->creationEnfant($entityManager, $request);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals('Erreur dans le format d\'au moins un email', $response->getContent());
    }

    public function testCreationEnfant_flushException()
    {
        $data = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'date_de_naissance' => '2010-01-01'
        ];

        $request = new Request([], [], [], [], [], [], json_encode($data));
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush')->will($this->throwException(new \Exception()));

        $controller = new EnfantController($this->createMock(JWTTokenManagerInterface::class));
        $response = $controller->creationEnfant($entityManager, $request);

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
        $this->assertEquals('Une erreur est survenue lors de l\'enregistrement du nouvel enfant', $response->getContent());
    }
}