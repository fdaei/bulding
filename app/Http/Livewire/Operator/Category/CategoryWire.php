<?php

namespace App\Http\Livewire\Operator\Category;

use App\Helper\Utility;
use App\Models\Category;
use App\Models\Category as Model;

use App\Models\Notice;
use App\Traits\AlertTrait;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryWire extends Component
{
    use WithPagination , AlertTrait,WithFileUploads;

    protected $listeners = ["delete"];
    public Model $model;
    public  $img ;
    public string $icon ="";
    public bool $update_mode = false;

    protected String $paginationTheme = 'bootstrap';

    protected array $rules = [
        'model.name'=>'required',
        'model.parent_id'=>'nullable|int',
        'model.Weight'=>'numeric|required',
        'model.icon'=>'nullable',
        'img'=>'image|nullable',
        'model.color' =>  ['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        'model.background'=> ['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],

    ];

    public function mount(Model $category_instance): void
    {
        $this->model = $category_instance;
        $this->model->color="#000";
        $this->model->background="#ffffff";
        $this->model->Weight=0;
    }
    public function insert(): void
    {
        if ($this->validate()) {
            $this->model->icon=$this->icon;
            if ($this->img)
            {
                $this->model->image=$this->img->store( Utility::pathUploads(),'public');
            }
            $this->model->save();
            if($this->model->parent_id){
                $parent = Model::find($this->model->parent_id);
                $parent->appendNode($this->model);
            }
            $this->model = new Model;
            $this->icon="";
            $this->img=null;
            $this->model->color="#000";
            $this->model->background="#ffffff";
            $this->model->Weight=0;
            $this->successAlert("دسته بندی با موفقیت ثبت شد.");
        }
    }

    public function edit(int $id): void
    {
        $this->update_mode = true;
        $this->model = Model::find($id);
    }
    public function update(): void
    {
        if ($this->validate()) {
            $this->model->icon=$this->icon;
            if ($this->img)
            {
                Utility::removeImage(asset(('storage/' . $this->model->image)));
                $this->model->image=$this->img->store( Utility::pathUploads(),'public');
            }
            $this->model->update();
            if($this->model->parent_id){
                $parent = Model::find($this->model->parent_id);
                $parent->appendNode($this->model);
            }
            $this->model = new Model;
            $this->update_mode = false;
            $this->successAlert("دسته بندی با موفقیت ویرایش شد.");
        }
    }

    public function cancel(): void
    {
        $this->model = new Model;
        $this->update_mode = false;
    }

    public function delete(int $id): void
    {
        $model = Model::find($id);
        $nodeChildren = $model->children;
        foreach ($nodeChildren as $item)
        {
            $item->parent_id = 1;
            $item->update();
        }
        if($this->update_mode){
            $this->model = new Model;
            $this->update_mode = false;
        }
        $notices = Notice::where("category_id" , $model->id)->get();
        foreach ($notices as $item)
        {
            $item->category_id = 1;
            $item->update();
        }
        $model->delete();
        $this->successAlert("دسته بندی با موفقیت حذف شد.");
    }



    public function render() : view
    {

        $items = Model::orderby('weight', 'desc')->paginate();
        $parents = Model::all();

        return view('operator.livewire.category.index' ,
            [
                'items' => $items,
                'parents' => $parents,
                'update_mode' => $this->update_mode
            ]
        )->extends('layouts.operator.main')->section('content');
    }

}
