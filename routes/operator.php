<?php

use App\Http\Livewire\Operator\CommentWire;
use App\Http\Livewire\Operator\DashboardWire;
use App\Http\Livewire\Operator\MessageWire;
use App\Http\Livewire\Operator\NoticeFeatureWire;
use App\Http\Livewire\Operator\PasswordWire;
use App\Http\Livewire\Operator\SettingWire;
use App\Http\Livewire\Operator\TariffWire;
use App\Http\Livewire\Operator\CategoryFeatureWire;
use App\Http\Livewire\Operator\OrderWire;
use App\Http\Livewire\Operator\ProfileWire;
use App\Http\Livewire\Operator\Ticket\ShowWire;
use App\Http\Livewire\Operator\User\CreateWire;
use App\Http\Livewire\Operator\User\IndexWire;
use App\Http\Livewire\Operator\User\UpdateWire;
use App\Http\Livewire\Operator\Notice\CreateWire as NoticeCreate;
use App\Http\Livewire\Operator\Notice\IndexWire as NoticeIndex;
use App\Http\Livewire\Operator\Notice\ShowWire as NoticeShow;
use App\Http\Livewire\Operator\Notice\UpdateWire as NoticeUpdate;
use App\Http\Livewire\Operator\Category\CategoryWire;
use App\Http\Livewire\Operator\Ticket\CreateWire as TicketCreate;
use App\Http\Livewire\Operator\Ticket\Indexwire as TicketIndex;
use App\Http\Livewire\Operator\Category\ShowWire as Showfeatuure;
use App\Http\Livewire\Operator\Category\SelectWire as Selectfeatuure;
use Illuminate\Support\Facades\Route;


Route::get("/category" , CategoryWire::class)->name("category");
Route::get("/category-feature" , CategoryFeatureWire::class)->name("category.feature");

Route::get('/user/create', CreateWire::class)->name('create');
Route::get('/user/index', IndexWire::class)->name('index');
Route::get('/user/update/{id}', UpdateWire::class)->name('update');

Route::get('/message',MessageWire::class)->name('message');

Route::get('/comment',CommentWire::class)->name('comment');

Route::get('/tariff',TariffWire::class)->name('tariff');
Route::get('/notice/create',NoticeCreate::class)->name('noticecreate');
Route::get('/notice/index',NoticeIndex::class)->name('notice');
Route::get('/notice/update/{id}',NoticeUpdate::class)->name('notice.update');
Route::get('/notice/show/{id}',NoticeShow::class)->name('notice.show');

Route::get("/profile" , ProfileWire::class)->name("profile");
Route::get("/category-feature" , CategoryFeatureWire::class)->name("category.feature");
Route::get("/notice/feature/update/{id}" , NoticeFeatureWire::class)->name("noticefeature.update");
Route::get("/notice/feature/update/{id}" , NoticeFeatureWire::class)->name("noticefeature.update");
Route::patch("/notice/feature/update/send/{id}" ,[NoticeFeatureWire::class,'update'])->name("send.value");
Route::get("/orders" , OrderWire::class)->name("orders");

Route::get("/settings", SettingWire::class)->name("settings");

Route::get("/password", PasswordWire::class)->name("changePassword");

//Route::get("/login" , AuthWire::class);
Route::get("/ticket/create" , TicketCreate::class)->name("ticket-create");
Route::get("/ticket/{id}" , ShowWire::class)->name("ticket-show");
Route::get("/ticket" , TicketIndex::class)->name("ticket-index");
Route::get("/dashboard" , DashboardWire::class)->name("dashboard");
Route::get("/category/feature/show/{id}" , Showfeatuure::class)->name("category.feature.show");
Route::get("/category/feature/select/{id}" , Selectfeatuure::class)->name("category.feature.select");

