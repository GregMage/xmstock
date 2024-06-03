<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmstock module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */

// Button
define('_MA_XMSTOCK_AREA_ADD', 'Ajouter une zone de stockage');
define('_MA_XMSTOCK_AREA_LIST', 'Liste des zones de stockage');
define('_MA_XMSTOCK_OUTPUT_ADD', 'Ajouter une sortie');
define('_MA_XMSTOCK_OUTPUT_LIST', 'Liste de sortie');
define('_MA_XMSTOCK_STOCK_ADD', 'Ajouter un stock');
define('_MA_XMSTOCK_STOCK_LIST', 'Liste des stocks');
define('_MA_XMSTOCK_TRANSFER_ENTRYINSTOCK', 'Entrée en stock');
define('_MA_XMSTOCK_TRANSFER_LIST', 'Liste des transferts');
define('_MA_XMSTOCK_TRANSFER_OUTOFSTOCK', 'Sortie de stock');
define('_MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK', 'Transfert de stock');

// Shared
define('_MA_XMSTOCK_ADD', 'Ajouter');
define('_MA_XMSTOCK_ACTION', 'Action');
define('_MA_XMSTOCK_DEL', 'Supprimer');
define('_MA_XMSTOCK_EDIT', 'Modifier');
define('_MA_XMSTOCK_ERROR', 'Erreur');
define('_MA_XMSTOCK_INFORMATION', 'Informations');
define('_MA_XMSTOCK_ORDER', 'Commander');
define('_MA_XMSTOCK_LOAN', 'Emprunter');
define('_MA_XMSTOCK_PROCESS', 'Faire avancer');
define('_MA_XMSTOCK_REDIRECT_SAVE', 'Enregistré avec succès');
define('_MA_XMSTOCK_REJECT', 'Refuser');
define('_MA_XMSTOCK_SORTBY', 'Trier par');
define('_MA_XMSTOCK_STATUS', 'Statut');
define('_MA_XMSTOCK_STATUS_A', 'Actif');
define('_MA_XMSTOCK_STATUS_NA', 'Désactivé');
define('_MA_XMSTOCK_STATUS_EXECUTED', 'Réalisé');
define('_MA_XMSTOCK_STATUS_WAITING', 'En attente');
define('_MA_XMSTOCK_TITLE', 'Titre');
define('_MA_XMSTOCK_VIEW', 'Voir');
define('_MA_XMSTOCK_VALID', 'Validation');
define('_MA_XMSTOCK_WARNING', 'Avertissement');

// Admin
define('_MA_XMSTOCK_INDEX_IMAGEINFO', 'Statut du serveur');
define('_MA_XMSTOCK_INDEX_MAXPOSTSIZE', 'Taille d\'envoi maximal autorisé (directive post_max_size dans php.ini) : ');
define('_MA_XMSTOCK_INDEX_MAXUPLOADSIZE', 'Taille d\'envoi maximal autorisé (directive upload_max_filesize dans le fichier php.ini) : ');
define('_MA_XMSTOCK_INDEX_MEMORYLIMIT', 'Limite de mémoire (directive memory_limit dans php.ini) : ');
define('_MA_XMSTOCK_INDEX_ON', "<span style='font-weight: bold;'>ON</span>");
define('_MA_XMSTOCK_INDEX_OFF', "<span style='font-weight: bold;'>OFF</span>");
define('_MA_XMSTOCK_INDEX_SERVERUPLOADSTATUS', 'Statut d\'envoi du serveur : ');
define('_MA_XMSTOCK_INDEX_SPHPINI', "<span style='font-weight: bold;'>Informations extraites du fichier php.ini :</span>");
define('_MA_XMSTOCK_INDEXCONFIG_XMARTICLE_ERROR', 'Vous devez installer le module xmarticle pour utiliser xmstock');
define('_MA_XMSTOCK_INDEXCONFIG_XMPROD_WARNINGNOTINSTALLED', 'Vous n\'avez pas installé le module xmprod, ce module est requis si vous souhaitez avoir une gestion de production');
define('_MA_XMSTOCK_INDEXCONFIG_XMPROD_WARNINGNOTACTIVATE', 'Vous devez activer dans les préférences du module xmstock l\'utilisation de xmprod (si vous souhaitez avoir une gestion de production)');

