@section('title',' پیام ها ')
<div class="rounded shadow-sm p-3">
    <div class="container-fluid mt-3">
        @if($update_mode)
            <div class=" bg-white my-3 p-4 animated">
                <legend class="border-bottom">{{$model->phone_number}}</legend>
                <div>
                    <p>
                        {{$model->context}}
                    </p>
                </div>
            </div>
        @endif
        <div class="row bg-white">
            <div class="statbox widget box box-shadow w-100">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>موضوع</th>
                            <th> شماره تلفن</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$item->subject}}</td>
                                <td>{{$item->phone_number}}</td>
                                <td>        <a class="btn btn-outline-warning btn-sm" wire:click="edit({{$item->id}})">
                        <span class="fa fa-eye">
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
