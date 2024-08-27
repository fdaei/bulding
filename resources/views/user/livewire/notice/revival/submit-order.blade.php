@section("title" ,"پنل کاربری | مشاهده جزئیات")
<div class="container">
    <div class="d-flex justify-content-end px-5 mb-3">
        <div class="p-3 bg-c-yellow rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">تمدید تعرفه</span>
        </div>
    </div>
    <div class="row" wire:ignore>
        <div class="col-md-12 p-3 border rounded shadow-sm">
            <div class="table-responsive">
                <table class="table bg-light">
                    <thead class="table-dark">
                    <tr class="text-center">
                        <th colspan="2">اطلاعات آگهی</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fal fa-cubes me-2"></i>دسته بندی</td>
                            <td>{!! $model->category->fullTitle  !!}</td>
                        </tr>
                        <tr>
                            <td><i class="fal fa-pen-nib me-2"></i>عنوان آگهی</td>
                            <td>
                                {{$model->title}}
                                @if(session()->get("dataSession.special"))
                                    <span class="badge bg-warning">آگهی ویژه</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fal fa-align-right me-2"></i>توضیحات آگهی</td>
                            <td>
                                <p>
                                    {{$model->context}}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fal fa-location me-2"></i>استان / شهر</td>
                            <td>
                                {{$model->city->name}}
                                /
                                {{$model->state->name}}
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fal fa-map me-2"></i>آدرس</td>
                            <td>{{$model->address}}</td>
                        </tr>
                        <tr>
                            <td><i class="fal fa-stopwatch me-2"></i>مدت زمان آگهی</td>
                            <td>
                                @if(session()->get("dataSession.time") <> -1)
                                {{session()->get("dataSession.time")}}روز
                                @else
                                &infin;
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fal fa-dollar-sign me-2"></i>مبلغ قابل پرداخت</td>
                            <td>{{number_format(session()->get("dataSession.price"))}} تومان</td>
                        </tr>
                        <tr class="bg-dark">
                            <td class="text-white text-center" colspan="2">مشخصه های آگهی</td>
                        </tr>

                        @forelse($noticeFeatures as $key => $item)
                            @if($item->type <> \App\Enums\InputTypeEnum::checkbox)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->value}}</td>
                                    </tr>
                            @else
                                <tr>
                                    <td>{{$item->name}}</td>
                                    @php
                                        $dataArray = explode("#" , $item->value);
                                    @endphp
                                    <td>
                                        @forelse($dataArray as $value)
                                            {{$value}}
                                            @if(!$loop->last)
                                                /
                                            @endif
                                        @empty
                                        @endforelse
                                    </td>
                                </tr>
                            @endif
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <a href="{{route("user.revival-tariff" , ["id" => session()->get("dataSession.notice_id")])}}" class="btn btn-secondary">مرحله قبل</a>
        <button wire:click="submitOrder" class="btn btn-info">ثبت سفارش</button>
    </div>
</div>
