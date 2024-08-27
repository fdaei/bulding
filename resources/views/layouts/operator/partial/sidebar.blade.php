<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <span class="brand-text d-block font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @forelse($sidebar as $item)
                    <li class="nav-item">
                        <a href="{{$item["link"]}}" class="nav-link {{$item["is_active"]}}" >
                            <i  class="{{$item["icon"]}} text-white"></i>
                            <p>
                                {{$item["name"]}}
                            </p>
                            @if($item["name"]=="تیکت ها")
                                <span class="badge bg-danger"> {{ count(\App\Models\TicketResponse::where('is_read', 0)->where('to_admin', 1)->get())+ count(\App\Models\Ticket::where('is_read', 0)->where('to_admin', 1)->get())}}</span>
                            @endif
                        </a>
                    </li>
                @empty
                @endforelse
                </ul>
            </nav>
        </div>
    </div>
</aside>
