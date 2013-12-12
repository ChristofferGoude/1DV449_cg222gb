Christoffer Goude - 1DV449 - 20131212

## Seminarie 3

### Diskussionsfr�gor - Mashup

#### Del 1 - Projektid�

**Bakgrund**

Jag har alltid varit mycket intresserad av musik, och att uppt�cka nya band och artister som man gillar tycker jag �r bland 
det b�sta som finns! Med mitt projekt ville jag d�rf�r skapa n�gonting som kunde underl�tta f�r anv�ndare att s�ka efter ny,
sp�nnande musik och kanske uppt�cka band och artister som inte �r s� k�nda! Ofta kan en helt ok�nd artist vara precis det
man s�ker efter. Utifr�n denna projektid� t�nkte jag jobba mot Soundclouds API f�r att kunna s�ka och lyssna p� musik, samt
Facebooks OAuth-API f�r autentisering, och f�r att ge anv�ndaren m�jlighet att skapa ett konto och skapa listor �ver dom
artister och band dom hittar.

**Musik-API**

Soundclouds API verkar vara kraftfullt och kan leverera m�nga olika funktioner. Man kan bland annat lyssna p� musik, s�ka 
efter musik, lyssna p� musik och kommentera. Soundclouds API st�djer �ven autentisering med Soundcloud-konto.

Soundclouds API kan leverera data i m�nga olika format, det st�djer anv�ndning av Ruby, Python, PHP och Javascript f�r dom
flesta funktionerna i API'et. Str�mning av ljud/musik st�djer inte PHP, men st�djer dom andra spr�ken.

F�r n�rvarande �r API'et kostnadsfritt, men Soundcloud f�rbeh�ller sig r�tten att i framtiden b�rja ta betalt f�r det. Dom
st�rsta begr�nsningarna som finns i dagsl�get har att g�ra med anv�ndarr�ttigheter. All musik som finns p� Soundcloud 
tillh�r inte Soundcloud sj�lva, utan tillh�r anv�ndaren som laddade upp verket (med detta menas verket i sin helhet; ljud, 
bilder, text och annat som tillh�r verket). D�rf�r finns h�rda krav p� att den r�ttm�tiga �garen till verket tydligt 
representeras n�r information om deras verk visas i eller distribueras via en applikation. API'et kr�ver ocks� en API-nyckel,
men ut�ver detta s� �r API'et i princip helt �ppet, och f�r �ven anv�ndas i vissa kommersiella syften.

Dom risker jag ser med att anv�nda detta API �r f�rst och fr�mst att best�mma vilka grundfunktioner som ska finnas med i 
applikationen och bygga en stabil applikation kring detta. Soundclouds API �r som sagt mycket �ppet och har m�nga funktioner,
men jag ser hellre att man har en enklare applikation som fungerar stabilt snararare �n m�nga d�liga funktioner. En annan
risk �r representationen av �garen till verket. Soundcloud f�rbeh�ller sig ocks� att �ndra p� API'et n�r dom vill, samt att
b�rja ta betalt f�r det om dom s� �nskar, detta utg�r d� sj�lvklart en risk!

Jag har �ven funderat p� att anv�nda ett ytterligare musik-API f�r att f� tillg�ng till mer information.

**Autentiserings-API**

Facebooks API f�r autentisering �r n�got som jag inte anv�nt tidigare, men som verkar smidigt att anv�nda. D�rf�r t�nkte jag
g�ra slag i saken och testa detta nu, och samtidigt ge anv�ndare en till m�jlighet till autentisering i min applikation.
Via Facebooks API vill jag ge anv�ndaren m�jlighet att skapa ett konto i appen och lista musik och artister dom hittar via 
appen.

Facebooks API �r �ppet och jag ser inga direkta risker att anv�nda det.

#### Del 2 - Fallstudie - Exempel p� en bra befintlig mashup-applikation

En mashup jag hittat som jag tycker �r r�tt bra �r Webstagram (http://web.stagram.com/). Denna mashup tillhandah�ller ett 
nytt webinterface f�r Instagram, som till exempel g�r det enklare att s�ka p� anv�ndare n�r man kollar Instagram via webben.
Denna mashup kombinerar Instagrams API med Facebooks API, och ger anv�ndaren ett mer detaljerat interface.

Jag befinner mig nuf�rtiden p� resande fot ganska ofta och det h�nder m�nga g�nger att jag vill kolla Instagram via min 
laptop ist�llet f�r p� mobilen, och denna mashup g�r det enklare f�r mig.

