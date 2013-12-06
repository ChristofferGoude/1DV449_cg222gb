Christoffer Goude - 1DV449 - 20131206

## Laboration 2 - Rapport

### Del 1 - Optimering

#### Optimering 1: Inline CSS i index.php

**Teori**

Att ha inline-css i en fil kan g�ra s� att inladdningen tar l�ngre tid. Under laddning av index.php utan minifiering och
med inline-css fick jag extremt l�nga laddningstider. Minifierade sedan css'en och lade den i en egen separat css-fil.

**Laddningstid innan �tg�rd**

Laddningstiden av huvudsidan gick vid ett tillf�lle upp till hela 17.31 sekunder, men detta vet jag inte om riktigt vad det
berodde p�. Medeltiden f�r inladdningen f�re l�g p� omkring 50ms.

**Laddningstid efter �tg�rd**

Sv�rt att s�ga om det gjorde stor skillnad. Vid tester efter �tg�rderna hamnade inladdningarna p� runt 35-45ms, vilket inte
�r n�got att direkt hurra �ver. Dock kan m�nga sm� optimeringar skapa stora skillnader vid stora applikationer, vilket g�r
att det �r viktigt att h�lla sig borta fr�n inline-css.

**Reflektion**

Den inline-css som fanns i index.php var inte s� omfattande, men kunde �nd� ha p�verkat laddningstiderna. Genom att minifiera
css'en och l�gga den i en separat fil s� minskade inladdningstiden n�got, och skulle man ha mycket olika delar av inline-css
som kanske ocks� �r mer invecklad �n p� denna sida kan man t�nka sig att laddningstiderna skulle bli avsev�rt kortare om man
sk�ter css'en p� ett snyggt s�tt.

#### Optimering 2: Minifiera bootstrap-css

**Teori**

D� bootstrap inte �r en fil som ska �ndras kan en minifiering av koden g�ra inladdningen kortare.

**Laddningstid f�re �tg�rd**

Det var ganska stor skillnad p� inladdningstiderna f�r bootstrap.css, men medelv�rdet jag fick ut var ungef�r 220ms.

**Laddningstid efter �tg�rd**

Efter minifiering blev laddningstiden f�r bootstrap.css mer normaliserad. Den h�gsta peaken blev 83ms, med ett medelv�rde
p� ungef�r 38ms. En klar f�rb�ttring fr�n f�reg�ende l�sning.

**Reflektion**

Genom att bootstrap-filen inneh�ller mycket kod kan det medf�ra att inladdningen blir l�ngre. Samtidigt �r det inte n�got som
beh�ver �ndras i denna css-fil, vilket g�r att man l�tt kan minifiera den och optimera prestanda utan att f�rsv�ra arbetet 
med  webbsidan. Genom testerna fick jag ut att laddningstiden blev generellt b�ttre och sidan fick mer konsekvent l�gre 
laddningstider.

#### Optimering 3: Fortsatt minifiering av resterande CSS-filer

**Teori**

Dom andra css-filerna (lightbox.css och screen.css) som anv�nds p� sidan �r statiska filer och kommer inte �ndras, vilket g�r att dom �r starka kandidater
f�r minifiering. Dessa ligger som separata filer och inte som inline-css, vilket �r bra, men inladdning kan g�ras snabbare
genom att minifiera dessa.

**Laddningstid f�re �tg�rd**

Laddningstiden av dessa filer var ganska olika vid olika tillf�llen, som mest l�g laddningstiderna p� �ver 1000ms f�r dessa
filer, som l�gst runt 50ms. Medelv�rdet jag fick fram efter tester var p� hela 430ms.

**Laddningstid efter �tg�rd**

�terigen f�r jag mer konsekvent l�ga laddningstider efter att ha minifierat css-filerna. Medelv�rdet f�r laddningen av filerna
efter minifieringen hamnade p� lite drygt 56ms, en klar f�rb�ttring. Peaken f�r laddningstiden var 176ms, vilket ligger en
bra bit under f�reg�ende medelv�rde.

