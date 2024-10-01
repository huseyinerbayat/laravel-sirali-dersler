<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;

class UpdatePricesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products = Book::get();
        foreach($products as $product) {
            $product->price += $product->price * 0.1;
            $product->save();
        }
        return Command::SUCCESS;
    }
}
