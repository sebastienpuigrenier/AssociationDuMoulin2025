<?php

namespace App\Entity;

use App\Repository\EnfantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;

#[ORM\Entity(repositoryClass: EnfantRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER', fields: ['nom', 'prenom', 'date_de_naissance'])]
class Enfant
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private string $id;

    #[ORM\Column(length: 255)]
    private string $nom;

    #[ORM\Column(length: 255)]
    private string $prenom;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private \DateTimeImmutable $date_de_naissance;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email_parent_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email_parent_2 = null;

    public function __construct(
    ) {
        $this->id = Uuid::uuid4()->toString();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): \DateTimeImmutable
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeImmutable $date_de_naissance): static
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getEmailParent1(): ?string
    {
        return $this->email_parent_1;
    }

    public function setEmailParent1(?string $email_parent_1): static
    {
        $this->email_parent_1 = $email_parent_1;

        return $this;
    }

    public function getEmailParent2(): ?string
    {
        return $this->email_parent_2;
    }

    public function setEmailParent2(?string $email_parent_2): static
    {
        $this->email_parent_2 = $email_parent_2;

        return $this;
    }
}
