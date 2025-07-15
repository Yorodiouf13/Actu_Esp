from PyQt5.QtWidgets import (
    QWidget, QVBoxLayout, QLabel, QPushButton, QListWidget, QHBoxLayout,
    QInputDialog, QMessageBox
)
from PyQt5.QtGui import QFont
from services.soap_client import list_users, add_user, update_user, delete_user

class UserManagement(QWidget):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Gestion des utilisateurs (SOAP)")
        self.setGeometry(150, 150, 500, 400)
        self.init_ui()
        self.load_users()

    def init_ui(self):
        layout = QVBoxLayout()

        title = QLabel("Gestion des utilisateurs")
        title.setFont(QFont("Arial", 16))
        layout.addWidget(title)

        self.user_list = QListWidget()
        layout.addWidget(self.user_list)

        button_layout = QHBoxLayout()
        btn_add = QPushButton("Ajouter")
        btn_edit = QPushButton("Modifier")
        btn_delete = QPushButton("Supprimer")
        btn_refresh = QPushButton("Rafraîchir")

        btn_add.clicked.connect(self.add_user)
        btn_edit.clicked.connect(self.edit_user)
        btn_delete.clicked.connect(self.delete_user)
        btn_refresh.clicked.connect(self.load_users)

        button_layout.addWidget(btn_add)
        button_layout.addWidget(btn_edit)
        button_layout.addWidget(btn_delete)
        button_layout.addWidget(btn_refresh)

        layout.addLayout(button_layout)
        self.setLayout(layout)

    def load_users(self):
        self.user_list.clear()
        users_xml = list_users("1234567890SECRET")
        # affichage très simple : on affiche la ligne XML brute
        # tu pourras parser pour afficher proprement login/role
        for line in users_xml.splitlines():
            self.user_list.addItem(line.strip())

    def add_user(self):
        login, ok1 = QInputDialog.getText(self, "Ajouter", "Login :")
        if not ok1 or not login:
            return
        password, ok2 = QInputDialog.getText(self, "Ajouter", "Password :")
        if not ok2 or not password:
            return
        role, ok3 = QInputDialog.getText(self, "Ajouter", "Role (admin/editor/visitor) :")
        if not ok3 or not role:
            return

        result = add_user("1234567890SECRET", login, password, role)
        QMessageBox.information(self, "Résultat", result)
        self.load_users()

    def edit_user(self):
        selected = self.user_list.currentItem()
        if not selected:
            QMessageBox.warning(self, "Erreur", "Sélectionnez un utilisateur.")
            return
        user_id, ok1 = QInputDialog.getText(self, "Modifier", "ID de l'utilisateur :")
        if not ok1 or not user_id:
            return
        login, ok2 = QInputDialog.getText(self, "Modifier", "Nouveau login :")
        if not ok2 or not login:
            return
        role, ok3 = QInputDialog.getText(self, "Modifier", "Nouveau role :")
        if not ok3 or not role:
            return

        result = update_user("1234567890SECRET", user_id, login, role)
        QMessageBox.information(self, "Résultat", result)
        self.load_users()

    def delete_user(self):
        selected = self.user_list.currentItem()
        if not selected:
            QMessageBox.warning(self, "Erreur", "Sélectionnez un utilisateur.")
            return
        user_id, ok = QInputDialog.getText(self, "Supprimer", "ID de l'utilisateur :")
        if not ok or not user_id:
            return
        result = delete_user("1234567890SECRET", user_id)
        QMessageBox.information(self, "Résultat", result)
        self.load_users()
