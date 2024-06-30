<?php

namespace App\Entity;

use App\Enum\VoucherStatus;
use App\Repository\VoucherRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: VoucherRepository::class)]
#[Broadcast]
class Voucher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'vouchers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicle $vehicle = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $issuedAt = null;

    #[ORM\Column]
    private ?bool $valid = null;

    #[ORM\Column]
    private ?VoucherStatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): static
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getIssuedAt(): ?\DateTimeImmutable
    {
        return $this->issuedAt;
    }

    public function setIssuedAt(\DateTimeImmutable $issuedAt): static
    {
        $this->issuedAt = $issuedAt;

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): static
    {
        $this->valid = $valid;

        return $this;
    }

    public function isUsed(): ?bool
    {
        return $this->status == VoucherStatus::USED;
    }

    public function getStatus(): ?VoucherStatus
    {
        return  $this->status;
    }

    public function setStatus(VoucherStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
