from soap_client import authenticate, list_users, add_user, update_user, delete_user
from rest_client import get_all_articles, get_articles_by_category, get_categories_with_articles

def main():
    print("=== ESP NEWS CLIENT (Python) ===")
    login = input("Login : ")
    password = input("Mot de passe : ")

    # Auth via SOAP
    auth_result = authenticate(login, password)
    if auth_result['success'] and auth_result['role'] == 'admin':
        print("Connexion réussie en tant qu'admin !")
        menu_admin()
    else:
        print("Échec ou pas admin. Accès restreint.")
        exit()

def menu_admin():
    while True:
        print("\n--- Menu Principal ---")
        print("1. gestion des utilisateurs (SOAP)")
        print("2. Lister tous les articles (REST)")
        print("3. Lister les articles par catégorie (REST)")
        print("4. Lister les catégories avec articles (REST)")
        print("5. Quitter")
        choix = input("Votre choix : ")

        if choix == "1":
            menu_gestion_utilisateurs()
        elif choix == "2":
            print(get_all_articles())
        elif choix == "3":
            cat_id = input("ID catégorie : ")
            print(get_articles_by_category(cat_id))
        elif choix == "4":
            print(get_categories_with_articles())
        elif choix == "5":
            print("Au revoir !")
            break
        else:
            print("Choix invalide.")
    
def menu_gestion_utilisateurs():
    while True:
        print("\n--- Gestion des utilisateurs (SOAP) ---")
        print("1. Lister les utilisateurs")
        print("2. Ajouter un utilisateur")
        print("3. Modifier un utilisateur")
        print("4. Supprimer un utilisateur")
        print("5. Retour")
        choix = input("Votre choix : ")

        if choix == "1":
            token = "1234567890SECRET"
            print(list_users(token))
        elif choix == "2":
            login = input("Login : ")
            password = input("Password : ")
            role = input("Role (admin/editor/visitor) : ")
            token = "1234567890SECRET"
            print(add_user(token, login, password, role))
        elif choix == "3":
            user_id = input("ID de l'utilisateur à modifier : ")
            login = input("Nouveau login : ")
            password = input("Nouveau password : ")
            role = input("Nouveau role : ")
            token = "1234567890SECRET"
            print(update_user(token, user_id, login, password, role))
        elif choix == "4":
            user_id = input("ID de l'utilisateur à supprimer : ")
            token = "1234567890SECRET"
            print(delete_user(token, user_id))
        elif choix == "5":
            break
        else:
            print("Choix invalide.")

if __name__ == "__main__":
    main()
