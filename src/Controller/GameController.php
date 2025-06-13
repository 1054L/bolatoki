<?php 
namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class GameController
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    #[Route('/api/publicgames', name: 'api_public_games', methods: ['GET'])]
    public function __invoke(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $games = $this->gameRepository->findGroupedByDate();
        $json = $serializer->serialize($games, 'json', ['groups' => ['game:read']]);

        return new JsonResponse($json, 200, [], true);
    }

}
