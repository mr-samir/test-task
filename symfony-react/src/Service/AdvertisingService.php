<?php

namespace App\Service;

use App\Entity\Advertising;
use App\Repository\AdvertisingRepository;
use Doctrine\ORM\EntityNotFoundException;

class AdvertisingService
{
    /** @var AdvertisingRepository */
    protected $advRepository;

    /**
     * AdvService constructor.
     * @param AdvertisingRepository $advRepository
     */
    public function __construct(AdvertisingRepository $advRepository) {
        $this->advRepository = $advRepository;
    }

    /**
     * @param string $slotElementId
     * @return Advertising
     * @throws EntityNotFoundException
     */
    public function getSlot(string $slotElementId): Advertising
    {
        $slot = $this->advRepository->findOneBySlotElementId($slotElementId);

        if (!$slot) {
            throw new EntityNotFoundException('Slot with id '.$slotElementId.' does not exist!');
        }

        return $slot;
    }

    /**
     * @return array|null
     */
    public function getAllSlots(): ?array
    {
        return $this->advRepository->findAll();
    }
}