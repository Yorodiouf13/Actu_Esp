from PyQt5.QtWidgets import (
    QWidget, QVBoxLayout, QLabel, QListWidget, QPushButton
)
from PyQt5.QtGui import QFont
from services.rest_client import get_categories_with_articles

class CategoryViewer(QWidget):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Catégories avec articles (REST)")
        self.setGeometry(150, 150, 600, 400)
        self.init_ui()
        self.load_categories()

    def init_ui(self):
        layout = QVBoxLayout()

        title = QLabel("Catégories avec leurs articles")
        title.setFont(QFont("Arial", 16))
        layout.addWidget(title)

        self.category_list = QListWidget()
        layout.addWidget(self.category_list)

        refresh_btn = QPushButton("Rafraîchir")
        refresh_btn.clicked.connect(self.load_categories)
        layout.addWidget(refresh_btn)

        self.setLayout(layout)

    def load_categories(self):
        self.category_list.clear()
        categories_json = get_categories_with_articles()
        for cat in categories_json:
            self.category_list.addItem(f"Catégorie: {cat['libelle']} - Articles: {len(cat['articles'])}")
