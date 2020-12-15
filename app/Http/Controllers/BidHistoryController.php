<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidHistoryRequest;
use App\Models\BidHistory;
use App\Models\Item;
use App\Repository\BidHistoryRepository;
use Illuminate\Http\RedirectResponse;

class BidHistoryController extends Controller
{
    public $bidHistoryRepository;

    /**
     * BidHistoryController constructor.
     *
     * @param  BidHistoryRepository  $bidHistoryRepository
     */
    public function __construct(BidHistoryRepository $bidHistoryRepository)
    {
        $this->bidHistoryRepository = $bidHistoryRepository;
    }

    /**
     * @param  Item  $item
     * @param  BidHistoryRequest  $request
     *
     * @return RedirectResponse
     */
    public function submitBid(Item $item, BidHistoryRequest $request): RedirectResponse
    {
        if ((int) $request->input('bid') < (int) $item->minimal_bid) {
            return redirect()->back()->with('error', 'Please submit at least minimal bid amount !');
        }

        if ((int) $request->input('bid') <= (int) $item->bids()->latest()->first()->bid_amount) {
            return redirect()->back()->with('error', 'You bid should be bigger than the last one!');
        }

        $bidData = [
            'item_id'    => $item->id,
            'user_id'    => auth()->user()->id,
            'bid_amount' => $request->input('bid')
        ];

        $this->bidHistoryRepository->store($bidData);

        return redirect()->back()->with('success', 'Thank you, bid submitted');
    }
}
