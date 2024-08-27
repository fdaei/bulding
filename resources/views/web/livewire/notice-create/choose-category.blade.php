@section("title" , config('app.name')." | انتخاب دسته بندی")
<div class="container p-3">
    @include("layouts.web.partial.wizard")
    <div class="row d-flex justify-content-start ">
        @forelse($category as $item)
            <div class="p-2 col-4 col-md-3 d-grid gap-2">
                <button type="button" wire:click="categoryChild({{$item->id}})" class="btn  p-3 text-center component-box " style="background-color: {{$item->background}}">
                    @if($item->icon)
                        <i class="{{$item->icon}} d-block" style="color: {{$item->color}}"></i>
                    @endif
                    @if($item->image)
                        <img src="{{\App\Helper\Utility::pathImage($item->image)}}" class="card-img-top rounded-circle" style="height: 70px;width: 70px;">
                    @endif
                    <span class="d-block pt-3 ">{{$item->name}}</span>
                </button>
            </div>
        @empty
        @endforelse
    </div>
</div>








