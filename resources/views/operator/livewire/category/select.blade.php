@section('title','پنل مدیریت | انتخاب مشخصه')
<div class=" rounded shadow-sm p-3">
    <a class="btn btn-outline-danger m-3" href="{{route('operator.category')}}"> بازگشت</a>
    <div class="bg-white container-fluid mt-3">
        <div class="row">
            <div class="statbox widget box  w-100">
                <div >
                    <div class="row">
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th>نام</th>
                                <th>فیلد ضروری</th>
                                <th>نوع</th>
                                <th>پیشوند</th>
                                <th>پسوند</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $item)
                                <tr class="text-center">
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->required?"ضروری":"غیرضروری"}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->prefix}}</td>
                                    <td>{{$item->suffix}}</td>
                                    <td>
                                        <button  wire:click="add({{$item->id}})" data-toggle="tooltip" class="btn btn-outline-primary btn-sm">انتخاب</button>
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
