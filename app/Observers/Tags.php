<?php

namespace App\Observers;

use App\Models\ProductModel;
use App\Models\TagsModel;

class Tags
{
    /**
     * Handle the TagsModel "created" event.
     *
     * @param  \App\Models\TagsModel  $tagsModel
     * @return void
     */
    public function created(TagsModel $tagsModel)
    {
        //
    }

    /**
     * Handle the TagsModel "updated" event.
     *
     * @param  \App\Models\TagsModel  $tagsModel
     * @return void
     */
    public function updated(TagsModel $tagsModel)
    {
        //
    }

    /**
     * Handle the TagsModel "deleted" event.
     *
     * @param  \App\Models\TagsModel  $tagsModel
     * @return void
     */
    public function deleted(TagsModel $tagsModel)
    {
        $tagsModel->books()->detach();
    }

    /**
     * Handle the TagsModel "restored" event.
     *
     * @param  \App\Models\TagsModel  $tagsModel
     * @return void
     */
    public function restored(TagsModel $tagsModel)
    {
        //
    }

    /**
     * Handle the TagsModel "force deleted" event.
     *
     * @param  \App\Models\TagsModel  $tagsModel
     * @return void
     */
    public function forceDeleted(TagsModel $tagsModel)
    {
        $tagsModel->books()->detach();
    }
}
