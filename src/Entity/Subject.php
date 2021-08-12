<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubjectRepository::class)
 * @ORM\Table(indexes={@ORM\Index(name="title_idx",columns={"title"}, options={"length": 255})})
 */
class Subject
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
     * @ORM\ManyToOne(targetEntity=Subject::class, inversedBy="subjects")
     */
    private $parentSubject;

    /**
     * @ORM\OneToMany(targetEntity=Subject::class, mappedBy="parentSubjectId")
     */
    private $subjects;

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
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

    /**
     * @return Collection|self[]
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(self $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
            $subject->setParentSubject($this);
        }

        return $this;
    }

    public function removeSubject(self $subject): self
    {
        if ($this->subjects->removeElement($subject)) {
            // set the owning side to null (unless already changed)
            if ($subject->getParentSubject() === $this) {
                $subject->setParentSubject(null);
            }
        }

        return $this;
    }

    public function getParentSubject(): ?self
    {
        return $this->parentSubject;
    }

    public function setParentSubject(?self $parentSubject): self
    {
        $this->parentSubject = $parentSubject;

        return $this;
    }
}
