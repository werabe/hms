<?php

namespace App\Entity;

use App\Repository\HelpRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HelpRequestRepository::class)
 */
class HelpRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $requestedAt;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $assignedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $respondedAt;

    /**
     * @ORM\ManyToOne(targetEntity=ProblemType::class, inversedBy="helpRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $problem;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="helpRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $requestedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestedAt(): ?\DateTimeImmutable
    {
        return $this->requestedAt;
    }

    public function setRequestedAt(\DateTimeImmutable $requestedAt): self
    {
        $this->requestedAt = $requestedAt;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAssignedAt(): ?\DateTimeImmutable
    {
        return $this->assignedAt;
    }

    public function setAssignedAt(?\DateTimeImmutable $assignedAt): self
    {
        $this->assignedAt = $assignedAt;

        return $this;
    }

    public function getRespondedAt(): ?\DateTimeImmutable
    {
        return $this->respondedAt;
    }

    public function setRespondedAt(?\DateTimeImmutable $respondedAt): self
    {
        $this->respondedAt = $respondedAt;

        return $this;
    }

    public function getProblem(): ?ProblemType
    {
        return $this->problem;
    }

    public function setProblem(?ProblemType $problem): self
    {
        $this->problem = $problem;

        return $this;
    }

    public function getRequestedBy(): ?User
    {
        return $this->requestedBy;
    }

    public function setRequestedBy(?User $requestedBy): self
    {
        $this->requestedBy = $requestedBy;

        return $this;
    }
}
