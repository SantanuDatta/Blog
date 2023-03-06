<div class="br-logo"><a href=""><span>[</span>bracket <i>plus</i><span>]</span></a></div>
<div class="br-sideleft sideleft-scrollbar">
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="{{ route('admin.dashboard') }}" class="br-menu-link active">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">Dashboard</span>
            </a><!-- br-menu-link -->
            <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Post Management</label>
        </li><!-- br-menu-item -->
        <!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#"
                class="br-menu-link with-sub
                @if (Route::is('category.manage') || Route::is('category.create') || Route::is('category.edit')) active @endif
            ">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Categories</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('category.create') }}"
                        class="sub-link @if (Route::is('category.create')) active @endif">Add New Category</a></li>
                <li class="sub-item"><a href="{{ route('category.manage') }}"
                        class="sub-link @if (Route::is('category.manage')) active @endif">Manage All Categories</a></li>
            </ul>
        </li>
        <li class="br-menu-item">
            <a href="#"
                class="br-menu-link with-sub
                @if (Route::is('post.manage') || Route::is('post.create') || Route::is('post.edit')) active @endif
            ">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Posts</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('post.create') }}"
                        class="sub-link @if (Route::is('post.create')) active @endif">Add New Post</a></li>
                <li class="sub-item"><a href="{{ route('post.manage') }}"
                        class="sub-link @if (Route::is('post.manage')) active @endif">Mmanage All Posts</a></li>
            </ul>
        </li>
    </ul><!-- br-sideleft-menu -->
    @if (Auth::user()->role == 1)
        <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">All Editors & Readers</label>
        <li class="br-menu-item">
            <a href="#"
                class="br-menu-link with-sub
                    @if (Route::is('editor.manage') || Route::is('editor.create') || Route::is('editor.edit')) active @endif
                ">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Editors</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('editor.create') }}"
                        class="sub-link @if (Route::is('editor.create')) active @endif">Add New Editors</a></li>
                <li class="sub-item"><a href="{{ route('editor.manage') }}"
                        class="sub-link @if (Route::is('editor.manage')) active @endif">Manage All Editors</a></li>
            </ul>
        </li>
        <li class="br-menu-item">
            <a href="#"
                class="br-menu-link with-sub
                    @if (Route::is('reader.manage') || Route::is('reader.create') || Route::is('reader.edit')) active @endif
                ">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Readers</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('reader.create') }}"
                        class="sub-link @if (Route::is('reader.create')) active @endif">Add New Reader</a></li>
                <li class="sub-item"><a href="{{ route('reader.manage') }}"
                        class="sub-link @if (Route::is('reader.manage')) active @endif">Manage All Readers</a></li>
            </ul>
        </li>
        <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Moderate Comments</label>
        <li class="br-menu-item">
            <a href="{{ route('comment.manage') }}"
                class="br-menu-link
                    @if (Route::is('comment.manage') || Route::is('comment.show') || Route::is('comment.update')) active @endif
                ">
                <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
                <span class="menu-item-label">Comments Overview</span>
            </a><!-- br-menu-link -->
        </li>
        <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Subscribers</label>
        <li class="br-menu-item">
            <a href="{{ route('subscriber.manage') }}"
                class="br-menu-link
                    @if (Route::is('subscriber.manage')) active @endif
                ">
                <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
                <span class="menu-item-label">Subsribers Overview</span>
            </a><!-- br-menu-link -->
        </li>

        <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Settings</label>
        <li class="br-menu-item">
            <a href="{{ route('setting.manage') }}"
                class="br-menu-link
                    @if (Route::is('setting.manage')) active @endif
                ">
                <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
                <span class="menu-item-label">Change Settings</span>
            </a><!-- br-menu-link -->
        </li>
    @endif

    <br>
</div><!-- br-sideleft -->
