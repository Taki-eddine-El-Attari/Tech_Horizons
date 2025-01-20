<x-auth-layout titre="Inscription" titreAuth="Inscription" :action="route('inscription')" submitMessage="S'inscrire">

    <x-input_auth label="Nom complet" name="name" :value="old('name')" placeholder="Nom et prénom"></x-input_auth>
    <x-input_auth label="Adresse e-mail" name="email" placeholder="example@gmail.com" :value="old('email')"></x-input_auth>
    <x-input_auth label="Mot de passe" type='password' name="password" :value="old('password')"></x-input_auth>
    <x-input_auth label="Confirmation du mot de passe" type='password' name="password_confirmation" :value="old('password')"></x-input_auth>

</x-auth-layout>