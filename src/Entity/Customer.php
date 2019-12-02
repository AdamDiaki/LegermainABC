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

    public function __construct()
    {
        $this->requestProjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|RequestProject[]
     */
    public function getRequestProjects(): Collection
    {
        return $this->requestProjects;
    }

    public function addRequestProject(RequestProject $requestProject): self
    {
        if (!$this->requestProjects->contains($requestProject)) {
            $this->requestProjects[] = $requestProject;
            $requestProject->setCustomer($this);
        }

        return $this;
    }

    public function removeRequestProject(RequestProject $requestProject): self
    {
        if ($this->requestProjects->contains($requestProject)) {
            $this->requestProjects->removeElement($requestProject);
            // set the owning side to null (unless already changed)
            if ($requestProject->getCustomer() === $this) {
                $requestProject->setCustomer(null);
            }
        }

        return $this;
    }
}
