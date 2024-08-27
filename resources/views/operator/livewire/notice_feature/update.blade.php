@section('title','پنل مدیریت | ویرایش مشخصه های اگهی')
<div class="bg-white rounded shadow-sm p-3">
    <div class="row">
        <div class="statbox widget box box-shadow w-100">
            <form class="row" action="{{route('operator.send.value',['id'=>$id])}}" method="post" >
                @csrf
                @method('patch')
            @forelse($features as $key=>$value)
                <div class="col-md-6 input-group mb-3">
                <label class="m-2">{{$value->name}}:</label>
                    @if($value->prefix)
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{$value->prefix}}</span>
                    </div>
                    @endif
                    @if($value->type==0)
                    <div class="custom-file ">
                        <input class="form-control d-inline" type="text" name="text[]"
                        {{$value->required?"required":""}}
                        placeholder="{{$value->feature_value}}"
                        @if(isset($value->value))
                            value="{{$value->value}}"
                        @endif
                       />
                        <input hidden name="textid[]" value={{$value->id}}>
                    </div>
                    @endif
                    @if($value->type==1)
                        <select name="select[]" id="cars" class="form-control">
                            @foreach(explode('#', $value->feature_value) as $item)
                                <option @if(isset($value->value)) {{$item==$value->value?"selected":""}} @endif
                                >{{$item}}</option>
                            @endforeach
                        </select>
                        <input hidden name="selectid[]" value={{$value->id}}>
                    @endif
                    @if($value->type==2)
                        @foreach(explode('#', $value->feature_value) as$key=>$item)
                            <input class="mt-3" type="radio" name="radio{{$key}}" value="{{$item}}"
                            @if(isset($value->value))
                                {{$item==$value->value?"checked ":""}}
                                @endif
                                />
                            <label class="mx-4 mt-2" for="css">{{$item}}</label><br>
                        @endforeach
                            <input hidden name="radioid[]" value={{$value->id}}>
                    @endif
                    @if($value->type==3)
                        @foreach(explode('#', $value->feature_value) as $item)
                            <input class="mt-3"  type="checkbox" id="vehicle1" name="checkbox[]" value={{$item}}
                            @if(isset($value->value))
                            @foreach(explode('#', $value->value) as $key)
                            @if($item==$key)
                                checked
                                @endif
                                @endforeach
                                @endif
                            />
                            <label class="mx-4 mt-2" for="vehicle1">{{$item}}</label><br>
                        @endforeach
                            <input hidden name="checkboxid[]"  value={{$value->id}}>
                            <input hidden name="checkbox[]"  value="*">
                    @endif
                    @if($value->suffix)
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{$value->suffix}}</span>
                    </div>
                    @endif

                </div>
            @empty
            @endforelse
                <div class=" col-sm-12 form-group mb-4  justify-content-start">
                    <button class="btn btn-outline-info m-2 px-3" type="submit">
                       ویرایش
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
