-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               5.6.20 - MySQL Community Server (GPL)
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             8.3.0.4863
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Datenbank Struktur für filmwebsite
DROP DATABASE IF EXISTS `filmwebsite`;
CREATE DATABASE IF NOT EXISTS `filmwebsite` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `filmwebsite`;


-- Exportiere Struktur von Tabelle filmwebsite.film
DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Genre_id` int(10) unsigned NOT NULL,
  `Filmgesellschaft_id` int(10) unsigned NOT NULL,
  `Titel` varchar(50) NOT NULL DEFAULT '',
  `Erscheinungsdatum` date NOT NULL,
  `DauerInMinuten` int(10) unsigned DEFAULT NULL,
  `Bild` varchar(150) DEFAULT NULL,
  `Beschreibung` text,
  `Preis` float(8,2) DEFAULT NULL,
  `Freigabe` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Filmgesellschaft_id` (`Filmgesellschaft_id`),
  KEY `FK_film_2` (`Genre_id`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`Filmgesellschaft_id`) REFERENCES `filmgesellschaft` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `film_ibfk_2` FOREIGN KEY (`Genre_id`) REFERENCES `genre` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle filmwebsite.film: ~32 rows (ungefähr)
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id`, `Genre_id`, `Filmgesellschaft_id`, `Titel`, `Erscheinungsdatum`, `DauerInMinuten`, `Bild`, `Beschreibung`, `Preis`, `Freigabe`) VALUES
	(1, 1, 1, 'Ein Fisch namens Wanda', '1988-01-26', 108, '1_1417612412.jpg', 'Ein Gaunerquartett mißtraut sich gegenseitig. Nach einem gelungenen Juwelenraub wird George an die Polizei verraten, schafft es jedoch, die Juwelen in einem geheimen Schließfach zu deponieren und den Schlüssel dafür in Kens Aquarium zu verstecken. Wanda findet rasch den Schlüssel und versucht, unter Einsatz ihres Körpers über Georges Anwalt an das Versteck zu kommen, was der eifersüchtige Otto, den sie vor Ken als Bruder ausgibt, wiederholt torpediert. Nach zahlreichen Verwicklungen können sich Wanda und der auf Abwege geratene Anwalt mit der Beute absetzen.', 9.95, 1),
	(2, 2, 2, 'True Lies', '1994-08-18', 144, '2_1417616437.jpg', 'Wenn jemand ein Doppelleben führt, ist alles für ihn doppelt so gefährlich - diese Erfahrung muß Top-Spion Harry Tasker (ARNOLD SCHWARZENEGGER) am eigenen Leibe machen, als seine Familie in den Kampf gegen eine internationale Terroristenbande hineingezogen wird. Jahrelang konnte er tagsüber die Welt retten und abends gegenüber seiner Frau Helen die Scheinidentität eines langweiligen Computerhändlers aufrechterhalten. Doch als auch sie unter wahnwitzigen Umständen zur Geheimnisträgerin wird, bricht der Berg der Lügen, Verdächtigungen und Mißverständnisse donnernd in sich zusammen. Und Harry weiß, daß nun die Stunde der Wahrheit gekommen ist.', 12.95, 1),
	(3, 3, 3, 'Unbreakable', '2000-12-28', 106, '3_1417614392.jpg', 'Ein verheerendes Zugunglück vor den Toren von Philadelphia. 131 Tote. Nur ein Mann hat die Katastrophe überlebt...völlig unverletzt, ganz ohne Schrammen. Hatte David Dunn nur Glück? Oder gibt es einen tieferen Grund für sein Überleben? Er hat keine Antworten auf seine Fragen. Doch dann tritt der mysteriöse Elijah Price in sein Leben. Er behauptet, David Dunn sein unzerbrechlich und er wüßte warum...Seien Sie gefasst auf geheimnisvolle, übernatürliche Kräfte und ein unerwartetes Ende!', 19.95, 1),
	(4, 3, 4, 'Twelve Monkeys', '1996-03-21', 129, '4_1417616157.jpg', 'Das Jahr 2035. In den verlassenen Städten haben die Tiere die Herrschaft übernommen. Die Erdoberfläche ist entvölkert, nachdem eine Virenkatastrophe im Jahre 1996 nahezu die gesamte Menschheit dahingerafft hat. Die wenigen Überlebenden vegetieren in einem klaustrophobischen Unterweltsystem dahin. Die einzige Hoffnung auf ein besseres Leben besteht darin, einen selbstmörderischen Boten durch die Zeit zurückschicken, auf daß dieser den Ursprung der Apokalypse lokalisieren möge. Der Schwerkriminelle James Cole ist einer der Auserwählten.', 11.95, 1),
	(5, 2, 2, 'Stirb langsam 3', '1995-06-22', 131, 'stirblangsam.jpg', 'Der New Yorker Polizist John McClane (Bruce Willis) muss sich mit einer neuen Situation befassen. Denn diesmal ist er nicht der Jäger, sondern der Gejagte. Der Superverbrecher Simon (Jeremy Irons) hat den Cop für ein teuflisches Katz-und-Maus-Spiel auserkoren. Sollte McClane den Befehlen des Kriminellen nicht gehorchen, würde in New York eine Bombe nach der anderen hochgehen. Als der Elektrowarenhändler Zeus (Samuel L. Jackson) per Zufall in die explosive Geschichte hineingezogen wird, wird er zu McClanes Partner.', 8.95, 1),
	(6, 2, 5, 'Das fünfte Element', '1997-08-28', 126, '6_1417614596.jpg', 'Im 23. Jahrhundert bewegt sich das Böse in Form eines nahezu unzerstörbaren Kometen auf die Erde zu. Wird er nicht aufgehalten, wird er die Welt vernichten. Doch die Mondoshawan, ein uraltes, friedliebendes Volk, besitzen eine Waffe, das sogenannte fünfte Element, mit der der Komet vernichtet werden kann. Auf ihrem Weg zur Erde werden sie jedoch von bösen Mächten vernichtet, die den Untergang der Menschheit herbeiführen wollen. Wissenschaftlern aber gelingt es, das fast zerstörte fünfte Element wieder herzustellen. Durch eine Reihe von Zufällen wird schließlich der Taxifahrer Korben Dallas (Bruce Willis) in die Geschichte hineingezogen: In seinen Händen liegt plötzlich die Zukunft der Menschheit.', 12.95, 1),
	(7, 4, 6, 'Der Herr der Ringe - Die Gefährten', '2001-12-19', 178, '7_1417614784.jpg', 'Nach seinem 111. Geburtstag entschließt sich der Hobbit Bilbo Beutlin schweren Herzens, einen magischen Ring an seinen Neffen Frodo zu übergeben. Der große Zauberer Gandalf betraut Frodo mit der Aufgabe, den Ring in das Reich des nach der Herrschaft über Mittelerde strebenden Magiers Sauron zu bringen. Dort soll er ihn im Magma des Schicksalsberges vernichten. So macht sich Frodo in Begleitung von Gandalf, seinen Hobbit-Freunden, einem Zwerg sowie menschlichen und elbischen Gefährten auf die gefährliche Reise.', 15.95, 1),
	(8, 4, 6, 'Der Herr der Ringe - Die zwei Türme', '2002-12-18', 179, '8_1417615513.jpg', 'Nach Boromirs Tod und Gandalfs Sturz in drei Gruppen zersplittert, wehren sich die Gefährten gegen die böse Macht Saurons und Sarumans. Ringträger Frodo und Hobbit-Freund Sam treffen auf die schizophrene Kreatur Gollum, die ihnen den Weg zu Saurons Reich weist. Derweilen befreien sich Merry und Pippin von Uruk-hais und finden im Fangornwald mächtige Verbündete, während Aragorn, Gimli und Legolas sich als letzte Hoffnung für das Volk von Rohan erweisen. Dieses erwartet den Ansturm von Sarumans Teufelsheer.', 15.95, 1),
	(9, 2, 2, 'Master and Commander', '2003-11-27', 138, 'master.jpg', 'Gelenkt von Kapitän Jack Aubrey und Schiffsarzt und Geheimagent Stephen Maturin, ist das brititsche Schiff "HMS Surprise" während der Napoleonischen Kriege unterwegs auf hoher See - zwischen Kap Horn, den Galapagosinseln und Südamerika. Dabei kommt es zu einer Auseinandersetzung mit einem französischen Piratenschiff.', 18.95, 1),
	(10, 5, 4, 'Beautiful Mind, A', '2002-02-12', 138, 'beautyfullmind.jpg', 'Nach "Gladiator" spielte sich Russell Crowe mit der beeindruckenden Darstellung des verschrobenen Mathematikers erneut, wenn auch vergeblich, in greifbare Nähe einer Oscar-Prämierung. Dennoch zählte das packende Drama mit vier Academy Awards zu den großen Gewinnern des Jahres 2002. Neben der Auszeichnung als bester Film wurden unter anderem Jennifer Connellys einfühlsames Spiel als Nashs Ehefrau sowie Ron Howards Regie honoriert. Ein sehenswertes Werk.', 11.95, 1),
	(11, 2, 4, 'Gladiator', '2000-05-25', 155, '11_1417614664.jpg', 'Der römische Feldherr Maximus soll Nachfolger von Kaiser Marcus Aurelius werden. Um dies zu verhindern, ordnet dessen Sohn die Exikution von Maximus an. Ihm gelingt zwar die Flucht, doch er muss sich fortan als Gladiator verdingen. Und er hat nur ein Ziel: Rache an seinem Peiniger zu nehmen.', 9.90, 1),
	(12, 5, 2, 'Elizabeth', '1998-10-29', 124, '12_1417612936.jpg', 'Keine dröge Geschichtsstunde, sondern einen opulent inszenierten Höllentrip in die düster-grausame Welt der elisabethanischen Ära liefert der indische Regisseur Shekhar Kapur ("Bandit Queen") mit diesem atmospärisch stimmigen Historiendrama ab. Garant für das Höchstmaß an Authentizität sind die prächtige Ausstattung sowie das detailgenaue Kostüm- und Produktionsdesign, vor allem aber das vielschichtige Königinnen-Porträt der jungen Australierin Cate Blanchett ("Oscar und Lucinda").', 9.90, 1),
	(13, 5, 7, 'talentierte Mr. Ripley, Der', '2000-02-17', 139, '13_1417616584.jpg', 'Die Highsociety; das ist der Traum des Arbeiterkindes Tom Ripley. Eine Möglichkeit tut sich auf, als ihn ein reicher Reeder für seinesgleichen hält und nach Italien schickt, um seinen Sohn Dickie vom Dolce vita zurück ins Geschäftsleben zu bugsieren. Stattdessen lässt sich Tom von Dickie und dessen Verlobter Marge ins Szeneleben einführen, das er nicht mehr verlassen will, koste es, was es wolle.', 9.90, 1),
	(14, 2, 8, 'Matrix', '1999-06-17', 136, '14_1417615817.jpg', 'Der Hacker Neo wird übers Internet von einer geheinmisvollen Untergrund-Organisation kontaktiert. Der Kopf der Gruppe - der gesuchte Terrorist Morpheus - weiht ihn in ein entsetzliches Geheimnis ein: Die Realität, wie wir sie erleben, ist nur eine Scheinwelt. In Wahrheit werden die Menschen längst von einer unheimlichen virtuellen Macht beherrscht - der Matrix', 9.90, 1),
	(15, 1, 9, 'Chocolat', '2001-03-15', 121, 'chocolat.jpg', 'In einem verschlafenen französischen Städtchen eröffnet Vianne mitten in der Fastenzeit eine Chocolaterie. Sie verwöhnt die Menschen mit Herzlichkeit, Hilfsbereitschaft und süßen Genüssen. Schnell bricht Viannes Freigeist verkrustete Strukturen auf und zwingt den Sittenwächter des Orts zu aggressivem Handeln.', 12.95, 1),
	(16, 2, 8, 'Red Planet', '2001-03-01', 106, '16_1417616706.jpg', 'Mitte des 21.Jahrhunderts droht der Erde eine ökologische Katastrophe. Die letzte Hoffnung der Menschheit ist "Der rote Planet". Ein Team der besten Wissenschaftler macht sich auf den Weg zum Mars, um dessen Kolonisierung vorzubereiten. Auf ihrer Mission muss die Crew aber feststellen, dass der Mars zwar eine Wüste ist, aber keineswegs unbewohnt. Es lauert eine Gefahr auf sie, mit der niemand gerechnet hat: Sie kommt ohne einen Laut, ohne Warnung und ohne Ausweg.', 12.95, 1),
	(17, 5, 8, 'Othello', '1995-01-01', 123, '17_1417616878.jpg', 'Nach Verfilmungen von Orson Welles, Stuart Burge und Franco Zeffirelli nimmt sich nun Bühnendarsteller Oliver Parker in seinem Regie-Debüt des klassischen Shakespeare-Stoffes an. Er darf für sich in Anspruch nehmen, der erste zu sein, der die Titelrolle mit einem Schwarzen - dem großartig aufspielenden Laurence Fishburne - besetzt. Überhaupt liegt die Qualität dieser Othello-Adaption vor allem bei dem exquisiten Schauspielensemble, dem auch Kenneth Branagh angehört. Tip der Woche für den klassischen Cineasten.', 5.90, 1),
	(18, 6, 7, 'Event Horizon', '1997-01-01', 95, 'eventhorizont.jpg', 'Der englische Regisseur Paul Anderson, der bereits mit seinem ersten Hollywood-Actioner "Mortal Kombat" einen großen Hit landen konnte, hat mit diesem spektakulären Zukunftsschocker einen originellen Genre-Mix in Szene gesetzt, in dem er Horror-, SF- und Thriller-Elemente geschickt miteinander vermischt. Visuell von den beklemmenden Bildern des "Aliens"-Kameramann Adrian Biddles effektiv unterstützt, gibt ein hochkarätiges Schauspieler-Ensemble um "Black Cinema"-Star Laurence Fishburne ("Boyz N the Hood") eine bestechende Vorstellung ab.', 8.95, 1),
	(23, 4, 2, 'Avatar - Aufbruch nach Pandora', '2009-12-17', 171, 'avatar.jpg', 'Dem querschnittsgelähmten Kriegsveteranen Jake Sully (Sam Worthington) wird die Chance offeriert wieder an einem Einsatz teilzunehmen: Auf dem Planeten Pandora gibt es große Vorkommen des wichtigen Rohstoffs Unobtanium. Die Umwelt des Planeten ist jedoch ebenso schön wie tödlich für den Menschen, deshalb wurde an dem Projekt AVTR gearbeitet dessen Ziel es ist menschliche DNA mit dem der Ureinwohner, den Na\'vi, zu mischen. So wurden AVaTaRe erschaffen, die es den Menschen ermöglichen sich gefahrlos in der Umwelt des Paneten zu bewegen. Jake, der in seiner Verkörperung als Avatar auch wieder gehen kann, macht schließlich die Bekanntschaft der Na\'vi-Prinzessin Neytiri (Zoe Saldana), diese zeigt ihm deren Kultur, Vorlieben und das Leben in Einklang mit der Natur.', 12.95, 1),
	(25, 2, 8, 'Inception', '2010-07-29', 148, '25_1417604939.jpg', 'Dom Cobb (Leonardo DiCaprio) ist ein begnadeter Dieb, der absolut beste auf dem Gebiet der Extraktion, einer kunstvollen und gefährlichen Form des Diebstahls: Cobb stiehlt wertvolle Geheimnisse aus den Tiefen des Unterbewusstseins, wenn der Verstand am verwundbarsten ist – während der Traumphase. Dank seiner seltenen Begabung ist Cobb in der heimtückischen, neuen Welt der Industriespionage heiß begehrt. Doch diese Existenz hat auch ihre Schattenseiten: er wird auf der ganzen Welt gesucht und hat alles verloren, was er liebte.', 10.90, 1),
	(26, 2, 10, 'Django Unchained', '2013-01-17', 141, 'django.jpg', 'Angesiedelt in den Südstaaten, zwei Jahre vor dem Bürgerkrieg, erzählt DJANGO UNCHAINED die Geschichte von Django, einem Sklaven, dessen brutale Vergangenheit mit seinen Vorbesitzern dazu führt, dass er dem deutschstämmigen Kopfgeldjäger Dr. King Schultz Auge in Auge gegenübersteht. Schultz verfolgt gerade die Spur der mordenden Brittle-Brüder und nur Django kann ihn ans Ziel führen. Der unorthodoxe Schultz sichert sich daher Djangos Hilfe, indem er ihm verspricht, ihn zu befreien, nachdem er die Brittles gefangen genommen hat – tot oder lebendig.', 14.95, 1),
	(27, 2, 4, 'Inglourious Basterds', '2009-08-20', 154, 'basterds.jpg', 'Lt. Aldo Raine befehligt einen Trupp jüdischer Soldaten, der hinter feindlichen Linien auf französischem Boden Angst und Schrecken unter deutschen Soldaten verbreitet. Unter britischem Kommando lassen sie sich für ein Himmelfahrtskommando einspannen, führende Nazis bei einer Filmpremiere in einem Pariser Kino zu töten. Die Betreiberin des Kinos, die junge Jüdin Shosanna Dreyfuss, hat eigene Pläne für den Abend: Vor Jahren ist sie verschont worden, als Oberst Hans Landa ihre Familie massakrierte. Jetzt will sie Rache.', 14.95, 1),
	(28, 3, 8, 'Dark Knight Rises', '2012-07-26', 164, 'darkknight.jpg', 'Tom Hardy spielt in The Dark Knight Rises den Hünen Bane, der in den Comics im Gefängnis aufgewachsen ist und Batmans Gegenspieler wurde. Durch Experimente mit der Droge Venom gelingt Bane zu übermenschlicher Stärke, die ihn gleichzeitig in eine Sucht treiben. Intelligent, gerissen, skrupellos: Banes Charakter ist zwischen seinem Genie und Wahnsinn zerrissen. Im Comic besiegt Bane Batman in dem er ihm das Rückgrat bricht. Somit ist Batman fortan an einem Rollstuhl gefesselt und Bane wird zu \'The Man who Broke the Bat\'.', 14.95, 1),
	(29, 4, 8, 'Hobbit - Smaugs Einöde, Der', '2013-12-12', 161, 'hobbit2.jpg', 'Nachdem der Hobbit Bilbo Beutlin (Martin Freeman) und seine Reisegesellschaft aus 13 Zwergen, angeführt von dem Zwergenkönig Thorin Eichenschild (Richard Armitage) und dem Zauberer Gandalf (Ian McKellen), mit Hilfe der Adler vor den Angriffen der Orks gerettet wurden, stehen sie nun vor dem zweiten Abschnitt ihrer Reise. Sie müssen den Düsterwald durchqueren, um in das alte Zwergenkönigreich Erebor vorzudringen. Dort werden sie jedoch nicht nur von Riesenspinnen bedroht, sondern fallen auch in die Hände der Waldelben, die in einem alten Konflikt mit den Zwergen stehen. Der Zwergenkönig Thranduil (Lee Pace) ist nicht eben erfreut, daß Thorin seinen Thron zurückfordert - doch Bilbo kann den Zwergen helfen und per Fass und Fluß setzt man seine Reise zur Seestadt Esgaroth fort, wo Ihnen der Bürgermeister (Stephen Fry) einen freundlicheren Empfang bereitet, weil er glaubt, so die Bevölkerung mit der Aussicht auf kommenden Reichtum unter Kontrolle behalten zu können. Doch Esgaroth lebt vor allem in Angst vor dem Drachen Smaug - und der Schiffer Bard befürchtet das Schlimmste, wenn die Zwerge den Drachen wecken. Doch Thorin läßt sich nicht mehr aufhalten: es gilt, in den einsamen Berg einzudringen und damit kommt Bilbos eigentliche Mission als vermeintlicher Meisterdieb zum Tragen.', 14.95, 1),
	(30, 1, 11, 'Eiskönigin - Völlig unverfroren, Die', '2013-11-28', 102, 'eiskoenigin.jpg', 'Durch eine Prophezeiung fällt das Königreich Arendelle in einen ewig währenden Winter. Um gegen das kalte Schicksal des Reichs anzukämpfen und den Frostzauber aufzuheben, schließt sich die Königstochter Anna (Kristen Bell) mit dem schroffen Kristoff (Jonathan Groff) zusammen, einem draufgängerischen Bergbewohner. Zusätzlich stehen ihnen noch das treue Rentier Sven und der tollpatschige Schneemann Olaf (Josh Gad) zur Seite. Ihr Vorhaben kann ihnen nur gelingen, wenn sie Annas Schwester Elsa (Idina Menzel), die mittlerweile als Schneekönigin bekannt ist, ausfindig machen und besiegen. Auf ihrer wagemutigen Reise müssen sie gegen geheimnisvolle Kreaturen ankämpfen, sich gegen scharze Magie durchsetzen und dem Angriff der Elemente strotzen. Hinter jeder Ecke lauert eine neue Gefahr und ihre Reise wird zum Wettlauf gegen die Zeit.', 10.95, 1),
	(31, 7, 12, 'Tribute von Panem - Catching Fire, Die', '2013-11-21', 146, 'tribute.jpg', 'Katniss Everdeen (Jennifer Lawrence) und Peeta Mellark (Josh Hutcherson) haben es geschafft, die 74. Hungerspiele von Panem durch einen Trick gemeinsam zu gewinnen und am Leben zu bleiben - was ihnen die Regierung unter der Führung von Präsident Snow (Donald Sutherland) nicht vergibt, war der Sieg doch erzwungen, weil sich erste Rebellionen in den Distrikten bemerkbar machten. Jetzt zwingt Snow die Gewinner zu einer Propagandareisetour, um die Regierung zu preisen und zu stärken, während sie das massenwirksame Liebespaar mimen. Doch das weder Peeta noch Katniss davon überzeugt sind, bemerkt auch das Volk in den Distrikten. Aufstände drohen. Gerade will das System die beiden Gewinner liquidieren, verfällt der neue Spielleiter Heavensbee (Philip Seymour Hoffman) auf die Idee, stattdessen die Gewinner der letzten 24 Hungerspiele gegeneinander antreten zu lassen. Prompt finden sich Peeta und Katniss bald wieder in der Arena wieder - diesmal jedoch gegen ein Team von erfolgreichen Kämpfern und Killern.', 17.98, 1),
	(32, 7, 8, 'Gravity', '2013-10-03', 93, 'gravity.jpg', 'Ryan Stone (Sandra Bullock) und Matt Kowalski (George Clooney) befinden sich mit einem Kollegen bei einem Außeneinsatz seitlich ihres Raumschiffs. Während Kowalski sich die Zeit mit kleinen Rundfahrten im Raumanzug vertreibt, ist die Astro-Physikerin so in ihre Arbeit vertieft, dass sie nur langsam reagiert, als sie vor herum fliegenden Trümmern gewarnt werden. Bevor sie sich in Sicherheit bringen kann, wird sie ins All hinausgeschleudert, kann aber von Kowalski eingeholt werden.\r\n\r\nWieder zurück müssen sie feststellen, dass ihr Kollege und die übrige Besatzung tot sind, da die Trümmer ein großes Loch in die Außenhaut des Raumschiffs gerissen hatten. Kowalski hat die Idee, mit seinem Rückenantrieb zu einer leerstehenden, russischen Raumstation zu fliegen, um von dort weiter zu einer besetzten chinesischen Station zu gelangen, aber sie haben nur für einen Versuch Energie, um dort anzudocken.', 12.95, 1),
	(33, 1, 10, 'Das ist das Ende', '2013-08-08', 107, 'dasende.jpg', 'Jay Baruchel (Jay Baruchel) ist nach einem Jahr wieder in L.A., um seinen alten Freund Seth (Seth Rogen) zu besuchen. Auf dem Plan stehen nur Burger, Gras und Computerspiele, also das volle Programm zum abhängen. Doch Seth hat abends noch die Idee James Franco (James Franco) in dessen neuen Haus zu besuchen, wo er mit Freunden eine Party feiert. Jay hat absolut keine Lust dazu, da er weder Hollywood, noch Franco und dessen Kumpels leiden kann, aber Seth verspricht ihm, sich dort um ihn zu kümmern.\r\n\r\nDoch das klappt nicht und die Party entwickelt sich so, wie Jay es sich vorgestellt hatte - Jonah Hill (Jonah Hill) geht ihm mit seiner aufgesetzten Freundlichkeit auf die Nerven, Craig Robinson (Craig Robinson) singt schlüpfrige Lieder und Michael Cera (Michael Cera) treibt es wild auf der Toilette. Alle haben Fun, aber Jay keine Lust mehr, weshalb er Seth mit einem Trick nach außen lockt, um mit ihm in Ruhe darüber sprechen zu können. Außerdem wollte er sich Zigaretten holen, aber als sie in dem Laden sind, bricht plötzlich ein schweres Erdbeben los, dass sich nur als die Vorhut für etwas viel Schlimmeres erweist.', 9.98, 1),
	(34, 6, 8, 'Conjuring - Die Heimsuchung', '2013-08-01', 112, 'conjuring.jpg', 'Anfang der 70er Jahre haben sich Ed (Patrick Wilson) und Lorraine Warren (Vera Farmiga) als Parapsychologen und Vorortermittler in übernatürlichen Fällen einen Namen gemacht, ihre Untersuchungen sind soweit angesehen, daß sie sogar an Hochschulen Vorträge halten dürfen. Doch ihr nächster Fall wird zu einer harten Nuss: Roger Perron (Ron Livingston), seine Frau Carolyn (Lili Taylor) und ihre fünf Töchter ziehen in ein altes Haus in einer ländlichen Gegen von Rhode Island und sehen sich alsbald recht agressiven Phänomenen ausgesetzt, die alle Familienmitglieder in Angst und Schrecken versetzten. Die Warrens nehmen sich des Falls an und versuchen anhand der Geschichte des Hauses herauszufinden, warum es dort spukt bzw. woher die dämonischen Präsenzen kommen - nur so bekommen sie eine Erlaubnis, das Haus exorzieren zu lassen. Doch die Intensität nimmt zu und je weiter die Warrens ermitteln, desto mehr belastet der Fall Lorraine. Und schließlich bricht die Hölle los.', 9.98, 1),
	(35, 1, 11, 'Monster Uni, Die', '2013-06-20', 104, 'monster.jpg', 'Nächtens aus dem Schrank stolpern und kleine Kinder erschrecken, darin hat es das Monsterpaar Mike und Sully zur Meisterschaft gebracht. Aber aller Anfang war schwer, blickt man in der Zeit zurück, als beide noch jung waren und das Schreck- und Kreischhandwerk erst lernen mußten. Mike, der einäugige Kopf auf zwei Beinen, war damals noch ein motivierter, aber unglücklich agierender Streber an der Monster-Universität - und Sully, sehr beliebt, aber schlecht an Leistungen, war der Uni-Star, der den Kleinen ständig auf dem Kieker hatte. Doch irgendwann kommt der Punkt, als es nicht mehr weitergeht: als Mike und Sully aus dem Schreck-Programm gestrichen werden, bleibt ihnen nur der Ausweg über die Hintertür. Dazu müssen sie aber bei den Uni-Schreck-Spielen einen großen Sieg erringen und da ihr Ansehen am Boden ist, bleibt nur die unangesagteste Studentenverbindung übrig, um ans Ziel zu kommen...zusammenraufen und sich selbst überwinden ist angesagt.', 9.98, 1),
	(36, 5, 13, 'Place Beyond the Pines, The', '2013-06-13', 140, 'theplace2.jpg', 'Luke (Ryan Gosling) fährt Motorrad-Stunts auf einem Jahrmarkt, mit dem er über die Lande zieht. Nach einer Aufführung wartet Romina (Eva Mendes) auf ihn, mit der er vor einem Jahr, als er das letzte Mal dort war, eine kurze Affäre hatte. Sie lässt sich von ihm nach Hause fahren, macht aber deutlich, dass sie einen anderen Mann hat und ihn nur kurz wieder sehen wollte. Er akzeptiert das, will sie am nächsten Tag aber noch einmal besuchen, bevor er weiter zieht. Doch er trifft nur ihre Mutter an, die einen kleinen Jungen auf dem Arm trägt - seinen Sohn Jason , wie sie ihm sagt.\r\n\r\nEr fährt zu dem Restaurant, in dem Romina arbeitet und stellt sie zur Rede, aber sie erwartet von ihm nichts - Jason hätte einen Vater, der für sie sorgt. Doch Luke entscheidet schnell, beendet seinen Job auf dem Jahrmarkt und will sich eine Arbeit besorgen, um sich selbst um seine kleine Familie kümmern. Er lernt Robin (Ben Mendelsohn) kennen, in dessen kleiner Werkstatt er unterkommt, aber diese wirft kaum Geld ab. Robin erzählt ihm, dass er vor 12 Jahren Banken ausgeraubt hätte bis ihm die Sache zu heiß geworden wäre. Dank Lukes Fähigkeiten auf dem Motorrad gelingt der erste Raub problemlos, weshalb er erstmals in der Lage ist, etwas für Romina und seinen kleinen Sohn zu kaufen. Einen Moment lang träumt er von eine heilen Familie, aber dann übertreibt er es mit den Banküberfällen und gerät in Konflikt mit dem ehrgeizigen Polizisten Avery (Bradley Cooper).', 11.98, 1),
	(37, 7, 7, 'Star Trek: Into Darkness', '2013-05-09', 132, 'startrek.jpg', 'Bei einer Exkursion der Enterprise auf einen fremden Planeten kommt Captain James T.Kirk (Chris Pine) in einen Gewissenskonflikt. Um zu verhindern, dass die dort lebenden Ureinwohner durch einen Vulkan ausgelöscht werden, versuchen er und seine Männer den Ausbruch rechtzeitig zu stoppen. Dafür landet der 1.Offizier Mr.Spock (Zachary Quinto) mitten in der Lava, um diese mit einem speziellen Gerät zu versteinern. Doch die Hitze setzt ihm trotz seines Anzugs so stark zu, dass er nicht mehr selbstständig zur Enterprise zurückkehren kann. Gegen seinen Willen rettet ihn Kirk, indem er mit der Enterprise auftaucht und in an Bord beamt. Damit hatte er gegen die Vorschriften der Raumfahrtbehörde verstoßen, die jede Einmischung in das Leben anderer Kulturen untersagt, weshalb das Raumschiff von keinem der Ureinwohner hätte gesehen werden dürfen.\r\n\r\nAls Kirk und Spock nach ihrer Rückkehr zu Admiral Pike (Bruce Grennwood) gerufen werden, rechnet Kirk noch mit dem Auftrag, fünf Jahre den Weltraum erkunden zu dürfen, doch stattdessen wird er degradiert und ihm die Enterprise weg genommen. Obwohl er Spock mit seiner Aktion das Leben gerettet hatte, hatte dieser die Vorgänge ehrlich protokolliert. Dank Pikes Fürsprache darf er wenigstens als 1.Offizier unter seinem Kommando auf der Enterprise dienen, aber die kommenden Ereignisse machen einen Strich durch diese Rechnung. Erst explodiert eine Bombe in einer wichtigen Weltraumbehörde und tötet viele Menschen, dann werden die Raumschiffkapitäne und ihre 1.Offiziere direkt angegriffen.', 8.98, 1);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle filmwebsite.filmgesellschaft
DROP TABLE IF EXISTS `filmgesellschaft`;
CREATE TABLE IF NOT EXISTS `filmgesellschaft` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle filmwebsite.filmgesellschaft: ~13 rows (ungefähr)
/*!40000 ALTER TABLE `filmgesellschaft` DISABLE KEYS */;
INSERT INTO `filmgesellschaft` (`id`, `Name`) VALUES
	(1, 'MGM'),
	(2, '20th Century Fox'),
	(3, 'Touchstone Pictures'),
	(4, 'Universal Pictures'),
	(5, 'Gaumont'),
	(6, 'New Line Cinema'),
	(7, 'Paramount'),
	(8, 'Warner'),
	(9, 'Miramax'),
	(10, 'Sony Pictures'),
	(11, 'Walt Disney'),
	(12, 'Lionsgate'),
	(13, 'Studiocanal');
/*!40000 ALTER TABLE `filmgesellschaft` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle filmwebsite.genre
DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Beschreibung` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle filmwebsite.genre: ~7 rows (ungefähr)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id`, `Name`, `Beschreibung`) VALUES
	(1, 'Comedy', NULL),
	(2, 'Action', NULL),
	(3, 'Thriller', NULL),
	(4, 'Fantasy', NULL),
	(5, 'Drama', NULL),
	(6, 'Horror', NULL),
	(7, 'Science Fiction', NULL);
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle filmwebsite.hauptdarsteller
DROP TABLE IF EXISTS `hauptdarsteller`;
CREATE TABLE IF NOT EXISTS `hauptdarsteller` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) NOT NULL,
  `Vorname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle filmwebsite.hauptdarsteller: ~12 rows (ungefähr)
