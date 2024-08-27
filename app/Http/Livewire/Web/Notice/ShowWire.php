<?php

namespace App\Http\Livewire\Web\Notice;

use App\Models\Comment;
use App\Models\CommentResponse;
use App\Models\Notice;
use App\Models\Notice as Model;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Livewire\Component;

class ShowWire extends Component
{
    use AlertTrait;
    public Model $model;
    public Comment $comment;
    public CommentResponse $response;
    public string $response_text="";
    public $lat , $lng;
    public function mount($id) : void
    {
        $this->model=Notice::find($id);
        $this->lat = $this->model->lat;
        $this->lng = $this->model->lng;
        $this->comment=new Comment;
        $this->response=new CommentResponse;
    }
    public function render():View
    {
        return view('web.livewire.notice.show')
            ->extends("layouts.web.main")
            ->section("content");
    }
    protected function rules() : array
    {
        return [
            'comment.title' => 'required',
            'comment.context' => 'required',
        ];
    }
    public function SendResponse($id,$a):void
    {
        if($this->response_text!=null)
        {
            if(!Auth::guest())
            {

                if($a=="comment")
                {
                    Comment::find($id)->comments()->create([
                        'user_id'=>Auth::id(),
                        'notice_id'=>$this->model->id,
                        'text'=>$this->response_text,
                        'status'=>2,
                    ]);
                }
                elseif ($a=="response")
                {
                    CommentResponse::find($id)->comments()->create([
                        'user_id'=>Auth::id(),
                        'notice_id'=>$this->model->id,
                        'text'=>$this->response_text,
                        'status'=>2,
                    ]);
                }
                $this->response_text="";
                $this->successAlert("پاسخ شما با موفقیت ثبت شد.");
            }
            else
            {
                $this->dangerAlert('لطفا ابتدا وارد پنل کاربری خود شوید');
            }
        }
        else{
            $this->dangerAlert(' لطفا ابتدا پاسخ خود را در کادر وارد کنید');
        }
    }
    public function insert() : void
    {
        if($this->validate())
        {
            if(!Auth::guest())
            {
                $this->comment->user_id=Auth::id();
                $this->comment->status=0;
                $this->comment->notice_id=$this->model->id;
                $this->comment->save();
                $this->successAlert("نظر شما با موفقیت ثبت شد.");
                $this->comment=new Comment;
            }
            else
            {
                $this->dangerAlert('لطفا ابتدا وارد پنل کاربری خود شوید');
            }
        }
    }
}
