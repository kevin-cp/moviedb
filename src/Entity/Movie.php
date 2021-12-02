<?php

namespace App\Entity;

// On va appliquer la logique de mapping via l'annotation @ORM
// qui correspond à un dossier "Mapping" de Doctrine

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Classe qui représente la table "movie" et ses enregistrements
 * 
 * @ORM\Entity
 */
class Movie
{
  /**
   * Clé primaire
   * Auto-increment
   * type INT
   * 
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * Titre
   * 
   * @ORM\Column(type="string", length=211)
   */
  private $title;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $createdAt;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $updatedAt;

  /**
   * Get clé primaire
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get titre
   */ 
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set titre
   *
   * @return  self
   */ 
  public function setTitle(string $title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get the value of createdAt
   */ 
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set the value of createdAt
   *
   * @return  self
   */ 
  public function setCreatedAt(DateTime $createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * Get the value of updatedAt
   */ 
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }

  /**
   * Set the value of updatedAt
   *
   * @return  self
   */ 
  public function setUpdatedAt(DateTime $updatedAt)
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }
}