@section("title" ,"پنل کاربری | سفارشات")
<div class="container">
    <div class="d-flex justify-content-end px-5 mb-3">
        <div class="p-3 bg-c-yellow rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">سفارشات</span>
        </div>
    </div>
    <div class="bg-white table-responsive">
        <table class="table">
            <thead>
            <tr class="text-center">
                <th>کد سفارش</th>
                <th>تاریخ</th>
                <th>نام آگهی</th>
                <th>قیمت</th>
                <th>وضعیت</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $item)
                <tr class="text-center">
                    <td class="text-center">{{$item->id}}</td>
                    <td>{{ \App\Helper\Utility::convertToSWithOutTime($item->created_at) }}</td>
                    <td>{{ $item->notice->title }}</td>
                    <td>{{ number_format($item->price) }} <span>تومان</span></td>
                    <td class="{{ $item->is_paid? "text-success" : "text-danger" }}">{{ $item->is_paid? "پرداخت شده" : "پرداخت نشده" }}</td>
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
