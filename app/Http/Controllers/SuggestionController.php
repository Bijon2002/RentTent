<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingList;
use App\Models\FoodMenu;

class SuggestionController extends Controller
{
    public function index()
    {
        $boardings = BoardingList::all();   // Fetch all room listings
        $foodVendors = FoodMenu::all();     // Fetch all food vendors

        return view('suggestions', compact('boardings', 'foodVendors'));
    }
}
