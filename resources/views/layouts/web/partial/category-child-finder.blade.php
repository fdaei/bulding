<ul class="list-group category-list sub-category bg-light mt-2">
    @forelse($item->children as $item)
        @if($item->children->count() == 0)
        <li wire:click="ShowNotices({{$item->id}})" class="list-group-item p-3 border-0 main-category cursor-pointer">{{$item->name}}</li>
        @else
            <li class="list-group-item p-3 border-0 main-category">{{$item->name}}
                    <i class="fal fa-chevron-down float-end rotate-0"></i>
                    @include("layouts.web.partial.category-child-finder" , $item->children)
            </li>
        @endif
    @empty
    @endforelse
</ul>