// Error message
define('_MA_XMSTOCK_ERROR_AMOUNT', 'La Quantité doit être un nombre');
define('_MA_XMSTOCK_ERROR_ARTICLEID', 'Il n\'y a pas d\'article sélectionné');
define('_MA_XMSTOCK_ERROR_LOCATION', 'L\'emplacement n\'est pas défini');
define('_MA_XMSTOCK_ERROR_NACTIVE', 'Erreur: Le contenu est désactivé!');
define('_MA_XMSTOCK_ERROR_NOAREA', 'Il n\'y a pas de zones de stockage dans la base de données');
define('_MA_XMSTOCK_ERROR_NOARTICLE', 'Il n\'y a pas d\'article, il est nécessaire d\'avoir au minimum un article!');
define('_MA_XMSTOCK_ERROR_NOLOAN', 'Il n\'y a pas de prêt dans la base de données');
define('_MA_XMSTOCK_ERROR_NOORDER', 'Il n\'y a pas de commande dans la base de données');
define('_MA_XMSTOCK_ERROR_NOOUTPUT', 'Il n\'y a pas de sorties dans la base de données');
define('_MA_XMSTOCK_ERROR_NOPRICE', 'Pas de prix dans la base de donnée');
define('_MA_XMSTOCK_ERROR_NOSTOCK', 'Il n\'y a pas de stock dans la base de données');
define('_MA_XMSTOCK_ERROR_NOTRANSFER', 'Il n\'y a pas de transferts dans la base de données');
define('_MA_XMSTOCK_ERROR_ONEARTICLE', 'Vous devez avoir au minimum un article (pas de valeur 0 sur l\'article restant)');
define('_MA_XMSTOCK_ERROR_ORDER_DEL', 'Vous ne pouvez pas supprimer cette commande !');
define('_MA_XMSTOCK_ERROR_PRICE', 'Le prix doit être un nombre et supérieur à 0');
define('_MA_XMSTOCK_ERROR_SIZE', "La taille dans les préférences du module (taille maximale des fichiers téléchargés) dépasse les valeurs maximales définies dans 'post_max_size' ou 'upload_max_filesize' dans la configuration du fichier php.ini.");
define('_MA_XMSTOCK_ERROR_SPLIT', 'Vous ne pouvez pas spliter l\'article complet (il n\'y a qu\'un article...)');
define('_MA_XMSTOCK_ERROR_TRANSFER_AR_AREAID', 'Il n\'y a pas de stock de destination sélectionné');
define('_MA_XMSTOCK_ERROR_TRANSFER_ST_AREAID', 'Il n\'y a pas de stock de départ sélectionné');
define('_MA_XMSTOCK_ERROR_TRANSFER_ST_TO_AR', 'Les stocks de départ et d\'arrivée sont identiques');
define('_MA_XMSTOCK_ERROR_TRANSFER_OUTPUT', 'Vous devez choisir un déstinataire externe <b>ou</b> interne. Pas les deux!');
define('_MA_XMSTOCK_ERROR_TRANSFER_OUTPUTID', 'Il n\'y a pas de sortie sélectionnée');
define('_MA_XMSTOCK_ERROR_TRANSFER_NOARTICLE', 'L\'article sélectionné n\'est pas disponible dans le stock sélectionné');
define('_MA_XMSTOCK_ERROR_TRANSFER_TBAMOUNT', 'La quantité demandée (%s) est plus importante que celle disponible (%s)');
define('_MA_XMSTOCK_ERROR_USER', 'Aucun utilisateur séléctionné');
define('_MA_XMSTOCK_ERROR_WEIGHT', 'Le poids doit être un nombre');

