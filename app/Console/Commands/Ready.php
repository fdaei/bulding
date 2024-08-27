<?php

namespace App\Console\Commands;

use App\Models\AddOn;
use App\Models\Admin;
use App\Models\Category;
use App\Models\CategoryFeature;
use App\Models\CategoryFeatureCategory;
use App\Models\CategoryFeatureValue;
use App\Models\City;
use App\Models\CommentResponse;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Notice;
use App\Models\NoticeFeature;
use App\Models\Order;
use App\Models\Setting;
use App\Models\State;
use App\Models\Tariff;
use App\Models\Ticket;
use App\Models\TicketFile;
use App\Models\TicketResponse;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Ready extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ready:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'empty all component and make admin and category';

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
        AddOn::truncate();
        Admin::truncate();
        Category::truncate();
        CategoryFeature::truncate();
        CategoryFeatureCategory::truncate();
        CategoryFeatureValue::truncate();
        City::truncate();
        Comment::truncate();
        CommentResponse::truncate();
        Gallery::truncate();
        Message::truncate();
        Notice::truncate();
        NoticeFeature::truncate();
        Order::truncate();
        Setting::truncate();
        State::truncate();
        Tariff::truncate();
        Ticket::truncate();
        TicketFile::truncate();
        TicketResponse::truncate();
        User::truncate();
        $model=new Admin();
        $model->first_name='admin';
        $model->last_name='admin';
        $model->username='admin';
        $model->phone_number='09909565518';
        $model->email='email@gmail.com';
        $model->password=Hash::make('123456789');
        $model->save();
        $model=new Category();
        $model->name='بدون دسته بندی';
        $model->Weight=0;
        $model->parent_id=null;
        $model->icon=null;
        $model->color='#000';
        $model->background='#ffffff';
        $model->image=null;
        $model->save();
        return Command::SUCCESS;
    }
}
