<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Film;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Получение списка комментариев к фильму.
     *
     * @return Responsable
     */
    public function index(Comment $comment)
    {
        return $this->success(['comments' => $comment::all()]);
    }

    /**
     * Добавление отзыва к фильму.
     *
     * @param Request $request
     * @return Responsable
     */
    public function store(CommentRequest $request, Comment $comment)
    {
        if ($comment::find(['user_id' => Auth::user()->id])) {
            abort(403, 'Комментарий уже существует');
        }
        $comment->create([
            'text' => $request->text,
            'rating' => $request->rating,
            'film_id' => $request->film,
            'user_id' => Auth::user()->id,
            'parent_id' => $request->parent_id
        ]);

    }

    /**
     * Редактирование комментария.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     * @return Responsable
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        if (Gate::allows('comment-edit', $comment)) {
            $comment->update([
                'text' => $request->text,
                'rating' => $request->rating
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Удаление комментария.
     *
     * @param Comment $comment
     * @return Responsable
     */
    public function destroy(Comment $comment)
    {
        if (Gate::allows('comment-delete', $comment)) {
            $comment->delete();
        } else {
            abort(403);
        }
    }
}
