# Projecte PHP - Gestió de Productes

## Descripció del projecte
Aquest projecte és un sistema web de gestió de productes amb autenticació d'usuaris.  
Permet als usuaris registrar-se, iniciar sessió, veure la seva informació i gestionar els productes que afegeixen (crear, editar i eliminar).  
El projecte està desenvolupat amb PHP i MySQL, utilitzant sessions per gestionar l'autenticació.

---

## Estructura de fitxers

PJPHP/
- config/
  - connexio.php: Connexió a la base de dades i creació de taules
- public/
  - login.php: Formulari d'inici de sessió
  - crear_usuari.php: Formulari per registrar nous usuaris
  - verificar_login.php: Processa el login
  - dashboard.php: Dashboard principal després del login
  - verinformacio.php: Mostrar info de l'usuari i canviar contrasenya
  - productes.php: Llista de productes de l'usuari
  - afegir_producte.php: Afegir un nou producte
  - editar_producte.php: Editar producte existent
  - eliminar_producte.php: Eliminar producte
- CSS/
- index.php: Redirigeix automàticament a login.php


---

## Credencials de prova
admin : 1234
usuario:1234
Quan un usuari canvia la contrasenya a `verinformacio.php`, la nova contrasenya substitueix l'antiga i s'haurà d'utilitzar per iniciar sessió en el futur.

---

## Funcionalitats principals

- Registre de nous usuaris amb validació de contrasenya mínima (8 caràcters).  
- Login amb verificació de contrasenya.  
- Dashboard amb informació personal i últim login.  
- Gestió de productes:
  - Crear producte amb `nom`, `preu`, `empresa`, `fecha_publicacio` i `origen`.
  - Editar productes existents.
  - Eliminar productes.
- Les operacions de productes només afecten els productes de l'usuari loguejat.  
- Actualització de la contrasenya sense tancar sessió.  

---

## Base de dades

- Base de dades: `projecte`  
- Taules principals: `usuaris`, `productes`  
- Relació: `productes.usuari_id` → `usuaris.id` (FOREIGN KEY amb `ON DELETE CASCADE`)  

---


