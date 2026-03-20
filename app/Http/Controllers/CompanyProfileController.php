<?php

namespace App\Http\Controllers;

use App\Models\StoneType;
use Illuminate\Http\Request;


class CompanyProfileController extends Controller
{
    public function index()
    {
        $stoneTypes = StoneType::where('is_available', true)->get();

        return view('welcome', compact('stoneTypes'));
    }


}
