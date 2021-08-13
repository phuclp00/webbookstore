<?php

namespace App\Observers;

use App\Models\ProductModel;
use Illuminate\Support\Facades\Redis;

class Product
{
    private function update_total_book()
    {
        $data = ProductModel::all();
        $total = 0;
        foreach ($data as $key => $value) {
            $total += $value->total;
        }
        return  Redis::set('product:book:total', $total);
    }
    /**
     * Handle the ProductModel "created" event.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return void
     */
    public function created(ProductModel $productModel)
    {
        $this->update_total_book();
    }

    /**
     * Handle the ProductModel "updated" event.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return void
     */
    public function updated(ProductModel $productModel)
    {
        $this->update_total_book();
    }

    /**
     * Handle the ProductModel "deleted" event.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return void
     */
    public function deleted(ProductModel $productModel)
    {
        $this->update_total_book();
    }

    /**
     * Handle the ProductModel "restored" event.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return void
     */
    public function restored(ProductModel $productModel)
    {
        $this->update_total_book();
    }

    /**
     * Handle the ProductModel "force deleted" event.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return void
     */
    public function forceDeleted(ProductModel $productModel)
    {
        $this->update_total_book();
    }
}
