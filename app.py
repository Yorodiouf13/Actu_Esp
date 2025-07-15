import sys
from PyQt5.QtWidgets import QApplication
from gui.login_window import LoginWindow

def main():
    app = QApplication(sys.argv)
    app.setStyleSheet("""
        QWidget {
            background-color: #f0f4f8;
            font-size: 14px;
        }
        QPushButton {
            background-color: #3498db;
            color: white;
            padding: 8px;
            border-radius: 5px;
        }
        QPushButton:hover {
            background-color: #2980b9;
        }
        QLineEdit {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        QLabel {
            color: #333;
        }
    """)
    login_window = LoginWindow()
    login_window.show()
    sys.exit(app.exec_())


if __name__ == "__main__":
    main()
