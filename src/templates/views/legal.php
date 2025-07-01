<?php
$title = "Les Hauts de Lo Cantaire - Informations légales -";
$css = BASE_URL . "public/css/legal.css";

ob_start();
?>
<main>
  <section>
    <h1>Mentions légales</h1>
    <p><em>Ce site est un projet fictif, réalisé dans un but de démonstration. Il n’a pas vocation à être publié en ligne. Les informations ci-dessous sont en grande partie fictives mais respectent les obligations légales applicables à un site réel.</em></p>

    <h2>Éditeur du site</h2>
    <p>
      Nom : Société Démo SARL<br>
      Adresse : 123 rue de l’Exemple, 75000 Paris<br>
      Téléphone : 01 23 45 67 89<br>
      Email : contact@demoweb.fr<br>
      Responsable de la publication : Jean Dupont
    </p>

    <h2>Hébergement</h2>
    <p>
      Hébergeur : FictiHost SAS<br>
      Adresse : 456 avenue Imaginaire, 69000 Lyon<br>
      Téléphone : 04 56 78 90 12
    </p>

    <h2>Responsabilité</h2>
    <p>
      Le site <strong>Les Hauts de Lo Cantaire</strong> est proposé à des fins de test ou de démonstration. L’éditeur ne saurait être tenu responsable des éventuelles erreurs, interruptions ou contenus tiers présents à titre d’exemple.
    </p>

    <h2>Collecte et traitement des données</h2>
    <p>
      Les données collectées concernent exclusivement les comptes administrateurs. Elles sont enregistrées dans une base de données interne, utilisées uniquement pour gérer les connexions au site, et ne sont jamais partagées avec des tiers.<br>
      Les mots de passe sont stockés de manière sécurisée, via un procédé de hachage conforme aux bonnes pratiques de sécurité informatique.
    </p>

    <h2>Durée de conservation des données</h2>
    <p>
      Les données des administrateurs sont conservées tant que le compte est actif. En cas d’inactivité prolongée (au-delà de trois ans), les comptes peuvent être supprimés ou anonymisés.<br>
      Les journaux de connexion, s’ils sont utilisés, sont conservés pour une durée maximale de six mois.
    </p>

    <h2>Droits des utilisateurs</h2>
    <p>
      Conformément au Règlement Général sur la Protection des Données (RGPD), chaque administrateur peut demander l’accès, la modification ou la suppression de ses données en contactant l’adresse mentionnée ci-dessus.
    </p>

    <h2>Cookies</h2>
    <p>
      Le site utilise uniquement des cookies de session nécessaires au bon fonctionnement de l’espace d’administration. Ces cookies sont temporaires et supprimés à la fermeture du navigateur. Aucun cookie de suivi ou de publicité n’est utilisé.
    </p>

    <h2>Contenus visuels</h2>
    <p>
      Le site contient des images ajoutées à des fins de présentation. Leur origine et leurs droits d’utilisation n’ont pas été vérifiés dans le cadre de ce projet fictif.<br>
      Si le site devait être mis en ligne, toutes les images seraient remplacées par des contenus libres de droits ou disposant d’une licence appropriée.
    </p>
  </section>
</main>
<?php $content = ob_get_clean(); 
require_once __DIR__ . '/../layout/layout.php';
?>