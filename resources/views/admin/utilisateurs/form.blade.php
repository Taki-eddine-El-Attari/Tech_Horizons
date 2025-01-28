<x-default-layout :titre="$user->exists ? 'Modifier l\'utilisateur' : 'Créer un utilisateur'">
    <form action="{{ $user->exists ? route('admin.utilisateurs.update' , ['Utilisateur' => $user]) : route('admin.utilisateurs.store') }}" method="POST" class="password-form" enctype="multipart/form-data">
        @csrf
        @if($user->exists)
        @method('PUT')
        @endif
        <div class="form-section">
            <h1 class="form-title">{{ $user->exists ? 'Modifier l\'utilisateur': 'Création d\'un utilisateur' }}</h1>
            <p class="form-description">{{ $user->exists ? 'Mettez à jour les informations de l\'utilisateur.' : 'Créez un nouvel utilisateur pour votre site.'}}</p>

            <div class="form-fields">
                <x-input label="Nom et prénom" name="name" minlength="5" :value="old('name', $user->name )"></x-input>
                <x-input label="Email" name="email" :value="old('email', $user->email)"></x-input>
                @if(!$user->exists)
                <x-input label="Mot de passe" type="password" name="password" :required="!$user->exists"></x-input>
                @endif
                <x-select 
                    label="Role" 
                    name="role" 
                    :value="old('role', $user->role?->value)"
                    :list="collect(\App\Enumérations\Role::cases())->map(fn($role) => (object)['id' => $role->value, 'name' => $role->label()])"
                ></x-select>
                <x-select 
                    label="Theme" 
                    name="theme_id" 
                    :value="old('theme_id', $user->theme_id)"
                    :list="$themes"
                ></x-select>


            </div>

            <div class="form-actions">
                <button type="submit" class="form-submit-button">{{ $user->exists ? 'Modifier' : 'Ajouter' }}</button>
            </div>
        </div>
    </form>
</x-default-layout>
