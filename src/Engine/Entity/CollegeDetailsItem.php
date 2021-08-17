<?php


namespace App\Engine\Entity;


/**
 * Class DetailsItem
 * @package App\Engine\Entity
 */
class CollegeDetailsItem extends CollegeItem
{

    /** @var string|null $address Адрес */
    private ?string $address;

    /** @var string|null $phone Телефон */
    private ?string $phone;

    /** @var string|null $site Url сайта колледжа */
    private ?string $site;

    /** @var string|null $email */
    private ?string $email;

    /**
     * @var string|null
     */
    private ?string $campusVisitingCenter;
    /**
     * @var string|null
     */
    private ?string $campusTours;

    /** @var string|null $contact */
    private ?string $contact;

    /**
     * @var string|null
     */
    private ?string $onCampusInterview;

    /**
     * @var CollegeAdmissionsItem|null
     */
    private ?CollegeAdmissionsItem $collegeAdmissionsItem;

    /**
     * @return string|null
     */
    public function getOnCampusInterview(): ?string
    {
        return $this->onCampusInterview;
    }

    /**
     * @param string|null $onCampusInterview
     */
    public function setOnCampusInterview(?string $onCampusInterview): void
    {
        $this->onCampusInterview = $onCampusInterview;
    }

    /**
     * @return string[]
     */
    public static function getTitleLabels(): array
    {
        return ['Title', 'Address', 'Phone', 'Site'];
    }

    /**
     * @return string|null
     */
    public function getCampusVisitingCenter(): ?string
    {
        return $this->campusVisitingCenter;
    }

    /**
     * @param string|null $campusVisitingCenter
     */
    public function setCampusVisitingCenter(?string $campusVisitingCenter): void
    {
        $this->campusVisitingCenter = $campusVisitingCenter;
    }

    /**
     * @return string|null
     */
    public function getCampusTours(): ?string
    {
        return $this->campusTours;
    }

    /**
     * @param string|null $campusTours
     */
    public function setCampusTours(?string $campusTours): void
    {
        $this->campusTours = $campusTours;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string|null $contact
     */
    public function setContact(?string $contact): void
    {
        $this->contact = $contact;
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            $this->getTitle(),
            $this->getAddress(),
            $this->getPhone(),
            $this->getSite()
        ];
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getSite(): ?string
    {
        return $this->site;
    }

    /**
     * @param string|null $site
     */
    public function setSite(?string $site): void
    {
        $this->site = $site;
    }

    /**
     * @return CollegeAdmissionsItem|null
     */
    public function getCollegeAdmissionsItem(): ?CollegeAdmissionsItem
    {
        return $this->collegeAdmissionsItem;
    }

    /**
     * @param CollegeAdmissionsItem|null $collegeAdmissionsItem
     */
    public function setCollegeAdmissionsItem(?CollegeAdmissionsItem $collegeAdmissionsItem): void
    {
        $this->collegeAdmissionsItem = $collegeAdmissionsItem;
    }


}