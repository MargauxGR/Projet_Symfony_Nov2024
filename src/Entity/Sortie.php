<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Merci de nommer la sortie.')]
    #[Assert\Length(min: 25, max: 255,
        minMessage: "Minimum {{ limit }} caractères requis.",
        maxMessage: "Texte limité à {{ limit }} caractères.")]
    #[Assert\Regex(pattern: '/^[a-z0-9_-]+$/i',
        message: 'Merci de n\'utiliser que des lettres, des chiffres, ou des tirets tels que "-" "_".',)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    #[Assert\NotBlank(message: 'Merci de préciser la date et l\'heure de la sortie.')]
    private ?\DateTimeImmutable $dateHeureDebut = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Merci d\'indiquer une durée en minutes.')]
    private ?int $duree = null;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    #[Assert\NotBlank(message: 'Merci de sélectionner une date limite pour l\'inscription à la sortie.')]
    private ?\DateTimeImmutable $dateLimiteInscription = null;

    #[ORM\Column(nullable: false)]
    private ?int $nbInscriptionsMax = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Merci de décrire la sortie.')]
    #[Assert\Length(min: 50, max: 2550,
        minMessage: "Minimum {{limit}} caractères requis",
        maxMessage: "Texte limité à {{limit}} caractères.")]
    #[Assert\Regex(pattern: '/^[a-z0-9_-]+$/i',
        message: 'Merci de n\'utiliser que des lettres, des chiffres, ou caractères spéciaux autorisés(-_.,;:!?() ).',)
        ]
    private ?string $infosSortie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateHeureDebut(): ?\DateTimeImmutable
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(?\DateTimeImmutable $dateHeureDebut): static
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateLimiteInscription(): ?\DateTimeImmutable
    {
        return $this->dateLimiteInscription;
    }

    public function setDateLimiteInscription(?\DateTimeImmutable $dateLimiteInscription): static
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

        return $this;
    }

    public function getNbInscriptionsMax(): ?int
    {
        return $this->nbInscriptionsMax;
    }

    public function setNbInscriptionsMax(?int $nbInscriptionsMax): static
    {
        $this->nbInscriptionsMax = $nbInscriptionsMax;

        return $this;
    }

    public function getInfosSortie(): ?string
    {
        return $this->infosSortie;
    }

    public function setInfosSortie(?string $infosSortie): static
    {
        $this->infosSortie = $infosSortie;

        return $this;
    }



}
