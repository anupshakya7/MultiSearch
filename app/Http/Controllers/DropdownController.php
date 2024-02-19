<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;
use Monolog\Level;

class DropdownController extends Controller
{
    public function country($id)
    {
        $institute = Institute::where('country_id', $id)->get();
    }
}
