<?php


namespace App\Repository;


use App\Models\Item;

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
}