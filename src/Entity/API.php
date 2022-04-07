<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\APIRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: APIRepository::class)]
#[ApiResource]
class API
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $age;

    #[ORM\Column(type: 'string', length: 10)]
    private $postcode;

    #[ORM\Column(type: 'string', length: 10)]
    private $regNo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getRegNo(): ?string
    {
        return $this->regNo;
    }

    public function setRegNo(string $regNo): self
    {
        $this->regNo = $regNo;

        return $this;
    }
}
