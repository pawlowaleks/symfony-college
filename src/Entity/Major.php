<?php

namespace App\Entity;

use App\Repository\MajorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MajorRepository::class)
 * @ORM\Table(indexes={@ORM\Index(name="title_idx",columns={"title"}, options={"length": 255})})
 */
class Major
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToMany(targetEntity=College::class, mappedBy="major")
     */
    private $colleges;

    /**
     * @ORM\ManyToOne(targetEntity=Major::class, inversedBy="majors")
     */
    private $parentMajor;

    /**
     * @ORM\OneToMany(targetEntity=Major::class, mappedBy="parentMajorId")
     */
    private $majors;

    public function __construct()
    {
        $this->colleges = new ArrayCollection();
        $this->majors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection|College[]
     */
    public function getColleges(): Collection
    {
        return $this->colleges;
    }

    public function addCollege(College $college): self
    {
        if (!$this->colleges->contains($college)) {
            $this->colleges[] = $college;
            $college->addMajor($this);
        }

        return $this;
    }

    public function removeCollege(College $college): self
    {
        if ($this->colleges->removeElement($college)) {
            $college->removeMajor($this);
        }

        return $this;
    }

    public function getParentMajor(): ?self
    {
        return $this->parentMajor;
    }

    public function setParentMajor(?self $parentMajor): self
    {
        $this->parentMajor = $parentMajor;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getMajors(): Collection
    {
        return $this->majors;
    }

    public function addMajor(self $major): self
    {
        if (!$this->majors->contains($major)) {
            $this->majors[] = $major;
            $major->setParentMajor($this);
        }

        return $this;
    }

    public function removeMajor(self $major): self
    {
        if ($this->majors->removeElement($major)) {
            // set the owning side to null (unless already changed)
            if ($major->getParentMajor() === $this) {
                $major->setParentMajor(null);
            }
        }

        return $this;
    }
}
