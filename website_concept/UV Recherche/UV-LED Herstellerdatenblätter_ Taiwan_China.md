# **Analysebericht: Transparenz technischer Spezifikationen asiatischer UV-LED-Hersteller – Eine ingenieurwissenschaftliche Evaluation**

## **1\. Einleitung und technischer Kontext**

Die Integration von Ultraviolett-Leuchtdioden (UV-LEDs) in industrielle Fertigungsprozesse markiert einen der signifikantesten technologischen Wandel in der Aushärtungschemie und Anlagentechnik des 21\. Jahrhunderts. Während der Übergang von konventionellen Quecksilberdampflampen zu Halbleiterlichtquellen massive Vorteile hinsichtlich Energieeffizienz, thermischer Belastung des Substrats und Lebensdauer verspricht, stellt er Ingenieure und Systemintegratoren vor neue Herausforderungen bei der Interpretation technischer Daten.

Traditionelle Datenblätter für Bogenlampen basierten oft auf einer integralen Leistungsangabe (W/cm) über ein breites Spektrum. Im Gegensatz dazu sind UV-LEDs quasi-monochromatische, diskrete Punktstrahler, deren Performance extrem von der thermischen Konditionierung und der optischen Strahlformung abhängt. Ein bloßer Wert der „Peak Irradiance“ (Spitzenbestrahlungsstärke) direkt am Austrittsfenster ist für komplexe industrielle Anwendungen – wie den hochgeschwindigkeitshärtenden Offsetdruck, die Präzisionsverklebung in der Medizintechnik oder die Beschichtung optischer Fasern – vollkommen unzureichend.

Der vorliegende Forschungsbericht untersucht den asiatischen Markt für UV-LED-Systeme mit einem spezifischen Fokus auf Hersteller in Taiwan und Festlandchina. Das Ziel dieser Untersuchung ist nicht primär die Identifikation der leistungsstärksten Systeme, sondern die Selektion jener Hersteller, die eine technische Transparenz an den Tag legen, die eine präzise ingenieurmäßige Auslegung ermöglicht. Basierend auf den strengen Kriterien des Auftraggebers wurden Unternehmen evaluiert, die detaillierte Daten zur **Abhängigkeit der Bestrahlungsstärke vom Arbeitsabstand (Working Distance, WD)**, zur **räumlichen Abstrahlcharakteristik (Radiation Profile)** und zu den **thermodynamischen Anforderungen wassergekühlter Systeme (Kühlleistung/Durchflussraten)** veröffentlichen.

Die Analyse identifizierte fünf Hersteller, die diese Kriterien erfüllen: **Shenzhen Height-LED Opto-electronics**, **Tech Seed Enterprise (Taiwan)**, **Shenzhen Lamplic Technology**, **UVET (Dongguan)** und **CoolUV Technology (Shanghai)**. Im Folgenden wird detailliert dargelegt, warum deren Datenblätter als Industriestandard für Transparenz gelten können und welche physikalischen und prozesstechnischen Implikationen sich aus den veröffentlichten Werten ableiten lassen.

## ---

**2\. Physikalische Grundlagen der Spezifikationsanalyse**

Um die Qualität der von den Herstellern bereitgestellten Daten adäquat zu bewerten, ist ein tiefes Verständnis der zugrundeliegenden physikalischen Mechanismen notwendig. Die Transparenz eines Datenblattes misst sich daran, wie gut es dem Anwender ermöglicht, das Verhalten des Photonenflusses und des thermischen Managements in der Realanwendung vorherzusagen.

### **2.1 Die Irradianz-Abstands-Relation**

Eine der kritischsten, aber oft verschleierten Kennzahlen in der UV-LED-Industrie ist der Abfall der Bestrahlungsstärke mit zunehmendem Abstand. Viele Hersteller bewerben ihre Produkte mit extremen Spitzenwerten (z.B. 20 W/cm²), die jedoch nur direkt an der Quarzglasscheibe (0 mm Abstand) gemessen werden. Da LEDs ohne Sekundäroptik in der Regel eine Lambert’sche Abstrahlcharakteristik aufweisen (Intensität $I \\propto \\cos(\\theta)$), divergiert das Licht rasch.

