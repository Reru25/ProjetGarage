<?php

namespace App\Entity;

use App\Repository\ReviewsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewsRepository::class)]
class Reviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: 'User', inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: true, onDelete:'SET NULL')]
    private ?User $user_mail = null;

    #[ORM\Column]
    private ?int $grade = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $review = null;

    #[ORM\Column]
    private ?bool $was_moderated = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserMail(): ?User
    {
        return $this->user_mail;
    }

    public function setUserMail(User $user_mail): static
    {
        $this->user_mail = $user_mail;

        return $this;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): static
    {
        $this->review = $review;

        return $this;
    }

    public function isWasModerated(): ?bool
    {
        return $this->was_moderated;
    }

    public function setWasModerated(bool $was_moderated): static
    {
        $this->was_moderated = $was_moderated;

        return $this;
    }
}
