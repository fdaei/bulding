<ul>
    @forelse($key->comments as $key)
        <div class="bg-white shadow-sm border-1 border p-3 m-2">
        @if($key->comments)
                {{$key->text}}
                @include("layouts.web.partial.comment-child" , $key->comments)
        @else
                {{$key->text}}
        @endif
            <div>
                <p class="clearfix">
                    <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$key->id}}" aria-expanded="false" aria-controls="collapseExample{{$key->id}}" style="float: left">
                        پاسخ
                        <i class="fas fa-reply-all"></i>
                    </button>
                </p>
                <div class="collapse" id="collapseExample{{$key->id}}">
                                    <textarea wire:model.defer="response_text" class="form-control card card-body">
                                    </textarea>
                    <button wire:click="SendResponse({{$key->id}},'response')" class="btn-outline-info btn my-2 btn-sm">ارسال  <i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    @empty
    @endforelse
</ul>
