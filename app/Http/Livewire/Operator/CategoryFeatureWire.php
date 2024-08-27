<?php

namespace App\Http\Livewire\Operator;

use App\Enums\InputTypeEnum;
use App\Enums\TypeNoticeEnum;
use App\Models\Category;
use App\Models\CategoryFeature as Model;
use App\Models\CategoryFeatureValue as FeatureVal;
use App\Traits\AlertTrait;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryFeatureWire extends Component
{
    use WithPagination,AlertTrait;
    protected $listeners = ["delete"];
    protected string $paginationTheme = 'bootstrap';
    public $test;
    public Model $model;
    public string $data = "";
    public bool $update_mode =  false , $required = false;
    public ?string $type = null;
    public function mount(Model $modelInstance) : void
    {
        $this->model = $modelInstance;
    }
    protected $rules = [
        "model.name" => "required",
        "type" => "required",
        "model.prefix" => "nullable",
        "model.suffix" => "nullable",
        "data" => "required",
        "required" => "boolean",
    ];
    protected function rules():array
    {
        $dataValidation = "";
        if ($this->type <> InputTypeEnum::text)
        {
            $dataValidation = "required";
        }
        else $dataValidation = "nullable";
        return [
            "model.name" => "required",
            "type" => "required",
            "model.prefix" => "nullable",
            "model.suffix" => "nullable",
            "data" => $dataValidation,
            "required" => "boolean",
        ];
    }

    public function insert() : void
    {
        $this->validate();
        $this->model->required = $this->required;
        $this->model->type = $this->type;
        $this->model->save();

        if ($this->model->type <> "text"){
            $this->data = $this->readyForSave($this->data);
            FeatureVal::create([
                "category_feature_id" => $this->model->id,
                "feature_value" => $this->data,
            ]);
        }
        else{
            FeatureVal::create([
                "category_feature_id" => $this->model->id,
                "feature_value" => $this->data,
            ]);
        }
        $this->successAlert("مشخصه با موفقیت ثبت شد.");
        $this->model = new Model;
        unset($this->required,$this->data);
        $this->type = null;
    }
    public function readyForSave(string $data) : string
    {
        $dataArray  = explode("\n" , $data);
        foreach ($dataArray as $key => $item){
            $dataArray[$key] = trim($item);
        }
        return implode("#" , $dataArray);
    }
    public function readyForShow($data): string
    {
        $dataArray = explode("#" , $data);
        return implode("\n" , $dataArray);
    }
    public function edit(int $id): void
    {
        if($this->update_mode == true){
            $this->data = "";
        }
        else
        {
            $this->update_mode = true;
        }
        $this->update_mode = true;
        $this->model = Model::find($id);
        $this->required = $this->model->required;
        $this->type = $this->model->getRawOriginal("type");

        $featureVal = FeatureVal::where("category_feature_id" , $this->model->id)->get();
        foreach ($featureVal as  $item){
            $this->data = $item->feature_value;
        }
        if($this->type <> 0 )
        {
            $this->data = $this->readyForShow($this->data);
        }
    }
    public function update(): void
    {
        $this->validate();
        $this->model->required = $this->required;
        $this->model->type = $this->type;
        $this->model->update();

        if($this->model->type <> "text")
        {
            $this->data = $this->readyForSave($this->data);
            FeatureVal::where("category_feature_id" , $this->model->id)->update(array("feature_value" => $this->data));
        }
        else
        {
            FeatureVal::where("category_feature_id" , $this->model->id)->update(array("feature_value" => $this->data));
        }
        $this->successAlert("مشخصه با موفقیت ویرایش شد.");
        $this->model = new Model;
        $this->update_mode = false;
        unset($this->required ,$this->inputs,$this->data);
        $this->type = null;
    }
    public function cancel(): void
    {
        $this->model = new Model;
        $this->update_mode = false;
        unset($this->required , $this->category , $this->data , $this->inputs);
        $this->type = null;
    }
    public function delete(int $id): void
    {
        $model = Model::find($id);
        $model->delete();
        if($this->update_mode){
            $this->model = new Model;
            $this->update_mode = false;
            unset($this->required ,$this->inputs,$this->data);
            $this->type = null;
        }
        $this->successAlert("مشخصه با موفقیت حذف شد.");
    }
    public function render() : view
    {
        $items = Model::orderby('id', 'desc')->paginate();
        return view('operator.livewire.category-feature.index' ,compact( "items" ))
            ->extends('layouts.operator.main')
            ->section('content');
    }
}
