<?php

namespace App\Http\Livewire\User\Notice;

use App\Models\Notice;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class NoticeShowWire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render():view
    {
        $notices = Notice::orderBy("id" , 'DESC')->where("user_id" , Auth::id())->paginate();
        return view('user.livewire.notice.index' , compact("notices"))
            ->extends("layouts.web.panel.main")
            ->section("content");
    }
}
