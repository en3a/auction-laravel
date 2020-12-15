<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemFilterRequest;
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

    public function index(ItemFilterRequest $request)
    {
        $items = $this->itemRepository->getPaginatedList($request);

        return view('home', compact('items'));
    }

    public function show(Item $item)
    {
        $lastBidUserId = @$item->bids()->latest()->first('user_id')['user_id'];

        return view('details', compact('item', 'lastBidUserId'));
    }
}
