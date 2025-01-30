<x-default-layout titre=" Mon compte ">
    @if(Auth::user()->isAbonne())
    <form action="{{ route('theme.update') }}" method="POST" class="password-form">
        @csrf
        @method('PATCH')
        <div class="form-section">
            <h1 class="form-title">Gestion d'abonnements</h1>
            <p class="form-description">Gérez vos abonnements.</p>

            <div class="form-fields">
                <x-select name="theme_id" label="Thème" :list="$themes" :value="old('theme_id', auth()->user()->theme_id)" multiple help="Appuyez sur le bouton Ctrl pour la sélection multiple"></x-select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Modifier mes abonnées</button>
            </div>
        </div>
    </form>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="password-form">
        @csrf
        @method('PATCH')
        <div class="form-section">

            <h1 class="form-title">Informations personnelles</h1>
            <p class="form-description">Modifiez vos informations personnelles.</p>

            <div class="form-fields">

                <x-input label="Nom complet" name="name" :value="old('name', auth()->user()->name )"></x-input>
                <x-input label="Adresse e-mail" name="email" :value="old('email', auth()->user()->email )"></x-input>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Modifier mes informations</button>
            </div>

        </div>
    </form>

    <form action="{{ route('password.update') }}" method="POST" class="password-form">
        @csrf
        @method('PATCH')
        <div class="form-section">

            <h1 class="form-title">Mot de passe</h1>
            <p class="form-description">Vous pouvez modifier votre mot de passe pour vos futures connexions.</p>

            <div class="form-fields">

                <x-input label="Mot de passe actuel" type='password' name="current_password"></x-input>
                <x-input label="Nouveau mot de passe" type='password' name="password"></x-input>
                <x-input label="Confirmation du mot de passe" type='password' name="password_confirmation"></x-input>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Modifier mon mot de passe</button>
            </div>
        </div>
    </form>
</x-default-layout>
