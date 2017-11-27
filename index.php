<?php

require_once 'DAO/UserDAO.php';
require_once 'Entity/User.php';

// Pour accéder aux données présentes en base, j'instancie (je crée) un objet
// de classe UserDAO
$userDAO = new UserDAO();

$jeanne = $userDAO->getUserByUsername('jeannemoreau');

$jean = new User();

$jean->setEmail('jeannot@laposte.net');
$jean->setFirstname('Jean');
$jean->setLastname('Dupont');
$jean->setUsername('jeannot');

var_dump($jean);

$userDAO->insert($jean);

var_dump($jean);


