<?php

namespace App\Http\Livewire\Operator;

use App\Models\Category;
use App\Models\CategoryFeature;
use App\Models\CategoryFeatureValue;
use App\Models\Notice as Model;
use App\Models\NoticeFeature;
use App\Traits\AlertTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;


class NoticeFeatureWire extends Component
{
    use AlertTrait;

    public Model $model;
    public  $features;
    public $value;
    public $number;

    public function mount($id): void
    {
        $this->number = $id;
        $this->model = Model::find($id);
        $this->features = DB::table('category_features')
            ->join('category_feature_values', 'category_features.id', '=', 'category_feature_values.category_feature_id')->join('notice_features', 'category_features.id', '=', 'notice_features.category_feature_id')->where('notice_id',$this->number)->get();
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $update = NoticeFeature::where('notice_id', $id)->get();
        if (isset($request->textid)) {
            foreach ($request->text as $key => $item) {
                $a = NoticeFeature::find($request->textid[$key]);
                $a->value = $item;
                $a->update();
            }
        }

        if (isset($request->select)) {
            foreach ($request->select as $key => $item) {
                $a = NoticeFeature::find($request->selectid[$key]);
                $a->value = $item;
                $a->update();
            }
        }

        if (isset($request->checkboxid)) {
            $string = "";
            foreach ($request->checkbox as $key=>$item) {
                $string = $string . $item ."#";
            }
            $array = explode('#*#', $string);
            for ($i = 0; $i < count($request->checkboxid); $i++) {
                $a = NoticeFeature::find($request->checkboxid[$i]);
                $a->value = $array[$i];
                $a->update();
            }
        }
        if (isset($request->radioid)) {
            foreach ($request->radioid as $key => $item) {
                $a = NoticeFeature::find($item);
                $string ="radio".($key);
                $a->value = $request->$string;
                $a->update();
            }
        }
        $this->SuccessAlertWithRedirect();
        return redirect()->route('operator.notice');
    }

    protected array $rules = [
        'model.category_id' => 'required',
    ];

    public function updateCategory():Redirector
    {
        $bool=false;
        if ($this->validate()) {
            foreach ($this->model->category->categoryFeatures as $key){
                foreach ($this->model->notice_features as $item){
                    if($item->category_feature_id==$key->id)
                    {
                        $same[]=DB::table('category_features')
                            ->join('category_feature_values', 'category_features.id', '=', 'category_feature_values.category_feature_id')->join('notice_features', 'category_features.id', '=', 'notice_features.category_feature_id')->where('category_features.id',$key->id)->where('notice_id',$this->number)->get();
                        $bool=true;
                    }
                }
                if($bool==false)
                {
                    $same[]=DB::table('category_features')
                        ->join('category_feature_values', 'category_features.id', '=', 'category_feature_values.category_feature_id')->where('category_features.id',$key->id)->get();
                }
                $bool=false;
            }
            $this->features=null;
            foreach ($same as $item)
            {
                foreach ($item as $key)
                    {
                        $this->features[]=$key;
                    }
            }
            $this->model->update();
            $this->model=new Model;
            $this->SuccessAlertWithRedirect();
            return redirect()->route('notice.index');
        }
    }
    public function render():View
    {
        $parents = Category::all();
        return view('operator.livewire.notice_feature.update', ['parents' => $parents, 'id' => $this->number])->extends('layouts.operator.main')->section('content');
    }
}
