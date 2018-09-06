<?php
namespace App\Controller;

use App\Entity\Team;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TeamController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function listAction()
    {
        $repository = $this->entityManager->getRepository(Team::class);

        $teamToArray = function (Team $team) {
            return $team->toArray();
        };

        $teamsArray = array_map($teamToArray, $repository->findAll());

        return new JsonResponse(['teams' => $teamsArray]);
    }

    public function createAction(Request $request)
    {
        try {
            $team = Team::fromNameAndStrip($request->get('name'), $request->get('strip'));
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }

        $this->entityManager->persist($team);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Created team', 'id' => $team->getId()], 201);
    }

    public function updateAction(Request $request, string $id)
    {
        $team = $this->entityManager->find(Team::class, $id);

        if (!$team instanceof Team) {
            return new JsonResponse(['error' => 'Team #'. $id . ' not found.'], 404);
        }

        $team->setName($request->get('name'));
        $team->setStrip($request->get('strip'));
        $this->entityManager->persist($team);
        $this->entityManager->flush();
        return new JsonResponse(['message' => 'Updated team', 'id' => $team->getId()]);
    }
}
