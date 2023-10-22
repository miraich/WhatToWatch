<?php

namespace App\Support;
interface ImportRepository
{
    public function getFilm(string $imdbId): ?array;
}
