<?php
namespace App\Test;


use App\Controller\TeamController;
use App\Entity\League;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TeamControllerTest extends TestCase
{
    /** @var EntityManagerInterface|MockObject */
    private $entityManager;

    /** @var TeamController */
    private $controller;

    public function setUp()
    {
        $this->entityManager = $this->getMockBuilder(EntityManagerInterface::class)->getMock();
        $this->controller = new TeamController($this->entityManager);
    }

    public function testListAction()
    {
        // ARRANGE
        $teamRepository = $this->getMockBuilder(TeamRepository::class)->disableOriginalConstructor()->getMock();
        $this->entityManager->expects($this->once())->method('getRepository')->willReturn($teamRepository);
        $team = $this->getMockBuilder(Team::class)->getMock();
        $team->method('toArray')->willReturn(['teamdata']);

        // ANTICIPATE
        $teamRepository->expects($this->once())->method('findAll')->willReturn([$team]);

        // ACT
        $response = $this->controller->listAction();

        // ASSERT

        $expectedResult = [
            'teams' => [
                [
                    'teamdata'
                ]
            ]
        ];

        $this->assertEquals(json_decode($response->getContent(), true), $expectedResult);
    }
}
