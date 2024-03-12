<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $url = 'https://reqres.in/api/users/2';
        // $response = Http::get($url);

        // dd($response->json());

        $response = Http::post('https://reqres.in/api/create', [
            "name" => "aca",
            "job" => "tehno prodavac auto delova"
        ]);
        dd($response->body());

    }
}
