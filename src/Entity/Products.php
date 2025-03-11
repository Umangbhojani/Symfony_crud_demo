<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pname = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $quntity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPname(): ?string
    {
        return $this->pname;
    }

    public function setPname(string $pname): static
    {
        $this->pname = $pname;

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

    public function getQuntity(): ?int
    {
        return $this->quntity;
    }

    public function setQuntity(int $quntity): static
    {
        $this->quntity = $quntity;

        return $this;
    }
}
