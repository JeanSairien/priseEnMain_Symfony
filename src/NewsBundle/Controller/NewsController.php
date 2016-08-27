<?php

namespace NewsBundle\Controller;

use Doctrine\ORM\Query\ResultSetMappingBuilder;
use NewsBundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsController
 *
 * @author Formateur BeWeb
 */
class NewsController extends Controller {
    //put your code here

    /**
     * Retourne la liste des news de la table dans la vue liste des news
     * @Route("/news",name="news")
     * @Template("NewsBundle::news.html.twig")
     */
    public function getNews() {
        //on jete notre liste de news vers la vue pour les afficher (notre clé pour twig est donc : news)
        return array('news' => $this->container->get("news.dao")->get());
    }

    /**
     * Retourne la page d'ajout de news nous allons donc retourner un formulaire
     * mappé (lié) a notre classe afin de faire correspondre les propriété de notre classe avec les champs du formulaire
     * @Route("/news/add",name="form")
     * @Template("NewsBundle::addNews.html.twig")
     * @param Request $request
     */
    public function formNews(Request $request) {
        //on créé un objet vide
        $niouse = new News();
        //on lie un formulaire avec l'objet créé
        $formBuilder = $this->createFormBuilder($niouse);
        //chaque champs du formulaire sera "lié" a notre classe
        $formBuilder->add("date");
        $formBuilder->add("titre");
        $formBuilder->add("sujet");
        $formBuilder->add("auteur");
        //petit bouton submit pour valider le formulaire
        $formBuilder->add("save", SubmitType::class);
        //après avoir "fabriqué" (build) le formulaire on le génère....
        $f = $formBuilder->getForm();
        //on renvoie le formulaire dans la vue
        return array("formNews" => $f->createView());
    }

    /**
     * Methode pour ajouter une news
     * lors du click sur le submit du formulaire on execute cette methode
     * Vu que nous avons envoyé des infos via POST on va recuperer les valeurs du post
     * via le parametre $requete
     * @Route("/news/valid",name = "valid")
     * @Template("NewsBundle::news.html.twig")
     */
    public function addNews(Request $request) {
        //nouvelle instance
        $niouse = new News();
        //liaison de l'objet avec le formulaire temporaire
        //creation du formulaire tampon
        $formBuilder = $this->createFormBuilder($niouse);
        $formBuilder->add("date");
        $formBuilder->add("titre");
        $formBuilder->add("sujet");
        $formBuilder->add("auteur");
        $f = $formBuilder->getForm();

        //on fait quand meme une verif pour s'assurer d'avoir eu un POST comme requete http
        if ($request->getMethod() == 'POST') {
            //on lie le formulaire temporaire avec les valeurs de la requete de type post
            //en gros on se retrouve avec un fork de notre formulaire en local ;) 
            $f->handleRequest($request);            
            //Partie persistance des données ou l'on sauvegarde notre news en base de données
            $this->container->get("news.dao")->save($niouse);
            //J'avoue n'avoir implementer aucun test pour m'assurer de la validité des données en database
            //quoi qu'il en soit après avoir ajouter une news on appele la methode qui va nous afficher la liste des news
            //Bien entendu j'utilise les alias pour le routage ;) 
            //faire un redirect vers getNews();
            return $this->redirect($this->generateUrl('news'));
        }
        //si jamais le post a pas marché je reviens vers l'edition
        //faire un redirect sur ajout de news
        return $this->redirect($this->generateUrl('form'));
    }

}
