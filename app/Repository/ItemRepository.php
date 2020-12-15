<?php


namespace App\Repository;


use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemRepository extends BaseRepository
{
    /**
     * CommentRepository constructor.
     *
     * @param  Item  $item
     */
    public function __construct(Item $item)
    {
        $this->model = $item;
    }

    /**
     * @param  Request  $request
     * @param  int  $paginateNumber
     *
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(Request $request, $paginateNumber = 12): LengthAwarePaginator
    {
        try {
            $items = $this->model::query();

            $items = $items->with('bids');

            if ($request->has('search_term')) {
                $items->where('name', 'LIKE', '%'.$request->input('search_term').'%');
            }

            if ($request->has('order')) {
                $items->orderBy('minimal_bid', $request->input('order'));
            } else {
                // by default
                $items->orderBy('minimal_bid', 'asc');
            }

            return $items->paginate(12);
        } catch (Exception $exception) {
            return redirect()->back()->withFlashDanger(__('Problem getting paginated data'));
        }
    }
}