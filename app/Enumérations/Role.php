<?php

namespace App\Enumérations;

enum Role : string
{
    case Editeur = 'editeur';
    case Responsable = 'responsable';
    case Default = 'abonne';
}