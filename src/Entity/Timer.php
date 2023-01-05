<?php

namespace App\Entity;

use App\Repository\TimerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TimerRepository::class)
 */
class Timer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"timer_read"})
     * @Groups({"timer_add"})
     * @Groups({"timer_edit"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * 
     * @Groups({"timer_read"})
     * @Groups({"timer_add"})
     * @Groups({"timer_edit"}) 
     */
    private $moving_date;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="timer", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovingDate(): ?\DateTimeInterface
    {
        return $this->moving_date;
    }

    public function setMovingDate(\DateTimeInterface $moving_date): self
    {
        $this->moving_date = $moving_date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
