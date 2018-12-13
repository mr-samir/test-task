<?php

namespace App\Http\Rest\Controller;

use App\Entity\Advertising;
use App\Service\AdvertisingService;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Predis\Client;

class AdvController extends FOSRestController
{
    /** @var AdvertisingService */
    private $advService;

    /**
     * AdvController constructor.
     * @param AdvertisingService $advService
     */
    public function __construct(AdvertisingService $advService)
    {
        $this->advService = $advService;
    }

    /**
     * @Rest\Put("/slot")
     *
     * @SWG\Put(
     *     tags={"Advertising"},
     *     summary="Create a new slot",
     *     description="Create a new slot",
     *     @SWG\Parameter(
     *         name="slot_name",
     *         description="",
     *         required=true,
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="slot_element_id",
     *         description="",
     *         required=true,
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="slot_sizes",
     *         description="",
     *         required=true,
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="is_available",
     *         description="",
     *         required=true,
     *         in="formData",
     *         type="boolean"
     *     ),
     *     @SWG\Parameter(
     *         name="is_lazy",
     *         description="",
     *         required=true,
     *         in="formData",
     *         type="boolean"
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Success",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(
     *                 @SWG\Property(
     *                     property="slot_name",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="slot_element_id",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="slot_sizes",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="is_available",
     *                     type="boolean",
     *                 ),
     *                 @SWG\Property(
     *                     property="is_lazy",
     *                     type="boolean",
     *                 ),
     *             )
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function putSlot(Request $request)
    {
        $request = $request->request;
        $em = $this->get('doctrine.orm.default_entity_manager');

        $new_slot = new Advertising;
        $new_slot->setSlotName($request->get('slot_name'));
        $new_slot->setSlotElementId($request->get('slot_element_id'));
        $new_slot->setSlotSizes($request->get('slot_sizes'));
        $new_slot->setIsAvailable($request->get('is_available'));
        $new_slot->setIsLazy($request->get('is_lazy'));
        $em->persist($new_slot);
        $em->flush();

        return View::create([
            'slot_name' => $new_slot->getSlotName(),
            'slot_element_id' => $new_slot->getSlotElementId(),
            'slot_sizes' => $new_slot->getSlotSizes(),
            'is_available' => $new_slot->getIsAvailable(),
            'is_lazy' => $new_slot->getIsLazy(),
        ], Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/slot/{slotElementId}")
     *
     * @SWG\Get(
     *     produces={"application/json"},
     *     tags={"Advertising"},
     *     summary="Get slot",
     *     description="Get slot",
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(
     *                 @SWG\Property(
     *                     property="slot_name",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="slot_element_id",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="slot_sizes",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="is_available",
     *                     type="boolean",
     *                 ),
     *                 @SWG\Property(
     *                     property="is_lazy",
     *                     type="boolean",
     *                 ),
     *             )
     *         )
     *     )
     * )
     *
     * @param string $slotElementId
     * @return \FOS\RestBundle\View\View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getSlot(string $slotElementId)
    {
        $slot = $this->advService->getSlot($slotElementId);

        return View::create([
            'slot_name' => $slot->getSlotName(),
            'slot_element_id' => $slot->getSlotElementId(),
            'slot_sizes' => $slot->getSlotSizes(),
            'is_available' => $slot->getIsAvailable(),
            'is_lazy' => $slot->getIsLazy(),
        ], Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/slot/{slotElementId}")
     *
     * @SWG\Post(
     *     produces={"application/json"},
     *     tags={"Advertising"},
     *     summary="Edit slot",
     *     description="Edit slot",
     *     @SWG\Parameter(
     *         name="slot_name",
     *         description="",
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="slot_sizes",
     *         description="",
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="is_available",
     *         description="",
     *         in="formData",
     *         type="boolean"
     *     ),
     *     @SWG\Parameter(
     *         name="is_lazy",
     *         description="",
     *         in="formData",
     *         type="boolean"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(
     *                 @SWG\Property(
     *                     property="slot_name",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="slot_element_id",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="slot_sizes",
     *                     type="string",
     *                 ),
     *                 @SWG\Property(
     *                     property="is_available",
     *                     type="boolean",
     *                 ),
     *                 @SWG\Property(
     *                     property="is_lazy",
     *                     type="boolean",
     *                 ),
     *             )
     *         )
     *     )
     * )
     *
     * @param string $slotElementId
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function postSlot(string $slotElementId, Request $request)
    {
        $request = $request->request;
        $em = $this->get('doctrine.orm.default_entity_manager');

        $slot = $this->advService->getSlot($slotElementId);

        if ($request->get('slot_name') !== null) {
            $slot->setSlotName($request->get('slot_name'));
        }

        if ($request->get('slot_sizes') !== null) {
            $slot->setSlotSizes($request->get('slot_sizes'));
        }

        if ($request->get('is_available') !== null) {
            $slot->setIsAvailable(
                filter_var($request->get('is_available'), FILTER_VALIDATE_BOOLEAN)
            );
        }

        if ($request->get('is_lazy') !== null) {
            $slot->setIsLazy(
                filter_var($request->get('is_lazy'), FILTER_VALIDATE_BOOLEAN)
            );
        }

        $em->flush();

        $data = [
            'slot_name' => $slot->getSlotName(),
            'slot_element_id' => $slot->getSlotElementId(),
            'slot_sizes' => $slot->getSlotSizes(),
            'is_available' => $slot->getIsAvailable(),
            'is_lazy' => $slot->getIsLazy(),
        ];
        $redis = new Client($this->getParameter('redis.url'));
        $redis->publish($this->getParameter('redis.channel'), json_encode($data));

        return View::create($data, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/slot/{slotElementId}")
     *
     * @SWG\Delete(
     *     produces={"application/json"},
     *     tags={"Advertising"},
     *     summary="Delete slot",
     *     description="Delete slot",
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     *
     * @param string $slotElementId
     * @return \FOS\RestBundle\View\View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteSlot(string $slotElementId)
    {
        $slot = $this->advService->getSlot($slotElementId);
        $em = $this->get('doctrine.orm.default_entity_manager');
        $em->remove($slot);
        $em->flush();

        return View::create([
            'message' => 'Success',
        ], Response::HTTP_OK);
    }
}
