import requests

BASE_URL = "http://localhost/esp_news_webservices/api/articles.php"

def get_all_articles():
    try:
        response = requests.get(BASE_URL, params={"endpoint": "articles"})
        response.raise_for_status()
        return response.json()
    except Exception as e:
        return f"Erreur REST : {e}"

def get_articles_by_category(category_id):
    try:
        response = requests.get(BASE_URL, params={"endpoint": "articles_by_category", "id": category_id})
        response.raise_for_status()
        return response.json()
    except Exception as e:
        return f"Erreur REST : {e}"

def get_categories_with_articles():
    try:
        response = requests.get(BASE_URL, params={"endpoint": "categories"})
        response.raise_for_status()
        return response.json()
    except Exception as e:
        return f"Erreur REST : {e}"
