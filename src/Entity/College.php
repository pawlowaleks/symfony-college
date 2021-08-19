<?php

namespace App\Entity;

use Andante\TimestampableBundle\Timestampable\TimestampableInterface;
use Andante\TimestampableBundle\Timestampable\TimestampableTrait;
use App\Repository\CollegeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollegeRepository::class)
 * @ORM\Table(indexes={@ORM\Index(name="title_idx",columns={"title"}, options={"length": 255})})
 */
class College implements TimestampableInterface
{
    use TimestampableTrait;

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
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $site;

    /**
     * @ORM\ManyToMany(targetEntity=Major::class, inversedBy="colleges")
     */
    private $major;

    /**
     * @ORM\OneToOne(targetEntity=CollegeAdmissions::class, mappedBy="college", cascade={"persist", "remove"})
     */
    private $collegeAdmissions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $campusVisitingCenter;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $campusTours;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $onCampusInterview;

    /**
     * @ORM\OneToOne(targetEntity=CollegeAcademics::class, mappedBy="college", cascade={"persist", "remove"})
     */
    private $collegeAcademics;

    /**
     * @ORM\OneToOne(targetEntity=CollegeCareers::class, mappedBy="college", cascade={"persist", "remove"})
     */
    private $collegeCareers;

    /**
     * @ORM\OneToOne(targetEntity=CollegeTuition::class, mappedBy="college", cascade={"persist", "remove"})
     */
    private $collegeTuition;

    public function __construct()
    {
        $this->major = new ArrayCollection();
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return Collection|Major[]
     */
    public function getMajor(): Collection
    {
        return $this->major;
    }

    public function addMajor(Major $major): self
    {
        if (!$this->major->contains($major)) {
            $this->major[] = $major;
        }

        return $this;
    }

    public function removeMajor(Major $major): self
    {
        $this->major->removeElement($major);

        return $this;
    }

    public function getCollegeAdmissions(): ?CollegeAdmissions
    {
        return $this->collegeAdmissions;
    }

    public function setCollegeAdmissions(?CollegeAdmissions $collegeAdmissions): self
    {
        // unset the owning side of the relation if necessary
        if ($collegeAdmissions === null && $this->collegeAdmissions !== null) {
            $this->collegeAdmissions->setCollege(null);
        }

        // set the owning side of the relation if necessary
        if ($collegeAdmissions !== null && $collegeAdmissions->getCollege() !== $this) {
            $collegeAdmissions->setCollege($this);
        }

        $this->collegeAdmissions = $collegeAdmissions;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCampusVisitingCenter(): ?string
    {
        return $this->campusVisitingCenter;
    }

    public function setCampusVisitingCenter(?string $campusVisitingCenter): self
    {
        $this->campusVisitingCenter = $campusVisitingCenter;

        return $this;
    }

    public function getCampusTours(): ?string
    {
        return $this->campusTours;
    }

    public function setCampusTours(?string $campusTours): self
    {
        $this->campusTours = $campusTours;

        return $this;
    }

    public function getOnCampusInterview(): ?string
    {
        return $this->onCampusInterview;
    }

    public function setOnCampusInterview(?string $onCampusInterview): self
    {
        $this->onCampusInterview = $onCampusInterview;

        return $this;
    }

    public function getCollegeAcademics(): ?CollegeAcademics
    {
        return $this->collegeAcademics;
    }

    public function setCollegeAcademics(?CollegeAcademics $collegeAcademics): self
    {
        // unset the owning side of the relation if necessary
        if ($collegeAcademics === null && $this->collegeAcademics !== null) {
            $this->collegeAcademics->setCollege(null);
        }

        // set the owning side of the relation if necessary
        if ($collegeAcademics !== null && $collegeAcademics->getCollege() !== $this) {
            $collegeAcademics->setCollege($this);
        }

        $this->collegeAcademics = $collegeAcademics;

        return $this;
    }

    public function getCollegeCareers(): ?CollegeCareers
    {
        return $this->collegeCareers;
    }

    public function setCollegeCareers(?CollegeCareers $collegeCareers): self
    {
        // unset the owning side of the relation if necessary
        if ($collegeCareers === null && $this->collegeCareers !== null) {
            $this->collegeCareers->setCollege(null);
        }

        // set the owning side of the relation if necessary
        if ($collegeCareers !== null && $collegeCareers->getCollege() !== $this) {
            $collegeCareers->setCollege($this);
        }

        $this->collegeCareers = $collegeCareers;

        return $this;
    }

    public function getCollegeTuition(): ?CollegeTuition
    {
        return $this->collegeTuition;
    }

    public function setCollegeTuition(?CollegeTuition $collegeTuition): self
    {
        // unset the owning side of the relation if necessary
        if ($collegeTuition === null && $this->collegeTuition !== null) {
            $this->collegeTuition->setCollege(null);
        }

        // set the owning side of the relation if necessary
        if ($collegeTuition !== null && $collegeTuition->getCollege() !== $this) {
            $collegeTuition->setCollege($this);
        }

        $this->collegeTuition = $collegeTuition;

        return $this;
    }
}
