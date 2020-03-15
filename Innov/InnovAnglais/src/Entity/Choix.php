<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChoixRepository")
 */
class Choix
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $est_correct;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vocabulaire", inversedBy="vocabulaire")
     */
    private $choix;
    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="question")
     */
    private $question;

    public function getId(): ?int 
    {
        return $this->id;
    }

    public function getEstCorrect(): ?int
    {
        return $this->est_correct;
    }

    public function setEstCorrect(int $est_correct): self
    {
        $this->est_correct = $est_correct;

        return $this;
    }

    public function getChoix(): ?string
    {
        return $this->choix;
    }

    public function setChoix(string $choix): self
    {
        $this->choix = $choix;

        return $this;
    }
}
