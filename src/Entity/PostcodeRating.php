<?php

namespace App\Entity;

use App\Repository\PostcodeRatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostcodeRatingRepository::class)]
class PostcodeRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'string', length: 4)]
    private $postcode_area;

    #[ORM\Column(type: 'float', nullable: true)]
    private $rating_factor;

    public function getPostcodeArea(): ?string
    {
        return $this->postcode_area;
    }

    public function setPostcodeArea(string $postcode_area): self
    {
        $this->postcode_area = $postcode_area;

        return $this;
    }

    public function getRatingFactor(): ?float
    {
        return $this->rating_factor;
    }

    public function setRatingFactor(?float $rating_factor): self
    {
        $this->rating_factor = $rating_factor;

        return $this;
    }
}