/*!40000 ALTER TABLE `hauptdarsteller` DISABLE KEYS */;
INSERT INTO `hauptdarsteller` (`id`, `Name`, `Vorname`) VALUES
	(1, 'Willis', 'Bruce'),
	(2, 'Astin', 'Sean'),
	(3, 'Crowe', 'Russell'),
	(4, 'Blanchett', 'Cate'),
	(5, 'Moss', 'Carrie-Anne'),
	(6, 'Fishburne', 'Laurence'),
	(7, 'Lee Curtis', 'Jamie'),
	(8, 'DiCaprio', 'Leonardo'),
	(9, 'Waltz', 'Christoph'),
	(10, 'Pitt', 'Brad'),
	(11, 'Bale', 'Christian'),
	(12, 'Saldana', 'Zoe'),
	(13, 'Freeman', 'Martin'),
	(14, 'McKellen', 'Ian'),
	(15, 'Lee', 'Christopher'),
	(16, 'Bell', 'Kristen'),
	(17, 'Menzel', 'Idina'),
	(18, 'Lawrence', 'Jennifer'),
	(19, 'Hemsworth', 'Liam'),
	(20, 'Quaid', 'Jack'),
	(21, 'Bullock', 'Sandra'),
	(22, 'Clooney', 'George'),
	(23, 'Franco', 'James'),
	(24, 'Hill', 'Jonah'),
	(25, 'Rogen', 'Seth'),
	(26, 'Farmiga', 'Vera'),
	(27, 'Wilson', 'Patrick'),
	(28, 'Taylor', 'Lili'),
	(29, 'Crystal', 'Billy'),
	(30, 'Goodman', 'John'),
	(31, 'Buscemi', 'Steve'),
	(32, 'Gosling', 'Ryan'),
	(33, 'Van Hook', 'Craig'),
	(34, 'Mendes', 'Eva'),
	(35, 'Pine', 'Chris'),
	(36, 'Quinto', 'Zachary'),
	(38, 'Oldman', 'Gary'),
	(39, 'Jovovich', 'Milla'),
	(40, 'Foxx', 'Jamie'),
	(41, 'Phoenix', 'Joaquin'),
	(42, 'Nielsen', 'Connie'),
	(43, 'Gordon-Levitt', 'Joseph'),
	(44, 'Page', 'Ellen'),
	(45, 'Cleese', 'John'),
	(46, 'Kline', 'Kevin'),
	(47, 'Worthington', 'Sam'),
	(48, 'Weaver', 'Sigourney'),
	(49, 'Rush', 'Geoffrey'),
	(50, 'Jackson', 'Samuel L.'),
	(51, 'Wood', 'Elijah'),
	(52, 'Bloom', 'Orlando'),
	(53, 'Stowe', 'Madeleine');
