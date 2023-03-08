<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index()
    {
        return view("Beranda.index");
    }

    public function galangdana()
    {
        return view("Beranda.galang-dana");
    }
}
