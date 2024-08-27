@section('title','پنل مدیریت | تیکت ها ')
<div class="rounded">
    <div class="container-fluid">
        <div class="row">
                <div class="bg-white col-sm-8  statbox widget box box-shadow p-3">
                    <div>
                        <label>موضوع:</label>
                        <p>{{$model->title}}</p>
                    </div>
                    <div>
                        <label>نام کاربری:</label>
                        <p>{{$model->user->phone_number}}</p>
                    </div>
                    <div>
                        <label>وضعیت:</label>
                        <p>{{$model->is_close?"بسته":"باز"}}</p>
                    </div>
                    <div>
                        <label>اولویت:</label>
                        <p>{{$model->priority}}</p>
                    </div>
                    <div>
                        <label>متن پیام:</label>
                        <p>{{$model->message}}</p>
                    </div>
                    @if($model->file != null)
                    <button wire:click="export" class="btn-outline-secondary btn btn-sm">
                        دانلود فایل
                    </button>
                    @endif
                </div>
            <div class="pr-3 col-sm-4 statbox widget box box-shadow mt-3">
                <form wire:submit.prevent="insert" class="bg-white p-3">
                    <label>پاسخ:</label>
                    <br>
                    <textarea class="form-control" wire:model="response.message" style="height: 10rem;">
                    </textarea>
                    <br>
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
                    <div class="form-group mb-4 mt-3 d-flex justify-content-start">
                        <button class="btn btn-outline-info m-2 px-3" type="submit">
                            ارسال
                        </button>
                    </div>
                </form>
            </div>
        </div>
            <div class="col-sm-12 bg-white m-3 table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>مخاطب</th>
                        <th>خوانده</th>
                        <th>وضعیت</th>
                        <th>پیام</th>
                        <th>فایل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$item->to_admin?"ادمین":"کاربر"}}</td>
                            <td>{{$item->is_read?"خوانده شده":"خوانده نشده"}}</td>
                            <td>{{$item->ticket->is_close?"بسته":"باز"}}</td>
                            <td>
                                {{$item->message}}
                            </td>
                            @if($item->file != null)
                            <td>
                                <button wire:click="responesfile({{$item->id}})" class="btn-outline-secondary btn btn-sm">
                                    دانلود فایل
                                </button>
                            </td>
                            @else
                               <td> فایلی برای دانلود نیست.</td>
                            @endif
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
