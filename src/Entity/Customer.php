<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RequestProject", mappedBy="customer")
     */
    private $requestProjects;

    /**
     * Customer constructor.
     */
    public function __construct()
    {
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
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|RequestProject[]
     */
    public function getRequestProjects(): Collection
    {
        return $this->requestProjects;
    }

    /**
     * @param RequestProject $requestProject
     * @return $this
     */
    public function addRequestProject(RequestProject $requestProject): self
    {
        if (!$this->requestProjects->contains( $requestProject )) {
            $this->requestProjects[] = $requestProject;
            $requestProject->setCustomer( $this );
        }

        return $this;
    }

    /**
     * @param RequestProject $requestProject
     * @return $this
     */
    public function removeRequestProject(RequestProject $requestProject): self
    {
        if ($this->requestProjects->contains( $requestProject )) {
            $this->requestProjects->removeElement( $requestProject );
            // set the owning side to null (unless already changed)
            if ($requestProject->getCustomer() === $this) {
                $requestProject->setCustomer( null );
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->user . '';
    }

}
