<?php

namespace App\Observers;

use App\Events\Order\OrderComplete;
use App\Models\Order;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

class OrderObserver
{
    private function update_total_sales()
    {
        $data = new Collection();
        $total = 0;
        $order = Order::all();
        foreach ($order as $value) {
            foreach ($value->books as $item) {
                $data[] = $item;
            }
        }
        $count = $data->groupBy('book_id');
        foreach ($count as $key => $value) {
            foreach ($value as $book) {
                $total += $book->pivot->quantity;
            }
        }
        return Redis::set('orders:sales:total', $total);
    }

    private function update_total_orders()
    {
        $total = Order::all()->count();
        return Redis::set('orders:total', $total);
    }
    public function created(Order $userModel)
    {
        $this->update_total_orders();
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        foreach ($order->books as $book) {
            $total = $book->pivot->quantity;
            Redis::DECRBY('product:' . $book->book_id . ':sales', $total);
            $book->total = $book->total + $total;
            $book->save();
        }
        $this->update_total_sales();
        $this->update_total_orders();
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        foreach ($order->books as $book) {
            $total = $book->pivot->quantity;
            Redis::incrby('product:' . $book->book_id . ':sales', $total);
            $book->total -= $total;
            $book->save();
        }
        $this->update_total_sales();
        $this->update_total_orders();
    }
}
