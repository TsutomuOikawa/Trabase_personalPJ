<?php

namespace App\UseCases\Prefecture;

use App\Models\Prefecture;

class ShowAction
{
    public function __invoke(int $id)
    {
        $prefecture = Prefecture::with([
            'notes' => fn ($query) =>
                $query->withCount([
                    'comments',
                    'favoriteUsers',
                    ])
                    ->orderBy('notes.id', 'DESC')
                    ->limit(8)
            ,
            'wishes',
        ])->find($id);
        return $prefecture;
    }
}
