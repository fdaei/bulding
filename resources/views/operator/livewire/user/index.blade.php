@section('title',' پنل مدیریت | نمایش کاربران')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container-fluid mt-3">
        <div class="row">
            <input type="text" class="form-control mb-3" placeholder="جستجو..." wire:model="search">
            <div class="statbox widget box box-shadow w-100">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th> شماره تلفن</th>
                            <th> اینستاگرام</th>
                            <th>وب سایت</th>
                            <th>وضعیت</th>
                            <th>ایمیل</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$item->first_name}}</td>
                                <td>{{$item->last_name}}</td>
                                <td>{{$item->phone_number}}</td>
                                <td>{{$item->instagram}}</td>
                                <td>{{$item->website}}</td>
                                <td>{{$item->status?"فعال":"غبرفعال"}}</td>
                                <td>{{$item->email}}</td>
                                <td>        <a class="btn btn-outline-info btn-sm" href="{{route('operator.update',['id'=>$item->id])}}">
                        <span class="fa fa-pencil">
                        </span>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" wire:click="alertConfirm({{$item->id}})" >
                                        <span class="fa fa-trash"></span>
                                    </button></td>
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
