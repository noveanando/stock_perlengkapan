<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content custom-scroll">
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="javascript:void(0)" class="media-left">
                        <img src="{{ asset(Auth::user()->media ? getCropImage(Auth::user()->media->path, 'mini') : 'img/placeholder.jpg') }}"
                            class="img-circle img-sm" alt="">
                    </a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">
                            {{ Auth::user()->name }}
                            {{ Auth::user()->address }}
                        </span>
                        <div class="text-size-mini text-muted" id="header-company">
                            <i class="icon-office text-size-small"></i> &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    @foreach ($menus as $menu)
                        @if ($menu['route'] == 'newsection')
                            <li class="navigation-header">
                                <span>Main</span>
                                <i class="icon-menu" title="Main pages"></i>
                            </li>
                        @else
                            @if (empty($menu['submenu']))
                                <li class="{{ activeMenu($menu,request()->route()->getName()) }}"
                                    data-route="{{ $menu['route'] }}">
                                    <a href="{{ route($menu['route']) }}" class="me">
                                        <i class="{{ $menu['icon'] ? $menu['icon'] : 'icon-home4' }}"></i>
                                        <span id="menu-{{ $menu['route'] }}">{{ $menu['label'] }}</span>
                                    </a>
                                </li>
                            @else
                                <li class="parent-tag-menu">
                                    <a href="javascript:void(0)"><i
                                            class="{{ $menu['icon'] ? $menu['icon'] : 'icon-stack2' }}"></i>
                                        <span>{{ $menu['label'] }}</span></a>
                                    <ul>
                                        @foreach ($menu['submenu'] as $submenu)
                                            <li class="{{ activeMenu($submenu,request()->route()->getName()) }}"
                                                data-route="{{ $submenu['route'] }}">
                                                <a href="{{ empty($submenu['param']) ? route($submenu['route']) : route($submenu['route'], $submenu['param']) }}"
                                                    class="me">
                                                    {{ $submenu['label'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
