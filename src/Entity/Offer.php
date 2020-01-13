<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 */
class Offer
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $beginAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $hourlyWage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="offer")
     */
    private $applications;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accepted = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OfferType", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offerType;

    /**
     * Offer constructor.
     */
    public function __construct()
    {
        $this->applications = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        $this->createdAt = new \DateTime( 'now' );

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->beginAt;
    }

    /**
     * @param \DateTimeInterface $beginAt
     * @return $this
     */
    public function setBeginAt(\DateTimeInterface $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    /**
     * @param \DateTimeInterface $endAt
     * @return $this
     */
    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHourlyWage(): ?string
    {
        return $this->hourlyWage;
    }

    /**
     * @param string $hourlyWage
     * @return $this
     */
    public function setHourlyWage(string $hourlyWage): self
    {
        $this->hourlyWage = $hourlyWage;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    /**
     * @param Application $application
     * @return $this
     */
    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains( $application )) {
            $this->applications[] = $application;
            $application->setOffer( $this );
        }

        return $this;
    }

    /**
     * @param Application $application
     * @return $this
     */
    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains( $application )) {
            $this->applications->removeElement( $application );
            // set the owning side to null (unless already changed)
            if ($application->getOffer() === $this) {
                $application->setOffer( null );
            }
        }

        return $this;
    }

    /**
     * @return OfferType|null
     */
    public function getOfferType(): ?OfferType
    {
        return $this->offerType;
    }

    /**
     * @param OfferType|null $offerType
     * @return $this
     */
    public function setOfferType(?OfferType $offerType): self
    {
        $this->offerType = $offerType;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     * @return $this
     */
    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id . ' : ' . $this->title;

    }


}
