<?php
namespace App\Test;


use App\Controller\LeagueController;
use App\Entity\League;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LeagueControllerTest extends TestCase
{
    /** @var EntityManagerInterface|MockObject */
    private $entityManager;

    /** @var LeagueController */
    private $controller;

    public function setUp()
    {
        $this->entityManager = $this->getMockBuilder(EntityManagerInterface::class)->getMock();
        $this->controller = new LeagueController($this->entityManager);
    }

    public function testDeleteAction()
    {
        // ARRANGE
        $league = $this->getMockBuilder(League::class)->getMock();
        $this->entityManager->expects($this->once())->method('find')->with(League::class, '123')->willReturn($league);

        // ANTICIPATE
        $this->entityManager->expects($this->once())->method('remove')->with($league);
        $this->entityManager->expects($this->once())->method('flush');

        // ACT
        $response = $this->controller->deleteAction('123');

        // ASSERT
        $this->assertEquals($response->getStatusCode(), 200);
    }

    public function testDeleteActionWhereEntityNotFound()
    {
        // ARRANGE
        $this->entityManager->expects($this->once())->method('find')->with(League::class, '123')->willReturn(null);

        // ANTICIPATE
        $this->entityManager->expects($this->never())->method('remove');

        // ACT
        $response = $this->controller->deleteAction('123');

        // ASSERT
        $this->assertEquals($response->getStatusCode(), 404);
    }
}
