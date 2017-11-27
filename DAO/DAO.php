<?php

require_once 'PDO/PDOSingleton.php';
/**
 * Description of DAO
 *
 * @author Etudiant
 */
abstract class DAO {
    
    protected $connection;
    protected $tableName;
    
    public function __construct() {
        $this->connection = PDOSingleton::getPDO();
    }
    
    public function getEntityBy($column, $value) {
        $entityData = $this->queryByColumn($column, $value);
        
        return $this->buildEntityFromData($entityData);
    }
    /**
     * 
     * @param type $column
     * @param type $value
     */
    protected function queryByColumn($column, $value) {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE $column = :$column LIMIT 1";
        
        $query = $this->connection->prepare($sql);
        
        $query->bindParam(":$column", $value);
        
        $query->execute();
        
        return $query->fetch();
    }
    
    public function getTableName() {
        return $this->tableName;
    }
    
    public abstract function buildEntityFromData($entityData);
}
