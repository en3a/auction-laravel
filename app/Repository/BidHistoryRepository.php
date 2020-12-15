<?php


namespace App\Repository;


use App\Models\BidHistory;
use Exception;

use Illuminate\Support\Facades\DB;

use function __;
use function redirect;

class BidHistoryRepository extends BaseRepository
{
    /**
     * CommentRepository constructor.
     *
     * @param  BidHistory  $bidHistory
     */
    public function __construct(BidHistory $bidHistory)
    {
        $this->model = $bidHistory;
    }

    /**
     * @param  array  $data
     *
     * @return BidHistory
     */
    public function store(array $data = []): BidHistory
    {
        DB::beginTransaction();

        try {
            $bidHistory = $this->model->create($data);
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', __('Problem creating bid request'));
        }

        DB::commit();

        return $bidHistory;
    }

}