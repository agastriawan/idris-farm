<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Artikel;
use App\Models\Animal;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $totalArtikel = Artikel::count();
        $totalAnimal = Animal::count();
        $totalGallery = Gallery::count();

        return view('admin.dashboard', compact(
            'totalArtikel',
            'totalAnimal',
            'totalGallery'
        ));
    }
}
