<?php

namespace App\Listeners\Promotion;

use App\Models\Author;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Notifications\Promotion\PromotionStartNotification;
use App\Observers\Promotion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromotionStartListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $promotion = $event->promotion;
        $type = $event->type;
        $user = $event->user;
        $time_remaining = now() > $promotion->date_started ? 0 : now()->diffInSeconds($promotion->date_started);
        sleep($time_remaining);
        $pre_result = [];
        switch ($type['type']) {
            case 'books':
                $data = explode(',', $type['data']);
                foreach ($data as $key => $value) {
                    $id = explode(':', $value);
                    $pre_result[] = trim($id[0]);
                }
                foreach ($pre_result as $value) {
                    $book = ProductModel::find($value);
                    $book->promotion_id = $promotion->id;
                    $book->modified_by = $user->user_name;
                    $book->save();
                }
                break;
            case 'category':
                $data = explode(',', $type['data']);
                foreach ($data as $value) {
                    //   $books = ProductModel::where('cat_id', $cat_id)->get();
                    $categories = CategoryModel::where('name', trim($value))->with('descendants')->with([
                        'books.thumb',
                        'books.category',
                        'books.tags',
                        'books.format',
                        'books.series',
                        'books.publisher',
                        'books.supplier',
                        'books.translator',
                        'books.author',
                        'books.lang',
                        'books.promotion'
                    ])->get();
                    $categories->filter(function ($value) {
                        return $value->descendants->load(
                            'books.thumb',
                            'books.category',
                            'books.tags',
                            'books.format',
                            'books.series',
                            'books.publisher',
                            'books.supplier',
                            'books.translator',
                            'books.author',
                            'books.lang',
                            'books.promotion'
                        );
                    });
                    $categories->filter(function ($value) {
                        foreach ($value->descendants as $child) {
                            $value->books[] = $child->books;
                        }
                    });

                    foreach ($categories[0]->books as $book) {
                        if ($book->count() > 0) {
                            foreach ($book as $item) {
                                $item->promotion_id = $promotion->id;
                                $item->modified_by = $user->user_name;
                                $item->save();
                            }
                        }
                    }
                }
                break;
            case 'author':
                $data = explode(',', $type['data']);
                foreach ($data as $value) {
                    $author = Author::where('name', trim($value))->with('books')->first();
                    foreach ($author->books as $book) {
                        $book->promotion_id = $promotion->id;
                        $book->modified_by = $user->user_name;
                        $book->save();
                    }
                }
                break;
            default:
                break;
        }
        $admin = UserModel::where('level', 'admin')->get();
        if ($admin) {
            foreach ($admin as $user) {
                $user->notify(new PromotionStartNotification($promotion));
            }
        }
    }
    public function shouldQueue($event)
    {
        return $event->promotion->date_expired > now();
    }
}
