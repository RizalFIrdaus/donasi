<?php

namespace App\Service;

use Illuminate\Http\Request;

interface GalangDanaService
{
    public function startProgress(Request $request);
    public function progress(int $progress, int $total): int;
    public function updateProgress(Request $request, int $progress);
}
