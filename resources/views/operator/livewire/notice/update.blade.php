@section('title','پنل مدیریت | ویرایش اگهی')
<div class="bg-white rounded shadow-sm p-3">
    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        با انتخاب زمان انقضا آگهی مورد نظر تایید می شود.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="statbox widget box box-shadow w-100">
                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    @csrf
                    <legend>اطلاعات آگهی</legend>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-4 mb-4">

                            <label >موضوع  <span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" wire:model="model.title" />
                            @error('model.title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>زمان انقضا</label>
                            <div class="form-group ">
                                <input wire:change="change_expire_time" wire:model="expire_time" id="input1" class="form-control help"  type="text"  placeholder="جستوجو براساس تاریخ(روز/ماه/سال)" />
                            </div>
                        </div>
                        @error('model.expire_time')<span class="text-danger">{{ $message }}</span>@enderror
                        <div class="col-md-4 mb-4">
                            <label > ادرس   <span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" wire:model="model.address">
                            @error('model.address')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <label >وضعیت  <span class="text-danger">*</span></label>
                                <select class="form-select form-control" wire:model="model.status">
                                    @foreach(\App\Enums\TypeNoticeEnum::READ as  $key=>$value)
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            @error('model.status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-4" >
                            <label >استان  <span class="text-danger">*</span></label>
                            <select class="form-select form-control"  wire:model="model.state_id"
                                    wire:change="getCity">
                            @forelse($States as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @empty
                            @endforelse
                            </select>
                            @error('model.state_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>شهر  <span class="text-danger">*</span></label>
                            <select class="form-select form-control" wire:model="city_id">
                                @if($cities == null)
                                    <option value="">ابتدا استان را انتخاب نمایید</option>
                                @else
                                @forelse($cities as $city)
                                    <option
                                        {{$this->model->city_id == $city->id ? 'selected="selected"' : ''}}
                                        value="{{$city->id}}">
                                        {{$city->name}}
                                    </option>
                                @empty
                                @endforelse
                                @endif
                            </select>
                            @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label>نوع اگهی  <span class="text-danger">*</span></label>
                            <select class="form-select form-control" wire:model="model.especial">
                                <option value="0">معمولی</option>
                                <option value="1">ویژه</option>
                            </select>
                            @error('model.especial')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label>وضعیت انقضا  <span class="text-danger">*</span></label>
                            <select class="form-select form-control" wire:model="model.expired">
                                <option value="0">منقضی شده</option>
                                <option value="1">منقضی نشده</option>
                            </select>
                            @error('model.expired')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="parent_id"> تغییر دسته بندی  <span class="text-danger">*</span></label>
                            <select class="form-control" wire:model="model.category_id">
                                @forelse($parents as $parent)
                                    <option value="{{$parent->id}}">{!! $parent->full_title !!}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('model.category_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-4 ">
                            <label for="email">متن  <span class="text-danger">*</span></label>
                            <textarea type="text"class="form-control" rows="6" wire:model="model.context" ></textarea>
                            @error('model.context')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-4 ">
                            <label for="email">موقعیت</label>
                            <div style="height: 400px">
                                    <livewire:web.map-wire >
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>تصویر شاخص</label>
                            <input type="file"  wire:model="image"/>
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-1">
                            <img style="width: 5em;"  src="{{\App\Helper\Utility::pathImage($model->image)}}" class="rounded-circle">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="instagram">تصویر ها</label>
                            <input type="file"  wire:model="gallery" multiple/>
                        </div>
                        @forelse($images as $item)
                            <div class="m-2 rounded">
                                <img style="width: 6em;height: 6em;" class="rounded-circle"  src="{{\App\Helper\Utility::pathImage($item->path)}}">
                                <button wire:click="delete({{$item->id}})" type="button" class="btn btn-outline-danger fas fa-trash-alt m-1"></button>
                            </div>
                        @empty
                        @endforelse
                        @error('gallery')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group mb-4 mt-3 d-flex justify-content-start">
                        <button class="btn btn-outline-info m-2 px-3" type="submit">
                            ویرایش اگهی
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section("script")
    <script>
        document.addEventListener('livewire:load', () => {
            initMap(); // error, map is already initialized
        });
        function initMap() {
            var lat = 30.2832993;
            var lng = 57.0705093;
            if (@this.lat && @this.lng) {
                lat = @this.lat;
                lng = @this.lng;
            }
            let map = leaflet.map('map-id', {
                fullscreenControl: true,
            }).setView([lat, lng], 13);
            leaflet.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoic2hlcnZpbi15YXpkYW4iLCJhIjoiY2txeXV3MzJ6MTkxZTJ1cWhsdmtwaWQyZyJ9.E8cpnl7dqFrbixzhy3hSNw', {
                attribution: '',
                maxZoom: 18,
                id: 'mapbox.streets',
            }).addTo(map);
            leaflet.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18
                }).addTo(map);
            var marker = L.marker([lat, lng], {
                clickable: true,
                draggable: true,
                icon: L.icon({
                    iconUrl:'/images/vendor/leaflet/dist/marker-icon.png',
                    iconSize: [32, 45],
                })
            }).addTo(map).on('dragend', function (marker) {
            @this.lat
                = marker.target._latlng.lat;
            @this.lng
                = marker.target._latlng.lng;
            });
        }
        document.addEventListener('livewire:load', function () {
            $("#input1").persianDatepicker({
                cellWidth: 30,
                cellHeight: 25,
                fontSize: 15,
                onSelect: function () {
                @this.expire_time = document.getElementById("input1").value;
                    $('.alert').alert();
                }
            });
        })
    </script>
@endsection
