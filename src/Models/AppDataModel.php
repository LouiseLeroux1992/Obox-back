<?php

namespace App\Models;

class AppDataModel
{
    /**
     * Returns the array of reserveTasks
     *
     * @return array
     */
    public static function getReserveTasksData(): array
    {
        return self::$reserveTasksData;
    }

    /**
     * Returns the array of tags
     *
     * @return array
     */
    public static function getTagsData(): array
    {
        return self::$tagsData;
    }

    /**
     * Returns the array of articles
     *
     * @return array
     */
    public static function getArticlesData(): array
    {
        return self::$articlesData;
    }

    /**
     * Returns the array of themes
     *
     * @return array
     */
    public static function getThemesData(): array
    {
        return self::$themesData;
    }

    /**
     * Returns the array of users
     *
     * @return array
     */
    public static function getUsersData(): array
    {
        return self::$usersData;
    }


    private static $reserveTasksData = [
        [
            'name' => "Résilier/Ouvrir les contrats d'eau, électricité, gaz, assurance habitation, et internet.",
            'tagRank' => 0
        ],
        [
            'name' => "Effectuer le changement d'adresse auprès des banques, assurances, la  Caisse d'Assurance Maladie, la Caisse de Retraite, la mutuelle, l'employeur et les impôts.",
            'tagRank' => 0
        ],
        [
            'name' => "Effectuer la demande de suivi de courrier auprès de la Poste.",
            'tagRank' => 0
        ],
        [
            'name' => "Envoyer au propriétaire le préavis de départ du logement (minimum 3 mois avant la date de rupture du bail souhaitée si le logement est non meublé).",
            'tagRank' => 1
        ],
        [
            'name' => "Inscrire les enfants à l'école.",
            'tagRank' => 2
        ],
        [
            'name' => "Prévoir la garde des enfants pour le jour du déménagement",
            'tagRank' => 2
        ],
        [
            'name' => "Informer le bureau du service national (afin que les enfants soient appelés pour la Journée de la Défense et Citoyenneté).",
            'tagRank' => 2
        ],
        [
            'name' => "Informer pôle emploi au maximum dans les 3 jours suivant le déménagement.",
            'tagRank' => 3
        ],
        [
            'name' => "Informer la Caisse d'Assurance Maladie et la mutuelle.",
            'tagRank' => 4
        ],
        [
            'name' => "Informer la CAF, la Caisse de Retraite et autres administrations du service public pour transfert des dossiers.",
            'tagRank' => 4
        ],
        [
            'name' => "Choisir un nouveau médecin traitant.",
            'tagRank' => 4
        ],
        [
            'name' => "Informer la Sécurité Sociale du départ afin de désactiver la Carte Vitale.",
            'tagRank' => 5
        ],
        [
            'name' => "Résilier les abonnements internet et téléphone mobile.",
            'tagRank' => 5
        ],
        [
            'name' => "Vérifier la durée de validité des pièces d'identité et passeports",
            'tagRank' => 5
        ],
        [
            'name' => "Consulter les démarches à réaliser pour entrer dans le pays de destination.",
            'tagRank' => 5
        ],
        [
            'name' => "Effectuer une demande de permis de conduire international.",
            'tagRank' => 5
        ],
        [
            'name' => "Vérifier les vaccins obligatoires dans le pays de destination.",
            'tagRank' => 5
        ],
        [
            'name' => "Ouvrir un compte bancaire dans le pays de destination.",
            'tagRank' => 5
        ],
        [
            'name' => "S'inscrire au registre des Français établis hors de France.",
            'tagRank' => 5
        ],
        [
            'name' => "S'inscrire sur la liste électorale du consulat de France à l'étranger.",
            'tagRank' => 5
        ],
        [
            'name' => "Calculer le volume des biens à déménager.",
            'tagRank' => 6
        ],
        [
            'name' => "Effecuter une demande de devis pour le transport des biens.",
            'tagRank' => 6
        ],
        [
            'name' => "Changer l'adresse de la carte grise auprès de la préfecture.",
            'tagRank' => 7
        ],
        [
            'name' => "Informer l'assureur du véhicule du changement d'adresse.",
            'tagRank' => 7
        ],
        [
            'name' => "Réserver un véhicule de location adapté au volume du déménagement.",
            'tagRank' => 8
        ],
        [
            'name' => "Récupérer le certificat de scolarité auprès de l'ancien établissement des enfants",
            'tagRank' => 2
        ]
    ];

