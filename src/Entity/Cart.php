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

    
}
