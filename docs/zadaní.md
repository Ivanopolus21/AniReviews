# Popis
 Web zobrazuje seznam mých anime recenzí. Na tomto webu si uživatel může přečíst mé recenze a komentovat je.

# Uživatelské role

* Návštěvník (nepřihlášený uživatel)
* Uživatel (po přihlášení)
* Admin (s extra pravomocemi)

# Funkce podle rolí:
* Nepřihlášení uživatelé můžou registrovat se. Mohou číst recenze, komentáře ostatních uživatelů, prohlížet stránku hodnocení a domovskou stránku. Nemohou zanechat komentáře pod recenzemi.

* Přihlášení uživatelé mohou zanechávat komentáře, mazat své komentáře a odhlašovat se.

* Admin může smazat jakýkoli komentář a má všechna další práva přihlášeného uživatele.

## Stack

PHP, Databáze (podle toho co bude dostupné), HTML 5, Adobe Photoshop.

---

## Akceptační podmínky

### Přihlášení uživatele
Uživatel vyplní username a password. Formulář obsahuje validace na vyplnění obou položek.

### Registrace uživatele

Uživatel vyplní username, birthday, e-mail, password a confirm password. Formulář obsahuje validace na vyplnění všech položek.

### Přidání a editace komentáře (pouze uživatel nebo admin)

Uživatel přidává nový komentáře nebo vymazuje již existující (uživatel jenom své komentaře, admin muže všichní). Formulář validuje vyplnění pole v komentáři a tokenu csrf uživatele.
