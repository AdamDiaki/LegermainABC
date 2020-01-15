<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActualityRepository")
 * @UniqueEntity(
 *     fields={"title"},
 *     errorPath="title",
 *     message="This title is already use"
 * )
 */
class Actuality
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(min="2",minMessage="le titre doit comporter aumoins deux caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *  @Assert\Length(min="2",minMessage="le contenu doit comporter aumoins deux caractères", max="200", maxMessage="le contenu doit comporter aumoins deux caractères")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image", inversedBy="actualities")
     *
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishAt;

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
     * @throws \Exception
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        $this->publishAt = new \DateTime( 'now' );


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
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * @param Image|null $image
     * @return $this
     */
    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id . ' : ' . $this->tilte;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getPublishAt(): ?\DateTimeInterface
    {
        return $this->publishAt;
    }

    /**
     * @param \DateTimeInterface $publishAt
     * @return $this
     */
    public function setPublishAt(\DateTimeInterface $publishAt): self
    {
        $this->publishAt = $publishAt;

        return $this;
    }


}
