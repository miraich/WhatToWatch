<?php

namespace App\Support;

use App\Models\Film;

class FilmService
{
    public function __construct(private readonly ImportRepository $repository)
    {
    }

    public function requestFilm(string $imdb): ?array
    {
        return $this->repository->getFilm($imdb);
    }

    public function updateFilmData(array $data, string $imdbId)
    {
        $film = Film::firstOrNew(['imdb_id' => $imdbId]);

        $film->update([
            'name' => $data['Title'],
            'poster_image' => $data['Poster'],
            'description' => $data['Plot'],
            'director' => $data['Director'],
            'starring' => $data['Actors'],
            'genre' => $data['Genre'],
            'run_time' => $data['Runtime'],
            'released' => $data['Released'],
        ]);
    }
}
