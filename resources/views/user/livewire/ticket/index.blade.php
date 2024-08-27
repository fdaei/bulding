@section("title" ,"پنل کاربری | تیکت")
<div class="container">
    <div class="d-flex justify-content-end px-5 mb-3">
        <div class="p-3 bg-c-yellow rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">تیکت ها</span>
        </div>
    </div>
    @if(!$send_mode)
        <div class="  mb-3 d-flex justify-content-between flex-column flex-md-row ">
            <div class="">
                <button wire:click="changeMode" class="btn btn-success">ارسال تیکت جدید</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th >#</th>
                    <th>عنوان</th>
                    <th>مخاطب</th>
                    <th>اولویت</th>
                    <th>خوانده شده</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tickets as $item)
                    <tr class="text-center">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->to_admin?"ادمین" : "کاربر"}}</td>
                        <td>{{$item->priority}}</td>
                        <td>
                            @if(\App\Http\Livewire\User\Ticket\TicketWire::read($item->id))
                                خوانده نشده
                                <span class="badge bg-danger">{{\App\Http\Livewire\User\Ticket\TicketWire::read($item->id)}}</span>
                            @else
                                خوانده شده
                            @endif
                        </td>
                        <td>{{$item->is_close?"بسته":"باز"}}</td>
                        <td>
                            <a wire:click="seen" href="{{route("user.response" , ["id" => $item->id])}}" type="button" class="btn btn-outline-info btn-sm" >
                                @if($item->user_id)
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                @else
                                    <i class="fad fa-eye"></i>
                                @endif
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7"><span>هیچ تیکتی موجود نیست</span></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div>
            {{$tickets->links()}}
        </div>
    @else
        <div class="alert alert-warning px-5 mb-3">
            <p class="m-0">در زیر می توانید تیکت جدید را ارسال کنید.</p>
        </div>
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <form wire:submit.prevent="sendTicket">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="title" class="form-label">عنوان<span class="text-danger">*</span></label>
                            <input wire:model.defer="model.title" type="text"  class="form-control"  id="title">
                            @error('model.title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="priority" class="form-label">اولویت<span class="text-danger">*</span></label>
                            <select class="form-control" wire:model.defer="model.priority" id="priority">
                                <option>انتخاب کنید</option>
                                @foreach(\App\Enums\PriorityEnum::READ as  $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            @error('model.priority')<span class="text-danger" >{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 ">
                            <label for="message" class="form-label">متن<span class="text-danger">*</span></label>
                            <textarea wire:model.defer="model.message" class="form-control description" style="height: 35vh" id="message"></textarea>
                            @error('model.message')<span class="text-danger" >{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="file" class="form-label">فایل</label>
                            @if($file)
                                <i wire:loading.remove class="far fa-check text-success"></i>
                            @endif
                            <div wire:loading wire:target="file">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <input wire:model="file" type="file" class="form-control" id="file">
                        </div>
                        <div class="col-sm-12 mb-4 d-flex justify-content-start">
                            <button class="btn btn-outline-success m-3 px-5" type="submit">
                                ارسال
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
