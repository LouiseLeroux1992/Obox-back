<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"todolist_browse"})
     * @Groups({"todolist_read"})
     * @Groups({"todolist_add"})
     * @Groups({"todolist_edit"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"todolist_browse"})
     * @Groups({"todolist_read"})
     * @Groups({"todolist_add"})
     * @Groups({"todolist_edit"})
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     * 
     * @Groups({"todolist_browse"})
     * @Groups({"todolist_read"})
     * @Groups({"todolist_add"})
     * @Groups({"todolist_edit"})
     */
    private $deadline;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"todolist_browse"})
     * @Groups({"todolist_read"})
     * @Groups({"todolist_add"})
     * @Groups({"todolist_edit"})
     */
    private $done;

    /**
     * @ORM\ManyToOne(targetEntity=Tag::class, inversedBy="tasks")
     * 
     */
    private $tag;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"todolist_add"})
     */
    private $user;

    public function __construct()
    {
        $this->done = false;
    }

    public static function createfrom($reserveTask)
    {
        $newTask = new Task;
        $newTask->setName($reserveTask->getName());
        $newTask->setTag($reserveTask->getTag());
        $newTask->setDone(false);

        return $newTask;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDeadline():?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function isDone(): ?bool
    {
        return $this->done;
    }

    public function setDone(bool $done): self
    {
        $this->done = $done;

        return $this;
    }

    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    public function setTag(?Tag $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
