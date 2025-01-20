<x-auth-layout titre="Connexion" titreAuth="Connexion" :action="route('connexion')" submitMessage="Se connecter">

    <x-input_auth label="Adresse e-mail" name="email" placeholder="example@gmail.com" :value="old('email')"></x-input_auth>
    <x-input_auth label="Mot de passe" type='password' name="password" :value="old('password')"></x-input_auth>

    <div class="remember-me">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Rester connecté</label>
    </div>

</x-auth-layout>