<?php

namespace App\Entity;

use App\Repository\WorkingHoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkingHoursRepository::class)]
class WorkingHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $monday = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $tuesday = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $wednesday = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $thursday = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $friday = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $saturday = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $sunday = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonday(): ?string
    {
        return $this->monday;
    }

    public function setMonday(?string $monday): static
    {
        $this->monday = $monday;

        return $this;
    }


    public function getTuesday(): ?string
    {
        return $this->tuesday;
    }

    public function setTuesday(?string $tuesday): static
    {
        $this->tuesday = $tuesday;

        return $this;
    }


    public function getWednesday(): ?string
    {
        return $this->wednesday;
    }

    public function setWednesday(?string $wednesday): static
    {
        $this->wednesday = $wednesday;

        return $this;
    }


    public function getThursday(): ?string
    {
        return $this->thursday;
    }

    public function setThursday(?string $thursday): static
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getFriday(): ?string
    {
        return $this->friday;
    }

    public function setFriday(?string $friday): static
    {
        $this->friday = $friday;

        return $this;
    }

    public function getSaturday(): ?string
    {
        return $this->saturday;
    }

    public function setSaturday(?string $saturday): static
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSunday(): ?string
    {
        return $this->sunday;
    }

    public function setSunday(?string $sunday): static
    {
        $this->sunday = $sunday;

        return $this;
    }

}
