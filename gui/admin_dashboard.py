from PyQt5.QtWidgets import (
    QWidget, QPushButton, QVBoxLayout, QLabel
)
from PyQt5.QtGui import QFont
from gui.user_management import UserManagement
from gui.article_viewer import ArticleViewer
from gui.category_viewer import CategoryViewer



class AdminDashboard(QWidget):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("ESP NEWS - Dashboard Admin")
        self.setGeometry(100, 100, 400, 300)
        self.init_ui()

    def init_ui(self):
        layout = QVBoxLayout()

        self.title_label = QLabel("Tableau de bord Admin")
        self.title_label.setFont(QFont("Arial", 18))
        layout.addWidget(self.title_label)

        self.btn_users = QPushButton("Gestion des utilisateurs (SOAP)")
        self.btn_articles = QPushButton("Lister les articles (REST)")
        self.btn_categories = QPushButton("Lister catégories avec articles (REST)")
        self.btn_quit = QPushButton("Quitter")

        self.btn_users.clicked.connect(self.open_user_management)
        self.btn_articles.clicked.connect(self.open_article_viewer)
        self.btn_categories.clicked.connect(self.open_category_viewer)

        layout.addWidget(self.btn_users)
        layout.addWidget(self.btn_articles)
        layout.addWidget(self.btn_categories)
        layout.addWidget(self.btn_quit)

        self.setLayout(layout)

    def open_user_management(self):
        self.user_window = UserManagement()
        self.user_window.show()

    def open_article_viewer(self):
        self.article_window = ArticleViewer()
        self.article_window.show()

    def open_category_viewer(self):
        self.category_window = CategoryViewer()
        self.category_window.show()

