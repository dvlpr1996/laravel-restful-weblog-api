<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => Config::get('api.meta_info')
        ];
    }
}
