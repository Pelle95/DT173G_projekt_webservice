## DT173G - Projekt

# Webbtjänst

Detta är en webbtjänst som är tänkt att konsumeras vid behov. Webbtjänsten är baserad runt att ha tillgång till CRUD (Create, Read, Update, Delete), vilket innebär att man ska kunna läsa data, ta bort data, skapa data och redigera data.

Webbtjänsten är skapad i PHP, och har en anslutning till en databas som är baserad på MySQL/MariaDB.

Det är en objektbaserad lösning, vilket innebär att den använder sig utav klass-filer. Den fungerar genom att anrop görs mot webbtjänsten, och webbtjänsten därigenom ansluter till databasen och hämtar den information som efterfrågas, lägger till ny information, tar bort eller redigerar befintlig information.

Jag har valt att ha tre filer, med en tillhörande klass för varje fil. En för kurser, en för jobb, och en för webbplatser. Anrop som vill nå data angående exempelvis jobb, anropar därför filen jobs.php, och den inom sig, beroende på vilket typ av anrop det är hämtar informationen genom sin klass-fil där funktionerna som ansluter till databasen ligger.