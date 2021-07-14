<?php

namespace App\Entity;

use App\Repository\ActivepatientsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivepatientsRepository::class)
 */
class Activepatients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $patientid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatientId(): ?int
    {
        return $this->patientid;
    }

    public function setPatientId(int $patientid): self
    {
        $this->patientid = $patientid;

        return $this;
    }
}
