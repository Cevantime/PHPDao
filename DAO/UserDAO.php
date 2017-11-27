<?php

require_once 'Entity/User.php';
require_once 'DAO/DAO.php';
/**
 * Description of UserDAO
 *
 * @author Etudiant
 */
class UserDAO extends DAO {
    
    const TABLE_NAME = 'user';
    
    public function __construct() {
        // je dois initialiser mon objet pdo et mon nom de table
        $this->tableName = self::TABLE_NAME;
        
        $this->connection = new PDO('mysql://host=localhost;dbname=phpdao;charset=utf8', 'root', '', array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));
    }
    
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

}
