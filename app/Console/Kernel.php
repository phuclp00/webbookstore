<?php

namespace App\Console;

use App\Models\BookPromotions;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use \Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Cache;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $data = BookPromotions::all();
            $flag = false;
            foreach ($data as $value) {
                if ($value->date_expired <= now()) {
                    $flag = true;
                    $value->books()->update(['promotion_id' => null]);
                }
            }
            if ($flag) {
                Cache::forget('category.books.all');
                Cache::forget('product.flashsale');
            }
        })->description('Check Promotion Expired')->hourly()
            ->emailOutputTo('locdo255@gmail.com')
            ->emailOutputOnFailure('locdo255@gmail.com');
        // Auto start queue without php artisan queue:work on sever 
        $schedule->command('queue:restart')
            ->everyFiveMinutes();
        $schedule->command('queue:work --daemon')
            ->everyMinute()
            ->sendOutputTo(storage_path() . '/logs/queue-jobs.log');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
