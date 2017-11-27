<?php

require_once 'Entity/User.php';
require_once 'DAO/DAO.php';
require_once 'Interface/Inserter.php';
require_once 'Exception/NoIdException.php';
/**
 * Description of UserDAO
 *
 * @author Etudiant
 */
class UserDAO extends DAO implements Inserter {
    
    const TABLE_NAME = 'user';
    
    protected $tableName = self::TABLE_NAME;
    
    /**
     * Get a user by its username
     * @param User $username
     */
    public function getUserByUsername($username) {
        return $this->getEntityBy('username', $username);
    }
    
    /**
     * Get a user by its id
     * @param integer $id
     */
    public function getUserById($id) {
        return $this->getEntityBy('id', $id);
    }
    
    private function buildUserFromData($userData) {
        if( ! $userData) {
            return null;
        }
        
        $user = new User();
        
        $user->setId($userData['id']);
        $user->setUsername($userData['username']);
        $user->setEmail($userData['email']);
        $user->setFirstname($userData['firstname']);
        $user->setLastname($userData['lastname']);
        
        return $user;
    }

    public function buildEntityFromData($entityData) {
        return $this->buildUserFromData($entityData);
    }

    /**
     * Insert a new row in database from the given User
     * @param User $user
     */
    public function insert($user) {
        $sql = "INSERT INTO {$this->getTableName()} ( id, username, email, firstname, lastname ) "
        . "VALUES (:id, :username, :email, :firstname, :lastname)";
        
        $query = $this->connection->prepare($sql);
        
        $query->bindValue(':id', $user->getId());
        $query->bindValue(':username', $user->getUsername());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':firstname', $user->getFirstname());
        $query->bindValue(':lastname', $user->getLastname());
        
        $result = $query->execute();
        
        $lastId = $this->connection->lastInsertId();
        
        $user->setId($lastId);
        
        return $result;
    }

    public function update($entity) {
        if( ! $entity->getId()){
            throw new NoIdException($entity);
        }
        
        $sql = "UPDATE {$this->getTableName()} "
        . "SET username = :username, email = :email, firstname = :firstname, lastname = :lastname "
        . "WHERE id = :id";
        
        $query = $this->connection->prepare($sql);
        
        $query->bindValue(':id', $user->getId());
        $query->bindValue(':username', $user->getUsername());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':firstname', $user->getFirstname());
        $query->bindValue(':lastname', $user->getLastname());
        
        return $query->execute();
    }

}
