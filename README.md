## Introduction :

![list_review_within_pictures](https://cloud.githubusercontent.com/assets/25680893/23475852/22cdd4a4-feb9-11e6-897d-bbe13693bd19.png)

"Yassinos_Productreviewpicture" est un module en Magento 1.9 dédié pour donner la main à un utilisateur d'un "web shop" 
Magento d'envoyer une image en joint avec son commentaire dans le "review" de la fiche produit, l'image est affichable 
dans l'espace admin panel du site et aussi bien quand dans la grid en question, sa modification ainsi que le 
commentaire qui l'accompagne reste toujours possible pour l'admin.

![edit_form_review_picture](https://cloud.githubusercontent.com/assets/25680893/23475871/2fa0c614-feb9-11e6-9194-74cd7f2f292b.png)

## Coté technique :

Le module est fait selon les bonnes pratiques conseillé de Magento 1.
Ce que peut distinguer ce module c'est sa variété technique , j'ai essayé d'utiliser la majorité des intervetions 
élémentaires qui peuvent etre démandé d'un développeur Magento pour "customiser" un module ou modifier une fonctionnalité :

- surcharge  : des controlleurs (back et front) , Models , Blocks ,themes...
- customisation des blocks et fomrs via un observer pas un surcharge.
- customisation des grid (et affichages des images dans une grid)
- utilisation des objets (Varien pour l'import des images).
- utilisation des installer pour la modificaitions des tables.
- création de config de module (l'administration via le backoffice).

![grid_review_with_picture](https://cloud.githubusercontent.com/assets/25680893/23475874/324aac36-feb9-11e6-8915-a28b757146e4.png)

## Coté evolution :
Ce module est encore trés évolutif , on compte ajouter la fonction de réponse au commentaires le traduire en magento 2 , 
et plein d'autres trucs qui peuvent attirer l'attentions des Marchands ayant des Web shop réalisé en Magento..

![review_frontend_form](https://cloud.githubusercontent.com/assets/25680893/23475880/37318166-feb9-11e6-850e-387cfbd82b71.png)
