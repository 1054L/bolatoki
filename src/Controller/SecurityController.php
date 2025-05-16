<?php

namespace App\Controller;

use ApiPlatform\OpenApi\Model\Response;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
class SecurityController extends AbstractController
{
    private $entityManager;
    private $passwordHasher;
    private $validator;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->validator = $validator;
    }

    #[Route('/auth/login', name: 'login', methods:['POST', 'OPTIONS'], defaults: ['api_platform' => false])]
    public function login(Request $request, EntityManagerInterface $entityManager, JWTTokenManagerInterface $jwtManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $data['username']]);

        if (!$user || !$this->passwordHasher->isPasswordValid($user, $data['password'])) {
            return new JsonResponse(['error' => 'Credenciales inválidas'], 401);
        }

        $token = $jwtManager->create($user);
        $user->setToken($token);
        
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->json(['token' => $token]);
    }

    #[Route('/auth/logout', name: 'logout', methods:'GET')]
    public function logout()
    {
        return $this->json(['message' => 'Sesión cerrada']);
    }

    #[Route('/auth/signup', name: 'create_user', methods:'POST')]
    public function createUser(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {

        $user = new User();

        $data = json_decode($request->getContent(), true);
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setName($data['name']);
        $user->setSurname($data['surname']);
        $type = 1;
        if (isset($data['type'])) {
            $type = $data['type'];
        }
        $user->setType($type);

        $errors = $this->validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse(['errors' => (string) $errors], 400);
        }

        $hashedPassword = $this->passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);
        
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user, 200); 
    }
}