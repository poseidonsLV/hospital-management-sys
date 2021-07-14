<?php

namespace App\Entity;

use App\Repository\PatientsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientsRepository::class)
 */
class Patients
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $contact;

    /**
     * @ORM\Column(type="string")
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="boolean")
     */
    private $father;

    /**
     * @ORM\Column(type="string")
     */
    private $village;

    /**
     * @ORM\Column(type="string")
     */
    private $district;

    /**
     * @ORM\Column(type="integer")
     */
    private $emergency;

    /**
     * @ORM\Column(type="string")
     */
    private $occupation;

    /**
     * @ORM\Column(type="string")
     */
    private $bloodgroup;

    /**
     * @ORM\Column(type="string")
     */
    private $religion;

    /**
     * @ORM\Column(type="string")
     */
    private $room;

    /**
     * @ORM\Column(type="integer")
     */
    private $admisionfee;

    /**
     * @ORM\Column(type="string")
     */
    private $advance;

    /**
     * @ORM\Column(type="string")
     */
    private $consultant;

    /**
     * @ORM\Column(type="string")
     */
    private $referredby;

    /**
     * @ORM\Column(type="string")
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     */
    private $time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function setContact($contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getFather(): ?bool
    {
        return $this->father;
    }

    public function setFather(bool $father): self
    {
        $this->father = $father;

        return $this;
    }

    public function getVillage()
    {
        return $this->village;
    }

    public function setVillage($village): self
    {
        $this->village = $village;

        return $this;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function setDistrict($district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getEmergency(): ?int
    {
        return $this->emergency;
    }

    public function setEmergency(int $emergency): self
    {
        $this->emergency = $emergency;

        return $this;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function setOccupation($occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getBloodGroup()
    {
        return $this->bloodgroup;
    }

    public function setBloodGroup($bloodgroup): self
    {
        $this->bloodgroup = $bloodgroup;

        return $this;
    }

    public function getReligion()
    {
        return $this->religion;
    }

    public function setReligion($religion): self
    {
        $this->religion = $religion;

        return $this;
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getAdmisionFee(): ?int
    {
        return $this->admisionfee;
    }

    public function setAdmisionFee(int $admisionfee): self
    {
        $this->admisionfee = $admisionfee;

        return $this;
    }

    public function getAdvance()
    {
        return $this->advance;
    }

    public function setAdvance($advance): self
    {
        $this->advance = $advance;

        return $this;
    }

    public function getConsultant()
    {
        return $this->consultant;
    }

    public function setConsultant($consultant): self
    {
        $this->consultant = $consultant;

        return $this;
    }

    public function getReferredBy()
    {
        return $this->referredby;
    }

    public function setReferredBy($referredby): self
    {
        $this->referredby = $referredby;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time): self
    {
        $this->time = $time;

        return $this;
    }
}
