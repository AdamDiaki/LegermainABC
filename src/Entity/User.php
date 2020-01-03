<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"number","email"},
 *     errorPath="email",
 *     message="This email is already use"
 * )
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="2",minMessage="le prénom doit comporter aumoins deux caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="2",minMessage="le nom doit comporter aumoins deux caractères")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="Le mot de passe doit comporter 8 caractères")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="user")
     */
    private $applications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RequestProject", mappedBy="user")
     */
    private $requestProjects;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
        $this->requestProjects = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return $this
     */
    public function setNumber(string $number): self
    {
        $this->number = $number;

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
     * @return string
     */
    public function __toString()
    {
        return $this->id . ' : ' . $this->firstname . ' ' . $this->name;

    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains( $application )) {
            $this->applications[] = $application;
            $application->setUser( $this );
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains( $application )) {
            $this->applications->removeElement( $application );
            // set the owning side to null (unless already changed)
            if ($application->getUser() === $this) {
                $application->setUser( null );
            }
        }

        return $this;
    }

    /**
     * @return Collection|RequestProject[]
     */
    public function getRequestProjects(): Collection
    {
        return $this->requestProjects;
    }

    public function addRequestProject(RequestProject $requestProject): self
    {
        if (!$this->requestProjects->contains( $requestProject )) {
            $this->requestProjects[] = $requestProject;
            $requestProject->setUser( $this );
        }

        return $this;
    }

    public function removeRequestProject(RequestProject $requestProject): self
    {
        if ($this->requestProjects->contains( $requestProject )) {
            $this->requestProjects->removeElement( $requestProject );
            // set the owning side to null (unless already changed)
            if ($requestProject->getUser() === $this) {
                $requestProject->setUser( null );
            }
        }

        return $this;
    }


}
