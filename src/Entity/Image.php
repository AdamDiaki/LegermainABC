<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @Vich\Uploadable
 * @UniqueEntity(
 *     fields={"link"},
 *     errorPath="link",
 *     message="This link is already use"
 * )
 *
 */
class Image
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
    private $link;
    /**
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="link")
     * @Assert\Image(mimeTypes= {"image/png","image/jpeg","image/jpg"},mimeTypesMessage="le format de l'image n'est pas respecté, png, jpeg, jpg")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Actuality", mappedBy="image")
     */
    private $actualities;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleImages", mappedBy="image")
     */
    private $articleImages;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accueil;


    /**
     * Image constructor.
     */
    public function __construct()
    {
        $this->actualities = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->articleImages = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    /**
     * @return File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime( 'now' );
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "uploads/images/articles/$this->link";
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return $this
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection|Actuality[]
     */
    public function getActualities(): Collection
    {
        return $this->actualities;
    }

    /**
     * @param Actuality $actuality
     * @return $this
     */
    public function addActuality(Actuality $actuality): self
    {
        if (!$this->actualities->contains( $actuality )) {
            $this->actualities[] = $actuality;
            $actuality->setImage( $this );
        }

        return $this;
    }

    /**
     * @param Actuality $actuality
     * @return $this
     */
    public function removeActuality(Actuality $actuality): self
    {
        if ($this->actualities->contains( $actuality )) {
            $this->actualities->removeElement( $actuality );
            // set the owning side to null (unless already changed)
            if ($actuality->getImage() === $this) {
                $actuality->setImage( null );
            }
        }

        return $this;
    }


    /**
     * @return Collection|ArticleImages[]
     */
    public function getArticleImages(): Collection
    {
        return $this->articleImages;
    }

    /**
     * @param ArticleImages $articleImage
     * @return $this
     */
    public function addArticleImage(ArticleImages $articleImage): self
    {
        if (!$this->articleImages->contains( $articleImage )) {
            $this->articleImages[] = $articleImage;
            $articleImage->setImage( $this );
        }

        return $this;
    }

    /**
     * @param ArticleImages $articleImage
     * @return $this
     */
    public function removeArticleImage(ArticleImages $articleImage): self
    {
        if ($this->articleImages->contains( $articleImage )) {
            $this->articleImages->removeElement( $articleImage );
            // set the owning side to null (unless already changed)
            if ($articleImage->getImage() === $this) {
                $articleImage->setImage( null );
            }
        }

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAccueil(): ?bool
    {
        return $this->accueil;
    }

    /**
     * @param bool $accueil
     * @return $this
     */
    public function setAccueil(bool $accueil): self
    {
        $this->accueil = $accueil;

        return $this;
    }


}