Für industrielle Anwendungen ist der Wert bei 0 mm irrelevant. In einer Druckmaschine beispielsweise flattern Substrate, oder mechanische Toleranzen erfordern einen Sicherheitsabstand von 5 mm bis 20 mm, um Kollisionen zu vermeiden. Ein System, das bei 0 mm 20 W/cm² liefert, aber aufgrund fehlender Kollimation bei 10 mm auf 2 W/cm² abfällt, ist für Tiefenhärtung unbrauchbar. Hersteller, die Tabellen oder Kurven für Abstände wie 5, 10, 20 oder 50 mm bereitstellen, ermöglichen dem Ingenieur die Berechnung der tatsächlich am Substrat ankommenden Dosis (Energieeintrag pro Fläche, $J/cm²$), welche das Integral der Irradianz über die Zeit ist.

### **2.2 Thermodynamik und Fluidmechanik der Kühlung**

Die Effizienz und Lebensdauer einer UV-LED hängen exponentiell von der Sperrschichttemperatur ($T\_j$) ab. Mit steigender Temperatur sinkt der Strahlungsfluss (Thermal Droop) und die Peak-Wellenlänge verschiebt sich (Red-Shift), was die Abstimmung auf den Photoinitiator stören kann. Bei wassergekühlten Hochleistungssystemen ist die Angabe „benötigt Chiller“ ungenügend.

Ingenieure benötigen präzise Angaben zum Volumenstrom ($\\dot{V}$, meist in L/min) und zum Druckabfall ($\\Delta p$). Diese Werte definieren die Wärmeabfuhrkapazität ($P\_{cool}$) gemäß der fundamentalen kalorimetrischen Gleichung:

$$P\_{cool} \= \\dot{m} \\cdot c\_p \\cdot \\Delta T$$  
Wobei $\\dot{m}$ der Massenstrom (abhängig von L/min), $c\_p$ die spezifische Wärmekapazität des Kühlmediums und $\\Delta T$ die zulässige Temperaturdifferenz ist. Ohne die Angabe des Mindestdurchflusses riskiert der Integrator eine Unterdimensionierung der Pumpe, was zu laminarer Strömung im Kühlkörper, schlechtem Wärmeübergang und schließlich zum Ausfall der Arrays führen kann.

## ---

**3\. Detaillierte Analyse der Hersteller**

Im Folgenden werden die fünf identifizierten Hersteller hinsichtlich ihrer Erfüllung der geforderten Transparenzkriterien analysiert. Die Bewertung basiert auf den vorliegenden technischen Dokumentationen und Datenblättern.

### **3.1 Shenzhen Height-LED Opto-electronics Technology Co., Ltd. (Height-LED)**

Standort: Shenzhen, China  
Kernkompetenz: UV-LED-Härtungssysteme für Druck (Flexo/Offset) und Klebstoffanwendungen.  
Height-LED hebt sich in der Landschaft der chinesischen Hersteller durch eine bemerkenswerte Ehrlichkeit in der Darstellung der Leistungsdaten ab. Anstatt ausschließlich theoretische Maxima zu bewerben, bietet das Unternehmen differenzierte Daten, die die physikalischen Realitäten verschiedener Wellenlängen anerkennen.

#### **3.1.1 Irradianz-Profile und Arbeitsabstände**

Das Unternehmen veröffentlicht für seine Kernprodukte, wie die **SZUV-II** Serie und die **HTJP-II** Serie, spezifische Bestrahlungsstärken bei definierten Arbeitsabständen. Besonders hervorzuheben ist die Unterscheidung zwischen den Wellenlängen. Es ist ein physikalisches Faktum, dass 365nm-LED-Chips (auf Galliumnitrid-Basis) oft eine geringere externe Quanteneffizienz aufweisen als 395nm-Chips. Height-LED maskiert dies nicht, sondern quantifiziert es präzise.

Die Analyse der technischen Datenblätter 1 zeigt folgende Spezifikationen für das Modell SZUV-II (Lichtaustrittsfläche 165mm x 10mm):

