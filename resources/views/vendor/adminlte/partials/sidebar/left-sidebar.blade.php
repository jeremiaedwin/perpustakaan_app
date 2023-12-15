<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                <li class="nav-item">
                @can('get all peminjaman', Peminjaman::class)
                    <a href="/peminjaman" class="nav-link"><i class="fa fa-sticky-note"></i>  Peminjaman</a>
                @endcan
                
                
                </li>
                <li class="nav-item">
                @can('get buku', DataBuku::class)
                    <a href="/anggota" class="nav-link"><i class="fa fa-user"></i>  Anggota</a>
                @endcan
                </li>
                <li class="nav-item">
                @can('get anggota', Anggota::class)
                    <a href="/data_buku" class="nav-link"><i class="fa fa-book"></i>  Buku</a>
                @endcan
                </li>
            </ul>
        </nav>
    </div>

</aside>
