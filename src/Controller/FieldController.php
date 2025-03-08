<?php

namespace App\Controller;

use App\Repository\FieldRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FieldController extends AbstractController
{
    #[Route('/field', name: 'app_field')]
    public function index(): Response
    {
        return $this->render('field/index.html.twig', [
            'controller_name' => 'FieldController',
        ]);
    }

    #[Route('/fields', name:"get_all_fields", methods:["GET"])]
    public function getAllFields(FieldRepository $fieldRepository): JsonResponse
    {
        $fields = $fieldRepository->findAllFields();

        return $this->json($fields);
    }

    /**
     * @Route("/fields/year/{year}", name="get_fields_by_year", methods={"GET"})
     */
    public function getFieldsByYear(FieldRepository $fieldRepository, int $year): JsonResponse
    {
        $fields = $fieldRepository->findFieldsByYear($year);

        return $this->json($fields);
    }

    /**
     * @Route("/fields/{id}", name="get_field_by_id", methods={"GET"})
     */
    public function getFieldById(FieldRepository $fieldRepository, int $id): JsonResponse
    {
        $field = $fieldRepository->findFieldById($id);

        if (!$field) {
            return $this->json(['message' => 'Field not found'], 404);
        }

        return $this->json($field);
    }
}
