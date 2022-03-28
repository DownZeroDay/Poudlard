<?php 
namespace App\Entity;

class Droit
{
private int $id;
private string $label;


/**
 * Get the value of id
 */ 
public function getId()
{
return $this->id;
}
/**
 * Get the value of label
 */ 
public function getLabel()
{
return $this->label;
}

/**
 * Set the value of label
 *
 * @return  self
 */ 
public function setLabel($label)
{
$this->label = $label;

return $this;
}

}

?>