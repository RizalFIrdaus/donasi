<?php

namespace App\Service\Imp;

use App\Service\GalangDanaService;
use Illuminate\Http\Request;

class GalangDanaServiceImp implements GalangDanaService
{
    public function startProgress(Request $request)
    {
        if ($request->session()->has("progress") == false) {
            $request->session()->put('progress', ["data" => 0]);
        }
    }

    public function updateProgress(Request $request, int $progress)
    {
        if ($progress >= $request->session()->get("progress")["data"]) {
            $request->session()->put('progress', ["data" => $progress]);
        }
    }

    public function progress(int $progress, int $total): int
    {
        return ceil(($progress / $total) * 100);
    }
}