/*!40000 ALTER TABLE `hauptdarsteller` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle filmwebsite.spielt
DROP TABLE IF EXISTS `spielt`;
CREATE TABLE IF NOT EXISTS `spielt` (
  `Film_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Hauptdarsteller_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Rolle` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`Film_id`,`Hauptdarsteller_id`),
  KEY `Film_id` (`Film_id`),
  KEY `Hauptdarsteller_id` (`Hauptdarsteller_id`),
  CONSTRAINT `spielt_ibfk_1` FOREIGN KEY (`Film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spielt_ibfk_2` FOREIGN KEY (`Hauptdarsteller_id`) REFERENCES `hauptdarsteller` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Exportiere Daten aus Tabelle filmwebsite.spielt: ~28 rows (ungefähr)
/*!40000 ALTER TABLE `spielt` DISABLE KEYS */;
INSERT INTO `spielt` (`Film_id`, `Hauptdarsteller_id`, `Rolle`) VALUES
	(1, 7, 'Wanda Gershwitz'),
	(1, 45, 'Archie Leach'),
	(1, 46, 'Otto'),
	(2, 7, 'Helen Tasker'),
	(3, 1, 'David Dunn'),
	(3, 50, 'Elijah Price'),
	(4, 1, 'James Cole'),
	(4, 10, 'Jeffrey Goines'),
	(4, 53, 'Kathryn Railly'),
	(5, 1, 'John McClane'),
	(6, 1, 'Major Korben Dallas'),
	(6, 38, 'Jean-Baptiste Emanuel Zorg'),
	(6, 39, 'Leeloo'),
	(7, 2, 'Sam Gamgee'),
	(7, 4, 'Galadriel'),
	(7, 14, 'Gandalf'),
	(7, 15, 'Saruman'),
	(7, 51, 'Frodo Baggins'),
	(7, 52, 'Legolas Greenleaf'),
	(8, 2, 'Sam Gamgee'),
	(8, 4, 'Galadriel'),
	(8, 14, 'Gandalf der Graue'),
	(8, 51, 'Frodo Baggins'),
	(9, 3, 'Capt. Jack Aubrey'),
	(10, 3, 'John Nash'),
	(11, 3, 'Maximus'),
	(11, 41, 'Commodus'),
	(11, 42, 'Lucilla'),
	(12, 4, 'Elizabeth I'),
	(12, 49, 'Sir Francis Walsingham'),
	(13, 4, 'Meredith Logue'),
	(14, 5, 'Trinity'),
	(14, 6, 'Morpheus'),
	(15, 5, 'Caroline Clairmont'),
	(16, 5, 'Cmdr. Kate Bowman'),
	(17, 6, 'Othello'),
	(18, 6, 'Captain Miller'),
	(23, 12, 'Neytiri'),
	(23, 47, 'Jake Sully'),
	(23, 48, 'Grace'),
	(25, 8, 'Cobb'),
	(25, 43, 'Arthur'),
	(25, 44, 'Ariadne'),
	(26, 8, 'Calvin Candie'),
	(26, 9, 'Dr. King Schultz'),
	(26, 40, 'Django'),
	(27, 9, 'Col. Hans Landa'),
	(27, 10, 'Lt. Aldo Raine'),
	(28, 11, 'Bruce Wayne'),
	(29, 13, 'Bilbo'),
	(29, 14, 'Gandalf'),
	(29, 15, 'Saruman'),
	(30, 16, 'Anna'),
	(30, 17, 'Elsa'),
	(31, 18, 'Katniss Everdeen'),
	(31, 19, 'Gale Hawthorne'),
	(31, 20, 'Marvel'),
	(32, 21, 'Ryan Stone'),
	(32, 22, 'Matt Kowalski'),
	(33, 23, 'James Franco'),
	(33, 24, 'Jonah Hill'),
	(33, 25, 'Seth Rogen'),
	(34, 26, 'Lorraine Warren'),
	(34, 27, 'Ed Warren'),
	(34, 28, 'Carolyn Perron'),
	(35, 29, 'Mike'),
	(35, 30, 'Sullivan'),
	(35, 31, 'Randy'),
	(36, 32, 'Luke'),
	(36, 33, 'Jack'),
	(36, 34, 'Romina'),
	(37, 12, 'Uhura'),
	(37, 35, 'Kirk'),
	(37, 36, 'Spock');
/*!40000 ALTER TABLE `spielt` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
