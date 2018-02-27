<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class initRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '载人redis数据';

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
     * @return mixed
     */
    public function handle()
    {
        //1.加载注册用户的数据
        $users = User::all();
        foreach ($users as $user){
            echo Redis::sadd('r_username',$user->email);
        }
    }
}
