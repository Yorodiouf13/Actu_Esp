from PyQt5.QtWidgets import (
    QWidget, QLabel, QLineEdit, QPushButton, QVBoxLayout, QMessageBox
)
from PyQt5.QtGui import QFont
from gui.admin_dashboard import AdminDashboard
from services.soap_client import authenticate

class LoginWindow(QWidget):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("ESP NEWS - Connexion")
        self.setGeometry(100, 100, 300, 200)
        self.init_ui()

    def init_ui(self):
        layout = QVBoxLayout()

        self.title_label = QLabel("Connexion Admin")
        self.title_label.setFont(QFont("Arial", 16))
        layout.addWidget(self.title_label)

        self.login_input = QLineEdit()
        self.login_input.setPlaceholderText("Login")
        layout.addWidget(self.login_input)

        self.password_input = QLineEdit()
        self.password_input.setEchoMode(QLineEdit.Password)
        self.password_input.setPlaceholderText("Mot de passe")
        layout.addWidget(self.password_input)

        self.login_button = QPushButton("Se connecter")
        self.login_button.clicked.connect(self.handle_login)
        layout.addWidget(self.login_button)

        self.setLayout(layout)

    def handle_login(self):
        login = self.login_input.text()
        password = self.password_input.text()
        result = authenticate(login, password)

        if result["success"] and result["role"] == "admin":
            QMessageBox.information(self, "Succès", "Connecté en tant qu'admin.")
            self.open_dashboard()
        else:
            QMessageBox.warning(self, "Erreur", "Échec de connexion ou accès refusé.")

    def open_dashboard(self):
        self.dashboard = AdminDashboard()
        self.dashboard.show()
        self.close()
