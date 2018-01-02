#Seminarska naloga EP

**POSTOPEK ZA BAZO**

mysql -h 127.0.0.1 -u root -p\
CREATE DATABASE ep_db;\
exit

// se postavis v direktorij ep-projekt/api/db\
mysql -h localhost -u root -p ep_db < ep_db.sql\
mysql -h 127.0.0.1 -u root -p


**Baza:** 
- servername: localhost
- db name: ep_db
- username: root
- password root

**Administrator:**
- firstname: Admin
- lastname: Administratovic
- email: admin@admin.com
- password: admin1
  
**Prodajalec:**
- firstname: Prodajalec
- lastname: Ep
- email: pe@gmail.com
- password: eptest
    
**Stranka:**
- firstname: Ep
- lastname: Test
- email: ep@gmail.com
- password: eptest

#TO DO:
- poskrbi za XSS
- napiši funkcije za vnos elementov v bazo
- ne prikaži izdelkov, ki so deaktivirani
- košarica ne dela kot bi mogla, zgleda da loči artikle glede na pravi ID ampak ne posodobi pravih vrednosti