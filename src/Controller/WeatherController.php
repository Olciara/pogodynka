<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\WeatherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather', name: 'app_weather')]
    public function index(): Response
    {
        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
        ]);
    }
    // #[Route('/weather/{id}', name: 'app_weather', requirements: ['id' => '\d+'])]

    // public function city(Location $location, WeatherRepository $repository): Response
    
    #[Route('/weather/{country}/{city}', name: 'app_weather')]
    public function city(#[MapEntity(mapping: ['country' => 'country', 'city' => 'city'])]
                            Location $location, WeatherRepository $repository
                        ): Response
                        {
                            $measurements = $repository->findByLocation($location);
                            return $this->render('weather/city.html.twig', [
                            'location' => $location,
                            'measurements' => $measurements,
                            ]);
    
    }   
    
}