* **Bei 365nm / 385nm:** Die Bestrahlungsstärke wird mit **2,3 W/cm²** bei einem Arbeitsabstand von **20 mm** angegeben.  
* **Bei 395nm / 405nm:** Hier liegt der Wert höher bei **3,5 W/cm²** bei demselben Abstand von **20 mm**.

Für andere Konfigurationen, wie Flächenstrahler (Area Light Sources), werden noch detailliertere Werte für geringere Abstände geliefert. Ein Modell (SZUV-II-FS200100-BH) wird beispielsweise mit 1,2 W/cm² (365nm) und 1,8 W/cm² (395nm) bei **10 mm Abstand** spezifiziert.3 Diese explizite Nennung von Werten bei 10 mm und 20 mm ist für Integratoren von unschätzbarem Wert. Sie ermöglicht eine Interpolation der Kurve und zeigt, dass das System für mittlere Abstände ausgelegt ist, wo eine gewisse Divergenz in Kauf genommen wird, um eine größere Fläche abzudecken.

#### **3.1.2 Spezifikation der Kühlleistung und Durchflussmengen**

Height-LED integriert bei seinen wassergekühlten Systemen (wie der HTJP-II Serie, die bis zu 25 W/cm² Spitzenleistung erreichen kann 4) fortschrittliche Kontrollmechanismen. Die Dokumentation beschreibt ein intelligentes Wassermanagement:

* **Durchflusssteuerung:** Das System nutzt Magnetventile, um den Wasserfluss synchron zum Lampenstatus zu steuern („Lamp ON \= Water ON“). Dies ist eine entscheidende Information für die Anlagenplanung, da es bedeutet, dass der Chiller Druckschwankungen (Wasserschläge) abfangen muss, wenn Ventile schnell schalten.5  
* **Überwachung:** Die Datenblätter erwähnen explizit die Echtzeitüberwachung von Strom, Spannung und Temperatur mit automatischen Alarm- und Abschaltfunktionen. Dies impliziert, dass der Hersteller genaue Grenzwerte für die Kühlwassertemperatur und den Durchfluss definiert hat, die im Handbuch hinterlegt sind, um die Garantie zu gewährleisten.

#### **3.1.3 Abstrahlcharakteristik**

Obwohl Height-LED weniger Polardiagramme in den Vordergrund stellt, definiert das Unternehmen das Strahlungsprofil indirekt aber präzise über das Verhältnis von Gehäusegröße zu Lichtaustrittsfenster. Bei der SZUV-II wird beispielsweise eine Lichtaustrittsfläche von 165mm x 10mm in einem Gehäuse von 200mm Länge spezifiziert.1 Diese geometrischen Daten erlauben Rückschlüsse auf die Randabfälle der Intensität (Edge Rolloff). Die Tatsache, dass sie spezifische Intensitätswerte für 10mm und 20mm Distanz angeben, bestätigt, dass die optische Bank so konzipiert ist, dass sie über diese Distanz noch nutzbare Energie liefert, was auf eine moderate Kollimation hindeutet.

### **3.2 Tech Seed Enterprise Co., Ltd. (Taiwan)**

Standort: Taichung City, Taiwan  
Kernkompetenz: Hochpräzise Punkt-, Linien- und Flächen-UV-LED-Systeme (oft in Verbindung mit japanischer Technologie wie HOYA).  
Tech Seed Enterprise repräsentiert das High-End-Segment des taiwanesischen Marktes. Ihre Dokumentation spiegelt die strengen Anforderungen der Halbleiter- und Optikfertigung wider, wo Präzision wichtiger ist als rohe Leistung. Die Verbindung zu Technologien von HOYA deutet auf höchste optische Standards hin.

#### **3.2.1 Diagramme zum Abstrahlwinkel und Intensitätsverteilung**

Tech Seed ist einer der wenigen Hersteller, der explizit auf „Intensity Distribution Graphs“ (Intensitätsverteilungsgraphen) verweist und diese als zentrales Auswahlkriterium für verschiedene Linsenkomponenten anbietet. In ihren Unterlagen 6 finden sich Verweise auf spezifische Optiken (wie FGB5, FGS5, FGB7), die das Abstrahlprofil massiv verändern.

