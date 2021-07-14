<?php

namespace App\Entity;

use App\Repository\AvailableRoomsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvailableRoomsRepository::class)
 */
class Availablerooms
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
    private $roomid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomId(): ?int
    {
        return $this->roomid;
    }

    public function setRoomId(int $roomid): self
    {
        $this->roomid = $roomid;

        return $this;
    }
}
