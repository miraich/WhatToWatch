<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\CreateFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Http\Responses\Success;
use App\Jobs\AddFilm;
use App\Models\Film;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;

class FilmController extends Controller
{
    /**
     * Получение списка фильмов.
     *
     * @return Responsable
     */
    public function index()
    {
        return $this->success(Film::all());
    }


    /**
     * Добавление фильма в базу.
     *
     * @param CreateFilmRequest $request
     * @return Responsable
     */
    public function store(CreateFilmRequest $request)
    {
        if (Gate::allows('film-create')) {

            Film::create([
                'imdb_id' => $request->imdb_id,
                'status' => StatusEnum::PENDING->value,
            ]);

            AddFilm::dispatch($request->imdb_id);

        }
    }

    /**
     * Получение информации о фильме.
     *
     * @param \App\Models\Film $film
     * @return Responsable
     */
    public function show(Film $film)
    {
        return $this->success($film);
    }

    /**
     * Редактирование фильма.
     *
     * @param UpdateFilmRequest $request
     * @param Film $film
     * @return Responsable
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        if (Gate::allows('film-edit')) {
            $film->update([
                'name' => $request->name,
                'poster_image' => $request->poster_image,
                'preview_image' => $request->preview_image,
                'background_image' => $request->background_image,
                'background_color' => $request->background_color,
                'video_link' => $request->video_link,
                'preview_video_link' => $request->preview_video_link,
                'description' => $request->description,
                'director' => $request->director,
                'starring' => $request->starring,
                'genre' => $request->genre,
                'run_time' => $request->run_time,
                'released' => $request->released,
                'imdb_id' => $request->imdb_id,
                'status' => $request->status
            ]);
        }

        return $this->success([$film]);
    }

    /**
     * Получение списка похожих фильмов.
     *
     * @param Film $film
     * @return Success
     */
    public function similar(Film $film)
    {
        return $this->success([]);
    }
}
