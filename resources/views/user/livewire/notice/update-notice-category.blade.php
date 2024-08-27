@section("title" ,"پنل کاربری | ویرایش دسته بندی")
<div class="container">
    <div class="d-flex justify-content-end px-5  mb-3">
        <div class="p-3 bg-c-yellow alert-success rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">ویرایش دسته بندی</span>
        </div>
    </div>
    <div class="alert alert-warning px-5 mb-3">
        <p class="m-0">
            دسته بندی قبلی شما :
            {!! $this->currentCategory->fullTitle !!}
        </p>
    </div>
    <div class="row d-flex justify-content-start ">
        @forelse($categories as $item)
            <div class="p-2 col-4 col-md-3 d-grid gap-2">
                <button type="button" wire:click="categoryChild({{$item->id}})" class="btn  p-3 text-center component-box "  style="background-color: {{$item->background}};">
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
    <div class="d-flex justify-content-between mt-3">
        <a href="{{route("user.notice-index")}}" class="btn btn-danger px-5">لغو</a>
        <button wire:click="submit" class="btn btn-success px-3">اعمال تغییرات</button>
    </div>
</div>
