@props([ 'theme' , 'list' => false])

{{-- Début du post --}}
    <theme class="post">
        <div class="post-image-container">
            <img class="post-image" src="" style="background-color: {{ $theme->couleur }}">
        </div>
        <div class="post-content">
            <h1 class="theme-category">{{ $theme->name }}</h1>
            <p class="post-description">{{ $theme->Description }}</p>

            <time class="post-date">@datetime ($theme->created_at)  </time>
        </div>
    </theme>
{{-- Fin du post --}}