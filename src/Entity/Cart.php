<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\Column(length: 255)]
    private ?string $Quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $SKU = null;

    #[ORM\Column(nullable: true)]
    private ?float $Discount = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Order $Orders = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(string $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getSKU(): ?string
    {
        return $this->SKU;
    }

    public function setSKU(string $SKU): self
    {
        $this->SKU = $SKU;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->Discount;
    }

    public function setDiscount(?float $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->Orders;
    }

    public function setOrders(?Order $Orders): self
    {
        $this->Orders = $Orders;

        return $this;
    }
}
