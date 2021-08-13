<?php

namespace App\Observers;

use App\Models\BookPromotions;
use App\Models\ProductModel;

class Promotion
{
    /**
     * Handle the BookPromotion "created" event.
     *
     * @param  \App\Models\BookPromotions  $bookPromotion
     * @return void
     */
    public function created(BookPromotions $bookPromotion)
    {
    }

    /**
     * Handle the BookPromotion "updated" event.
     *
     * @param  \App\Models\BookPromotion  $bookPromotion
     * @return void
     */
    public function updated(BookPromotions $bookPromotion)
    {
        //
    }

    /**
     * Handle the BookPromotion "deleted" event.
     *
     * @param  \App\Models\BookPromotions  $bookPromotion
     * @return void
     */
    public function deleted(BookPromotions $bookPromotion)
    {
        $data = ProductModel::all();
        foreach ($data as $value) {
            if ($value->promotion_id == $bookPromotion->id) {
                $value->promotion_id = null;
                $value->save();
            }
        }
    }

    /**
     * Handle the BookPromotion "restored" event.
     *
     * @param  \App\Models\BookPromotions  $bookPromotion
     * @return void
     */
    public function restored(BookPromotions $bookPromotion)
    {
        //
    }

    /**
     * Handle the BookPromotion "force deleted" event.
     *
     * @param  \App\Models\BookPromotions  $bookPromotion
     * @return void
     */
    public function forceDeleted(BookPromotions $bookPromotion)
    {
        $data = ProductModel::all();
        foreach ($data as $value) {
            if ($value->promotion_id == $bookPromotion->id) {
                $value->promotion_id = null;
                $value->save();
            }
        }
    }
}
