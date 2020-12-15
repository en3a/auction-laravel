<?php

namespace App\Http\Controllers;

use App\Models\BidHistory;
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

    public function index(Request $request)
    {
        $items = Item::query();
        $items = $items->with('bids');

        if ($request->has('search_term')) {
            $items->where('name', 'LIKE', '%'.$request->input('search_term').'%');
        }

        if ($request->has('order')) {
            $items->orderBy('minimal_bid', $request->input('order'));
        } else {
            $items->orderBy('minimal_bid', 'ASC');
        }

        $items = $items->paginate(12);

        return view('home', compact('items'));
    }

    public function show(Item $item)
    {
        $lastBidUserId = $item->bids()->latest()->first('user_id')['user_id'];

        return view('details', compact('item', 'lastBidUserId'));
    }
}
