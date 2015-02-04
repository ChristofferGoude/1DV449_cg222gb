## Webbteknik II

### Projektidé VT 2015 - Christoffer Goude	
=============

**Projektidé**

Den mashup-applikation som jag i år tänkt göra är en fortsättning på idén som jag hade förra året. Då gjorde jag en sida som
slumpade fram ny musik åt användaren från två olika musik-API'er. Denna idé var ganska rolig, men kom att kännas rätt fattig på
funktionalitet i slutändan. Därför vill jag i år skapa en applikation där användaren istället kan söka på band och/eller artister,
och sedan få fram mycket olika information om artisten/bandet samt lyssna på aktuella låtar.

Efter lite efterforskning har jag kommit fram till att ha lite annan funktionalitet i applikationen än tidigare. Istället för att
lyrics på sidan vill jag få fram liknande artister och genre på artisten. Resten av funktionaliteten ska vara som tidigare skriven.

Vad jag vill inkludera på sidan:

+ Kort information om bandet/artisten
+ Lista med låtar som bandet/artisten gjort
- ~~Lyrics till bandets/artistens låtar~~
+ Möjlighet att skapa användare/logga in
+ Spara favoritquerys
+ Autocomplete
+ **(NY)** Artistens genre och liknande artister


**API'er**

För närvarande har jag inte bestämt exakt vilka API'er jag kommer använda, men har undersökt flera alternativ. Jag kommer bestämma
mig snarast för vilka API'er det blir och uppdatera den här filen efter det. Följande API'er är har jag kollat på och överväger:

- ~~Soundcloud~~
- ~~Musixmatch~~
- ~~Spotify~~
- ~~ChartLyrics~~
+ Wikipedia
+ Last.fm
+ Musicbrainz

Efter att ha sett över vilka API'er som verkar fungera bra bestämde jag mig för dessa tre. Genom Musicbrainz kommer jag kunna få
fram release-information, genom wikipedia får jag fram en artists biografi, och genom Last.fm kommer jag hitta genre och liknande
artister inom samma genre.

**Övrigt**

Körbar URL: http://www.fullyawesome.se/hakkiko
Video: https://www.youtube.com/watch?v=Wizyc18nsv8&feature=youtu.be