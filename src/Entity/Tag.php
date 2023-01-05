<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"tag_browse"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * 
     * @Groups({"tag_browse"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ReserveTask::class, mappedBy="tag")
     */
    private $reserveTasks;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="tag")
     * 
     */
    private $tasks;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * 
     * @Groups({"tag_browse"})
     */
    private $checked;

    public function __construct()
    {
        $this->reserveTasks = new ArrayCollection();
        $this->tasks = new ArrayCollection();
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

    /**
     * @return Collection<int, ReserveTask>
     */
    public function getReserveTasks(): Collection
    {
        return $this->reserveTasks;
    }

    public function addReserveTask(ReserveTask $reserveTask): self
    {
        if (!$this->reserveTasks->contains($reserveTask)) {
            $this->reserveTasks[] = $reserveTask;
            $reserveTask->setTag($this);
        }

        return $this;
    }

    public function removeReserveTask(ReserveTask $reserveTask): self
    {
        if ($this->reserveTasks->removeElement($reserveTask)) {
            // set the owning side to null (unless already changed)
            if ($reserveTask->getTag() === $this) {
                $reserveTask->setTag(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setTag($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getTag() === $this) {
                $task->setTag(null);
            }
        }

        return $this;
    }

    public function isChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(?bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }
}
