<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'app_movie')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/movies', name: 'app_movie_list')]
    public function list(): Response
    {
        return $this->render(
            'movie/liste.html.twig',
            [
                'maVariable' => 'test'
            ]

            );

    }

    #[Route('movie/random', name: 'app_movie_random')]


    public function showRandom(): Response
    {
        // random number between 1 and 10
        $random =  rand(1,10);
        return $this->render(
            'movie/liste.html.twig',
            [
                
            ]

            );
    }

    #[Route('movie/{id}', 
    name: 'app_movie_show',
    requirements: ['id' => '\d+'])]

    

    public function findbyID(int $id): Response
    {
        // data 

        // fetch 
        
        //$img = 'https://image.tmdb.org/t/p/w220_and_h330_face/';

        $superMovie = '{
          "adult": false,
            "backdrop_path": "/rwfuTHx9pHi40QnWLSiIPtYyQAs.jpg",
            "genre_ids": [
                28,
                878,
                53
            ],
            "id": 865,
            "original_language": "en",
            "original_title": "The Running Man",
            "overview": "By 2017, the global economy has collapsed and U.S. society has become a totalitarian police state, censoring all cultural activity. The government pacifies the populace by broadcasting a number of game shows in which convicted criminals fight for their lives, including the gladiator-style The Running Man, hosted by the ruthless Damon Killian, where “runners” attempt to evade “stalkers” and certain death for a chance to be pardoned and set free.",
            "popularity": 32.631,
            "poster_path": "/GTAUOhO4BN0peJVvxGEQydJvUO.jpg",
            "release_date": "1987-11-13",
            "title": "The Running Man",
            "video": false,
            "vote_average": 6.535,
            "vote_count": 2114
        }';

        $superMovie = json_decode($superMovie);
        

        return $this->render(
            'movie/movie.html.twig',
            [
                'superMovie' => $superMovie,
                'img' => 'https://image.tmdb.org/t/p/w220_and_h330_face/'
                
                ]

            );
    }


}