// area
define('_MA_XMSTOCK_AREA_ARTICLENAME', 'Nom');
define('_MA_XMSTOCK_AREA_ARTICLEREFERENCE', 'Référence');
define('_MA_XMSTOCK_AREA_AMOUNT', 'Quantité');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE1', '<');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE2', '≤');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE3', '=');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE4', '>');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE5', '≥');
define('_MA_XMSTOCK_AREA_COLOR', 'Couleur');
define('_MA_XMSTOCK_AREA_DESC', 'Description');
define('_MA_XMSTOCK_AREA_FILTERFORM', 'Filtre');
define('_MA_XMSTOCK_AREA_FORMPATH', 'Les fichiers sont dans : %s');
define('_MA_XMSTOCK_AREA_LOCATION', 'Emplacement');
define('_MA_XMSTOCK_AREA_LOGO', 'Logo');
define('_MA_XMSTOCK_AREA_LOGOFILE', 'Fichier logo');
define('_MA_XMSTOCK_AREA_NAME', 'Nom');
define('_MA_XMSTOCK_AREA_PRODUCTION', 'Production');
define('_MA_XMSTOCK_AREA_PRODUCTION_DESC', 'Intégrer ce stock dans l\'analyse du plan de production?');
define('_MA_XMSTOCK_AREA_SORT', 'Trier');
define('_MA_XMSTOCK_AREA_SORT1', 'Nom vers le haut');
define('_MA_XMSTOCK_AREA_SORT2', 'Nom vers le bas');
define('_MA_XMSTOCK_AREA_SORT3', 'Quantité vers le haut');
define('_MA_XMSTOCK_AREA_SORT4', 'Quantité vers le bas');
define('_MA_XMSTOCK_AREA_SUREDEL', 'Voulez-vous vraiment supprimer cette zone de stockage ? %s');
define('_MA_XMSTOCK_AREA_UPLOAD', 'Upload');
define('_MA_XMSTOCK_AREA_UPLOADSIZE', 'Taille maximum : %s Ko');
define('_MA_XMSTOCK_AREA_WEIGHT', 'Poids');

// stock
define('_MA_XMSTOCK_STOCK_AMOUNT', 'Quantité en stock');
define('_MA_XMSTOCK_STOCK_AREA', 'Stock');
define('_MA_XMSTOCK_STOCK_ARTICLE', 'Articles en stock');
define('_MA_XMSTOCK_STOCK_FREE', 'Libre service');
define('_MA_XMSTOCK_STOCK_LOAN', '<span class="fa fa-exchange"></span> Emprunt');
define('_MA_XMSTOCK_STOCK_LOCATION', 'Emplacement');
define('_MA_XMSTOCK_STOCK_ML', 'Linéaire (mml)');
define('_MA_XMSTOCK_STOCK_ML_DESC', 'A renseigner en mm');
define('_MA_XMSTOCK_STOCK_TYPE', 'Type');
define('_MA_XMSTOCK_STOCK_TYPE_DESC', 'L\'option linéaire (mml) est utilisée pour de la matière stocké sous forme de profilé linéaire.<br>L\'option emprunt permet d\'activer le système de prêt de l\'article.');
define('_MA_XMSTOCK_STOCK_STANDARD', 'Standard (Qté)');

//output
define('_MA_XMSTOCK_OUTPUT_DESC', 'Description');
define('_MA_XMSTOCK_OUTPUT_NAME', 'Nom');
define('_MA_XMSTOCK_OUTPUT_SUREDEL', 'Voulez-vous vraiment supprimer cette sortie ? %s');
define('_MA_XMSTOCK_OUTPUT_WEIGHT', 'Poids');