* **Bedeutung:** Ein Kunde kann nicht einfach eine „UV-Lampe“ kaufen; er muss die Optik wählen, die zu seiner Geometrie passt. Die Bereitstellung dieser Diagramme erlaubt es, den „Spot-Durchmesser“ bei verschiedenen Abständen exakt vorherzusagen.  
* **Uniformität:** Für Flächenstrahler spezifiziert Tech Seed die Uniformität der Bestrahlung (z.B. bei einem Arbeitsabstand von 5 mm).8 Dies ist kritisch für Anwendungen wie die Wafer-Belichtung oder Display-Verklebung, wo „Hotspots“ zu thermischem Stress und ungleichmäßiger Aushärtung führen würden.

#### **3.2.2 Peak Irradiance bei extremen Arbeitsabständen**

Die Datenblätter der **BT-Serie** (Spot-Typ) enthalten eine bemerkenswerte Datentiefe bezüglich des Intensitätsabfalls über große Distanzen. Ein Standard-LED-Strahler würde nach wenigen Zentimetern kaum noch Leistung bringen. Tech Seed veröffentlicht jedoch Datenpunkte, die eine extreme Kollimation belegen:

* **Modell BT-01 (365nm):**  
  * WD 10 mm: **2.000 mW/cm²**  
  * WD 20 mm: **1.500 mW/cm²**  
  * WD 93 mm: 100 mW/cm².7  
    Diese Daten sind aufschlussreich. Dass die Intensität bei einer Verdopplung des Abstands von 10 auf 20 mm nur um 25 % fällt (statt auf 25 % des Ursprungswerts, wie es das Abstandsquadratgesetz bei einer Punktquelle ohne Optik diktieren würde), beweist den Einsatz hochwertiger Quarz-Kollimationslinsen. Die Angabe eines Wertes bei 93 mm ist in der Branche unüblich und zeigt, dass diese Systeme für Anwendungen konzipiert sind, bei denen die Lichtquelle weit vom Objekt entfernt sein muss, etwa wegen Robotergreifern oder Bauteilgeometrien im Weg.

#### **3.2.3 Spezifikation der Kühlleistung**

Für die luftgekühlten Systeme der BT-Serie spezifiziert Tech Seed „Forced Air Cooling“ und gibt dabei das genaue Gewicht und die Leistungsaufnahme (18W) an.7 Dies erlaubt Rückschlüsse auf die thermische Masse und die benötigte Luftzirkulation im Einbauraum. Für größere Systeme (Area Type) werden Kühlanforderungen (z.B. Umgebungstemperaturfenster von 5-35°C) exakt definiert, um Kondensation auf den Optiken zu vermeiden.

### **3.3 Shenzhen Lamplic Technology Co., Ltd. (Lamplic)**

Standort: Shenzhen, China  
Kernkompetenz: UV-LED-Punkt-, Linien- und Flächenstrahler.  
Lamplic hat sich als Standardanbieter etabliert, der eine sehr granulare Aufschlüsselung der optischen Parameter bietet. Ihre Transparenz liegt besonders in der Korrelation von **Fokusabstand**, **Spotgröße** und **Intensität**.

#### **3.3.1 Fokusgeometrie und Strahlungsprofil**

Anstatt nur eine allgemeine Abstrahlcharakteristik anzugeben, liefert Lamplic Tabellen, die für jeden Bestrahlungskopf (Irradiation Head) die genaue Fokuslage definieren. Dies ist eine indirekte, aber für den Anwender oft nützlichere Form des Strahlungsprofils.  
Die Analyse der technischen Handbücher 9 offenbart folgende Zusammenhänge für die LHFC-Serie (Lüftergekühlt):

