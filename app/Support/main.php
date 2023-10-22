<?php

require_once("../../vendor/autoload.php");


use App\Support\FilmService;
use App\Support\RemoteRepository;
use GuzzleHttp\Client;

$client = new Client();
$repository = new RemoteRepository($client);
$service = new FilmService($repository);


dd($service->requestFilm('tt0111161'));
