<?php

/**
 * Description of NoIdException
 *
 * @author Etudiant
 */
class NoIdException extends Exception {
    
    private $entity; 
            
    public function __construct($entity) {
        parent::__construct('Only entities with id can be updated');
        $this->entity = $entity;
    }
    
    public function getEntity() {
        return $this->entity;
    }
}
