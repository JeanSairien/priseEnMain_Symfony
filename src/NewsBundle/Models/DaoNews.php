<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace NewsBundle\Models ;

use Doctrine\ORM\EntityManager;
use NewsBundle\Entity\News;
/**
 * Description of DaoNews
 *
 * @author Formateur BeWeb
 */
class DaoNews {
    //put your code here
    private $em ;
    
    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function save(News $news){
        $this->em->persist($news);
        $this->em->flush();
    }
}
