## Webbteknik II

### Projektid� VT 2015 - Christoffer Goude	
=============

**Projektid�**

Den mashup-applikation som jag i �r t�nkt g�ra �r en forts�ttning p� id�n som jag hade f�rra �ret. D� gjorde jag en sida som
slumpade fram ny musik �t anv�ndaren fr�n tv� olika musik-API'er. Denna id� var ganska rolig, men kom att k�nnas r�tt fattig p�
funktionalitet i slut�ndan. D�rf�r vill jag i �r skapa en applikation d�r anv�ndaren ist�llet kan s�ka p� band och/eller artister,
och sedan f� fram mycket olika information om artisten/bandet samt lyssna p� aktuella l�tar.

Efter lite efterforskning har jag kommit fram till att ha lite annan funktionalitet i applikationen �n tidigare. Ist�llet f�r att
lyrics p� sidan vill jag f� fram liknande artister och genre p� artisten. Resten av funktionaliteten ska vara som tidigare skriven.

Vad jag vill inkludera p� sidan:

+ Kort information om bandet/artisten
+ Lista med l�tar som bandet/artisten gjort
- ~~Lyrics till bandets/artistens l�tar~~
+ M�jlighet att skapa anv�ndare/logga in
+ Spara favoritquerys
+ Autocomplete
+ **(NY)** Artistens genre och liknande artister


**API'er**

F�r n�rvarande har jag inte best�mt exakt vilka API'er jag kommer anv�nda, men har unders�kt flera alternativ. Jag kommer best�mma
mig snarast f�r vilka API'er det blir och uppdatera den h�r filen efter det. F�ljande API'er �r har jag kollat p� och �verv�ger:

- ~~Soundcloud~~
- ~~Musixmatch~~
- ~~Spotify~~
- ~~ChartLyrics~~
+ Wikipedia
+ Last.fm
+ Musicbrainz

Efter att ha sett �ver vilka API'er som verkar fungera bra best�mde jag mig f�r dessa tre. Genom Musicbrainz kommer jag kunna f�
fram release-information, genom wikipedia f�r jag fram en artists biografi, och genom Last.fm kommer jag hitta genre och liknande
artister inom samma genre.

**�vrigt**

K�rbar URL: http://www.fullyawesome.se/hakkiko
Video: https://www.youtube.com/watch?v=Wizyc18nsv8&feature=youtu.be