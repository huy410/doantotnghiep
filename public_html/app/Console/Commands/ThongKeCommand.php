<?php

namespace App\Console\Commands;

use App\Models\ThongKe;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ThongKeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thongKe:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $order = DB::table('orders')
        ->select([DB::raw('count(DISTINCT customer_id) as total_customer'), DB::raw('count(id) as total_order'), DB::raw('sum(total_price) as total_money')])
        ->where('created_at','>', Carbon::now()->subDays(1))->first();
        ThongKe::create([
            'total_money' => $order->total_money,
            'total_customer' => $order->total_customer,
            'total_order' => $order->total_order,
        ]);
    }
}
