<?php

namespace App\Http\Controllers;

use App\UseCases\Prefecture\ShowAction;
use Illuminate\Http\Request;

class PrefectureController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ShowAction $action)
    {
        $prefecture = $action($request->prefecture_id);
        return view('prefectures.show', compact('prefecture'));
    }
}