* **Kopf LHFC084-03:** Bei einem Fokusabstand von **9 mm** wird ein Spotdurchmesser von **Φ3 mm** erzeugt, was zu einer enormen Intensität von **10.000 mW/cm²** führt.  
* Kopf LHFC084-06: Bei einem Fokusabstand von 17 mm weitet sich der Spot auf Φ6 mm, wodurch die Intensität auf 4.000 mW/cm² sinkt.  
  Diese Datenreihe (die sich für Φ4mm, Φ8mm, Φ10mm etc. fortsetzt) demonstriert physikalische Konsistenz (Energieerhaltung). Wenn sich die Spotfläche vergrößert, muss die Energiedichte sinken. Lamplic stellt diese Trade-offs transparent dar, sodass der Ingenieur entscheiden kann: Brauche ich maximale Intensität (kleiner Spot, kurzer Abstand) oder maximale Flächentoleranz (größerer Spot, weniger Intensität)?

#### **3.3.2 Thermisches Management: Wasser und Luft**

Lamplic unterscheidet in seinen Spezifikationen strikt zwischen „Fan Cooling“ und „Natural Cooling“.

* **Natural Cooling:** Wird für vibrationsfreie Umgebungen oder Reinräume spezifiziert, jedoch mit klaren Warnhinweisen zur Eignung (nicht für Dauerbetrieb geeignet).  
* **Controller-Kühlung:** Interessanterweise spezifiziert Lamplic für die Controller der **UVEC-4II** Serie eine „Semiconductor Cooling“ (Peltier-Elemente).9 Dies ist ein Detail, das viele Konkurrenten verschweigen. Es deutet darauf hin, dass Lamplic großen Wert auf die Stabilität der Treiberelektronik legt, da schwankende Temperaturen im Treiber zu schwankenden Strömen und damit zu instabilem UV-Output führen können.

### **3.4 UVET (Dongguan UVET Co., Ltd.)**

Standort: Dongguan, China  
Kernkompetenz: Hochleistungs-UV-LED-Systeme (wassergekühlt) für High-Speed-Druckanwendungen.  
UVET positioniert sich im Segment der Schwerindustrie. Ihre Systeme sind für den 24/7-Betrieb in Druckmaschinen ausgelegt. Dementsprechend liegt der Fokus ihrer Transparenz auf den fluidtechnischen Anforderungen, die für die Integration in industrielle Kühlkreisläufe essenziell sind.

#### **3.4.1 Durchflussmengen und thermischer Widerstand**

UVET gehört zu den wenigen Herstellern, die explizite hydraulische Parameter veröffentlichen. Die Analyse der technischen Unterlagen 11 fördert kritische Integrationsdaten zutage:

* **Durchflussrate:** Für die Kühlung einzelner Module empfiehlt UVET einen Wasserdurchfluss von **1 bis 2 Litern pro Minute (L/min)**.  
  * *Ingenieurtechnische Einordnung:* Bei einer typischen elektrischen Effizienz von LEDs von ca. 30-40% muss ein Großteil der Eingangsleistung als Wärme abgeführt werden. Ein Durchfluss von 2 L/min Wasser (mit seiner hohen Wärmekapazität von ca. 4,18 kJ/kg·K) erlaubt den Abtransport erheblicher Wärmemengen bei geringem Temperaturhub ($\\Delta T$), was für die Homogenität der Lichtleistung über die Modulbreite entscheidend ist.  
* **Thermischer Widerstand:** UVET spezifiziert einen thermischen Widerstand von **\< 1,5 °C/W** für das Gesamtsystem.11 Dies ist eine Kennzahl, die normalerweise nur auf Chip-Level (Datenblatt des LED-Dioden-Herstellers) zu finden ist. Dass UVET dies für das Gesamtsystem angibt, zeugt von extremem Selbstbewusstsein in ihr thermisches Design (Bonding, PCB-Material, Kühlkörper). Es erlaubt dem Anwender, die Chiptemperatur basierend auf der Wassertemperatur und der elektrischen Leistung exakt zu berechnen.

#### **3.4.2 Peak Irradiance und Flächenleistung**

Die wassergekühlten Modelle wie das **UVSN-4W** erreichen enorme Leistungsdichten.

* Spezifikation: **24 W/cm²** bei 395nm.12  
* Bestrahlungsfläche: 100 x 20 mm.  
  Diese Kombination aus hoher Fläche und extremer Intensität ist nur durch das oben beschriebene rigorose Wassermanagement möglich.

