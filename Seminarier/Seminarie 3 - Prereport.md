Christoffer Goude - 1DV449 - 20131212

## Seminarie 3

### Diskussionsfrågor - Mashup

#### Del 1 - Projektidé

**Bakgrund**

Jag har alltid varit mycket intresserad av musik, och att upptäcka nya band och artister som man gillar tycker jag är bland 
det bästa som finns! Med mitt projekt ville jag därför skapa någonting som kunde underlätta för användare att söka efter ny,
spännande musik och kanske upptäcka band och artister som inte är så kända! Ofta kan en helt okänd artist vara precis det
man söker efter. Utifrån denna projektidé tänkte jag jobba mot Soundclouds API för att kunna söka och lyssna på musik, samt
Facebooks OAuth-API för autentisering, och för att ge användaren möjlighet att skapa ett konto och skapa listor över dom
artister och band dom hittar.

**Musik-API**

Soundclouds API verkar vara kraftfullt och kan leverera många olika funktioner. Man kan bland annat lyssna på musik, söka 
efter musik, lyssna på musik och kommentera. Soundclouds API stödjer även autentisering med Soundcloud-konto.

Soundclouds API kan leverera data i många olika format, det stödjer användning av Ruby, Python, PHP och Javascript för dom
flesta funktionerna i API'et. Strömning av ljud/musik stödjer inte PHP, men stödjer dom andra språken.

För närvarande är API'et kostnadsfritt, men Soundcloud förbehåller sig rätten att i framtiden börja ta betalt för det. Dom
största begränsningarna som finns i dagsläget har att göra med användarrättigheter. All musik som finns på Soundcloud 
tillhör inte Soundcloud själva, utan tillhör användaren som laddade upp verket (med detta menas verket i sin helhet; ljud, 
bilder, text och annat som tillhör verket). Därför finns hårda krav på att den rättmätiga ägaren till verket tydligt 
representeras när information om deras verk visas i eller distribueras via en applikation. API'et kräver också en API-nyckel,
men utöver detta så är API'et i princip helt öppet, och får även användas i vissa kommersiella syften.

Dom risker jag ser med att använda detta API är först och främst att bestämma vilka grundfunktioner som ska finnas med i 
applikationen och bygga en stabil applikation kring detta. Soundclouds API är som sagt mycket öppet och har många funktioner,
men jag ser hellre att man har en enklare applikation som fungerar stabilt snararare än många dåliga funktioner. En annan
risk är representationen av ägaren till verket. Soundcloud förbehåller sig också att ändra på API'et när dom vill, samt att
börja ta betalt för det om dom så önskar, detta utgör då självklart en risk!

Jag har även funderat på att använda ett ytterligare musik-API för att få tillgång till mer information.

**Autentiserings-API**

Facebooks API för autentisering är något som jag inte använt tidigare, men som verkar smidigt att använda. Därför tänkte jag
göra slag i saken och testa detta nu, och samtidigt ge användare en till möjlighet till autentisering i min applikation.
Via Facebooks API vill jag ge användaren möjlighet att skapa ett konto i appen och lista musik och artister dom hittar via 
appen.

Facebooks API är öppet och jag ser inga direkta risker att använda det.

#### Del 2 - Fallstudie - Exempel på en bra befintlig mashup-applikation

En mashup jag hittat som jag tycker är rätt bra är Webstagram (http://web.stagram.com/). Denna mashup tillhandahåller ett 
nytt webinterface för Instagram, som till exempel gör det enklare att söka på användare när man kollar Instagram via webben.
Denna mashup kombinerar Instagrams API med Facebooks API, och ger användaren ett mer detaljerat interface.

Jag befinner mig nuförtiden på resande fot ganska ofta och det händer många gånger att jag vill kolla Instagram via min 
laptop istället för på mobilen, och denna mashup gör det enklare för mig.

