<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NewsBundle\Models;

use Doctrine\ORM\EntityManager;

/**
 * Description of Dao
 * Le Data Access Object va nous permettre de jouer avec la base donnée
 * Il va nous servir de base pour la gestion de nos entitées en base de données
 * pour se faire il respecte certaines regles conceptuelles :
 * - il implemente le CRUD (donc doit implémenter toutes les methodes definies dans l'interface CRUD
 * - Il est défini comme étant abstrait car il fort probable que pour chaque entités il va y avoir des manières spéciales d'interagir avec la base de données
 *      Du coup on ne pourra JAMAIS ecrire un new Dao()... on va créer des spécialisations qui elles seront des concretes
 * Néanmoins pour toutes les spécialisations que l'on va faire du DAO vu qu'on va jouer entre les entitées et les base de données 
 * Le DAO est construit avec l'entityManager (un objet spécial des ORM)
 * 
 * Toutes les spécialisations du DAO seront définis comme des services gérés par le pricipe des inversions de controle
 * 
 * Etant un classe abstraite on n'est pas obliger d'implémenter les methodes de l'interface, seules les concrètes sont obligées
 * 
 * @author Formateur BeWeb
 */
abstract class Dao implements CRUD{
    //put your code here
    //ces propriétés sont accessibles via cette classe et tous ses enfants
    protected $em;
    //On va affecter le nom de la table lors de l'instanciation des enfants
    protected $tableName;
    /**
     * Le constructeur des classes heritant de Dao prenent l'entityManager en argument (voir le fichier services.yml pour le comment s'est mis en place 
     * @param EntityManager $em
     */
    function __construct(EntityManager $em) {
        $this->em = $em;
    }
    /**
     * Vu qu'on peut le faire ici j'ai implémenter la methode delete dont la procedure est la même pour tout les DAO
     * Les autres methodes sont décrites dans les "enfants" 
     * @param type $entity
     */
    public function delete($entity) {
        $this->em->remove($entity);
        $this->em->flush();
    }


}
