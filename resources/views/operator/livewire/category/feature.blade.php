@section('title','پنل مدیریت | مشخصه های دسته بندی')
<div class="container mt-3 ">
    <a class="btn btn-outline-info m-3" href="{{route('operator.category.feature.select',['id'=>$id_category])}}">افزودن مشخصه</a>
    <a class="btn btn-outline-danger m-3" href="{{route('operator.category')}}"> بازگشت</a>
    <div class="row bg-white rounded">
        <div class="statbox widget box box-shadow w-100">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th>نام</th>
                        <th>فیلد ضروری</th>
                        <th>نوع</th>
                        <th>پیشوند</th>
                        <th>پسوند</th>
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
        </div>
    </div>
</div>
