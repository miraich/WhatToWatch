<?php

namespace App\Jobs;

use AllowDynamicProperties;
use App\Enums\StatusEnum;
use App\Exceptions\FilmsRepositoryException;
use App\Models\Film;
use App\Support\FilmService;
use App\Support\ImportRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddFilm implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct(protected string $imdbId)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(FilmService $service): void
    {
        $data = $service->requestFilm($this->imdbId);

        if (array_key_exists('Error', $data)) {
            throw new FilmsRepositoryException('There is no data searched by this tt**** ID');
        }

        $service->updateFilmData($data, $this->imdbId);
    }
}
