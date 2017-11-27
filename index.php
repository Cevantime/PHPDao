<?php

require_once 'DAO/UserDAO.php';

// Pour accéder aux données présentes en base, j'instancie (je crée) un objet
// de classe UserDAO
$userDAO = new UserDAO();

$jeanne = $userDAO->getUserByUsername('jeannemoreau');

var_dump($jeanne);



