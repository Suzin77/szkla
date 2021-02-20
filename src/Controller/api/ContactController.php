<?php

namespace App\Controller\api;

use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * ContactController
 * @Route("/api", name="api_")
 */
class ContactController extends AbstractController
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * ContactRESTController constructor.
     * @param ContactRepository $contactRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(ContactRepository $contactRepository, EntityManagerInterface $em)
    {
        $this->contactRepository = $contactRepository;
        $this->em = $em;
    }

    /**
     * Edit Contact.
     * @Rest\Patch("/contact/{id}/edit")
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function editContact(Request $request, int $id): JsonResponse
    {
        if ($contact = $this->contactRepository->find($id)) {
            $form = $this->createForm(ContactType::class, $contact, ['csrf_protection' => false]);
            $form->submit(json_decode($request->getContent(), true),false);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->em->persist($contact);
                $this->em->flush();
                return new JsonResponse(['status' => 'OK']);
            }
        }
        return new JsonResponse('Contact was not found!', JsonResponse::HTTP_NOT_FOUND);
    }
}