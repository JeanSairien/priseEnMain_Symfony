<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NewsBundle\Models;

/**
 *
 * Defini le "contrat" de fonctionnalités permettant de jouer avec la persistance
 * Une classe qui implémente une interface DOIT implémenter ses methodes
 * ici on va forcer les dev qui soccupent de coder le metier l'utilisation de ces methodes 
 * @author Formateur BeWeb
 */
interface CRUD {
    //put your code here
    public function save($entity);
    public function update($entity);
    public function get($val);
    public function delete($entity);
}
