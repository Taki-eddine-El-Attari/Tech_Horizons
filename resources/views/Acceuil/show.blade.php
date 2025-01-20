<x-default-layout :titre=" $article->titre ">
    <header>
        @vite(['resources/css/show.css', 'resources/js/show.js'])
    </header>

    <div class="posts">
      <x-article :$article />
      @auth
      <form action="{{ route('articles.commentaire', $article) }}" method="POST">
        @csrf
        <div class="comment-container">
          <input 
            class="comment-input" 
            type="text" 
            name="commentaire"
            placeholder="Dites-nous ce que vous en pensez ! 💬" 
            autocomplete="off">
          <button class="comment-button">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="comment-icon">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
              </svg>
          </button>
        </div>
        @error('commentaire')
          <p class="error-message">{{ $message }}</p>
          
        @enderror
      </form>
      @endauth
      <div>
       @foreach ($article->commentaire as $comment)
          <div class="comment-contain">
              <img 
                  class="comment-avatar" 
                  src="{{ Gravatar::get($comment->user->email) }}" 
                  alt="Image de profil de {{ $comment->user->name }}">
                  <div class="comment-content">
                    <div class="comment-header">
                       <h2 class="comment-author">{{ $comment->user->name }}</h2>
                         <time class="comment-time" datetime="{{ $comment->created_at }}">
                           @datetime($comment->created_at)
                         </time>
                    </div>
                      <p class="comment-text">{{ $comment->contenu}}</p>
                  </div>
          </div>
       @endforeach
      </div>
    </div>
</x-default-layout>