**Reflektion**

Anledningen till varf�r laddningstiderna s�nks och blir mer konsekventa �r s�kerligen f�r att dessa css-filer �r ganska stora,
och att ladda in s� mycket kod med mellanrum och noga utf�rd indentering f�rl�nger laddningstiderna avsev�rt.

#### Optimering 4: Borttagning av inladdning av icke-existerande filer

**Teori**

Filen mess.php f�rs�ker anropa och anv�nda sig av tv� stycker filer som inte existerar i projektet. Att f�rs�ka anropa d�da
l�nkar och resurser kan vara kr�vande och p�verka laddningstiden.

**Laddningstid f�re �tg�rd**

H�r hade jag lite problem att f� ut n�got vettigt m�tv�rde. Under m�tningarna fick jag ut svaret "pending" p� dessa tv�
resurser, vilket verkar indikera att programmet f�rs�ker ladda in dom men lyckas inte.

**Laddningstid efter �tg�rd**

Efter att inl�nkningen av dom d�da resurserna tagits bort s� laddade sidan som vanligt. Tyv�rr hade jag inte s� mycket medel
att m�ta laddningstiden med, men �tminstonde beh�ver inte l�ngre sidan st� och tugga och f�rs�ka ladda in dessa resurser i 
on�dan.

**Reflektion**

Tyv�rr fick jag som sagt inte ut s� mycket m�tv�rden som jag hade t�nkt fr�n detta, men det k�nns �nd� som en sm�rre optimering
att inte f�rs�ka ladda in icke-existerade resurser. Det �r �ven bra att ta bort dessa kodrader d� de antingen visar p� kod
som funnits i programmet tidigare och tagits bort, eller kod som �nnu inte �r implementerad och testad.
 
#### Optimering 5: Minifiering av Javascript

**Teori**

�ven en del av Javascriptfilerna som k�rs i mess.php �r l�nga filer med mycket kod, som inte heller kommer att �ndras d� de
�r delar av statiska skript. Genom att minifiera dessa kommer f�rhoppningsvis inl�sningstiden och laddtiden f�r sidan minskas.

**Laddningstid f�re �tg�rd**

Ganska h�ga laddningstider f�r dessa filer, medelv�rdet av testerna hamnade p� strax �ver 195ms, medan peaken landade p�
ungef�r 440ms.

**Laddningstid efter �tg�rd**

Laddningstiderna fortsatte faktiskt vara h�ga �ven efter minifiering, medelv�rdet av testerna landade �ven h�r p� omkring 
190ms.

**Reflektion** 
Efter att ha sett f�rb�ttringar genom att minifiera css-filerna t�nkte jag att �ven javascript-minifiering skulle ha en bra
p�verkan p� laddningstiderna, men efter testerna verkar det som laddningstiden ligger kvar p� ungef�r densamma.

#### Optimering 6: Inline-javascript

**Teori**

Genom att l�gga in �ven javascript som ligger i html-headers b�r laddningstiderna kunna minskar.

**Laddningstid f�re �tg�rd**

F�rst fick jag en extremt l�ng laddningstid p� hela 15 sekunder, men det vet jag inte om det berodde p� sidans kod. Efter
flera tester fick jag fram ett medelv�rde p� 271ms, med toppar p� lite drygt 1000ms innan sidan cachades.

**Laddningstid efter �tg�rd**

Efter �tg�rderna verkar laddningstiderna ha s�nkts ganska bra, medelv�rdet jag fick fram efter testerna var lite drygt 134ms.
Med toppar p� runt 600ms verkar det ha p�verkat laddningstiderna ganska mycket.

**Reflektion**

Det verkar som inlinekod, och speciellt script som k�rs g�r mycket f�r att �ka laddningstiden f�r sidan. Andra f�rdelar med
detta �r s�klart att man f�r en b�ttre �verblick av koden n�r man inte anv�nder inlinekod.


TODO: Se �ver hur listobjekt skapas med AJAX