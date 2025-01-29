<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        $themesData = [
            'Intelligence artificielle' => [
                'description' => "L’intelligence artificielle (IA) est un domaine de l’informatique qui vise à développer des machines et des logiciels capables de simuler l’intelligence humaine. Elle repose sur des algorithmes avancés, des modèles d’apprentissage automatique (machine learning) et des réseaux de neurones artificiels qui permettent aux systèmes d’analyser des données, d’apprendre de leurs expériences et de prendre des décisions autonomes. Aujourd’hui, l’IA est présente dans de nombreux domaines, allant des assistants virtuels (comme Siri et Alexa) à la reconnaissance faciale, en passant par la médecine, la finance et l’automatisation industrielle.<br><br>

                                  L’IA se divise en plusieurs catégories, notamment l’IA faible, qui est spécialisée dans des tâches précises (comme la recommandation de films ou la traduction automatique), et l’IA forte, qui cherche à reproduire une intelligence comparable à celle des humains. Malgré ses avantages, tels que l’amélioration de la productivité et l’automatisation des processus, l’intelligence artificielle soulève également des défis éthiques, notamment en matière de protection des données, de biais algorithmiques et d’impact sur l’emploi. Cependant, avec l’évolution constante des technologies, l’IA continue de révolutionner de nombreux secteurs et façonne progressivement le futur de l’innovation.",
                'image' => '/images/themes/intelligence_artificielle.jpg'
            ],
            'Internet des objets' => [
                'description' => "L’Internet des Objets (IoT - Internet of Things) désigne un réseau d’objets physiques connectés à Internet, capables de collecter, d’échanger et de traiter des données en temps réel. Ces objets intelligents, équipés de capteurs et de technologies de communication, interagissent entre eux et avec les utilisateurs pour automatiser et optimiser divers aspects de la vie quotidienne et industrielle. On retrouve l’IoT dans de nombreux domaines tels que les maisons intelligentes (smart homes), la santé, les villes connectées (smart cities), l’agriculture et l’industrie 4.0. <br><br> 
                        
                                  Grâce à l’IoT, il est possible d’améliorer l’efficacité énergétique, la sécurité et le confort. Par exemple, les thermostats intelligents ajustent automatiquement la température selon les habitudes des occupants, tandis que les capteurs de surveillance industrielle détectent les anomalies pour prévenir les pannes. Cependant, cette technologie soulève des défis, notamment en matière de cybersécurité, de confidentialité des données et d’interopérabilité entre les différents appareils. Avec les avancées en intelligence artificielle et en 5G, l’Internet des Objets continue d’évoluer, ouvrant la voie à un monde toujours plus connecté et automatisé.",
                
                'image' => '/images/themes/internet_des_objets.jpg'
            ],
            'Cybersécurité' => [
                'description' => "La cybersécurité est un domaine essentiel qui concerne la protection des systèmes informatiques, des réseaux et des données contre les menaces et attaques numériques. Avec la montée en puissance des technologies et de la transformation numérique, la sécurisation des informations est devenue une priorité pour les entreprises, les gouvernements et les particuliers.<br><br>

                                  Ce domaine englobe plusieurs aspects, tels que la protection des infrastructures informatiques, la prévention contre les cyberattaques (malwares, ransomwares, phishing, etc.), la gestion des accès et des identités, ainsi que la sécurisation des communications et des transactions en ligne. Il s’appuie sur des technologies avancées comme le chiffrement, les pare-feu, l’intelligence artificielle et l’analyse comportementale pour détecter et contrer les menaces.<br><br>

                                  La cybersécurité joue un rôle fondamental dans la protection des données personnelles et professionnelles. Avec la réglementation croissante, comme le RGPD en Europe, les organisations doivent se conformer à des normes strictes pour garantir la confidentialité et l’intégrité des informations qu’elles traitent.<br><br>

                                  Face aux menaces en constante évolution, la cybersécurité repose également sur la sensibilisation et la formation des utilisateurs. La sécurité ne dépend pas uniquement des outils techniques, mais aussi des bonnes pratiques adoptées par les individus, telles que l’utilisation de mots de passe sécurisés, la vigilance face aux emails suspects et la mise à jour régulière des logiciels.

                                  En somme, la cybersécurité est un enjeu majeur du monde moderne, garantissant la confiance numérique et la protection des infrastructures critiques. Son évolution continue reflète l’importance croissante de la sécurité dans un monde toujours plus connecté et exposé aux risques cybernétiques.",
                
                'image' => '/images/themes/cybersecurity.jpg'
            ],
            'Réalité virtuelle' => [
                'description' => "La réalité virtuelle (VR) et la réalité augmentée (AR) sont deux technologies immersives qui transforment notre manière d’interagir avec le monde numérique et physique. La réalité virtuelle plonge l’utilisateur dans un environnement totalement simulé, accessible via un casque VR, lui permettant d’explorer et d’interagir avec un espace en 3D. Elle est largement utilisée dans les jeux vidéo, la formation professionnelle, la simulation, ainsi que dans des domaines comme la médecine et l’architecture.<br><br>

                                  De son côté, la réalité augmentée superpose des éléments numériques (images, textes, objets 3D) sur le monde réel à l’aide d’un smartphone, d’une tablette ou de lunettes AR. Elle enrichit l’expérience utilisateur en intégrant des informations interactives en temps réel, comme dans les applications de navigation, l’éducation ou encore le commerce en ligne. Bien que ces technologies offrent de nombreuses opportunités, elles présentent encore des défis tels que les coûts élevés, les besoins en puissance de calcul et les questions liées à la confidentialité des données. Cependant, avec les progrès technologiques, la VR et l’AR sont appelées à jouer un rôle majeur dans de nombreux secteurs à l’avenir. Plongez dans ces nouveaux mondes virtuels.",
                
                'image' => '/images/themes/realite_virtuelle.jpg'
            ],
            'Blockchain' => [
                'description' => "La blockchain est une technologie de stockage et de transmission d’informations fonctionnant sur un réseau décentralisé. Elle repose sur un registre distribué où chaque transaction est enregistrée sous forme de blocs liés entre eux de manière cryptographique, garantissant ainsi leur intégrité et leur immuabilité. Contrairement aux bases de données centralisées, la blockchain ne dépend d’aucune autorité unique, ce qui renforce sa transparence et sa sécurité. Cette technologie est largement utilisée dans les cryptomonnaies comme le Bitcoin et l’Ethereum, mais elle trouve également des applications dans des domaines tels que la logistique, la santé, la finance et la gestion des identités numériques.<br><br>

                                  En plus de sa robustesse en matière de sécurité, la blockchain permet d’exécuter des smart contracts, des programmes autonomes qui automatisent des transactions sans intermédiaire. Cela réduit les coûts et accélère les processus tout en minimisant les risques d’erreurs. Cependant, malgré ses avantages, la blockchain fait face à plusieurs défis, notamment en termes de scalabilité, de consommation énergétique et de réglementation. Les blockchains publiques peuvent être lentes et gourmandes en ressources, tandis que l’absence d’un cadre légal clair peut freiner leur adoption à grande échelle. Néanmoins, les recherches et les innovations en cours visent à améliorer ces aspects afin d’exploiter pleinement le potentiel de cette technologie révolutionnaire.",
                
                'image' => '/images/themes/blockchain.jpg'
            ]
        ];

        foreach ($themesData as $name => $data) {
            $slug = Str::slug($name);
            if (!Theme::where('slug', $slug)->exists()) {
                Theme::create([
                    'name' => $name,
                    'slug' => $slug,
                    'Description' => $data['description'],
                    'image' => $data['image']
                ]);
            }
        };
    }
}
