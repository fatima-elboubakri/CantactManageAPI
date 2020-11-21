<?php

namespace App\Controller;

use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
USE Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{

    private $utilisateursRepository;

    public function __construct(UtilisateursRepository $utilisateursRepository)
    {
        $this->utilisateursRepository = $utilisateursRepository;
    }

    /**
     * @Route("/cantact/new", name="add_cantact", methods={"POST"})
     */
    public function addCantact(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $firstName = $data['firstname'];
        $lastName = $data['lastname'];
        $email = $data['mail'];
        $phoneNumber = $data['phone'];
        $gender = $data['gender'];
        $city = $data['city'];

        if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) || empty($gender) || empty($city)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->utilisateursRepository->saveUtilisateur($firstName, $lastName, $email, $phoneNumber, $gender, $city);

        return new JsonResponse (['status' => 'cantact created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/cantacts/{id}", name="get_one_cantact", methods={"GET"})
     */
    public function getCantact($id): JsonResponse
    {
        $utilisateur = $this->utilisateursRepository->findOneBy(['id' => $id]);

        $data = [
          //  'id' => $utilisateur->getId,
            'firstname' => $utilisateur->getFirstname(),
            'lastname' => $utilisateur->getLastname(),
            'mail' => $utilisateur->getMail(),
            'phone' => $utilisateur->getPhone(),
            'gender' => $utilisateur->getGender(),
            'city' => $utilisateur->getCity(),
        ];

        return new JsonResponse ($data, Response::HTTP_OK);
    }

    /**
     * @Route("/cantacts", name="get_all_cantacts", methods={"GET"})
     */
    public function getAllCantacts(): JsonResponse
    {
        $utilisateurs = $this->utilisateursRepository->findAll();
        $data = [];

        foreach ($utilisateurs as $utilisateur) {
            $data[] = [
                'firstname' => $utilisateur->getFirstname(),
                'lastname' => $utilisateur->getLastname(),
                'mail' => $utilisateur->getMail(),
                'phone' => $utilisateur->getPhone(),
                'gender' => $utilisateur->getGender(),
                'city' => $utilisateur->getCity(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/cantacts/{id}", name="update_cantact", methods={"PUT"})
     */
    public function updateCantact($id, Request $request): JsonResponse
    {
        $utilisateur = $this->utilisateursRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['firstname']) ? true : $utilisateur->setFirstname($data['firstname']);
        empty($data['lastname']) ? true : $utilisateur->setLastname($data['lastname']);
        empty($data['mail']) ? true : $utilisateur->setMail($data['mail']);
        empty($data['phone']) ? true : $utilisateur->setPhone($data['phone']);
        empty($data['gender']) ? true : $utilisateur->setGender($data['gender']);
        empty($data['city']) ? true : $utilisateur->setCity($data['city']);

        $updatedUtilisateur = $this->utilisateursRepository->updateUtilisateur($utilisateur);

        return new JsonResponse($updatedUtilisateur->toArray(), Response::HTTP_OK);
    }

    /**
     * @Route("/cantacts/{id}", name="delete_cantact", methods={"DELETE"})
     */
    public function deleteCantact($id): JsonResponse
    {
        $utilisateur = $this->utilisateursRepository->findOneBy(['id' => $id]);

        $this->utilisateursRepository->removeUtilisateur($utilisateur);

        return new JsonResponse(['status' => 'Cantact deleted'], Response::HTTP_NO_CONTENT);
    }
}
