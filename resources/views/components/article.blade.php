@props([ 'article' , 'list' => false])

{{-- Début du post --}}
    <article class="post">
        <div class="post-image-container">
            <img class="post-image" src="{{ str_starts_with($article->image , 'http') ? $article->image : asset('storage/' . $article->image )}}" style="background-color: {{ $article->couleur }}">
        </div>
        <div class="post-content">
            @if ($article->theme)
            <a href="{{ route('articles.bytheme', ['theme' =>$article->theme->slug]) }}" class="post-category">
              {{ $article->theme->name }}
            </a>
            @endif
            @if($article->numero)
            <a href="{{ route('articles.bynumero', ['numero' => $article->numero->numero]) }}" class="post-number">
            Numéro: {{ $article->numero->numero }}
            </a>
            @endif
            <h1 class="post-title">{{ $article->titre }}</h1>
            @if($article->statut)
                <a href="{{ route('articles.bystatut', ['statut' =>$article->statut]) }}" class="post-statut" style="background-color: 
                    @if($article->statut->name === 'En cours') #4f46e5
                    @elseif($article->statut->name === 'Publié') #4CAF50
                    @elseif($article->statut->name === 'Refus') #FF0000
                    @endif
                ">{{ $article->statut->name }}</a>
            @endif
            <p class="post-description">
             @if ($list)
              {{ $article->extrait }}
             @else
              {!! nl2br(e($article->contenu)) !!}
             @endif
            </p>

             @if ($list)
             
            <p class="post-notes">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                {{ $article->calculateAverageRating() }}
            </p>

            <a href="{{ route('articles.show', ['article' => $article]) }}" class="post-read-more">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="post-read-more-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
                Lire l'article
            </a>
             @else
                <time class="post-date">@datetime ($article->created_at)  </time>
                
            <p class="post-notes">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                {{ $article->calculateAverageRating() }}
            </p>             
             @endif

        </div>
    </article>
{{-- Fin du post --}}