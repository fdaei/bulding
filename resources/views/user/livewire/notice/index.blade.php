@section("title" ,"پنل کاربری | آگهی ها")
<div class="container">
    <div class="d-flex justify-content-end px-5 mb-3">
        <div class="p-3 bg-c-yellow rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">آگهی ها</span>
        </div>
    </div>
    <div class="bg-white table-responsive" style="height: 560px" >
        <table class="table">
            <thead>
            <tr class="text-center">
                <th>کد آگهی</th>
                <th>تصویر</th>
                <th>عنوان آگهی</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($notices as $item)
                <tr class="text-center align-middle">
                    <td>{{ $item->id }}</td>
                    <td><img src="{{\App\Helper\Utility::pathImage($item->image)}}" width="60" height="60" class="rounded-circle m-2" alt=""></td>
                    <td>{{ $item->title }}</td>
                    <td class="{{$item->status === "در حال انتظار"? "text-warning" : ($item->status === "لغو شده"? "text-danger" : ($item->status === "تایید شده"? "text-success" : ""))}}">{{ $item->status }}</td>
                    <td>
                        @if(!$item->expired)
                        <div class="dropdown">
                            <button class="btn btn-outline-info dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-pen"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{route("user.update-notice-category",["id" => $item->id])}}"><i class="fal fa-cubes me-2"></i>ویرایش دسته بندی</a></li>
                                <li><a class="dropdown-item" href="{{route("user.update-notice-detail",["id" => $item->id])}}"><i class="fal fa-align-right me-2"></i>ویرایش توضیحات آگهی</a></li>
                            </ul>
                        </div>
                        @else
                            <button  class="m-auto btn btn-outline-danger d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#modalMessage{{$item->id}}"><i class="fal fa-undo"></i></button>
                            <div class="modal fade" id="modalMessage{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex align-items-center">
                                                <i class="fal fa-exclamation-circle text-warning me-2"></i>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-0">آگهی منقضی شده است در صورتی که مایل به فعال کردن آن هستید بر روی
                                                <strong>ادامه</strong>
                                                کلیک کنید.
                                            </p>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <a  href="{{route("user.revival-tariff" , ["id" => $item->id])}}" class="btn btn-primary">ادامه</a>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    {{$notices->links()}}
</div>
