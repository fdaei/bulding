@section("title" ,"پنل کاربری | تمدید تعرفه")
<div class="container">
    <div class="d-flex justify-content-end px-5 mb-3">
        <div class="p-3 bg-c-yellow rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">تمدید تعرفه</span>
        </div>
    </div>
    <div class="alert alert-warning px-5 mb-3">
        <p class="m-0">درصورت انتخاب تعرفه قبلی هزینه کمتری پرداخت کنید</p>
    </div>
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
                <span class="d-block h6 mt-2">
                    @if($prevTariff == $item->id)
                        <del class="d-block">
                            {{number_format($item->price)}} تومان
                        </del>
                        <span>
                            {{number_format($item->revival)}} تومان
                        </span>
                    @else
                        {{number_format($item->price)}} تومان
                    @endif
                </span>
            </button>
        @empty
        @endforelse
    </div>
    <div class="d-flex {{$changeBack ? "justify-content-between" : "justify-content-end"}}">
        <button wire:click="cancel" class="btn btn-danger px-5">لغو</button>
        @if($changeBack)
            <button wire:click="next" class="btn btn-success px-3">جرئیات سفارش</button>
        @endif
    </div>
</div>
