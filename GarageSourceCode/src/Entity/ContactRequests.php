<?php

namespace App\Entity;

use App\Repository\ContactRequestsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRequestsRepository::class)]
class ContactRequests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $user_firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $user_lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $user_eMail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $user_phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subject = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $user_message = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserFirstName(): ?string
    {
        return $this->user_firstName;
    }

    public function setUserFirstName(string $user_firstName): static
    {
        $this->user_firstName = $user_firstName;

        return $this;
    }

    public function getUserLastName(): ?string
    {
        return $this->user_lastName;
    }

    public function setUserLastName(string $user_lastName): static
    {
        $this->user_lastName = $user_lastName;

        return $this;
    }

    public function getUserEMail(): ?string
    {
        return $this->user_eMail;
    }

    public function setUserEMail(string $user_eMail): static
    {
        $this->user_eMail = $user_eMail;

        return $this;
    }

    public function getUserPhoneNumber(): ?string
    {
        return $this->user_phoneNumber;
    }

    public function setUserPhoneNumber(string $user_phoneNumber): static
    {
        $this->user_phoneNumber = $user_phoneNumber;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getUserMessage(): ?string
    {
        return $this->user_message;
    }

    public function setUserMessage(?string $user_message): static
    {
        $this->user_message = $user_message;

        return $this;
    }
}