    private static $tagsData = [
        [
            'name' => "Tâches générales"
        ],
        [
            'name' => "Je quitte une location"
        ],
        [
            'name' => "Je déménage avec mes enfants"
        ],
        [
            'name' => "Je suis demandeur d'emploi"
        ],
        [
            'name' => "Je déménage dans une autre région"
        ],
        [
            'name' => "Je déménage à l'étranger"
        ],
        [
            'name' => "Je déménage des meubles par conteneur bateau"
        ],
        [
            'name' => "J'ai une voiture"
        ],
        [
            'name' => "Je loue un véhicule pour déménager"
        ]

    ];

    private static $articlesData = [
        [
            'title' => "Comment s’organiser pour faire ses cartons ?",

            'slug' => "comment-s-organiser-pour-faire-ses-cartons",

            'summary' => "La date approche, mais vous ne savez pas par où commencer pour remplir vos cartons ? Voici quelques recommandations qui vous simplifieront grandement la tâche.",

            'content' => "
            Utilisez des cartons de taille moyenne, et des petits cartons pour les objets lourds tels que les livres. Ils seront plus faciles à ranger, à déplacer, et vous éviterez de vous blesser en les portant.
            Notez précisément son contenu sur chaque carton, et en particulier la pièce dans laquelle il doit être rangé. Cela vous fera gagner beaucoup de temps lors de votre installation.
            Pour votre vaisselle, inutile d’utiliser du papier bulle : deux ou trois feuilles de papier journal entre chaque assiette, bol et verre suffira à la protéger. Cependant, ne rangez jamais vos ustensiles les uns contre les autres sans amortir les chocs. 
            Tentez de ranger vos objets par catégories, en suivant une certaine logique : par exemple, regroupez tous vos câbles, rallonges et multiprises dans un même carton. 
            Utilisez de plus petites boîtes pour séparer vos affaires à l’intérieur d’un carton, comme des boîtes à chaussures. Cela vous permettra de trier les petits objets plus facilement.  
            Vous ne savez pas où trouver des cartons ? N’hésitez pas à demander aux commerçants près de chez vous s’ils peuvent vous mettre de côté quelques cartons. La plupart des commerces qui reçoivent des livraisons quotidiennement jettent de nombreux cartons qui n’ont servi qu’une fois. Certaines entreprises vendent leurs cartons par lots. 
            Quel est le bon moment pour ranger les affaires dans les cartons ? Commencez suffisamment en avance pour avoir le temps de faire du tri. Un déménagement, c’est l’occasion de se séparer de certaines affaires dont nous n’avons plus l’utilité. Vous pouvez ainsi débuter par les objets que vous utilisez rarement : le matériel de bricolage, les livres, les vêtements hors saison, les objets de décoration. Les dernières choses que vous rangerez dans les cartons seront la vaisselle et les vêtements que vous portez le plus souvent. 
            Quand défaire les cartons ? Lors de votre emménagement, si votre nouvelle habitation vous le permet, ne tardez pas à ranger toutes vos affaires à leur place. Ainsi, vous prendrez rapidement vos marques dans votre nouveau logement, et vous éviterez de laisser certaines affaires dans des cartons pendant des mois, voire… Des années ! Plus on tarde à défaire les cartons, plus ils ont tendance à se faire oublier, parfois même jusqu’au prochain déménagement.
            ",

            'image' => "https://img.freepik.com/free-vector/family-moving-new-house-happy-cartoon-man-woman-boy-girl-carrying-boxes-apartment-vector-illustration-new-home-delivery-service-concept_74855-10050.jpg",
            'image_description' => "Une famille porte des cartons",
            'themeRanks' => [
                2
            ]
        ],
        [
            'title' => "Les aides dont vous pouvez bénéficier",

            'slug' => "les-aides-dont-vous-pouvez-beneficier",

            'summary' => "Vous ne le savez peut-être pas, mais plusieurs aides financières sont proposées par les organismes gouvernementaux lors d’un déménagement. Vérifiez si vous pouvez en bénéficier !",

            'content' => "Selon votre situation financière ou familiale, vous avez peut-être la possibilité de bénéficier d’un des dispositifs d’aide à la mobilité proposés par la CAF, l’organisme Action Logement ou la MDPH. 

            En effet, il existe de nombreuses aides proposées par les services public, en voici quelques-unes : 
        
            L’aide au déménagement pour les familles nombreuses est délivrée par la CAF aux foyers de plus de 3 enfants et éligibles aux APL (aide personnalisée au logement) ou ALF (allocation de logement familiale). Elle est égale aux frais réels du déménagement, plafonnée à 1054€ dans le cas de trois enfants à charge, et on ajoute à ce plafond 87,83€ par enfant à charge supplémentaire.. Pour obtenir cette aide, vous pouvez effectuer une demande de prime de déménagement auprès de la Caisse d’Allocations familiale de votre région. Pour plus de renseignements concernant cette aide : https://www.caf.fr/allocataires/aides-et-demarches/droits-et-prestations/logement/la-prime-de-demenagement
        
            L’aide Mobili-pass d’Action Logement est disponible pour les salariés en entreprise du secteur privé (hors secteur agricole) qui sont en situation  d’embauche, de mutation, de formation ou de sauvegarde d’emploi. Le nouveau logement doit se situer à moins de 70km de l’ancien. Son montant dépend de la zone géographique de la nouvelle résidence (au maximum 3500€, sous forme de subventions et prêt à taux réduit). Pour obtenir cette aide, vous pouvez effectuer une demande d’aide Mobili-pass auprès de l’organisme Action-Logement. Pour plus d’informations : https://www.actionlogement.fr/financement-mobilite

            L’aide Mobili-jeune d’Action-Logement est accordée aux personnes de  moins  de 30 ans en formation professionnelle dans le secteur privé (contrat d’apprentissage, d’alternance ou de professionnalisation), qui perçoivent des revenus inférieurs au SMIC. L’occupation du logement doit être liée à la période de formation. Son montant est de 10 à 100€ par mois, pour une durée maximum de 3 ans. Pour obtenir cette aide, vous pouvez faire une demande d’aide Mobili-jeune auprès de l’organisme Action-Logement. Pour plus de renseignements : https://mobilijeune.actionlogement.fr
        
            L’aide à la mobilité Parcoursup pour bacheliers s’adresse aux lycéens boursiers qui changent d’académie afin de poursuivre leurs études. Il faut avoir accepté définitivement une proposition d’admission sur Parcoursup dans une formation située hors de son académie de résidence. Elle s’élève à 500€ versés en début d’année universitaire. Elle peut être associée à d’autres bourses ou allocations. Pour plus de renseignements : https://amp.etudiant.gouv.fr/
        
            L’aide à la mobilité pour les études en Master s’adresse aux étudiants boursiers ayant obtenu une Licence et souhaitant poursuivre leurs études en Master hors de leur région académique d’origine. Son montant est de 1000€ versés en début d’année universitaire. Pour obtenir cette aide, vous pouvez effectuer une demande en ligne auprès du Crous. Pour plus de renseignements : https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000034675851/
        
            La prestation de compensation du handicap est délivrée par la Maison Départementale des Personnes Handicapées afin de prendre en charge totalement ou partiellement les dépenses liées à la perte d’autonomie des personnes en situation de handicap. Pour bénéficier de cette aide, vous pouvez effectuer une demande auprès de la  MDPH de votre département. Pour plus de renseignements : https://mdphenligne.cnsa.fr/",
            
            'image' => "https://img.freepik.com/free-vector/saving-money-financial-concept_74855-7849.jpg",
            'image_description' => "Deux personnes escaladent une tirelire en forme de cochon",
            'themeRanks' => [
                0,
                1
            ]
        ],
        [
            'title' => "La caution Visale",
            'slug' => "la-caution-visale",
            'summary' => "Vous souhaitez louer un logement, mais vous n’avez pas de garant ? Vérifiez si vous  êtes éligible pour bénéficier du garant Visale.",
            'content' => "Visale, c’est un dispositif d’Action Logement (service public) qui permet de bénéficier d’un garant fiable : dans certaines conditions, c’est l'État qui se porte garant pour vous. Ce dispositif est gratuit. 

            Pour en bénéficier, il faut remplir certaines conditions : avoir entre 18 et 30 ans, ou avoir plus  de 30 ans et être embauché depuis moins de 6 mois, ou gagner jusqu’à 1500€ nets par mois, ou avoir signé une promesse d’embauche depuis moins de 3 mois, ou encore être en situation de mobilité professionnelle. Toutes les conditions d’éligibilité sont décrites sur le site du dispositif Visale https://www.visale.fr/visale-pour-les-locataires/eligibilite/
            
            Ce dispositif est un atout à la fois pour les locataires, qui peuvent ainsi signer un bail plus facilement, et pour les propriétaires, qui bénéficient d’une garantie sécurisée.
            ",
            'image' => "https://img.freepik.com/free-vector/man-signing-contract-with-big-pen_74855-10909.jpg",
            'image_description' =>"Une personne tient un stylo géant pour signer un contrat",
            'themeRanks' => [
                0,
                1
            ]
        ],
        [
            'title' => "La réexpédition de courrier",

            'slug' => "la-réexpédition-de-courrier",

            'summary' => "Comment faire réexpédier son courrier lors d’un déménagement ?",

            'content' => "Pour faire réexpédier son courrier, c’est très simple : il vous suffit de vous rendre en bureau de poste, au plus tard 15 jours avant la date de votre déménagement, et de remplir une demande de réexpédition de courrier. Vous pouvez également effectuer cette démarche sur le site internet de La Poste. Deux délais de réexpédition vous seront proposés : 6 mois pour 6,45€ par mois (38,70€ au total), ou 12 mois pour 5.38€ par mois (64.50€ au total). La poste propose également des offres spécifiques, telles que le “pack déménagement” avec des tarifs avantageux.",

            'image' => "https://img.freepik.com/vecteurs-libre/femme-reception-courrier-lecture-lettre_74855-5964.jpg?w=1060&t=st=1671725741~exp=1671726341~hmac=95e8af721a1d7606b1914aa9907c3bd71f2033fc0689f7367311653ec6ac9f44",

            'image_description' =>"personnes recevant du courrier",
            'themeRanks' => [
                0
            ]
        ],
        [
            'title' => "Préparer son enfant à déménager",

            'slug' => "préparer-son-enfant-à-déménager",

            'summary' => "Un déménagement peut être source d’angoisse pour votre enfant. Voici quelques pistes pour lui permettre de vivre agréablement ce moment.",

            'content' => "Pour votre enfant, un déménagement peut constituer un grand chamboulement. Il va changer de logement, d’environnement, d’école, et va perdre ses repères. Il est donc important de prendre le temps de lui expliquer comment les changements vont se dérouler, même s’il est encore jeune. Permettez-lui également d’exprimer ses craintes et son ressenti en général. Est-il excité à l’idée de rencontrer de nouveaux amis ? A-t-il peur de ne connaître personne dans sa nouvelle école ? Est-il triste de quitter un lieu qui lui est familier ? En lui laissant la possibilité d’exprimer lui-même ces émotions, vous pourrez ouvrir le dialogue et l’accompagner au mieux. Si vous en avez la possibilité, emmenez-le à l’avance dans votre nouveau quartier, promenez-vous devant sa nouvelle école : cela lui permettra de se projeter et ouvrira la conversation sur son ressenti.",

            'image' => "https://img.freepik.com/vecteurs-libre/famille-velo-dans-parc-ville_74855-5243.jpg?w=1380&t=st=1671729006~exp=1671729606~hmac=5ebf8d202054de2acff01034ea2bb4fab881b4f11fd74093922061dd57cb8741",

            'image_description' =>"famille à vélo",
            'themeRanks' => [
                3
            ]
        ],
        [
            'title' => "Comment choisir sa société de déménagement ?",

            'slug' => "comment-choisir-sa-société-de-demenagement",

            'summary' => "Retrouvez dans notre article une multitude de conseils et d’astuces qui vous permettront de dénicher la meilleure société de déménagement !
            ",

            'content' => "C’est bien connu, déménager est l’une des sources de stress les plus importantes pour les français. Changer de domicile arrive ainsi en troisième position des situations les plus stressantes, derrière la perte d’un proche et le licenciement.
            Vous vous apprêtez à déménager ? Pas de panique, tout se passera bien si vous vous montrez organisé, et que vous préparez votre déménagement soigneusement et à l’avance. Pour cela, faire appel à une société de déménagement peut être d’une aide précieuse. Emballage de vos effets personnels, protection de vos meubles les plus fragiles, transport en toute sécurité à l’autre bout du pays, déchargement sans casse (et sans lumbago) … Les services pris en charge par une entreprise de déménagement peuvent grandement vous soulager.
            Seulement, lorsque l’on sait qu’il existe dans l’Hexagone plus de 2 000 entreprises de déménagement, comment s’assurer de trouver un déménageur sérieux et de ne pas tomber sur une arnaque en ligne ?  En effet, opter pour un déménageur incompétent peut au contraire aggraver votre état de stress. Retrouvez dans notre article une multitude de conseils et d’astuces qui vous permettront de dénicher la meilleure société de déménagement !
             1. Contacter plusieurs entreprises de déménagement

            En premier lieu, il est essentiel de commencer par demander plusieurs devis déménagement à différentes sociétés de déménagement. Cela vous permettra de comparer les rapports qualité – prix proposés par les déménageurs. Dans un deuxième temps, cela vous permettra aussi de faire le point plus facilement sur les services qui vous sont indispensables, et ceux dont vous n’avez peut-être pas besoin.
            Attention également à bien anticiper votre date de déménagement : plus vous vous y prendrez à l’avance, et plus vous aurez de choix parmi les différentes sociétés de déménagement. Un minimum de deux mois avant votre date de déménagement est généralement recommandé. C’est particulièrement vrai si vous avez prévu de déménager au printemps ou en été, des périodes traditionnellement très chargées dans le secteur.
            2. Vérifier l’inscription au registre du commerce et l’assurance de la société
            Le secteur du déménagement est régi par différentes lois et réglementations. En premier lieu, toute société de déménagement se doit d’être déclarée au registre du commerce et des sociétés (RCS). Vous pouvez vérifier par vous-même que cette inscription a bien été effectuée en recherchant le numéro de SIRET de l’entreprise sur des sites dédiés.
            Il est également obligatoire d’être inscrit au Registre des Transports, et de disposer d’une licence de transport pour chacun des camions de déménagement utilisés par l’entreprise de déménagement.
            Enfin, il peut être utile de vérifier que la société de déménagement possède bien une assurance couvrant à hauteur suffisante la valeur de vos biens, mais également les différents risques encourus lors du chargement, transport et déchargement. N’hésitez pas à demander au déménageur un justificatif de son assurance, et vérifiez bien sa date de validité.
            3. Choisir un déménageur certifié et / ou syndiqué
            Au-delà des obligations légales, il existe la certification NF Service dédiée au “déménagement de particuliers”, délivrée par l’Afnor, qui n’est autre que la branche française de l’ISO. Lorsqu’une société de déménagement est certifiée NF Service, cela signifie qu’elle s’engage à respecter un cahier des charges strict, encadrant chaque étape de sa prestation : préparation du déménagement, engagements contractuels, réalisation du déménagement et service après-vente.
            Vous pouvez aussi choisir de faire appel uniquement à une entreprise de déménagement affilié à l’un des syndicats du secteur : vous aurez ainsi la garantie que le déménageur respecte une charte de qualité, et est digne de confiance. Il existe deux principaux syndicats : la Fédération Française des Déménageurs (FFD) et la Chambre Syndicale du Déménagement (CSD).
             
            4. Lire les témoignages de clients
            Autre point essentiel pour choisir son déménageur : la lecture des avis et témoignages de clients ayant fait appel à ses services dans le passé. L’idéal serait d’obtenir des recommandations d’amis ou de proches : vous pourrez ainsi être certain que leurs avis sont fiables. Le bouche à oreille est également un excellent indicateur de la qualité d’une prestation.
            Néanmoins, si aucun de vos proches ne connaît les sociétés de déménagement que vous contactez, il y a de fortes chances que vous puissiez trouver quelques avis clients sur Internet. Avis Google, Yelp, ou encore sites d’avis clients certifiés tels que Trustpilot ou Ekomi… Prenez garde à bien conserver votre libre-arbitre. Méfiez-vous par exemple d’avis clients trop élogieux, qui pourraient avoir été écrits par le déménageur lui-même, ou au contraire, d’avis extrêmement négatifs, pouvant provenir d’un concurrent.
            5. Prendre le temps de rencontrer l’entreprise de déménagement
            Une fois votre sélection de meilleures sociétés de déménagement effectuée, il est essentiel de prendre le temps de rencontrer chaque déménageur. L’idéal est de les faire venir chez vous : cela leur permettra en effet de repérer d’éventuelles difficultés d’accès à prendre en compte le jour J : une rue étroite, une cage d’escalier manquant d’accessibilité, ou encore un petit ascenseur.
            C’est également l’occasion pour l’entreprise de déménagement de se faire une idée juste des biens à déménager. En effet, en tant que particulier, vous aurez tendance à en omettre certains, ou à oublier de préciser ceux qui nécessitent un démontage par exemple.
            Enfin, une rencontre en personne reste encore la meilleure manière de vous faire une opinion sur le sérieux et le professionnalisme de l’entreprise de déménagement. Vous pourrez ainsi évaluer sa ponctualité, et ses compétences en fonction des réponses que votre interlocuteur vous fournira.
            6. Étudier attentivement le devis
            Une fois le devis final reçu, prenez-bien le temps de l’étudier attentivement. Il vous faudra le passer au crible, en vérifiant ces différents points : description approfondie des services, date, volume du mobilier, valeur du mobilier, adresses précises des lieux de départ et d’arrivée, prix et modalités de paiement, taux de garantie, conditions générales de vente, ou encore références de l’entreprise.
            Méfiez-vous des sociétés de déménagement étrangement peu chères. Pour pouvoir pratiquer des tarifs aussi faibles, il y a fort à parier que l’entreprise de déménagement ne déclare pas l’ensemble de ses employés, ou ne soit pas correctement assurée. Pensez bien à lire également les petits caractères en bas de page ou au verso du devis ! C’est souvent là que l’on retrouve certains détails qu’il faut absolument repérer pour éviter une offre un peu louche voir une arnaque.
            7. Être présent le jour du déménagement
            Vous y êtes, le jour-J tant attendu est enfin là ! Il vous faudra rester présent sur place : tout d’abord pour vérifier que tout se déroule bien comme prévu, mais aussi pour signer et remettre à l’entreprise de déménagement certains documents officiels.
            Au début du déménagement, vous devrez ainsi signer et remettre au chef d’équipe une lettre de voiture, qui a pour but de prouver que vous l’autorisez à transporter vos biens. Une fois le déménagement terminé, il vous faudra signer la déclaration de fin de travail. Attention à bien prendre le temps de vérifier la bonne exécution du devis et l’état de vos biens. En effet, s’il y a le moindre souci (objets manquants, casse…), cela devra y être indiqué de manière claire et détaillée.
            En cas de problème, vous disposez ensuite d’un délai de 10 jours calendaires pour confirmer par lettre recommandée les réserves évoquées sur la déclaration de fin de travail. L’affaire peut alors être portée devant les tribunaux durant un an.
            ",

            'image' => "https://img.freepik.com/free-vector/loaders-carrying-armchair-boxes-new-house_74855-14095.jpg?w=996&t=st=1671791942~exp=1671792542~hmac=05d65bd12b938cbf1bcb8a341b10334117d3df758b20b7fecf4d78e623f5178e",

            'image_description' =>"Professionnels s’occupant du déménagement",
            'themeRanks' => [
                2
            ]
        ],
        [
            'title' => "Déménager avec son animal de compagnie",

            'slug' => "préparer-son-enfant-à-déménager",

            'summary' => "Vous vous apprêtez à déménager et heureusement, vous amenez votre animal de compagnie avec vous.
            Voici plusieurs conseils afin de permettre un déménagement tout en douceur à votre animal et bien sûr, pour éviter de le traumatiser.",

            'content' => "1. Faites faire une nouvelle médaille
            Assurez-vous que votre animal porte un collier qui soit solide avec vos coordonnées, mis à jour. Un numéro de téléphone cellulaire devrait aussi apparaître sur le médaillon du collier afin que les gens puissent vous appeler immédiatement si l’animal se perdait durant le déménagement.
            2. Obtenez le dossier du vétérinaire
            Si vous déménagez assez loin pour ne plus pouvoir continuer de fréquenter le même vétérinaire, assurez-vous d’obtenir de celui-ci le dossier complet de votre animal avec ses dates de vaccinations. Dépendant de votre destination, il serait bien de vérifier si votre animal nécessitera d’avantage de vaccins.
            3. Gardez les médicaments et de la nourriture
            Gardez avec vous l’équivalent d’une semaine de médicaments (si votre animal en prend) et de nourriture. Le stress du déménagement fera en sorte que votre petite bête à poils ne se sentira pas aventurier en fait de son alimentation.
            4. Isolez votre animal
            Les animaux peuvent se sentir vulnérables le jour d’un déménagement. Gardez-les en sécurité, loin du bruit et des allées et venues, en les enfermant dans la salle de lavage ou la salle de bain. Laissez-leur un bol d’eau, un peu de nourriture et leur litière. Vous pouvez aussi mettre un écriteau sur la porte « ne pas déranger, minou se cache »!
            5. Préparez une trousse de premiers soins
            Un kit de premier soin ne remplacera jamais les services d’urgence d’un vétérinaire, mais il pourrait tout de même vous être grandement utile arriverait-il une mésaventure. Pensez à y inclure : les coordonnées de votre vétérinaire, de la gaze, une muselière, des serviettes, une couverture, du ruban adhésif à bandages, et du peroxyde (3%).
            6. Soyez prudents
            Le jour du déménagement votre animal de compagnie sera certainement nerveux et pourrait démontrer des comportements inhabituels. Pour cette raison, il est préférable de les transporter dans une cage où vous mettrez une couverture qui leur appartient et un jouet.
            7. Préparez l’arrivée
            Les animaux se sentent anxieux et déroutés dans un nouvel environnement. Dès votre arrivée à la nouvelle maison, mettez-les à l’aise en installant immédiatement les balises qu’ils connaissent. Dans le cas de poissons, il est conseillé de préparer l’aquarium quelques jours d’avance pour que l’eau se réchauffe et les coraux transportés puissent s’acclimater avant la venue des petits habitants.
            8. Faites vos devoirs
            Avant le déménagement, demandez des références sur les cliniques vétérinaires autour de votre nouvelle adresse. Appelez celle de votre choix et voyez si elle prend de nouveaux patients et comment est leur fonctionnement.
            9. Préparez-vous
            Dans un déménagement, tout est dans la préparation. Que ce soit en avion, en voiture ou en train, des renseignements vous sont offerts pour pouvoir préparer votre animal au changement à venir. N’attendez pas la dernière minute.
            10. Découvrez votre nouveau quartier
            Une fois le nouveau vétérinaire trouvé, demandez-lui si la région présente des risques de santé pour votre animal dont vous avez besoin d’être informé. Par la suite, dès le premier soir, prenez une marche avec votre chien pour qu’il puisse sentir et découvrir son nouveau territoire. Gardez-le bien en laisse toutefois, le stress du voyage demeurera une journée ou deux. Sachez aussi qu’il pourrait avoir le désir de se sauver pour rentrer où était son « chez-lui ».",

            'image' => "https://img.freepik.com/vecteurs-libre/famille-velo-dans-parc-ville_74855-5243.jpg?w=1380&t=st=1671729006~exp=1671729606~hmac=5ebf8d202054de2acff01034ea2bb4fab881b4f11fd74093922061dd57cb8741",

            'image_description' =>"Deux femmes avec un chien et un chat",
            'themeRanks' => [
                2,
                3,
                4
            ]
        ], 

    ];

