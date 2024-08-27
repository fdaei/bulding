@section("title" ,"پنل کاربری | ویرایش توضیحات آگهی")
<div class="container">
    <div class="d-flex justify-content-end px-5  mb-3">
        <div class="p-3 bg-c-yellow alert-success rounded-bottom shadow-sm ">
            <span class="px-5 text-white ">ویرایش توضیحات آگهی</span>
        </div>
    </div>
    <form wire:submit.prevent="submit" class="row mb-3 d-flex">
        <div class="alert alert-warning px-5 col-12">
            <p class="m-0">
                دسته بندی انتخاب شده :
                {!! \App\Models\Category::find($this->model->category_id)->fullTitle !!}
            </p>
        </div>
        <div class="col-lg-4 order-md-2 pe-lg-0">
            <div class="border rounded p-2 mb-3">
                <div class="border-bottom mb-2">
                    <label class="form-label" for="state"><i class="fa fa-location me-2"></i><strong>استان</strong><span class="text-danger">*</span></label>
                    <select wire:model="state_id" wire:change="chooseState($event.target.value)" id="state" class="form-select mb-2" disabled>
                        <option value="{{0}}">--استان خود را مشخص کنید--</option>
                        @forelse($state as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('state_id')<span class="text-danger" >{{ $message }}</span>@enderror
                </div>
                <div class="border-bottom mb-2">
                    <label class="form-label" for="city"><i class="fas fa-map-marker-minus me-2"></i><strong>شهر</strong><span class="text-danger">*</span></label>
                    <select wire:model="city_id" id="city" class="form-select mb-2">
                        @isset($city)
                            @foreach($city as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @else
                            <option value="{{{0}}}">--ابتدا استان خود را مشخص کنید--</option>
                        @endif
                    </select>
                    @error('city_id')<span class="text-danger" >{{ $message }}</span>@enderror
                </div>
                <div class="border-bottom mb-2">
                    <label class="form-label" for="map-id"><i class="far fa-map-marked-alt me-2"></i><strong>موقعیت جغرافیایی</strong></label>
                    <div style="height: 330px">
                        <livewire:web.map-wire >
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-1 border rounded">
            <div class="bg-white">
                <div class="mb-2">
                    <label class="form-label pt-2" for="title"><i class="far fa-pen me-2"></i>عنوان آگهی<span class="text-danger">*</span></label>
                    <input wire:model="model.title" class="form-control mb-3" id="title">
                    @error('model.title')<span class="text-danger" >{{ $message }}</span>@enderror
                </div>
                <div class="mb-2">
                    <label class="form-label" for="context"><i class="far fa-comment-alt-dots me-2"></i>توضیحات آگهی<span class="text-danger">*</span></label>
                    <textarea wire:model.defer="model.context" class="form-control mb-3" style="height: 10rem;" id="context"></textarea>
                    @error('model.context')<span class="text-danger" >{{ $message }}</span>@enderror
                </div>
                <div class="mb-3">
                    @if(!$currentIndexImage)
                        <label class="form-label" for="newImage"><i class="fal fa-upload me-2"></i>تصویر شاخص<span class="text-danger">*</span></label>
                        @if($newImage)
                            <i wire:loading.remove wire:target="newImage" class="far fa-check text-success"></i>
                        @endif
                        <div wire:loading wire:target="newImage">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <input wire:model="newImage" class="form-control" type="file" id="newImage">
                        @error('newImage')<span class="text-danger">{{ $message }}</span>@enderror
                    @else
                        <div class="container-fluid border rounded px-1 mt-3 bg-light">
                            <div class="row d-flex justify-content-end py-2 px-3">
                                <div class="col-md-9 d-flex justify-content-center align-items-center p-2">عکس شاخص قبلی</div>
                                <div class=" col-md-3  p-0 hover-image-container">
                                    <img class="rounded border image img-fluid" src="{{\App\Helper\Utility::pathImage($this->model->image)}}"alt="تصویر شاخص">
                                    <div class="middle">
                                        <button wire:click="deleteIndexImage()" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="gallery"><i class="fal fa-upload me-2"></i>تصاویر دیگر</label>
                    @if($gallery)
                        <i wire:loading.remove wire:target="gallery" class="far fa-check text-success"></i>
                    @endif
                    <div wire:loading wire:target="gallery">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <input wire:model="gallery" class="form-control" type="file" id="gallery" multiple>
                    @error('gallery')<span class="text-danger" >{{ $message }}</span>@enderror
                    @if(!($this->model->gallerys->count() == count($this->galleryIds)))
                        <div class="container-fluid border rounded px-1 mt-3 bg-light">
                            <div class="row d-flex justify-content-end py-2 px-3">
                                <div class="">گالری قبلی</div>
                                @if($this->model->gallerys)
                                    @forelse($this->model->gallerys as $item)
                                        @if(!in_array($item->id , $galleryIds))
                                            <div class=" col-md-3  p-0 hover-image-container">
                                                <img class="rounded image img-fluid" src="{{\App\Helper\Utility::pathImage($item->path)}}"  alt="گالری تصاویر">
                                                <div class="middle">
                                                    <button wire:click="deleteGalleryImage({{ $item->id }})" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                @else
                                    <div class="d-flex justify-content-center align-items-center">
                                        <p>هیچ تصویری آپلود نشده است</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>


                {{--                        <!-- features -->--}}
                @forelse(\App\Models\Category::ancestorsAndSelf($this->model->category_id) as $i)

                    @forelse($i->categoryFeatures as $item)
                        @if($item->type == "select")
                            <div class="mb-2">
                                <label class="form-label" for="{{$item->name}}">
                                    {{$item->name}}
                                    @if($item->required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <select wire:model="selectInputs.{{$item->id}}" class="form-select" id="{{$item->name}}" {{$item->required? "required" : ""}} >
                                    <option value="">--انتخاب کنید--</option>
                                    @forelse($item->category_feature_values as $val)
                                        @php
                                            $array = explode("#" , $val->feature_value);
                                        @endphp
                                        @forelse($array as $value)
                                            <option value="{{$value}}">{{$value}}</option>
                                        @empty
                                        @endforelse
                                    @empty
                                    @endforelse
                                </select>
                                @error('model.title')<span class="text-danger" >{{ $message }}</span>@enderror
                            </div>
                        @endif
                    @empty
                    @endforelse

                    @forelse($i->categoryFeatures as $item)
                        @if($item->type == "radio")
                            <div class="mb-2 row">
                                <h6>{{$item->name}}
                                    @if($item->required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </h6>
                                <div class="col-md-4">
                                    @forelse($item->category_feature_values as $val)
                                        @php
                                            $array = explode("#" , $val->feature_value);
                                        @endphp
                                        @forelse($array as $value)
                                            <label class="form-check-label px-2" for="{{$value}}">{{$value}}</label>
                                            <input wire:model="radioInputs.{{$item->id}}" type="radio" name="{{$item->name}}"  class="form-check-input" value="{{$value}}" id="{{$value}}" {{$item->required? "required" : ""}} >
                                            @error('model.title')<span class="text-danger" >{{ $message }}</span>@enderror
                                        @empty
                                        @endforelse
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        @endif
                    @empty
                    @endforelse

                    @forelse($i->categoryFeatures as $item)
                        @if($item->type == "checkbox")
                            <div class="mb-2 row">
                                <h6>{{$item->name}}
                                    @if($item->required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </h6>
                                <div class="col-md-4">
                                    @forelse($item->category_feature_values as $val)
                                        @php
                                            $array = explode("#" , $val->feature_value);
                                        @endphp
                                        <div class="checkbox-group {{$item->required? "required" : ""}}">
                                            @forelse($array as $value)
                                                <label class="form-check-label px-2" for="{{$value}}">{{$value}}</label>
                                                <input wire:model="checkboxInputs.{{$item->id}}.{{$value}}" type="checkbox" class="form-check-input" value="{{$value}}" id="{{$value}}">
                                            @empty
                                            @endforelse
                                            <span class="text-danger error d-none" >مشخصه {{$item->name}} الزامی است.</span>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        @endif
                    @empty
                    @endforelse
                    @forelse($i->categoryFeatures as $item)
                        @if($item->type == "text")
                            <div class="mb-2 row">
                                <label class="col-sm-2 col-form-label" for="{{$item->name}}">
                                    {{$item->name}}
                                    @if($item->required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        @if($item->prefix)
                                            <span class="input-group-text">{{$item->prefix}}</span>
                                        @endif
                                        <input wire:model="textInputs.{{$item->id}}" type="text" class="form-control" {{$item->required? "required" : ""}} id="{{$item->name}}">
                                        @if($item->suffix)
                                            <span class="input-group-text">{{$item->suffix}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @empty
                @endforelse


                {{--                        <!-- end features -->--}}
                <div class="mb-2">
                    <label class="form-label" for="address"><i class="fal fa-map me-2"></i>آدرس<span class="text-danger">*</span></label>
                    <textarea wire:model.defer="model.address" class="form-control mb-3" style="height: 10rem;" id="address"></textarea>
                    @error('model.address')<span class="text-danger" >{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between order-3 mt-3">
            <a href="{{route("user.notice-index")}}" class="btn btn-danger px-5">لغو</a>
            <button class="btn btn-success px-3">اعمال تغییرات</button>
        </div>
    </form>
</div>
@section("script")
    <script>


        document.addEventListener('livewire:load', function () {

            initMap();
            function initMap() {
                var lat = 30.2832993;
                var lng = 57.0705093;
                if (@this.lat && @this.lng) {
                    lat = @this.lat;
                    lng = @this.lng;
                }
                window.LeafletMap = L.map('map-id', {
                    center: [lat, lng],
                    zoom: 18,
                    doubleClickZoom: "center"
                });

                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution:
                        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(window.LeafletMap);
                var marker = L.marker([lat, lng], {
                    clickable: true,
                    draggable: true,
                    icon: L.icon({
                        iconUrl: '/images/vendor/leaflet/dist/marker-icon.png',
                        iconSize: [32, 45],
                    })
                }).addTo(window.LeafletMap).on('dragend', function (marker) {
                @this.lat = marker.target._latlng.lat;
                @this.lng = marker.target._latlng.lng;
                });
            }
        })
    </script>
    <script>
        $('[required]')
            .on('invalid', function(){
                return this.setCustomValidity("این فیلد الزامی است");
            })
            .on('input', function(){
                return this.setCustomValidity('');
            });
    </script>
@endsection
