<x-default-layout>

   <div class="posts">
        @forelse ($themes as $theme)
       <x-theme :$theme list />
        @empty
            <p class="aucun-resultat">Aucun résultat.</p>
        @endforelse
    </div>

</x-default-layout>