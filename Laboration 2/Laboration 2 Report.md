Christoffer Goude - 1DV449 - 20131206

## Laboration 2 - Rapport

**Länk till applikationen**

http://www.christoffergoude.se/Messy

### Del 1 - Optimering

#### Optimering 1: Inline CSS i index.php

**Teori**

Att ha inline-css i en fil kan göra så att inladdningen tar längre tid. Under laddning av index.php utan minifiering och
med inline-css fick jag extremt långa laddningstider. Minifierade sedan css'en och lade den i en egen separat css-fil.

**Laddningstid innan åtgärd**

Laddningstiden av huvudsidan gick vid ett tillfälle upp till hela 17.31 sekunder, men detta vet jag inte om riktigt vad det
berodde på. Medeltiden för inladdningen före låg på omkring 50ms.

**Laddningstid efter åtgärd**

Svårt att säga om det gjorde stor skillnad. Vid tester efter åtgärderna hamnade inladdningarna på runt 35-45ms, vilket inte
är något att direkt hurra över. Dock kan många små optimeringar skapa stora skillnader vid stora applikationer, vilket gör
att det är viktigt att hålla sig borta från inline-css.

**Reflektion**

Den inline-css som fanns i index.php var inte så omfattande, men kunde ändå ha påverkat laddningstiderna. Genom att minifiera
css'en och lägga den i en separat fil så minskade inladdningstiden något, och skulle man ha mycket olika delar av inline-css
som kanske också är mer invecklad än på denna sida kan man tänka sig att laddningstiderna skulle bli avsevärt kortare om man
sköter css'en på ett snyggt sätt.

#### Optimering 2: Minifiera bootstrap-css

**Teori**

Då bootstrap inte är en fil som ska ändras kan en minifiering av koden göra inladdningen kortare.

**Laddningstid före åtgärd**

Det var ganska stor skillnad på inladdningstiderna för bootstrap.css, men medelvärdet jag fick ut var ungefär 220ms.

**Laddningstid efter åtgärd**

Efter minifiering blev laddningstiden för bootstrap.css mer normaliserad. Den högsta peaken blev 83ms, med ett medelvärde
på ungefär 38ms. En klar förbättring från föregående lösning.

**Reflektion**

Genom att bootstrap-filen innehåller mycket kod kan det medföra att inladdningen blir längre. Samtidigt är det inte något som
behöver ändras i denna css-fil, vilket gör att man lätt kan minifiera den och optimera prestanda utan att försvåra arbetet 
med  webbsidan. Genom testerna fick jag ut att laddningstiden blev generellt bättre och sidan fick mer konsekvent lägre 
laddningstider.

#### Optimering 3: Fortsatt minifiering av resterande CSS-filer

**Teori**

Dom andra css-filerna (lightbox.css och screen.css) som används på sidan är statiska filer och kommer inte ändras, vilket gör att dom är starka kandidater
för minifiering. Dessa ligger som separata filer och inte som inline-css, vilket är bra, men inladdning kan göras snabbare
genom att minifiera dessa.

**Laddningstid före åtgärd**

Laddningstiden av dessa filer var ganska olika vid olika tillfällen, som mest låg laddningstiderna på över 1000ms för dessa
filer, som lägst runt 50ms. Medelvärdet jag fick fram efter tester var på hela 430ms.

**Laddningstid efter åtgärd**

Återigen får jag mer konsekvent låga laddningstider efter att ha minifierat css-filerna. Medelvärdet för laddningen av filerna
efter minifieringen hamnade på lite drygt 56ms, en klar förbättring. Peaken för laddningstiden var 176ms, vilket ligger en
bra bit under föregående medelvärde.

**Reflektion**

Anledningen till varför laddningstiderna sänks och blir mer konsekventa är säkerligen för att dessa css-filer är ganska stora,
och att ladda in så mycket kod med mellanrum och noga utförd indentering förlänger laddningstiderna avsevärt.

#### Optimering 4: Borttagning av inladdning av icke-existerande filer

**Teori**

Filen mess.php försöker anropa och använda sig av två stycker filer som inte existerar i projektet. Att försöka anropa döda
länkar och resurser kan vara krävande och påverka laddningstiden.

**Laddningstid före åtgärd**

Här hade jag lite problem att få ut något vettigt mätvärde. Under mätningarna fick jag ut svaret "pending" på dessa två
resurser, vilket verkar indikera att programmet försöker ladda in dom men lyckas inte.

