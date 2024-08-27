<?php

namespace App\Http\Livewire\Web\Notice;

use App\Models\Category;
use App\Models\City;
use App\Models\Notice;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Framework\Constraint\Count;

class IndexWire extends Component
{
    protected $paginationTheme = 'bootstrap';
    protected Collection $root;
    protected  $items;
    public  $choice="";
    public $input_search="";
    public int $delete=-1;
    public  string $searchcity="";
    public  string $searchstate="";
    public ?Collection  $cities=null;
    public ?Collection  $states=null;
    public function mount(Request $request , $id = 0):void
    {
        $this->states=State::all();
        $item=Notice::orderby('especial','DESC');
        if($request->Adv)$item->where('title','LIKE','%'.$request->Adv.'%');
        if($request->state)
        {
            $this->cities=City::where('state_id',$request->state)->get();
            $item->where('state_id',$request->state);
            $this->searchstate=$request->state;
        }
        if($id != 0){
            foreach (Category::descendantsAndSelf($id) as $i)
            {
                $idcategory[]=$i->id;
            }
            $item->wherein('category_id',$idcategory);
            $this->choice=Category::find($id);
        }
        $this->items=$item->paginate(12);
        $this->roots=Category::orderby('weight')->whereIsRoot()->get();
    }
    public function countn($id)
    {
        $item=Notice::orderby('especial','DESC');
        foreach (Category::descendantsAndSelf($id) as $i)
        {
            $idcategory[]=$i->id;
        }
        $item->wherein('category_id',$idcategory);
       return count($item->get());
    }
    public function selectstate():void
    {
        if(isset($this->searchstate))
        {
            if($this->choice)
            {
                $this->roots=$this->choice->children;
                $item=Notice::orderby('especial','DESC')->where('state_id',$this->searchstate);
                foreach (Category::descendantsAndSelf($this->choice->id) as $key)
                {
                    $idcategory[]=$key->id;
                }
                $item->wherein('category_id',$idcategory);
                $this->items=$item->paginate(12);
            }
            else{
                $this->items=Notice::orderby('especial','DESC')->where('state_id',$this->searchstate)->paginate(12);
            }

            $this->cities=City::where('state_id',$this->searchstate)->get();
        }
    }
public function selectcity() : void
{
    if(isset($this->searchcity))
        {
            if($this->choice)
            {
                $this->roots=$this->choice->children;
                $item=Notice::orderby('especial','DESC')->where('city_id',$this->searchcity)->where('state_id',$this->searchstate);
                foreach (Category::descendantsAndSelf($this->choice->id) as $key)
                {
                    $idcategory[]=$key->id;
                }
                $item->wherein('category_id',$idcategory);
                $this->items=$item->paginate(12);
            }
            else{
                $this->items=Notice::orderby('especial','DESC')->where('city_id',$this->searchcity)->where('state_id',$this->searchstate)->paginate(12);
            }
        }
}
    public function changesidebar( int $id):void
    {
        $node=Category::find($id);
        $this->choice=$node;
        $this->roots=$node->children;
        $item=Notice::orderby('especial','DESC');
        foreach (Category::descendantsAndSelf($this->choice->id) as $key)
        {
            $idcategory[]=$key->id;
        }
        $item->wherein('category_id',$idcategory);
        if($this->searchstate)$item->where('state_id',$this->searchstate);
        if($this->searchcity) $item->where('city_id',$this->searchcity);
        $this->items=$item->paginate(12);
    }
    public function categoryfilter($id):void
    {
        $this->delete=$id;
        $item=Notice::orderby('especial','DESC');
        if($id!=$this->choice->id)
        {
            $test=Category::find($id)->parent;
            $this->root=$test->children;
            foreach ($this->choice->children as $key)
            {
                if($key->id==$id)
                {
                    $idcategory[]=$key->id;
                    break;
                }
                else
                {
                    $idcategory[]=$key->id;
                }
            }
            $item->wherein('category_id',$idcategory);
        }
        else{
            $this->roots=Category::orderby('weight')->whereIsRoot()->get();
            $this->choice=null;
        }
        if($this->searchstate)$item->where('state_id',$this->searchstate);
        if($this->searchcity)$item->where('city_id',$this->searchcity);
        $this->items=$item->paginate(12);
    }
    public function statefilter():void
    {
        $this->searchstate="";
        $this->searchcity="";
        if($this->choice){
            $this->roots=$this->choice->children;
            $item=Notice::orderby('especial','DESC');
            foreach (Category::descendantsAndSelf($this->choice->id) as $key)
            {
                $idcategory[]=$key->id;
            }
            $item->wherein('category_id',$idcategory);
            $this->items=$item->paginate(12);
        }
        else{
            $this->items=Notice::orderby('especial','DESC')->paginate(12);
        }
    }
    public function cityfilter():void
    {
        $this->searchcity="";
        if($this->choice){
            $this->roots=$this->choice->children;
            $item=Notice::orderby('especial','DESC')->where('state_id',$this->searchstate);
            foreach (Category::descendantsAndSelf($this->choice->id) as $key)
            {
                $idcategory[]=$key->id;
            }
            $item->wherein('category_id',$idcategory);
            $this->items=$item->paginate(12);
        }
        else{
            $this->items=Notice::orderby('especial','DESC')->where('state_id',$this->searchstate)->paginate(12);
        }
    }
    public function parent($id) : void
    {
        $node=Category::find($id);
        $this->choice=$node;
        $item=Notice::orderby('especial','DESC')->orwhere('category_id',$id);
        foreach ($node->children as $key)
        {
            $item->orwhere('category_id',$key->id);
        }
        if($this->searchcity) $item->where('city_id',$this->searchcity)->where('state_id',$this->searchstate);
        $this->items=$item->paginate(12);
    }
    public function render() :View
    {
        if($this->input_search)
        {
            $this->items=Notice::orderby('especial','DESC')->where('title','LIkE','%'.$this->input_search.'%')->orwhere('context','LIkE','%'.$this->input_search.'%')->paginate(12);
        }
        if(!$this->items)
        {
                $this->items=Notice::orderby('especial','DESC')->paginate(12);
        }
        return view('web.livewire.site.multi',['cities'=>$this->cities,'items'=>$this->items,'root'=>$this->roots,'states'=>$this->states])->extends('layouts.web.main')->section('content');
    }
}
