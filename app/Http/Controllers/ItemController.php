<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

use function compact;
use function dd;
use function view;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('bids')->get();

        return view('home', compact('items'));
    }
}
