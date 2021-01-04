<?php

namespace App\Presenters;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;
use App\Acquaintances\Interaction;
use App\Models\Post;

class PostPresenter extends FlexiblePresenter
{
    use Concens\HasAuthUser;

    public function values(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'visits' => Interaction::numberToReadable($this->visits),
            'created_at' => optional($this->created_at)->format('Y-m-d H:i:s'),
            'created_ago' => optional($this->created_at)->diffForHumans(),
            'likes' => $this->likersCountReadable(),
            'published' => $this->published,
        ];
    }

    public function presetShow()
    {
        return $this->with(fn (Post $post) => [
            'content' => $post->content,
            'author' => fn () => UserPresenter::make($post->author)
                ->preset('withCount')
                ->get(),
            'is_liked' => $post->is_liked,
            'can' => [
                'update' => $this->userCan('update', $post),
                'delete' => $this->userCan('delete', $post),
            ],
        ]);
    }

    public function presetList()
    {
        return $this->with(fn (Post $post) => [
            'author' => fn () => UserPresenter::make($post->author)
                ->only('id', 'name', 'profile_photo_path')
                ->get(),
        ]);
    }
}
