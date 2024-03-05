<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(
        '/', 
        name: 'app_home'
        )]

    public function index( Request $request): Response
    {

        $term = "";
        if ($request->getMethod() == "POST") {
            $term = $_POST["term"];
        }

        // On transforme le résultat de cURL en un objet JSON utilisable
        
        return $this->render('home/index.html.twig', ['films' =>$this->search($term)]);
    
        

        

        





/*
        // recuperation du get 
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            return $this->render('home/index.html.twig',
        [
            'films' => $this->search($search)
        ]);
        } else {
            return $this->render('movie/index.html.twig');
        
        }*/
        

        




        //dd($this->search('star wars'));

        // appel de la methode search
        
        



        
                
        
    }

    public function search(string $term): array
    {
        // recuperation de la clef API TMDB
        $apiKeyTMDB = $_ENV['TMDB_API_KEY'];

        // recherche de films
        $endPoint = 'https://api.themoviedb.org/3/search/movie?api_key=' . $apiKeyTMDB  . "&language=fr-FR&page=1" . "&query=" . $term;

        //dd($apiKeyTMDB, $endPoint);

        // Lancement d'une requête HTTP
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);

        $resultat_curl = curl_exec($ch);

        // On transforme le résultat de cURL en un objet JSON utilisable
        $json = json_decode ( $resultat_curl );

        

        //dd($json);

        // Renvoi du JSON
        if (isset($json->results)) {
            return $json->results;
        } else {
            return [];
        }

}

}