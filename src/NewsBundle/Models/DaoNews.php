<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NewsBundle\Models;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use NewsBundle\Entity\News;

/**
 * Description of DaoNews
 *
 * Cette classe est une spécialisation du DAO exclusivement reservée pour les News
 * Heritant du DAO, cette classe implémente du coup le CRUD
 * la methode delete est déjà codée dans le DAO donc a la base on a pas besoin de le faire ici
 * sauf si on désire la doter de nouvelles fonctionnalitées
 * 
 * Pour les autres vu que nous alons utiliser cette classe de manière concrete, il nous faut les implémenter
 * 
 * Cette classe est definie comme un service ( voir services.yml ) et c'est donc le kernel de symfony qui va faire le new DaoNews()
 * elle herite bien entendu du constructeur de son parent donc on instancie cette classe comme ça : new DaoNews($entityManager); mais bon le kernel se débrouille en suivant notre fichier service.yml
 * 
 * Vu trouverez dans les methodes du controller comment on appele un service pour executer ses methodes
 * @author Formateur BeWeb
 */
class DaoNews extends Dao{

    /**
     * Dans le constructeur on appele le constructeur parent et on affecte le nom de la table pour les news ;) 
     * @var EntityManager
     */
    function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->tableName = "niouz";
    }

    /**
     * Ajoute une nouvelle news en base de données
     * @param News $news
     */
    public function save($news) {
        $this->em->persist($news);
        $this->em->flush();
    }

    /**
     * Met a jour la news passée en argument
     * @param News $news
     */
    public function update($news) {
        $this->em->merge($news);
        $this->em->flush();
    }

    /**
     * retourne soit toutes les news, soit un news spécifique si on passe l'idée en parametre
     * @param type $id
     * @return type
     */
    public function get($id = null) {
        if ($id == null) {
            $rsm = new ResultSetMappingBuilder($this->em);
            //Le mappage se fera avec l'entitée News(qui est déclaré ici avec la table Niouz... voir l'annotation table de l'entité)
            //le deuxieme parametre est un alias au besoin qui va nous servir pour les clauses SQL
            $rsm->addRootEntityFromClassMetadata('NewsBundle:News', 'niouzes');
            //Ici on fait une requete SQL "classique" (on fera mieux plus tard ;), on y passe aussi notre mapping pour que doctrine puisse 
            //nous ...
            $query = $this->em->createNativeQuery("select * from ".$this->tableName."", $rsm);
            //...renvoyer une liste d'objets corespond a notre demande (ici News)
            //$niouzes est donc une liste de News
            return $query->getResult();
        } else {
            return $this->em->find('NewsBundle:News', $id);
        }
    }

    /**
     * Pour montrer la puissance de l'heritage (polymorphisme) on redefini la methode delete ecrite dans la classe abstraite Dao
     * 
     * @param type $news
     */
    public function delete($news) {
        //On execute le code ecrit dans la classe mère
        parent::delete($news);
        //on ajoute une action de plus ( absurde mais j'ai pas d'idées pour l'instant)
        var_dump("Suppriméé");
    }

}
