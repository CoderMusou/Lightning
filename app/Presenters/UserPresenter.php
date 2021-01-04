<?php

namespace App\Presenters;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;
use App\Models\User;

class UserPresenter extends FlexiblePresenter
{
    public function values(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'profile_photo_path' => $this->profile_photo_path,
        ];
    }

    public function presetWithCount()
    {
        return $this->with(fn (User $user) => [
            'postsCount' => $user->published_posts_count,
            'likesCount' => $user->liked_posts_count,
        ]);
    }
}