//transfer
define('_MA_XMSTOCK_TRANSFER_AMOUNT', 'Quantité');
define('_MA_XMSTOCK_TRANSFER_AMOUNT_DSC', 'Si il s\'agit d\'une quantité en "linéaire", il faut entrer la quantité en [mm]');
define('_MA_XMSTOCK_TRANSFER_ARAREA', 'Stock de destination');
define('_MA_XMSTOCK_TRANSFER_ARTICLE', 'Article à transférer');
define('_MA_XMSTOCK_TRANSFER_DATE', 'Date');
define('_MA_XMSTOCK_TRANSFER_DESC', 'Description du transfert');
define('_MA_XMSTOCK_TRANSFER_DESTINATION', 'Destination');
define('_MA_XMSTOCK_TRANSFER_FORM', 'Formulaire de transfert');
define('_MA_XMSTOCK_TRANSFER_INFORMATION', 'Transfer Information');
define('_MA_XMSTOCK_TRANSFER_LIST_WARNING', 'Transferts en attente de validation');
define('_MA_XMSTOCK_TRANSFER_LOCATION', 'Emplacement*');
define('_MA_XMSTOCK_TRANSFER_LOCATION_DSC', 'Emplacement de l\'article dans le stock');
define('_MA_XMSTOCK_TRANSFER_NEEDSYEAR', 'Période du besoin');
define('_MA_XMSTOCK_TRANSFER_NEEDSYEAR_DSC', 'Cet article est dans le plan de production, vous devez indiquer pour quelle période est votre besoin');
define('_MA_XMSTOCK_TRANSFER_OUTPUT', 'Déstinataire');
define('_MA_XMSTOCK_TRANSFER_OUTPUT_DSC', 'Vous devez choisir un déstinataire externe ou interne. Un seul choix entre les deux possibilités');
define('_MA_XMSTOCK_TRANSFER_OUTPUTID', 'Déstinataire externe');
define('_MA_XMSTOCK_TRANSFER_OUTPUTUSERID', 'Déstinataire interne');
define('_MA_XMSTOCK_TRANSFER_PRICE', 'Prix');
define('_MA_XMSTOCK_TRANSFER_PRICE_DSC', 'Indiquez le prix du lot à tranférer. Une valeur à 0 n\'affichera pas de prix');
define('_MA_XMSTOCK_TRANSFER_REF', 'Référence de transfert');
define('_MA_XMSTOCK_TRANSFER_STOCK', 'Stock: ');
define('_MA_XMSTOCK_TRANSFER_SUREDEL', 'Voulez-vous vraiment supprimer ce transfert ? %s');
define('_MA_XMSTOCK_TRANSFER_STAREA', 'Stock de départ');
define('_MA_XMSTOCK_TRANSFER_TIME', 'Heure');
define('_MA_XMSTOCK_TRANSFER_TRANSFER', 'Transfert');
define('_MA_XMSTOCK_TRANSFER_TYPE', 'Type de transfert');
define('_MA_XMSTOCK_TRANSFER_USER', 'Auteur du transfert');

// permission
define('_MA_XMSTOCK_PERMISSION_MANAGE', 'Autorisation de gestion');
define('_MA_XMSTOCK_PERMISSION_MANAGE_DSC', 'Choisissez les groupes qui peuvent gérer ces zones de stockage');
define('_MA_XMSTOCK_PERMISSION_ORDER', 'Autorisation de commander');
define('_MA_XMSTOCK_PERMISSION_ORDER_DSC', 'Choisissez les groupes qui peuvent commander des articles dans ces zones de stockage');
define('_MA_XMSTOCK_PERMISSION_OTHER', 'Autres autorisations');
define('_MA_XMSTOCK_PERMISSION_OTHER_DSC', 'Sélectionnez des groupes qui peuvent :');
define('_MA_XMSTOCK_PERMISSION_OTHER_4', 'Permission de voir le prix');
define('_MA_XMSTOCK_PERMISSION_OTHER_8', 'Permission de voir les statistiques prix');
define('_MA_XMSTOCK_PERMISSION_VIEW', 'Autorisation de voir un stock');
define('_MA_XMSTOCK_PERMISSION_VIEW_DSC', 'Choisissez les groupes qui peuvent voir ces stocks');

// renderStocks
define('_MA_XMSTOCK_RENDERSTOCKS_PRICE', 'Prix: %s CHF');
define('_MA_XMSTOCK_RENDERSTOCKS_TOTAL', 'Total: ');

// user
define('_MA_XMSTOCK_AREA_THEREAREARTICLE', 'Il y a <strong>%s</strong> articles dans cette zone de stockage !');
define('_MA_XMSTOCK_CADDY', 'Panier');
define('_MA_XMSTOCK_HOME', 'Page d\'accueil');
define('_MA_XMSTOCK_VIEWORDER', 'Visualisation de la commande');

