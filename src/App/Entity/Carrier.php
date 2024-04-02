<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrier
 *
 * @ORM\Table(name="carrier")
 * @ORM\Entity(repositoryClass="App\Repository\CarrierRepository")
 */
class Carrier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private string $name;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=100, nullable=false)
     */
    private string $service;

    /**
     * @var int
     *
     * @ORM\Column(name="deadline", type="integer", length=10, nullable=false)
     */
    private int $deadline;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private float $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @param string $service
     */
    public function setService(string $service): void
    {
        $this->service = $service;
    }

    /**
     * @return int
     */
    public function getDeadline(): int
    {
        return $this->deadline;
    }

    /**
     * @param int $deadline
     */
    public function setDeadline(int $deadline): void
    {
        $this->deadline = $deadline;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

}