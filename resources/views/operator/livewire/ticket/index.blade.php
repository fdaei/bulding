@section('title','پنل مدیریت | تیکت ها')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>کد اگهی</th>
                            <th>کاربر</th>
                            <th>موضوع</th>
                            <th>مخاطب</th>
                            <th>الویت</th>
                            <th>خوانده</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$item->id}}</td>
                                @if($item->user_id===0)
                                    <td>همه کاربران</td>
                                @else
                                <td>{{$item->user->phone_number}}</td>
                                @endif
                                <td>{{$item->title}}</td>
                                <td>{{$item->to_admin?"ادمین":"کاربر"}}</td>
                                <td>{{$item->priority}}</td>
                                <td>

                                    @if( \App\Http\Livewire\Operator\Ticket\Indexwire::read($item->id))
                                        خوانده نشده
                                        <span class="badge bg-danger"> {{ \App\Http\Livewire\Operator\Ticket\Indexwire::read($item->id)}}</span>
                                    @else
                                        خوانده شده
                                    @endif
                                </td>
                                <td>{{$item->is_close?"بسته":"باز"}}</td>
                                <td>
                                    @if($item->user_id!=0)
{{--                                        @dd($item->responses)--}}
                                    <a wire:click="seen({{$item->id}})" href="{{route('operator.ticket-show',['id'=>$item->id])}}" type="button" class="btn btn-outline-info btn-sm" >
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <p>اطلاعاتی جهت نمایش وجود ندارد.</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{$items->links()}}
            </div>
        </div>
    </div>
</div>

