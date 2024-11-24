<?php

namespace App\Entity;

use App\Repository\OutingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OutingRepository::class)]
class Outing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Merci de nommer la sortie.')]
    #[Assert\Length(min: 15, max: 255,
        minMessage: "Minimum {{ limit }} caractères requis.",
        maxMessage: "Texte limité à {{ limit }} caractères.")]
    #[Assert\Regex(pattern: '/^[a-zÀ-ù 0-9_-]+$/i',
        message: 'Merci de n\'utiliser que des lettres, des chiffres, ou des tirets tels que "-" "_".',)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    #[Assert\NotBlank(message: 'Merci de préciser la date et l\'heure de la sortie.')]
    private ?\DateTimeImmutable $startDateTime = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Merci d\'indiquer une durée en minutes.')]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    #[Assert\NotBlank(message: 'Merci de sélectionner une date limite pour l\'inscription à la sortie.')]
    private ?\DateTimeImmutable $registrationDeadline = null;

    #[ORM\Column(nullable: false)]
    private ?int $maxNbRegistration = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Merci de décrire la sortie.')]
    #[Assert\Length(min: 50, max: 2550,
        minMessage: "Minimum {{ limit }} caractères requis",
        maxMessage: "Texte limité à {{ limit }} caractères.")]
    #[Assert\Regex(pattern: '/^[a-zÀ-ù 0-9_-]+$/i',
        message: 'Merci de n\'utiliser que des lettres, des chiffres, ou caractères spéciaux autorisés(-_.,;:!?() ).',)
        ]
    private ?string $outingDetails = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDateTime(): ?\DateTimeImmutable
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(?\DateTimeImmutable $startDateTime): static
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getRegistrationDeadline(): ?\DateTimeImmutable
    {
        return $this->registrationDeadline;
    }

    public function setRegistrationDeadline(?\DateTimeImmutable $registrationDeadline): static
    {
        $this->registrationDeadline = $registrationDeadline;

        return $this;
    }

    public function getMaxNbRegistration(): ?int
    {
        return $this->maxNbRegistration;
    }

    public function setMaxNbRegistration(?int $maxNbRegistration): static
    {
        $this->maxNbRegistration = $maxNbRegistration;

        return $this;
    }

    public function getOutingDetails(): ?string
    {
        return $this->outingDetails;
    }

    public function setOutingDetails(?string $outingDetails): static
    {
        $this->outingDetails = $outingDetails;

        return $this;
    }





}
