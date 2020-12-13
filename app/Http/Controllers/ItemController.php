<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Repository\ItemRepository;
use Illuminate\Http\Request;

use function compact;
use function dd;
use function view;

class ItemController extends Controller
{
    private $itemRepository;

    /**
     * ItemController constructor.
     *
     * @param  ItemRepository  $itemRepository
     */
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }


    public function index()
    {
        $items = $this->itemRepository->with('bids')->get();

        return view('home', compact('items'));
    }

    public function show(Item $item)
    {
        // items details page
    }
}
