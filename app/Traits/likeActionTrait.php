<?php

namespace App\Traits;

use App\Events\Like;

trait likeActionTrait
{
    private $modelNameSpace = 'App\Models\\';

    private function setNameSpace($likeableType)
    {
        return $this->modelNameSpace . ucfirst($likeableType);
    }

    public function likeAction($likeableType, $likeableId, $isLike)
    {
        ($isLike) ? $action = 'likedBy' : $action = 'dislikedBy';

        $likeableId = $this->setNameSpace($likeableType)::find((int)$likeableId);
        $likeableId->$action(auth()->user());

        if ($isLike)
            event(new Like(auth()->user()->fullName(), $likeableId->user, $likeableId->slug));
    }
}
