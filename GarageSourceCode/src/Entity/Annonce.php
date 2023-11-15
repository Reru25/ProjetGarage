<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 20)]
    public ?string $brand = null;

    #[ORM\Column(length: 30)]
    public ?string $model = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    public ?string $description = null;

    #[ORM\Column]
    public ?int $year = null;

    #[ORM\Column]
    public ?int $mileage = null;

    #[ORM\Column(length: 20)]
    public ?string $fuel_type = null;

    #[ORM\Column(length: 20)]
    public ?string $transmission = null;

    #[ORM\Column]
    public ?int $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $imgPath1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $imgPath2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $imgPath3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $imgPath4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $imgPath5 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuel_type;
    }

    public function setFuelType(string $fuel_type): static
    {
        $this->fuel_type = $fuel_type;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getImgPath1(): ?string
    {
        return $this->imgPath1;
    }

    public function setImgPath1(?string $imgPath1): static
    {
        $this->imgPath1 = $imgPath1;

        return $this;
    }

    public function getImgPath2(): ?string
    {
        return $this->imgPath2;
    }

    public function setImgPath2(?string $imgPath2): static
    {
        $this->imgPath2 = $imgPath2;

        return $this;
    }

    public function getImgPath3(): ?string
    {
        return $this->imgPath3;
    }

    public function setImgPath3(?string $imgPath3): static
    {
        $this->imgPath3 = $imgPath3;

        return $this;
    }

    public function getImgPath4(): ?string
    {
        return $this->imgPath4;
    }

    public function setImgPath4(?string $imgPath4): static
    {
        $this->imgPath4 = $imgPath4;

        return $this;
    }

    public function getImgPath5(): ?string
    {
        return $this->imgPath5;
    }

    public function setImgPath5(?string $imgPath5): static
    {
        $this->imgPath5 = $imgPath5;

        return $this;
    }
}