**Laddningstid efter åtgärd**

Efter att inlänkningen av dom döda resurserna tagits bort så laddade sidan som vanligt. Tyvärr hade jag inte så mycket medel
att mäta laddningstiden med, men åtminstonde behöver inte längre sidan stå och tugga och försöka ladda in dessa resurser i 
onödan.

**Reflektion**

Tyvärr fick jag som sagt inte ut så mycket mätvärden som jag hade tänkt från detta, men det känns ändå som en smärre optimering
att inte försöka ladda in icke-existerade resurser. Det är även bra att ta bort dessa kodrader då de antingen visar på kod
som funnits i programmet tidigare och tagits bort, eller kod som ännu inte är implementerad och testad.
 
#### Optimering 5: Minifiering av Javascript

**Teori**

Även en del av Javascriptfilerna som körs i mess.php är långa filer med mycket kod, som inte heller kommer att ändras då de
är delar av statiska skript. Genom att minifiera dessa kommer förhoppningsvis inläsningstiden och laddtiden för sidan minskas.

**Laddningstid före åtgärd**

Ganska höga laddningstider för dessa filer, medelvärdet av testerna hamnade på strax över 195ms, medan peaken landade på
ungefär 440ms.

**Laddningstid efter åtgärd**

Laddningstiderna fortsatte faktiskt vara höga även efter minifiering, medelvärdet av testerna landade även här på omkring 
190ms.

**Reflektion** 
Efter att ha sett förbättringar genom att minifiera css-filerna tänkte jag att även javascript-minifiering skulle ha en bra
påverkan på laddningstiderna, men efter testerna verkar det som laddningstiden ligger kvar på ungefär densamma.

#### Optimering 6: Inline-javascript

**Teori**

Genom att lägga in även javascript som ligger i html-headers i egna filer bör laddningstiderna kunna minskar.

**Laddningstid före åtgärd**

Först fick jag en extremt lång laddningstid på hela 15 sekunder, men det vet jag inte om det berodde på sidans kod. Efter
flera tester fick jag fram ett medelvärde på 271ms, med toppar på lite drygt 1000ms innan sidan cachades.

**Laddningstid efter åtgärd**

Efter åtgärderna verkar laddningstiderna ha sänkts ganska bra, medelvärdet jag fick fram efter testerna var lite drygt 134ms.
Med toppar på runt 600ms verkar det ha påverkat laddningstiderna ganska mycket.

**Reflektion**

Det verkar som inlinekod, och speciellt script som körs gör mycket för att öka laddningstiden för sidan. Andra fördelar med
detta är såklart att man får en bättre överblick av koden när man inte använder inlinekod.

#### Optimering 7: Multipla anrop av fonter

**Teori**

När man anropar fonter via Googles API kan och bör man anropa dessa i en request, separerade med ett |-tecken.

**Laddningstid före åtgärd**

I genomsnitt landade laddningstiderna för var och en av dessa requests på 47ms.

**Laddningstid efter åtgärd**

Den genomsnittliga laddningstiden för den nya requesten hamnade omkring 50ms, och nu skickas som sagt bara en enda request.

**Reflektion**

Laddningstiden för den enda requesten verkar landa på ungefär densamma som för vardera av de tidigare två requests som skickades. Och det
är alltid bra att ha så få requests som möjligt!

#### Optimering 8: Lägga javascript i botten av sidan

**Teori**

Genom att lägga javascript-anrop i botten av sidan kan DOM'en laddas innan några anrop görs.

**Laddningstid före åtgärd**

Ungefär 35ms genomsnittlig laddning av varje javascript-fil, innan DOMen laddas.

**Laddningstid efter åtgärd**

Ungefär 25ms genomsnittlig laddning, och då görs detta efter att sidan laddats.

**Reflektion**

En förbättring kunde ses vid laddningen, och alla script laddas efter att sidans innehåll laddats, vilket inte påverkar scriptens
funktionalitet eller effektivitet.

#### Optimering 9: Borttagning av Middle.php

**Teori**

Genom att ta bort denna fil skippas en helt onödig sleep-funktion och en extra redirect.

**Laddningstid före åtgärd**

Exakt 2 sekunder.

**Laddningstid efter åtgärd**

Exakt 2 sekunder mindre.

