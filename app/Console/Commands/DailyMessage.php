<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mesaj:gunluk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gunluk mesaj gönderen artisan komutu';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo 'Bu benim ilk programlı çalışan komutum. 
        ';
    }
}
