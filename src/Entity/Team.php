<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $strip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStrip(): ?string
    {
        return $this->strip;
    }

    public function setStrip(?string $strip): self
    {
        $this->strip = $strip;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'strip' => $this->getStrip(),
        ];
        return $data;
    }

    public static function fromNameAndStrip($name, $strip): self
    {
        if (!isset($name) || !isset($strip)) {
            throw new \InvalidArgumentException('Cannot create team: incomplete data');
        }
        $team = new Team();
        $team->setName($name);
        $team->setStrip($strip);
        return $team;
    }
}
