<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
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
    private $linkCV;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LinkResume;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Applicant", inversedBy="applications")
     */
    private $applicant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="applications")
     */
    private $offer;

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
    public function getLinkCV(): ?string
    {
        return $this->linkCV;
    }

    /**
     * @param string $linkCV
     * @return $this
     */
    public function setLinkCV(string $linkCV): self
    {
        $this->linkCV = $linkCV;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLinkResume(): ?string
    {
        return $this->LinkResume;
    }

    /**
     * @param string $LinkResume
     * @return $this
     */
    public function setLinkResume(string $LinkResume): self
    {
        $this->LinkResume = $LinkResume;

        return $this;
    }

    /**
     * @return Applicant|null
     */
    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    /**
     * @param Applicant|null $applicant
     * @return $this
     */
    public function setApplicant(?Applicant $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }

    /**
     * @return Offer|null
     */
    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    /**
     * @param Offer|null $offer
     * @return $this
     */
    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }
}
