<?php

namespace App\Console;

use App\Jobs\NotificarClientePontosResgate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Como agendar no servidor:
        //1 - Rodar o comando no linux: crontab -e

        //2 - Ao abrir o arquivo, inserir a linha ao final:
        //* * * * * cd /caminho/para/seu/projeto && php artisan schedule:run >> /dev/null 2>&1
        $schedule->job(new NotificarClientePontosResgate)->daily();
        //->everyTwoHours()
        //->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