    private static $themesData = [
        [
            'name' => "démarches administratives",
            'slug' => "demarches-administratives",
            'image' => "https://cdn-icons-png.flaticon.com/512/3093/3093773.png",
            'description' => "Quelles sont les démarches importantes à connaitre afin d'organiser un déménagement ?",
            'image_description' => "Un dossier et une loupe"
        ],
        [
            'name' => "aides",
            'slug' => 'aides',
            'image' => "https://cdn-icons-png.flaticon.com/512/855/855288.png",
            'description' => "Quelles sont les  aides dont vous pouvez bénéficier lors d'un déménagement ?",
            'image_description' => "Des mains reçoivent un paquet avec un signe dollard"
        ],
        [
            'name' => "logistique",
            'slug' => 'logistique',
            'image' => "https://cdn-icons-png.flaticon.com/512/869/869083.png",
            'description' => "Comment s'organiser concrêtement ?",
            'image_description' => "Un chariot sur lequel sont posés deux cartons"
        ],
        [
            'name' => "famille",
            'slug' => 'famille',
            'image' => "https://cdn-icons-png.flaticon.com/512/6966/6966266.png",
            'description' => "Comment s'organiser en famille pour un déménagement ?",
            'image_description' => "Une famille"
        ],
        [
            'name' => "animaux",
            'slug' => 'animaux',
            'image' => "https://cdn-icons-png.flaticon.com/512/1076/1076826.png",
            'description' => "Comment s'organiser pour déménager avec des animaux ?",
            'image_description' => "Une patte de chat"
        ]
    ];

    private static $usersData = [
        [
            'email' => "admin@oclock.io",
            'roles' => ["ROLE_USER","ROLE_ADMIN"],
            'password' => "oboxadmin",
            'name' => "administrateur"
        ],
        [
            'email' => "user@oclock.io",
            'roles' => ["ROLE_USER"],
            'password' => "oboxuser",
            'name' => "user"
        ]
    ];
}