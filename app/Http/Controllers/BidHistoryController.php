<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidHistoryRequest;
use App\Models\BidHistory;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;

class BidHistoryController extends Controller
{
    /**
     * @param Item $item
     * @param BidHistoryRequest $request
     * @return RedirectResponse
     */
    public function submitBid(
        Item $item,
        BidHistoryRequest $request
    ): RedirectResponse
    {
        if ((int) $request->input('bid') < (int) $item->minimal_bid) {
            return redirect()->back()->with('error', 'Please submit at least minimal bid amount !');
        }

        BidHistory::create([
            'item_id' => $item->id,
            'user_id' => auth()->user()->id,
            'bid_amount' => $request->input('bid')
        ]);

        return redirect()->back()->with('success', 'Thank you, bid submitted');
    }
}
