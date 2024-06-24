<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\VehicleType;
use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
#[Broadcast]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 10)]
    private ?string $numberPlate = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(enumType: VehicleType::class)]
    private ?VehicleType $type = null;

    /**
     * @var Collection<int, Voucher>
     */
    #[ORM\OneToMany(targetEntity: Voucher::class, mappedBy: 'vehicle')]
    private Collection $vouchers;

    public function __construct()
    {
        $this->vouchers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNumberPlate(): ?string
    {
        return $this->numberPlate;
    }

    public function setNumberPlate(string $numberPlate): static
    {
        $this->numberPlate = $numberPlate;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getType(): ?VehicleType
    {
        return $this->type;
    }

    public function setType(VehicleType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Voucher>
     */
    public function getVouchers(): Collection
    {
        return $this->vouchers;
    }

    public function addVoucher(Voucher $voucher): static
    {
        if (!$this->vouchers->contains($voucher)) {
            $this->vouchers->add($voucher);
            $voucher->setVehicle($this);
        }

        return $this;
    }

    public function removeVoucher(Voucher $voucher): static
    {
        if ($this->vouchers->removeElement($voucher)) {
            // set the owning side to null (unless already changed)
            if ($voucher->getVehicle() === $this) {
                $voucher->setVehicle(null);
            }
        }

        return $this;
    }
}