### **3.5 CoolUV Technology (Shanghai Zhenhui Optoelectronics Co., Ltd.)**

Standort: Shanghai, China  
Kernkompetenz: Aushärtung von Glasfaserbeschichtungen (Optical Fiber Coating) und Hochgeschwindigkeitsdruck.  
CoolUV Technology verfolgt einen wissenschaftlichen Ansatz. Das Unternehmen betont die Nutzung von Monte-Carlo-Simulationen für das optische Design, um physikalische Limitierungen von Standard-LEDs zu überwinden.13

#### **3.5.1 Segmentierung nach Arbeitsabstand und Strahlungsprofil**

Einzigartig unter den untersuchten Herstellern ist die Kategorisierung der Produkte nicht (nur) nach Leistung, sondern nach dem **effektiven Arbeitsabstand**. Dies ist eine direkte Funktion des Strahlungsprofils (Abstrahlwinkel).

* **SmartCure / QuickCure Serien:** Spezifiziert für **\< 10 mm**. Hier wird eine breite Abstrahlung (Lambertian) akzeptiert oder gewünscht, um hohe Peak-Werte bei kurzer Distanz zu erreichen.  
* **UltraCure Serie:** Optimiert für **10 \- 120 mm**. Hier müssen Optiken das Licht bereits bündeln, um die Verluste zu kompensieren.  
* **PurpleBow Serie:** Entwickelt für **50 \- 200 mm**.13 Dies erfordert hochkomplexe Kollimationsoptiken (vermutlich Total Internal Reflection \- TIR Linsen), um auf 20 cm Distanz noch aushärtungsrelevante Intensitäten zu liefern.

Diese Klassifizierung ist für den Anwender transparenter als jedes Polardiagramm allein, da sie den Anwendungsbereich ("Use Case") definiert.

#### **3.5.2 Optische Simulation und Validierung**

CoolUV gibt an, dass ihre Simulationsergebnisse (Raytracing) eine Abweichung von weniger als 5 % zu den gemessenen Realwerten aufweisen.13 Für die **Linear-Serie** werden zudem unterschiedliche Bestrahlungsstärken für verschiedene Optik-Optionen („Wide angle“ vs. „Focused“) angegeben.

* Beispiel: Ein Modul liefert **350 mW/cm²** mit Weitwinkel-Optik, aber **750 \- 1.000 mW/cm²** mit fokussierter Optik bei gleicher elektrischer Leistung.15 Dies quantifiziert den Gewinn durch Strahlformung ("Etendue-Erhaltung") exakt.

## ---

**4\. Vergleichende Analyse und Markttrends**

Die Analyse der fünf Hersteller offenbart eine Zweiteilung des asiatischen UV-LED-Marktes in "Commodity"-Anbieter und "Engineering"-Partner. Die hier vorgestellten Unternehmen gehören klar zur zweiten Kategorie.

### **4.1 Die Abkehr vom "Peak-Irradiance"-Marketing**

Die Daten von Height-LED und Tech Seed zeigen einen klaren Trend: Die Abkehr von der alleinigen Nennung der Spitzenleistung am Austrittsfenster.  
Die Tabelle von Height-LED zeigt, dass bei 20 mm Arbeitsabstand eine 395nm-Quelle noch 3,5 W/cm² liefert. Ein Ingenieur kann diesen Wert nutzen, um die Prozessgeschwindigkeit zu berechnen:

$$v\_{max} \= \\frac{E\_{eff} \\cdot L\_{Belichtung}}{D\_{req}}$$

(wobei $E\_{eff}$ die effektive Irradianz bei Arbeitsabstand, $L\_{Belichtung}$ die Länge des Belichtungsfensters und $D\_{req}$ die benötigte Dosis des Lacks ist). Ohne die Angabe der Irradianz bei Arbeitsabstand (z.B. 20mm) wäre diese fundamentale Berechnung unmöglich bzw. massiv fehlerbehaftet.

### **4.2 Thermische Integration als Qualitätsmerkmal**

