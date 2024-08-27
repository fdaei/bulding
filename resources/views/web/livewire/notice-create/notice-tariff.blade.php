@section("title" , config('app.name')." | انتخاب تعرفه")
<div class="container p-3">
    @include("layouts.web.partial.wizard")
    <div class="row d-flex justify-content-center p-3 " >
        @forelse($tariffs as $item)
            <button wire:click="select({{$item->id}})" type="button" class="btn col-4 col-md-2 p-3  component-box m-2 {{$changeBack == $item->id ? "bg-secondary text-white" : ""}}">
                <i class="display-6 {{$item->notice_type ? "fas fa-user-crown" : "fas fa-bell"}} {{$item->notice_type ? "text-warning" : "text-primary"}}"></i>
                <span class="d-block pt-3 display-6 text-center mb-3">
                    @if($item->time <> -1)
                      {{$item->time}}روز
                    @else
                    &infin;
                    @endif
                </span>
                <span class="d-block h6">{{number_format($item->price)}} تومان</span>
            </button>
        @empty
        @endforelse
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{route("notice-details" , ["id" => session()->get("noticeData.category_id")])}}" class="btn btn-secondary">مرحله قبل</a>
        <button wire:click="next" class="btn btn-success px-3">مرحله بعد</button>
    </div>
</div>