// checkout
define('_MA_XMSTOCK_CHECKOUT', 'Valider la commande');
define('_MA_XMSTOCK_CHECKOUT_UNIT', 'mm');
define('_MA_XMSTOCK_CHECKOUT_DESC', 'Description');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY', 'Options de livraison');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY_WITHDRAWAL', 'Retrait');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY_DELIVERY', 'Livraison');
define('_MA_XMSTOCK_CHECKOUT_DORDER', 'Date souhaitée');
define('_MA_XMSTOCK_CHECKOUT_DORDER_DSC', '<div class="alert alert-warning">Le délai standard pour une livraison est de %s jours ouvrés!</div>');
define('_MA_XMSTOCK_CHECKOUT_ERRORQTY', 'La quantité demandée pour les articles avec le logo <span class="badge badge-pill badge-danger">Erreur</span> est supérieure à celle disponible en stock. <br>Cela n\'est pas possible dans le cas d\'un emprunt! La quantité a donc été adaptée.');
define('_MA_XMSTOCK_CHECKOUT_INFORMATION', 'Merci de rendre les articles avec le logo <span class="badge badge-pill badge-light">' . _MA_XMSTOCK_STOCK_LOAN . '</span> dans des délais raisonnables');
define('_MA_XMSTOCK_CHECKOUT_INPUTINF', 'Informations sur la commande');
define('_MA_XMSTOCK_CHECKOUT_SEND', 'Commande envoyée');
define('_MA_XMSTOCK_CHECKOUT_CONFIRM', 'Confirmation');
define('_MA_XMSTOCK_CHECKOUT_CONFIRM_SEND', 'Votre commande a bien été envoyée avec les informations suivantes :');
define('_MA_XMSTOCK_CHECKOUT_SUMMARY', 'Récapitulatif de votre panier');
define('_MA_XMSTOCK_CHECKOUT_VIEW', 'Suivre cette commande');
define('_MA_XMSTOCK_CHECKOUT_WARNINGQTY', 'La quantité demandée pour les articles avec le logo <span class="badge badge-pill badge-warning">Avertissement</span> est supérieure à celle disponible en stock. <br>Le délai de livraison pourrait être plus long !');
define('_MA_XMSTOCK_CHECKOUT_WARNINGQTY2', 'Si l\'article désiré est en stock mais pas en quantité suffisante et que vous désirez obtenir la quantité en stock avant la totalité, merci de spliter la commande en 2.');

// caddy
define('_MA_XMSTOCK_CADDY_NEEDSYEARS', 'Besoin');
define('_MA_XMSTOCK_CADDY_LENGHT', 'Longueur');
define('_MA_XMSTOCK_CADDY_EMPTY', 'Vider le panier');
define('_MA_XMSTOCK_CADDY_AREA', 'Zone de stockage');
define('_MA_XMSTOCK_CADDY_STEP1', '1- Ajouter au panier');
define('_MA_XMSTOCK_CADDY_STEP2', '2- Informations sur la commande');
define('_MA_XMSTOCK_CADDY_STEP3', '3- Confirmer les informations');
define('_MA_XMSTOCK_CADDY_CONTINUE', 'Continuer la sélection d\'articles');
define('_MA_XMSTOCK_CADDY_UPDATE', 'Mettre à jour la quantité');
define('_MA_XMSTOCK_CADDY_STEP1_2', 'Suivant (informations sur la commande)');
define('_MA_XMSTOCK_CADDY_STEP2_2', 'Suivant (Confirmer les informations)');
define('_MA_XMSTOCK_CADDY_QUANTITY', 'Quantité');
define('_MA_XMSTOCK_CADDY_ITMES', 'Articles');
define('_MA_XMSTOCK_CADDY_ERROR_EMPTY', 'Votre panier est vide');
define('_MA_XMSTOCK_CADDY_ERROR_NOARTICLE', 'L\'élément demandé n\'existe pas ou n\'est pas activé !');
define('_MA_XMSTOCK_CADDY_ERROR_NOAREA', 'La zone de stockage demandée n\'existe pas ou n\'est pas activée !');
define('_MA_XMSTOCK_CADDY_ERROR_NOPERMISSION', 'Vous n\'êtes pas autorisé à commander dans cette zone de stockage');
define('_MA_XMSTOCK_CADDY_ERROR_NOLOAN', 'Cette article ne peut pas être emprunter pour le moment!');
define('_MA_XMSTOCK_CADDY_WARNING_AREA', 'Attention, vous pouvez commander plusieurs articles mais uniquement si ils sont dans le même stock.<br>Si vous voulez commander l\'article ci dessous, il faut faire une autre commande');