**Reflektion**

Onödiga redirects kan man vara utan, och speciellt om det ligger en sleep-funktion med utan vidare anledning! ;)

### Del 2 - Säkerhet

#### Säkerhetsfråga 1 - Validering av login-information

**Säkerhetshål**

I filen check.php skickas inloggningsinformationen till sec.php utan någon validering. 

**Hur kan det utnyttjas?**

Då det inte finns någon validering av inloggningsuppgifterna kan någon som vill skapa oreda på sidan till exempel skicka in
SQL-injections i inloggningsformuläret och förstöra i databasen.

**Vilken skada kan detta orsaka?**

Om någon skickar in SQL-injections så kan det orsaka stor skada på databasen, till exempel kan man droppa hela tabeller eller
göra andra förändringar.

**Åtgärder**

Genom att lägga till en valideringsfunktion i check.php som kollar om det finns ogiltiga tecken i inloggningsinformationen,
till exempel taggar.

#### Säkerhetsfråga 2 - Sessionsvalidering

**Säkerhetshål**

I och med att sessionen inte valideras skulle någon kunna utföra en sessionsstöld och logga in med hjälp av detta.

**Hur kan det utnyttjas?**

Genom att olovligen kunna ta sig in på en sida kan den person som gör detta ta del av all information på sidan utan att ha
rätt till det.

**Vilken skada kan detta orsaka?**

Detta säkerhetshål kan framförallt leda till att information leder ut till fel personer.

**Åtgärder**

Genom att kolla användarens webbläsare kan man på så sätt undvika sessionsstölder.

#### Säkerhetsfråga 3 - XSS

**Säkerhetshål**

I filen functions.php skickas information till databasen via en funktion utan att först validera informationen.

**Hur kan det utnyttjas?**

Detta gör att illvilliga användare kan skicka med kod via meddelandeformuläret som kan ta sig in i databasen.

**Vilken skada kan detta orsaka?**

Med SQL-injections kan man skapa stor oreda i databasen, se Säkerhetsfråga 1: Validering av login-information.

**Åtgärder**

Genom att lägga till en require_once till filen check.php återanvänder jag valideringsfunktionen därifrån och kollar av 
användarens input innan det läggs till i databasen.

#### Säkerhetsfråga 4 - Strängkonkateneringar av SQL-querys

**Säkerhetshål**

Överallt där information skickas till databasen via SQL-queries kan SQL-injections utnyttjas.

**Hur kan det utnyttjas?**

Genom konkateneringen och det faktum att parametrarna inte binds så kan någon skicka in SQL-injections via dessa queries.

**Vilken skada kan detta orsaka?**

Någon som har förståelse för hur SQL-queries kan få kontroll över databasen.

**Åtgärder**

Genom att istället binda parametrar och göra en kontroll av typen kan man undvika illvilliga SQL-injections. Har gått igenom och täppt
till (förhoppningsvis) alla hål.

#### Säkerhetsfråga 5 - Ajaxanrop av icke autentisierade användare

**Säkerhetshål**

Ingen validering av användaren görs i functions.php som skäter om ajaxanropen. 

**Hur kan det utnyttjas?**

Detta innebär att man inte behöver vara inloggad för att utföra ett Ajaxanrop, vilket skaåar ett säkerhetshål.

**Vilken skada kan detta orsaka?**

Hela poängen med att ha en inloggningsfunktion är för att hålla icke autentisierade personer borta från vissa funktioner. Genom att
all information hämtas via ajax-anrop kan potentiellt en ej inloggad person få tillgång till informationen.

**Åtgärder**

Genom att autentisiera att det är en inloggad användare som utför ajax-anropet täpper vi till detta säkerhetshål. Detta görs enkelt genom
att anropa checkUser() i sec.php innan något anrop görs.

### Del 3 - AJAX

Genom att lägga in meddelandena i en array innan dom läggs till på sidan, samt att jag sorterar listan av meddelanden när
den hämtas från databasen hoppas jag kunna presentera meddelandena i rätt ordning. Genom att göra anropa en separat funktion som 
skriver ut meddelanden dels när sidan med producenten öppnas och dels när en användare klickar på knappen för att skicka ett meddelande 
så kan rutan med meddelanden uppdateras utan omladdning av sidan.

Genom att rensa rutan med meddelanden innan nya meddelanden hämtas undviker jag också dubletter.