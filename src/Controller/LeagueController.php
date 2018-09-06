<?php
namespace App\Controller;

use App\Entity\League;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class LeagueController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function deleteAction(string $id)
    {
        $league = $this->entityManager->find(League::class, $id);

        if ($league instanceof League) {
            $this->entityManager->remove($league);
            $this->entityManager->flush();
            return new JsonResponse(['message' => 'League #' . $id . ' deleted']);
        }

        return new JsonResponse(['error' => 'League #'. $id . ' not found.'], 404);
    }
}
