<?php 
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Game;
use App\Repository\ChampionshipRepository;
use App\Repository\FieldRepository;

class OrderInputDataTransformer implements DataTransformerInterface
{
    private $fieldRepository;
    private $championshipRepository;

    public function __construct(FieldRepository $fieldRepository, ChampionshipRepository $championshipRepository)
    {
        $this->fieldRepository = $fieldRepository;
        $this->championshipRepository = $championshipRepository;
    }

    public function transform($data, string $to, array $context = [])
    {
        // Transform the customer ID into a Customer entity
        if (isset($data['field']) && is_int($data['field'])) {
            $field = (int) basename($data['field']);
            $data['field'] = $this->fieldRepository->find($field);
        }
        
        if (isset($data['championships']) && is_array($data['championships'])) {
            $championships = [];
            foreach ($data['championships'] as $championshipIRI) {
                $championshipId = (int) basename($championshipIRI);
                $championships[] = $this->championshipRepository->find($championshipId);
            }
            $data['championships'] = $championships;
        }

        return $data;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return Game::class === $to && is_array($data);
    }
}