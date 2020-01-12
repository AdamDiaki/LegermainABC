<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 * @Vich\Uploadable
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
    private $linkResume;

    /**
     * @Vich\UploadableField(mapping="application_cv", fileNameProperty="linkCV")
     * @var File
     */
    private $cvFile;

    /**
     * @Vich\UploadableField(mapping="application_resume", fileNameProperty="linkResume")
     * @var File
     */
    private $resumeFile;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="applications")
     */
    private $offer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $applicationAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
        return $this->linkResume;
    }

    /**
     * @param string $linkResume
     * @return $this
     */
    public function setLinkResume(string $linkResume): self
    {
        $this->linkResume = $linkResume;

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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id . ' : ' . $this->offer . ' : ' . $this->applicant;
    }

    public function getApplicationAt(): ?\DateTimeInterface
    {
        return $this->applicationAt;
    }

    public function setApplicationAt(\DateTimeInterface $applicationAt): self
    {
        $this->applicationAt = $applicationAt;

        return $this;
    }

    /**
     * @return File
     */
    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    /**
     * @param File $cvFile
     */
    public function setCvFile(?File $cvFile): void
    {
        $this->cvFile = $cvFile;
        if ($cvFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->applicationAt = new \DateTime( 'now' );
        }
    }

    /**
     * @return File
     */
    public function getResumeFile(): ?File
    {
        return $this->resumeFile;
    }

    /**
     * @param File $resumeFile
     */
    public function setResumeFile(?File $resumeFile): void
    {
        $this->resumeFile = $resumeFile;
        if ($resumeFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->applicationAt = new \DateTime( 'now' );
        }
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
