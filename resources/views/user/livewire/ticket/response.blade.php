@section("title" ,"پنل کاربری | تیکت")
<div class="container">
    <div class="d-flex justify-content-end px-5 mb-3">
        <div class="p-3 bg-c-yellow rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">پاسخ به تیکت</span>
        </div>
    </div>
        @if($ticket->is_close)
        <div class="alert alert-warning px-5 mb-3">
            <p class="m-0">این تیکت بسته شده است.</p>
        </div>
        @elseif($ticket->user_id == 0)
        <div class="alert alert-warning px-5 mb-3">
            <p class="m-0">شما نمی توانید به این پیغام پاسخ دهید</p>
        </div>
        @endif
    <div class="row mb-3 d-flex">
        <div class="col-lg-4 order-md-2">

            <div class="border rounded p-2 mb-3">
                <div class="border-bottom mb-2">
                    <label class="form-label"><i class="fal fa-file-alt  me-2"></i><strong>عنوان پیام</strong></label>
                    <p class="p-2 m-0">{{$ticket->title}}</p>
                </div>
                <div class="border-bottom mb-2">
                    <label class="form-label"><i class="fal fa-user me-2"></i><strong>نام کاربری</strong></label>
                    <p class="p-2 m-0">{{($ticket->user_id == 0)?"همه کاربران" : $ticket->user->phone_number}}</p>
                </div>
                <div class="border-bottom mb-2">
                    <label class="form-label"><i class="fal fa-exclamation-circle me-2"></i><strong>اولویت</strong></label>
                    <p class="p-2 m-0">{{$ticket->priority}}</p>
                </div>

                <div class="mb-2">
                    <label class="form-label"><i class="far fa-paperclip me-2"></i><strong>فایل ضمیمه</strong></label>
                    @if($this->ticket->file != null)
                        <div class="d-flex justify-content-end">
                            <button wire:click="export" class="btn-outline-secondary btn btn-sm ">
                                دانلود فایل
                            </button>
                        </div>

                    @else
                        <p class="p-2 m-0">ندارد</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-1">
            <label class="form-label"><i class="far fa-envelope-open-text  me-2"></i><strong>متن پیام</strong></label>
            <p class="p-3 border rounded ">{{$ticket->message}}</p>
            @if($ticket->user_id and $ticket->is_close == 0)
                <form wire:submit.prevent="sendResponse" class="bg-white">
                    <div class="mb-2">
                        <label class="form-label" for="response"><i class="far fa-comment-alt-dots me-2"></i>پاسخ</label>
                        <textarea wire:model.defer="model.message" class="form-control mb-3" style="height: 10rem;" id="response">
                    </textarea>
                        @error('model.message')<span class="text-danger" >{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="attachFile"><i class="fal fa-upload me-2"></i>افزودن فایل</label>
                        @if($file)
                            <i wire:loading.remove class="far fa-check text-success"></i>
                        @endif
                        <div wire:loading wire:target="file">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <input wire:model="file" class="form-control" type="file" id="attachFile">
                    </div>

                    <div class="d-flex justify-content-start">
                        <button class="btn btn-outline-success m-2 px-3" type="submit">
                            ارسال
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    @if($ticket->user_id)
        <div class="bg-white table-responsive">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>مخاطب</th>
                    <th>خوانده</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($responses as $item)
                    <tr class="text-center">
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$item->to_admin?"ادمین":"کاربر"}}</td>
                        <td>{{$item->is_read?"خوانده شده":"خوانده نشده"}}</td>
                        <td>
                            <button  class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalMessage{{$item->id}}"><i class="fad fa-eye"></i></button>
                                <div class="modal fade" id="modalMessage{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">متن پیام</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{$item->message}}
                                            </div>
                                            <div class="modal-footer">
                                                <button wire:click="seen({{$item->id}})" type="button" class="btn btn-danger" data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @if($item->file)
                                <button wire:click="download({{$item->id}})" class="btn btn-outline-success"><i class="fal fa-download"></i></button>
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
    @endif
</div>
