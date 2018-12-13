<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdvertisingRepository")
 * @ORM\Table(
 *     uniqueConstraints={@UniqueConstraint(name="slot_element_id_unique", columns={"slot_element_id"})},
 *     indexes={@ORM\Index(name="search_idx", columns={"slot_element_id"})}
 * )
 */
class Advertising
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slot_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slot_element_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slot_sizes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_available;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_lazy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlotName(): ?string
    {
        return $this->slot_name;
    }

    public function setSlotName(string $slot_name): self
    {
        $this->slot_name = $slot_name;

        return $this;
    }

    public function getSlotElementId(): ?string
    {
        return $this->slot_element_id;
    }

    public function setSlotElementId(string $slot_element_id): self
    {
        $this->slot_element_id = $slot_element_id;

        return $this;
    }

    public function getSlotSizes(): ?string
    {
        return $this->slot_sizes;
    }

    public function setSlotSizes(string $slot_sizes): self
    {
        $this->slot_sizes = $slot_sizes;

        return $this;
    }

    public function getIsAvailable(): ?bool
    {
        return $this->is_available;
    }

    public function setIsAvailable(bool $is_available): self
    {
        $this->is_available = $is_available;

        return $this;
    }

    public function getIsLazy(): ?bool
    {
        return $this->is_lazy;
    }

    public function setIsLazy(bool $is_lazy): self
    {
        $this->is_lazy = $is_lazy;

        return $this;
    }
}
