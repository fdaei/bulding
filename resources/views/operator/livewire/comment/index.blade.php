@section('title','پنل مدیریت | دیدگاه ها')
<div class="bg-white rounded shadow-sm p-3">
    <div class="container-fluid mt-3">
        @if($show)
            <div class=" bg-white my-3 p-4 animated fadeInDown delay-5s">
                <div>
                    <p>
                        {{$model->context}}
                    </p>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>موضوع</th>
                            <th>توضیحات</th>
                            <th>کاربر</th>
                            <th>آگهی</th>
                            <th>وضعیت</th>
                            <th>نمایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{mb_substr($item->context,0,30,'utf-8')}}</td>
                                <th>{{$item->User->phone_number}}</th>
                                <th>{{$item->Notice->title}}</th>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$item->status}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                                            @foreach(\App\Enums\TypeCommentEnum::READ as $key => $value)
                                                <a class="dropdown-item" href="#" wire:click="changeStatus({{$item}},{{$key}})">{{$value}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <a class="btn-outline-warning btn-sm btn" onclick="myMove()" wire:click="show({{$item->id}})"><span class="fa fa-eye"></span></a>
                                </th>
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