Die explizite Nennung von Durchflussraten (1-2 L/min bei UVET) und Steuerungslogiken (Magnetventile bei Height-LED) zeigt, dass diese Hersteller verstehen, dass ihre Produkte Teile eines größeren Systems sind.  
Ein Rechenbeispiel verdeutlicht die Relevanz der UVET-Daten: Ein 1000W LED-System (elektrisch) erzeugt ca. 700W Wärme. Bei 1 L/min Wasserfluss (ca. 16,7 g/s) würde sich das Wasser um:

$$\\Delta T \= \\frac{700 W}{16,7 g/s \\cdot 4,18 J/gK} \\approx 10 K$$

erwärmen. Dies ist ein akzeptabler Wert. Würde der Durchfluss jedoch auf 0,5 L/min sinken (weil der Hersteller keine Spezifikation vorgibt und der Kunde eine zu schwache Pumpe wählt), stiege $\\Delta T$ auf 20 K. Das Austrittswasser wäre dann deutlich wärmer, was zu einem Temperaturgradienten über das LED-Array führen würde – die LEDs am Wasserausgang wären heißer, dunkler und hätten eine andere Wellenlänge als die am Eingang ("Zebra-Effekt"). UVETs Spezifikation verhindert diesen Designfehler proaktiv.

### **4.3 Optische Präzision: Empirie vs. Simulation**

Während **Tech Seed** auf empirische Messdaten (Intensitätsverteilungsgraphen) setzt, was in der japanisch-geprägten taiwanesischen Industrie Tradition hat, setzt **CoolUV** auf Simulation. Beide Ansätze bieten Transparenz: Tech Seed gibt Sicherheit über das *Ist*, CoolUV über das *Machbare* (Customizing). Für Anwendungen mit hohen Uniformitätsanforderungen (z.B. Display-Bonding) bietet Tech Seeds Ansatz (HOYA-Technologie) die höhere Sicherheit. Für Anwendungen mit großen Arbeitsabständen (z.B. Aushärtung in Vertiefungen) ist CoolUVs Ansatz der Kollimation überlegen.

## ---

**5\. Zusammenfassung der Empfehlungen**

Basierend auf der Analyse der technischen Dokumentation empfehlen sich die folgenden Hersteller für Ingenieure, die detaillierte Integrationsdaten benötigen:

| Hersteller | Region | Stärke der "Detaillierten" Spezifikation | Ideal für Anwendung |
| :---- | :---- | :---- | :---- |
| **Height-LED** | China (Shenzhen) | **Irradianz-Tabellen** für definierte Abstände (10/20mm) und Wellenlängen-Vergleich 1 | Industrieller Druck, Förderband-Härtung |
| **Tech Seed** | Taiwan | **Intensitätsverteilungs-Graphen** & Abfallkurven bis 93mm 7 | Präzisionskleben, Spot-Härtung, Optik |
| **Lamplic** | China (Shenzhen) | **Fokus-Tabellen**: Korrelation von Fokusabstand, Spotdurchmesser & Intensität 9 | Automatisierte Montage, Spot-Curing |
| **UVET** | China (Dongguan) | **Fluidtechnik**: Durchflussraten (1-2 L/min) & thermischer Widerstand 11 | High-Speed Inkjet, Siebdruck (Dauerlast) |
| **CoolUV** | China (Shanghai) | **Abstands-Kategorisierung**: Produktwahl nach WD (\<10mm bis 200mm) 13 | Faserbeschichtung, "Long-Throw" Curing |

Diese Hersteller haben den Schritt vom reinen Komponentenlieferanten zum Systempartner vollzogen, indem sie die physikalischen Grenzen ihrer Technologie nicht verschleiern, sondern quantifizieren. Für den Anwender bedeutet dies Planungssicherheit: Die Simulation des Prozesses (Dosis, Taktzeit, Kühlung) wird möglich, bevor die Hardware beschafft wird. Dies minimiert das Risiko teurer Fehlkonstruktionen bei der Umstellung auf UV-LED-Technologie erheblich.

#### **Works cited**

