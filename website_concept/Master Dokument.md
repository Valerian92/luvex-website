# **Master-Briefing: Strategie & Architektur für UV-Desinfektions-Plattform**

## **Version 1.0 – Phase: "Wissensportal mit Skalierungs-Option"**

### **1\. Projekt-Vision & Status Quo**

Wir entwickeln eine digitale Plattform für UV-C-Desinfektionssysteme (Fokus: Wasser/Luft/Oberflächen).  
Status: Start als Open-Source-orientiertes Wissensportal und Community-App.  
Ziel: Schneller Markteintritt mit Content (UV News, Newsletter, Wissensdatenbank) und einer App zur Berechnung/Erfassung von Systemen.  
Zukunft: Spätere Integration von Hersteller-Partnerschaften und Vertrieb (Affiliate, Dropshipping oder Marktplatz), ohne die bestehende Architektur neu schreiben zu müssen.

### **2\. Die Kern-Herausforderung (Das "Hybrid-Problem")**

Die KI, die dieses System baut, muss einen Spagat lösen:

1. **Phase 1 (Launch):** Die Seite muss als unabhängiges "Wikipedia für UV-Anlagen" wirken. Nutzer tragen ihre DIY-Systeme ein oder nutzen generische Vorlagen. Es darf **nicht** wie ein leerer Shop wirken.  
2. **Phase 2 (Skalierung):** Wir müssen später "offizielle Herstellermodelle" nahtlos integrieren können. Ein Nutzer, der heute ein generisches "50W System" konfiguriert, soll später vorgeschlagen bekommen: "Hier ist ein zertifiziertes System von Hersteller X, das genau deinen Daten entspricht."

Anforderung an die Architektur:  
Das Datenmodell muss flexibel genug sein, um "User-Generated Content" (unspezifisch, unzertifiziert) und "Manufacturer Content" (spezifisch, zertifiziert, teuer) parallel zu behandeln, ohne dass die UI bricht.

### **3\. Funktionale Anforderungen für den MVP (Minimum Viable Product)**

#### **A. Die Zentrale Datenbank (Inventory & Templates)**

Anstatt leer zu starten, benötigen wir "Schatten-Modelle" (Templates).

* **Strategie:** Wir hinterlegen gängige Markt-Standards (z.B. "Philips-Röhre T5 40W Äquivalent") als Template.  
* **User Flow:** Der User wählt das Template \-\> Das System kopiert die Daten in sein Profil \-\> Der User passt es an (Open Source Ansatz).  
* **Zukunfts-Hook:** Wenn wir später Partner werden, können wir das generische Template mit dem echten Kauflink des Herstellers verknüpfen ("Dieses Template basiert auf Modell XY").

#### **B. Content & News Engine (SEO-Treiber)**

* Schnelle Integration von "UV News" und einem Newsletter-System (z.B. nahtlose API zu Mailchimp/Brevo oder internes System).  
* Der Content muss die "Autorität" aufbauen, die für den späteren Verkauf von teuren technischen Geräten nötig ist.

#### **C. Der Rechner / Die App**

* Physikalische Berechnung der Dosis (bereits in Planung).  
* **Wichtig:** Die Ausgabe darf nicht nur "Du brauchst 400 J/m²" sein, sondern muss später einen "Call to Action" ermöglichen (z.B. "Passende Systeme anzeigen"). Vorerst zeigt dieser Button auf "Ähnliche Community-Projekte".

### **4\. Strategische Fragen an die Bau-KI (Request for Proposal)**

Bitte entwickle basierend auf diesem Briefing einen Plan für:

1. **Datenbank-Schema (User vs. Vendor):** Wie strukturieren wir die Datenbank so, dass ein Eintrag ein type Flag haben kann (z.B. user\_custom, generic\_template, verified\_manufacturer), damit wir später Filter setzen können ("Nur zertifizierte Anlagen anzeigen")?  
2. **Trust-Elemente:** Wie designen wir die UI so, dass sie trotz Open-Source-Charakter (Bastler) seriös genug wirkt, um später medizinische/industrielle Geräte zu verkaufen? (Trennung von "Hobby-Ecke" und "Profi-Bereich").  
3. **Onboarding-Strategie:** Wie bekommen wir Hersteller-Daten auf die Plattform, ohne Deals zu haben? (z.B. Crowdsourcing: "Trag dein gekauftes System ein und hilf der Community" \-\> Wir verifizieren den Datensatz später als "Gold Standard").  
4. **Rechtliche/Sicherheits-Architektur:** Da es um UV-Strahlung und Strom geht – wie bauen wir Disclaimers logisch in den UX-Flow ein, sodass wir (die Plattform) nicht haften, wenn ein User ein unsicheres DIY-System baut?

### **5\. Zusammenfassung der Mission**

Baue ein System, das heute wie ein hilfreiches Tool für Enthusiasten und Ingenieure aussieht, aber unter der Haube bereits die Strukturen eines spezialisierten Marktplatzes für technische Investitionsgüter besitzt.