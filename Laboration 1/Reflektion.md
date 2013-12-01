Christoffer Goude - 1DV449 - 20131201

## Laboration 1

### Reflektion

**Ni är fria att välja sätt att läsa in och extrahera data ur webbsidorna. Motivera ditt val!**

Jag valde att att använda php som programmeringsspråk för att jag nyligen använt det i föregående kurser, och tycker det
är ett mycket behändigt språk. Gällande datalagringen valde jag att använda en vanlig textfil för att spara datat. Detta
var på grund av att det var ren textbaserad data som skulle sparas. I en eventuell framtida applikation skulle jag nog
välja att använda något annat alternativ för att spara datan. Jag tyckte textfilen fungerade mycket bra för ändåmålet men
denna metod har såklart sina begränsningar.

**Vad finns det för risker med applikationer som innefattar automatisk skrapning av webbsidor? Nämn minst tre stycken!**

Just nu är ju mycket av applikationen hårdkodad, till exempel html-målet för att hämta ut DOM-noderna. Skulle personen som
äger sidan/uppdaterar sidan få för sig att ändra strukturen skulle plötsligt applikationen sluta fungera korrekt. Då gäller
det att man har felhantering som kan snappa upp felen.

Sedan så kan man få tag på mer data än man menar om man är ganska öppen i algoritmen för skrapningen ser ut. Detta kan
dels resultera i väldigt stora datamängder och även att man kommer åt data som man absolut inte bör/får komma åt. Dock
är ju detta intressant för "illvilliga" skrapare.

**Tänk dig att du skulle skrapa en sida gjord i ASP.NET WebForms. Vad för extra problem skulle man kunna få då?**

Det jag kan tänka mig är att html'en som man får ut via ASP.NET Webforms inte är konventionell html vilket skulle försvåra
uthämtandet av DOM-noder och annan information.

**Har du gjort något med din kod för att vara "en god webbskrapare" med avseende på hur du skrapar sidan?**

Det enda jag har gjort är att införa en knapp som startar skrapningen så att scriptet inte körs hela tiden utan hejd.
Det man skulle kunna tänka sig att göra är till exempel att lägga in en tidsgräns för hur ofta scriptet kan köras, detta
skulle kunna implementeras med en tidsgräns som sparas via textfil och kollas av när användaren vill köra en ny skrapning.
Sedan kan man även lägga in en popup-bekräftelse som körs när en skrapning ska göras med information om dom legala 
aspekterna av en skrapning och informera om att användaren bör ha webbsidans skapares tillåtelse för att få skrapa.

**Vad har du lärt dig av denna uppgift?**

Jag har lärt mig hur man använder nya funktioner i PHP för att plocka ut information från en webbsida med DOM och xPath,
och att göra automatiska inloggningar och annat med cUrl. Vidare så har jag lärt mig mer om webbskrapning vilket är ett
nytt koncept för mig, och några av för- och nackdelarna med webbskrapning.