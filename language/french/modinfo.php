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
// The name of this module
define('_MI_XMSTOCK_NAME', 'Stock');
define('_MI_XMSTOCK_DESC', 'Gestion de stock');

// Menu
define('_MI_XMSTOCK_MENU_HOME', 'Index');
define('_MI_XMSTOCK_MENU_AREA', 'Zone de stockage');
define('_MI_XMSTOCK_MENU_OUTPUT', 'Sorties');
define('_MI_XMSTOCK_MENU_STOCK', 'Stock');
define('_MI_XMSTOCK_MENU_TRANSFER', 'Transferts');
define('_MI_XMSTOCK_MENU_PERMISSION', 'Autorisations');
define('_MI_XMSTOCK_MENU_ABOUT', 'À propos');

// Sub menu
define('_MI_XMSTOCK_SUB_CADDY', 'Panier');
define('_MI_XMSTOCK_SUB_LOAN', 'Gestion des prêts');
define('_MI_XMSTOCK_SUB_ORDERS', 'Mes commandes');
define('_MI_XMSTOCK_SUB_ORDERSMANAGEMENT', 'Gestion des commandes');
define('_MI_XMSTOCK_SUB_OVERDRAFT', 'Liste des découverts');
define('_MI_XMSTOCK_SUB_TRANSFER', 'Transferts');

// Block
define('_MI_XMSTOCK_BLOCK_MYORDERS', 'Mes commandes');
define('_MI_XMSTOCK_BLOCK_MYORDERS_DESC', 'Afficher mes commandes');
define('_MI_XMSTOCK_BLOCK_PROCESS', 'Commandes à traiter');
define('_MI_XMSTOCK_BLOCK_PROCESS_DESC', 'Afficher les commandes à traiter');
define('_MI_XMSTOCK_BLOCK_TRANSFERT', 'Transferts');
define('_MI_XMSTOCK_BLOCK_TRANSFERT_DESC', 'Afficher les transferts');
define('_MI_XMSTOCK_BLOCK_MYLOANS', 'Mes emprunts');
define('_MI_XMSTOCK_BLOCK_MYLOANS_DESC', 'Afficher les emprunts de l\'utilisateur');
define('_MI_XMSTOCK_BLOCK_LOANS', 'Emprunts en cours');
define('_MI_XMSTOCK_BLOCK_LOANS_DESC', 'Afficher les emprunts sous gestion de l\'utilisateur');
define('_MI_XMSTOCK_BLOCK_OVERDRAFT', 'Composants stock minimum');
define('_MI_XMSTOCK_BLOCK_OVERDRAFT_DESC', 'Afficher les composants qui ont atteint le stock minimum');

// Pref
define('_MI_XMSTOCK_PREF_HEAD_GENERAL', "<span style='font-size: large; font-weight: bold;'>Général</span>");
define('_MI_XMSTOCK_PREF_GENERALITEMPERPAGE', 'Nombre d\'éléments par page dans la vue générale');
define('_MI_XMSTOCK_PREF_PRICE', 'Gestion des prix');
define('_MI_XMSTOCK_PREF_PRICE_0', 'Désactivé');
define('_MI_XMSTOCK_PREF_PRICE_1', 'Activé, écrase le prix enregistré');
define('_MI_XMSTOCK_PREF_PRICE_2', 'Activé, prend le prix existant et le moyenne avec le nouveau');
define('_MI_XMSTOCK_PREF_DAYDELIVERY', 'Nombre de jours avant livraison');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_DESC', 'Option qui permet de définir le nombre de jours standard avant la livraison');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_0', 'Désactivé');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_1', '1 jour');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_2', '2 jours');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_3', '3 jours');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_4', '4 jours');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_5', '5 jours');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_6', '6 jours');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_7', '7 jours');
define('_MI_XMSTOCK_PREF_GENERALEXCESSCUT', 'Surplu de coupe');
define('_MI_XMSTOCK_PREF_GENERALEXCESSCUT_DESC', 'Valeur ajoutée à chaque coupe pour la longueur finale de sortie de stock');
define('_MI_XMSTOCK_PREF_EDITOR', 'Éditeur de texte');
define('_MI_XMSTOCK_PREF_XMPROD', 'Utiliser le module xmprod pour ajouter une gestion de production');
define('_MI_XMSTOCK_PREF_CAPTCHA', 'Utiliser Captcha?');
define('_MI_XMSTOCK_PREF_CAPTCHA_DESC', 'Sélectionnez Oui pour utiliser Captcha dans le formulaire de soumission.');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE', 'Taille maximale des fichiers uploadés');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE_DESC', 'Cela concerne les logos uploadés pour les catégories et les actualités');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES', 'Mb');
define('_MI_XMSTOCK_PREF_HEAD_ADMIN', "<span style='font-size: large; font-weight: bold;'>Administration</span>");
define('_MI_XMSTOCK_PREF_ITEMPERPAGE', 'Nombre d\'éléments par page dans la vue d\'administration');
