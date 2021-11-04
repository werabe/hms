<?php

namespace App\Entity;

use App\Repository\ProblemTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProblemTypeRepository::class)
 */
class ProblemType
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Priority::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $priority;

    /**
     * @ORM\OneToMany(targetEntity=HelpRequest::class, mappedBy="problem")
     */
    private $helpRequests;

    public function __construct()
    {
        $this->helpRequests = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
    }
    
// 11393056
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriority(): ?Priority
    {
        return $this->priority;
    }

    public function setPriority(?Priority $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection|HelpRequest[]
     */
    public function getHelpRequests(): Collection
    {
        return $this->helpRequests;
    }

    public function addHelpRequest(HelpRequest $helpRequest): self
    {
        if (!$this->helpRequests->contains($helpRequest)) {
            $this->helpRequests[] = $helpRequest;
            $helpRequest->setProblem($this);
        }

        return $this;
    }

    public function removeHelpRequest(HelpRequest $helpRequest): self
    {
        if ($this->helpRequests->removeElement($helpRequest)) {
            // set the owning side to null (unless already changed)
            if ($helpRequest->getProblem() === $this) {
                $helpRequest->setProblem(null);
            }
        }

        return $this;
    }
}
