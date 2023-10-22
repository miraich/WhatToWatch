<?php

namespace App\Support;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class RemoteRepository implements ImportRepository
{

    public function __construct()
    {

    }

    /**
     */
    public function getFilm(string $imdbId): ?array
    {
        $response = $this->createRequest($imdbId);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function createRequest(string $imdbId): ResponseInterface
    {
        $url = 'https://www.omdbapi.com/';
        $api_key = 'c6c45a51';

        $ob = new Client();

        return $ob->request('get', "$url?apikey=$api_key&i=$imdbId");

    }
}
