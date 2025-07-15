from PyQt5.QtWidgets import (
    QWidget, QVBoxLayout, QLabel, QListWidget, QPushButton
)
from PyQt5.QtGui import QFont
from services.rest_client import get_all_articles

class ArticleViewer(QWidget):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Articles (REST)")
        self.setGeometry(150, 150, 600, 400)
        self.init_ui()
        self.load_articles()

    def init_ui(self):
        layout = QVBoxLayout()

        title = QLabel("Liste des articles")
        title.setFont(QFont("Arial", 16))
        layout.addWidget(title)

        self.article_list = QListWidget()
        layout.addWidget(self.article_list)

        refresh_btn = QPushButton("Rafraîchir")
        refresh_btn.clicked.connect(self.load_articles)
        layout.addWidget(refresh_btn)

        self.setLayout(layout)

    def load_articles(self):
        self.article_list.clear()
        articles_json = get_all_articles()
        # tu peux parser en JSON si ton get_all_articles renvoie JSON
        # sinon on affiche directement le texte
        for article in articles_json:
            self.article_list.addItem(f"ID: {article['id']} | Titre: {article['titre']}")