1. SZUV-II-FS16510-BH \- UV LED Curing system for printing, coating applications--Height LED, accessed January 19, 2026, [https://heightled.com/Products/info.aspx?itemid=333\&lcid=34\&pid=](https://heightled.com/Products/info.aspx?itemid=333&lcid=34&pid)  
2. uvled linear curing system(165x10mm) \- Height-LED, accessed January 19, 2026, [https://www.height-led.com/en/uvledlinear/show/477.html](https://www.height-led.com/en/uvledlinear/show/477.html)  
3. UV area light source(SZUV-II-FS200100-BL), accessed January 19, 2026, [https://heightled.com/Products/uvled-area-light-source](https://heightled.com/Products/uvled-area-light-source)  
4. UV LED Curing System Flexo Printing-led uv coating/printing curing-Height-LED, accessed January 19, 2026, [https://www.height-led.com/en/uvledprinting/show/504.html](https://www.height-led.com/en/uvledprinting/show/504.html)  
5. HTJP-II-SN43525-BH \- UVLED Curing System variety of uvled curing equipment, accessed January 19, 2026, [https://www.heightled.com/Products/info.aspx?itemid=299\&parent\&lcid=31\&pid=26](https://www.heightled.com/Products/info.aspx?itemid=299&parent&lcid=31&pid=26)  
6. UV Light Source by Tech Seed: Enhance Your Production Efficiency with Advanced UV Curing, accessed January 19, 2026, [https://www.techseed-tw.com/en/shop/uv-light-source-122](https://www.techseed-tw.com/en/shop/uv-light-source-122)  
7. UV-LED Spot Type BT Series, accessed January 19, 2026, [https://www.techseed-tw.com/en/shop/uv-led-spot-type-bt-series-121](https://www.techseed-tw.com/en/shop/uv-led-spot-type-bt-series-121)  
8. Discover the Power of UV-LED Area Type Light Sources by Tech Seed Enterprise, accessed January 19, 2026, [https://www.techseed-tw.com/en/shop/uv-led-area-type-120](https://www.techseed-tw.com/en/shop/uv-led-area-type-120)  
9. shenzhen lamplic tech co., ltd uv led spot curing system technical manual, accessed January 19, 2026, [https://www.unionprint.eu/wp-content/uploads/2018/06/UV-LED-Spot-Curing-System-NEW-003.pdf](https://www.unionprint.eu/wp-content/uploads/2018/06/UV-LED-Spot-Curing-System-NEW-003.pdf)  
10. UV LED Spot Curing System, accessed January 19, 2026, [http://imgusr.tradekey.com/images/uploadedimages/brochures/9/0/5378627-201107040303190.pdf](http://imgusr.tradekey.com/images/uploadedimages/brochures/9/0/5378627-201107040303190.pdf)  
11. Water-Cooled UV LED Module for Long-Lasting Performance \- UVET, accessed January 19, 2026, [https://www.uvndt.com/water-cooled-uv-led-module/](https://www.uvndt.com/water-cooled-uv-led-module/)  
12. China High Output Water-cooled LED UV curing lamp Manufacturers and Suppliers | UVET, accessed January 19, 2026, [https://www.uvet-printing.com/100x20mm-product/](https://www.uvet-printing.com/100x20mm-product/)  
13. total solutions for UV LED curing | 上海臻辉光电技术有限公司--Cooluv Technology Inc., accessed January 19, 2026, [http://en.cooluv.cn/About22.aspx?ClassID=85](http://en.cooluv.cn/About22.aspx?ClassID=85)  
14. total solutions for UV LED curing | 上海臻辉光电技术有限公司, accessed January 19, 2026, [http://en.cooluv.cn/About22.aspx?ClassID=116](http://en.cooluv.cn/About22.aspx?ClassID=116)  
15. CoolUV™ Linear 365nm, 385nm, 405nm \- UV LED Solution for Linear Curing Applications \- Lumos Solutions, accessed January 19, 2026, [http://lumossolutions.com/wp-content/uploads/2011/04/Lumos-Solutions-CoolUV-Linear.pdf](http://lumossolutions.com/wp-content/uploads/2011/04/Lumos-Solutions-CoolUV-Linear.pdf)