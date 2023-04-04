<?php

namespace App\Entity;

use App\Repository\AutosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutosRepository::class)]
class Autos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $kleur = null;

    #[ORM\Column]
    private ?int $massa = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prijs = null;

    #[ORM\Column]
    private ?int $voorraad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getKleur(): ?string
    {
        return $this->kleur;
    }

    public function setKleur(string $kleur): self
    {
        $this->kleur = $kleur;

        return $this;
    }

    public function getMassa(): ?int
    {
        return $this->massa;
    }

    public function setMassa(int $massa): self
    {
        $this->massa = $massa;

        return $this;
    }

    public function getPrijs(): ?string
    {
        return $this->prijs;
    }

    public function setPrijs(string $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getVoorraad(): ?int
    {
        return $this->voorraad;
    }

    public function setVoorraad(int $voorraad): self
    {
        $this->voorraad = $voorraad;

        return $this;
    }
}
