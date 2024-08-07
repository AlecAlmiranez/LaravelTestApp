<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dashboard') ? 'text-white bg-primary rounded text-decoration-underline' : '' }}" href="{{ route('dashboard') }}">
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('feed') ? 'text-white bg-primary rounded text-decoration-underline' : '' }}" href="{{ route('feed') }}">
                    <span>Feed</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('terms') ? 'text-white bg-primary rounded text-decoration-underline' : '' }}" href="{{ route('terms') }}">
                    <span>Terms</span></a>
            </li>
        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="{{ route('lang','en') }}">EN</a>
        <a class="btn btn-link btn-sm" href="{{ route('lang','es') }}">ES</a>
    </div>
</div>
