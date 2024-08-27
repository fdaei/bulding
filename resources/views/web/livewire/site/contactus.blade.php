@section('title','تماس با ما')
<div class="container-fluid">
    <div class="row">
            <div class="col-lg-6 col-sm-12">
                <form wire:submit.prevent="create" >
                    <div class="form-group my-3">
                        <label for="title">موضوع :</label>
                        <input type="text" class="form-control mt-2" wire:model="model.subject">
                        @error('model.subject')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group my-3" >
                        <label for="tel">شماره تلفن :</label>
                        <input type="tel" class="form-control mt-2"  placeholder="09*********" wire:model="model.phone_number" >
                        @error('model.phone_number')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group my-3">
                        <label>متن پیام:</label>
                        <textarea class="form-control mt-2"  rows="6" wire:model="model.context"></textarea>
                        @error('model.context')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <button class="btn btn-outline-info d-block px-4">ارسال</button>
                </form>
            </div>
        <div class="col-lg-6 d-sm-none test contact-img d-lg-block">
        </div>
    </div>
</div>

