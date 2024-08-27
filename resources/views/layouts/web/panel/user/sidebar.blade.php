<div class="col-sm-4 col-lg-3 user-panel-sidebar p-3">
    <div class="border rounded shadow-sm">
        <div class="progress-container p-5">
            <div class="image  d-flex flex-column justify-content-center align-items-center ">
                @if(\Illuminate\Support\Facades\Auth::user()->img)
                <img src="{{  \App\Helper\Utility::pathImage(\Illuminate\Support\Facades\Auth::user()->img)}}" alt="special-ad" class="rounded-circle border-dark border-1" height="100" width="100" >
                @else
                    <img src={{asset("/asset/user/images/unnamed.png")}} class="rounded-circle"  alt="special-ad" height="100" width="100">
                @endif
            </div>
            <h5 class="text-white text-center mt-3">{{\Illuminate\Support\Facades\Auth::user()->fullName}}</h5>
        </div>
        <div class="list-group pb-3 mt-5" wire:ignore>
            @forelse($sidebar as $item)
                <a href="{{$item["link"]}}" class="list-group-item rounded-0 {{$item["is_active"]}} pt-2 pb-2">
                    <i class="{{$item["icon"]}} px-2"></i>{{$item["title"]}}
                    @if($item["title"]=="تیکت")
                        <span class="badge bg-danger" >{{count(\App\Models\TicketResponse::where('is_read',0)->where('to_admin',0)->get())+count(\App\Models\Ticket::where('is_read',0)->where('to_admin',0)->get())}}</span>
                    @endif
                </a>
            @empty
            @endforelse
        </div>
    </div>
</div>


