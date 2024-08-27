<?php

use App\Http\Livewire\User\DashboardWire;
use App\Http\Livewire\User\Notice\NoticeShowWire;
use App\Http\Livewire\User\Notice\Revival\SubmitOrderWire;
use App\Http\Livewire\User\Notice\Revival\TariffWire as revivalTariff;
use App\Http\Livewire\User\Notice\UpdateCategoryWire;
use App\Http\Livewire\User\Notice\UpdateNoticeDetailWire;
use App\Http\Livewire\User\OrderWire;
use App\Http\Livewire\User\PasswordWire;
use App\Http\Livewire\User\ProfileWire;
use App\Http\Livewire\User\Ticket\ResponseWire;
use App\Http\Livewire\User\Ticket\TicketWire;
use Illuminate\Support\Facades\Route;

Route::get("/profile" , ProfileWire::class)->name("profile");
Route::get("/dashboard" ,DashboardWire::class)->name("dashboard");
Route::get("/ticket" , TicketWire::class)->name("ticket");
Route::get("/ticket-response/{id}" , ResponseWire::class)->name("response");
Route::get("/orders" , OrderWire::class)->name("order");
Route::get("/password" , PasswordWire::class)->name("password");
Route::get("/notices" , NoticeShowWire::class)->name("notice-index");
Route::get("/notice-category/update/{id}" , UpdateCategoryWire::class)->name("update-notice-category");
Route::get("/notice-detail/update/{id}" , UpdateNoticeDetailWire::class)->name("update-notice-detail");
Route::get("/revival-notice/tariff/{id}" , revivalTariff::class )->name("revival-tariff");
Route::get("/revival-notice/submit-order/{id}" , SubmitOrderWire::class )->name("submit-order");
