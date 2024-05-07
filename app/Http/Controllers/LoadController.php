<?php

namespace App\Http\Controllers;

use App\Models\Positions;
use Illuminate\Http\Request;

class LoadController extends Controller
{
    public function getPositions()
    {
        $positions = Positions::get();

        return response()->json($positions);
    }
}