// order
define('_MA_XMSTOCK_ORDER_ARTICLES', 'Articles commandés');
define('_MA_XMSTOCK_ORDER_DATECANCELLATION', 'Date d\'annulation');
define('_MA_XMSTOCK_ORDER_DATEDELIVERY', 'Date de livraison prévue');
define('_MA_XMSTOCK_ORDER_DATEDELIVERY_R', 'Date de la livraison');
define('_MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL', 'Date de livraison / retrait prévue');
define('_MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL_R', 'Date de livraison / retrait');
define('_MA_XMSTOCK_ORDER_DATEDESIRED', 'Date désirée');
define('_MA_XMSTOCK_ORDER_DATEORDER', 'Date de commande');
define('_MA_XMSTOCK_ORDER_DATEREADY', 'Date commande prête');
define('_MA_XMSTOCK_ORDER_DATEVALIDATION', 'Date de validation');
define('_MA_XMSTOCK_ORDER_DATEWITHDRAWAL', 'Date de retrait prévu');
define('_MA_XMSTOCK_ORDER_DATEWITHDRAWAL_R', 'Date du retrait');
define('_MA_XMSTOCK_ORDER_HISTORY', 'Historique de la commande');
define('_MA_XMSTOCK_ORDER_ORDER', 'N° de commande %s');
define('_MA_XMSTOCK_ORDER_DESCRIPTION', 'Description');
define('_MA_XMSTOCK_ORDER_DELIVERY', 'Options de livraison');
define('_MA_XMSTOCK_ORDER_DELIVERY_WITHDRAWAL', 'Retrait');
define('_MA_XMSTOCK_ORDER_DELIVERY_DELIVERY', 'Livraison');
define('_MA_XMSTOCK_ORDER_STATUS_0', 'Annulée');
define('_MA_XMSTOCK_ORDER_STATUS_1', 'En attente');
define('_MA_XMSTOCK_ORDER_STATUS_2', 'En cours');
define('_MA_XMSTOCK_ORDER_STATUS_3', 'Livraison/retrait');
define('_MA_XMSTOCK_ORDER_STATUS_4', 'Livrée');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_0', 'Commandes annulées');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_1', 'Commandes en attentes');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_2', 'Commandes en cours');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_3', 'Commandes prêtes (livraison/retrait)');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_4', 'Commandes livrées');
define('_MA_XMSTOCK_ORDER_SUREDEL', 'Voulez-vous vraiment supprimer cette commande ? #%s');
define('_MA_XMSTOCK_ORDERS', 'Commandes');

// vieworder
define('_MA_XMSTOCK_VIEWORDER_AMOUNT', 'Quantité');
define('_MA_XMSTOCK_VIEWORDER_ARTICLE', 'Article');
define('_MA_XMSTOCK_VIEWORDER_ORDER', 'Commande #');

// management
define('_MA_XMSTOCK_MANAGEMENT', 'Gestion des commandes');
define('_MA_XMSTOCK_MANAGEMENT_ALLORDERS', 'Toutes les commandes');
define('_MA_XMSTOCK_MANAGEMENT_CANCELED', 'Commandes annulées');
define('_MA_XMSTOCK_MANAGEMENT_CUSTOMER', 'Client');
define('_MA_XMSTOCK_MANAGEMENT_DELIVRED', 'Commandes livrées');
define('_MA_XMSTOCK_MANAGEMENT_PREPARATION', 'Commandes en préparation');
define('_MA_XMSTOCK_MANAGEMENT_READY', 'Commandes prêtes');
define('_MA_XMSTOCK_MANAGEMENT_SORTORDER', 'N° de commande');
define('_MA_XMSTOCK_MANAGEMENT_TOPROCESS', 'Commandes à traiter');
define('_MA_XMSTOCK_MANAGEMENT_VIEW', 'Visualisation d\'une commande');
define('_MA_XMSTOCK_MANAGEMENT_VIEWALL', 'Visualization of orders');

