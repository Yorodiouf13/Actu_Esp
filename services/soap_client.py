import requests

SOAP_URL = "http://localhost/esp_news_webservices/services/soap.php"
SOAP_NAMESPACE = "urn://localhost/esp_news_webservices/services/soap.php"

HEADERS = {
    "Content-Type": "text/xml;charset=UTF-8",
    "SOAPAction": ""
}

TOKEN = "1234567890SECRET" 

def authenticate(login, password):
    soap_body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
                      xmlns:urn="{SOAP_NAMESPACE}">
       <soapenv:Header/>
       <soapenv:Body>
          <urn:authenticate>
             <login>{login}</login>
             <password>{password}</password>
          </urn:authenticate>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = requests.post(SOAP_URL, data=soap_body.encode("utf-8"), headers=HEADERS)
    if response.status_code != 200:
        print("Erreur SOAP HTTP :", response.status_code)
        return {"success": False}

    text = response.text

    success = "<key xsi:type=\"xsd:string\">success</key>" in text and \
              "<value xsi:type=\"xsd:boolean\">true</value>" in text

    role = None
    if "<key xsi:type=\"xsd:string\">role</key>" in text:
        if "<value xsi:type=\"xsd:string\">admin</value>" in text:
            role = "admin"
        elif "<value xsi:type=\"xsd:string\">editor</value>" in text:
            role = "editor"
        elif "<value xsi:type=\"xsd:string\">visitor</value>" in text:
            role = "visitor"

    return {"success": success, "role": role}


def list_users(TOKEN):
    soap_body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
                      xmlns:urn="{SOAP_NAMESPACE}">
       <soapenv:Header/>
       <soapenv:Body>
          <urn:listUsers>
             <token>{TOKEN}</token>
          </urn:listUsers>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = requests.post(SOAP_URL, data=soap_body.encode("utf-8"), headers=HEADERS)
    if response.status_code != 200:
        return f"Erreur SOAP HTTP : {response.status_code}"
    return response.text


def add_user(TOKEN, login, password, role):
    soap_body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
                      xmlns:urn="{SOAP_NAMESPACE}">
       <soapenv:Header/>
       <soapenv:Body>
          <urn:addUser>
            <token>{TOKEN}</token>
             <login>{login}</login>
             <password>{password}</password>
             <role>{role}</role>
          </urn:addUser>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = requests.post(SOAP_URL, data=soap_body.encode("utf-8"), headers=HEADERS)
    if response.status_code != 200:
        return f"Erreur SOAP HTTP : {response.status_code}"
    return response.text


def update_user(TOKEN, user_id, login, password, role):
    soap_body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
                      xmlns:urn="{SOAP_NAMESPACE}">
       <soapenv:Header/>
       <soapenv:Body>
          <urn:updateUser>
             <token>{TOKEN}</token>          
             <id>{user_id}</id>
             <login>{login}</login>
             <password>{password}</password>
             <role>{role}</role>
          </urn:updateUser>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = requests.post(SOAP_URL, data=soap_body.encode("utf-8"), headers=HEADERS)
    if response.status_code != 200:
        return f"Erreur SOAP HTTP : {response.status_code}"
    return response.text


def delete_user(TOKEN, user_id):
    soap_body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
                      xmlns:urn="{SOAP_NAMESPACE}">
       <soapenv:Header/>
       <soapenv:Body>
          <urn:deleteUser>
            <token>{TOKEN}</token>
            <id>{user_id}</id>
          </urn:deleteUser>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = requests.post(SOAP_URL, data=soap_body.encode("utf-8"), headers=HEADERS)
    if response.status_code != 200:
        return f"Erreur SOAP HTTP : {response.status_code}"
    return response.text
