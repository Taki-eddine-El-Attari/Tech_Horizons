<?php

return [
    'required' => 'Le champ :attribute est obligatoire.',
    'email' => 'Le champ :attribute doit être une adresse email valide.',
    'unique' => 'La valeur du champ :attribute est déjà utilisée.',
    'min' => [
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
        'numeric' => 'La valeur de :attribute doit être supérieure ou égale à :min.',
        'array' => 'Le tableau :attribute doit contenir au moins :min éléments.',
    ],
    'max' => [
        'string' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
        'numeric' => 'La valeur de :attribute ne doit pas être supérieure à :max.',
        'array' => 'Le tableau :attribute ne peut pas contenir plus de :max éléments.',
        'file' => 'La taille du fichier :attribute ne doit pas dépasser :max kilo-octets.',
    ],
    'between' => [
        'numeric' => 'La valeur de :attribute doit être comprise entre :min et :max.',
        'string' => 'Le texte de :attribute doit contenir entre :min et :max caractères.',
        'array' => 'Le tableau :attribute doit contenir entre :min et :max éléments.',
    ],
    'string' => 'Le champ :attribute doit être une chaîne de caractères.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'integer' => 'Le champ :attribute doit être un entier.',
    'date' => 'Le champ :attribute n\'est pas une date valide.',
    'url' => 'Le format de l\'URL :attribute n\'est pas valide.',
    'alpha' => 'Le champ :attribute doit contenir uniquement des lettres.',
    'alpha_num' => 'Le champ :attribute doit contenir uniquement des chiffres et des lettres.',
    'array' => 'Le champ :attribute doit être un tableau.',
    'confirmed' => 'La confirmation du :attribute ne correspond pas.',
    'file' => 'Le champ :attribute doit être un fichier.',
    'image' => 'Le champ :attribute doit être une image.',
    'mimes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'dimensions' => 'Les dimensions de l\'image :attribute ne sont pas conformes.',
    'uploaded' => 'Le fichier :attribute n\'a pas pu être téléchargé.',
    'mimetypes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'size' => [
        'file' => 'La taille du fichier :attribute doit être de :size kilo-octets.',
    ],
    
    
    'attributes' => [
        'name' => 'nom complet',
        'email' => 'adresse e-mail',
        'password' => 'mot de passe',
        'first_name' => 'prénom',
        'last_name' => 'nom',
        'phone' => 'téléphone',
        'address' => 'adresse',
        'city' => 'ville',
        'country' => 'pays',
        'title' => 'titre',
        'description' => 'description',
        'content' => 'contenu',
        'price' => 'prix',
        'role' => 'rôle',
        'message' => 'message',
        'comment' => 'commentaire',
        'current_password' => 'mot de passe actuel',
        'image' => 'image',
        'cover_image' => 'image de couverture',
        'avatar' => 'photo de profil',
        'document' => 'document',
        'file' => 'fichier',
        'photo' => 'photo',
        'attachment' => 'pièce jointe',
        'browser' => 'navigateur',
    ],

    'custom' => [
        'image' => [
            'required' => 'Veuillez sélectionner une image',
            'image' => 'Le fichier doit être une image',
            'max' => 'L\'image ne doit pas dépasser :max kilo-octets',
        ],
    ],
    
];
