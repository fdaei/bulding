<?php


use App\Http\Livewire\Operator\AuthWire;

use App\Http\Livewire\Web\ContactUsWire;
use App\Http\Livewire\Web\EspecialWire;
use App\Http\Livewire\Web\Notice\ChooseCategoryWire;
use App\Http\Livewire\Web\Notice\NoticeWire;
use App\Http\Livewire\Web\Notice\SubmitOrderWire;
use App\Http\Livewire\Web\Notice\TariffWire;
use App\Http\Livewire\Web\LoginWire;
use App\Http\Livewire\Web\Notice\IndexWire as NoticesWire;
use App\Http\Livewire\Web\Notice\ShowWire as ShowNotice;

use App\Http\Livewire\Web\RegisterWire;
use App\Http\Livewire\Web\SiteWire;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/" , SiteWire::class)->name("home");
Route::get("/notices/{id?}", NoticesWire::class)->name('search.notices');
Route::get("/notices-index/vip", EspecialWire::class)->name('notices.vip');
Route::get("/notice-create/category" , ChooseCategoryWire::class)->name("notice-create-category");
Route::get("/notice-create/notice-details" , NoticeWire::class)->name("notice-details");
Route::get("/notice-create/tariff" , TariffWire::class)->name("notice-tariff");
Route::get("/notice-create/submit-order" , SubmitOrderWire::class)->name("submit-order");

Route::get("/logout" , function (){
    Auth::logout();
    Auth::guard('operator')->logout();
    return redirect()->to("/");
})->name("logout");

Route::get("/login" , LoginWire::class)->name("login");
Route::get("/register" , RegisterWire::class)->name("register");
Route::get("/operator/login" , AuthWire::class)->name("operator.login");
Route::get("/contact-us" , ContactUsWire::class)->name("contactus");
Route::get("/notice/{id}" , ShowNotice::class)->name("shownotice");
Breadcrumbs::for('home', function ($trail) {
    $trail->push('صفحه اصلی', route('home'));
});
Breadcrumbs::for('search.notices', function ($trail) {
    $trail->parent('home');
    $trail->push('نمایش همه آگهی ها ', route('search.notices'));
});
Breadcrumbs::for('shownotice', function ($trail, $id) {
    $notice = Notice::findOrFail($id);
    $trail->parent('home');
    $trail->push($notice->title, route('shownotice', $notice));
});
Breadcrumbs::for('livewire.message', function ($trail, $id) {
//    $notice = Notice::findOrFail($id);
    $trail->parent('home');
    $trail->push("ksk", route('shownotice'));
});
