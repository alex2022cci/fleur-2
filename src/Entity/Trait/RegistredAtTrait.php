<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait RegistredAtTrait
{
    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $RegistredAt;

    public function getRegistredAt(): ?\DateTimeImmutable
    {
        return $this->RegistredAt;
    }

    public function setRegistredAt(?\DateTimeImmutable $RegistredAt): self
    {
        $this->RegistredAt = $RegistredAt;

        return $this;
    }
}