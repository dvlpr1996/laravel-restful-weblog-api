<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'created at' => '12-13-2022',
                'home page' => 'https://github.com/dvlpr1996/',
                'copyright' => 'Copyright © 2022 (until present) Laravel restful weblog api. All Rights Reserved'
            ]
        ];
    }
}
