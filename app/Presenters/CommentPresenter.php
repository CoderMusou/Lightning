<?php

namespace App\Presenters;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;

class CommentPresenter extends FlexiblePresenter
{
    use Concens\HasAuthUser;

    public function values(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'commenter' => UserPresenter::make($this->commenter)->get(),
            'created_at' => $this->created_at->diffForHumans(),
            'can' => [
                'delete' => $this->userCan('delete', $this->resource),
            ],
        ];
    }
}