//action.php
define('_MA_XMSTOCK_ACTION_ARTICLES', 'Articles');
define('_MA_XMSTOCK_ACTION_EDIT', 'Edition d\'une commande');
define('_MA_XMSTOCK_ACTION_EDITSTOCK', 'Edition d\'un stock');
define('_MA_XMSTOCK_ACTION_INFODELARTICLE', 'Mettre "0" pour supprimer un article');
define('_MA_XMSTOCK_ACTION_NEXT1', 'Formulaire de validation de la commande');
define('_MA_XMSTOCK_ACTION_NEXT2', 'Formulaire de préparation de la commande');
define('_MA_XMSTOCK_ACTION_NEXT3', 'Formulaire de livraison de la commande');
define('_MA_XMSTOCK_ACTION_SPLIT', 'Diviser');
define('_MA_XMSTOCK_ACTION_SPLIT_AMOUNT', 'Quantité');
define('_MA_XMSTOCK_ACTION_SPLIT_DESC', 'Les articles sélectionnés dans "Diviser" seront regroupés dans une nouvelle commande. Si la "Quantité" est renseignée à 0, toute la quantité de l\'article sera transférée dans une nouvelle commande. Si la "Quantité" ne contient pas 0, alors la quantité renseignée restera dans cette commande et le solde sera transféré dans la nouvelle commande');
define('_MA_XMSTOCK_ACTION_SPLIT_TEXT', 'Cette commande est une commande divisée (commande d\'origine: %s)');
define('_MA_XMSTOCK_ACTION_TRANSFERT_REF', 'Commande %s');
define('_MA_XMSTOCK_ACTION_TRANSFERT_DESC', 'Commande du %s avec le numéro %s');
define('_MA_XMSTOCK_ACTION_WARNING_STATUS2', 'Une fois ce formulaire validé, les articles seront décomptés du stock!');
define('_MA_XMSTOCK_ACTION_WARNING_STATUS3', 'Une fois ce formulaire validé, la commande sera considérée comme livrée (article livrés ou retirés).');

// viewprice.php
define('_MA_XMSTOCK_VIEWPRICE_AMOUNT', 'Quantité transférée');
define('_MA_XMSTOCK_VIEWPRICE_DASHBOARD', 'Tableau de bord');
define('_MA_XMSTOCK_VIEWPRICE_DATE', 'Date');
define('_MA_XMSTOCK_VIEWPRICE_EXPORT', 'Exporter');
define('_MA_XMSTOCK_VIEWPRICE_FILTER', 'Filtre');
define('_MA_XMSTOCK_VIEWPRICE_PERPAGE', 'par page');
define('_MA_XMSTOCK_VIEWPRICE_PRICE', 'Prix');
define('_MA_XMSTOCK_VIEWPRICE_PRICECHF', 'Prix en CHF');

// loan.php
define('_MA_XMSTOCK_LOAN_ADD', 'Ajout d\'un prêt');
define('_MA_XMSTOCK_LOAN_AMOUNT', 'Quantité');
define('_MA_XMSTOCK_LOAN_AREA', 'Stock');
define('_MA_XMSTOCK_LOAN_ARTICLE', 'Article à mettre en prêt');
define('_MA_XMSTOCK_LOAN_DATE', 'Date de l\'emprunt');
define('_MA_XMSTOCK_LOAN_EDIT', 'Edition d\'un prêt');
define('_MA_XMSTOCK_LOAN_FORM', 'Formulaire de prêt');
define('_MA_XMSTOCK_LOAN_LARTICLE', 'Article en prêt');
define('_MA_XMSTOCK_LOAN_LIST', 'Liste des prêts');
define('_MA_XMSTOCK_LOAN_RDATE', 'Date de retour');
define('_MA_XMSTOCK_LOAN_STATUS', 'Statut du prêt');
define('_MA_XMSTOCK_LOAN_STATUS_L', 'En prêt');
define('_MA_XMSTOCK_LOAN_STATUS_C', 'Prêt cloturé');
define('_MA_XMSTOCK_LOAN_TRANSFERT_DESC', 'Prêt du %s avec le numéro %s');
define('_MA_XMSTOCK_LOAN_TRANSFERT_REF', 'Prêt %s');
define('_MA_XMSTOCK_LOAN_USERID', 'Déstinataire du prêt');
define('_MA_XMSTOCK_LOAN_USERSLIST', 'Liste des emprunteurs');
