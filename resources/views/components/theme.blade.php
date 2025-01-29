@props([ 'theme' , 'list' => false])

{{-- Début du post --}}
    <theme class="post">
        <div class="post-image-container">
            <img class="post-image" src="{{ $theme->image }}" alt="{{ $theme->name }}">
        </div>
        <div class="post-content">
            <h1 class="theme-category-2">{{ $theme->name }}</h1>
            <p class="theme-description">{!! $theme->Description !!}</p>

            <time class="post-date">@datetime ($theme->created_at)  </time>
        </div>
    </theme>
{{-- Fin du post --}}