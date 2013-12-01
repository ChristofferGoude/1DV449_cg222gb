Christoffer Goude - 1DV449 - 20131201

## Laboration 1

### Reflektion

**Ni �r fria att v�lja s�tt att l�sa in och extrahera data ur webbsidorna. Motivera ditt val!**

Jag valde att att anv�nda php som programmeringsspr�k f�r att jag nyligen anv�nt det i f�reg�ende kurser, och tycker det
�r ett mycket beh�ndigt spr�k. G�llande datalagringen valde jag att anv�nda en vanlig textfil f�r att spara datat. Detta
var p� grund av att det var ren textbaserad data som skulle sparas. I en eventuell framtida applikation skulle jag nog
v�lja att anv�nda n�got annat alternativ f�r att spara datan. Jag tyckte textfilen fungerade mycket bra f�r �nd�m�let men
denna metod har s�klart sina begr�nsningar.

**Vad finns det f�r risker med applikationer som innefattar automatisk skrapning av webbsidor? N�mn minst tre stycken!**

Just nu �r ju mycket av applikationen h�rdkodad, till exempel html-m�let f�r att h�mta ut DOM-noderna. Skulle personen som
�ger sidan/uppdaterar sidan f� f�r sig att �ndra strukturen skulle pl�tsligt applikationen sluta fungera korrekt. D� g�ller
det att man har felhantering som kan snappa upp felen.

Sedan s� kan man f� tag p� mer data �n man menar om man �r ganska �ppen i algoritmen f�r skrapningen ser ut. Detta kan
dels resultera i v�ldigt stora datam�ngder och �ven att man kommer �t data som man absolut inte b�r/f�r komma �t. Dock
�r ju detta intressant f�r "illvilliga" skrapare.

**T�nk dig att du skulle skrapa en sida gjord i ASP.NET WebForms. Vad f�r extra problem skulle man kunna f� d�?**

Det jag kan t�nka mig �r att html'en som man f�r ut via ASP.NET Webforms inte �r konventionell html vilket skulle f�rsv�ra
uth�mtandet av DOM-noder och annan information.

**Har du gjort n�got med din kod f�r att vara "en god webbskrapare" med avseende p� hur du skrapar sidan?**

Det enda jag har gjort �r att inf�ra en knapp som startar skrapningen s� att scriptet inte k�rs hela tiden utan hejd.
Det man skulle kunna t�nka sig att g�ra �r till exempel att l�gga in en tidsgr�ns f�r hur ofta scriptet kan k�ras, detta
skulle kunna implementeras med en tidsgr�ns som sparas via textfil och kollas av n�r anv�ndaren vill k�ra en ny skrapning.
Sedan kan man �ven l�gga in en popup-bekr�ftelse som k�rs n�r en skrapning ska g�ras med information om dom legala 
aspekterna av en skrapning och informera om att anv�ndaren b�r ha webbsidans skapares till�telse f�r att f� skrapa.

**Vad har du l�rt dig av denna uppgift?**

Jag har l�rt mig hur man anv�nder nya funktioner i PHP f�r att plocka ut information fr�n en webbsida med DOM och xPath,
och att g�ra automatiska inloggningar och annat med cUrl. Vidare s� har jag l�rt mig mer om webbskrapning vilket �r ett
nytt koncept f�r mig, och n�gra av f�r- och nackdelarna med webbskrapning.