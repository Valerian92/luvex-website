# **Master-Briefing: Strategie & Architektur für UV-Desinfektions-Plattform**

## **Version 1.1 – Phase: "Wissensportal & Safety-Shop"**

### **1\. Projekt-Vision & Status Quo**

Wir entwickeln eine digitale Plattform für UV-C-Desinfektionssysteme (Fokus: Wasser/Luft/Oberflächen) sowie Laserschutz.

Status: Start als Open-Source-orientiertes Wissensportal und Community-App.  
Sofortige Erweiterung: Launch eines spezialisierten Shops für Schutzausrüstung (UV- & Laserschutzbrillen).  
Ziel: Aufbau von Vertrauen durch das Thema "Sicherheit". Wir positionieren uns als Experten für Sicherheit, bevor wir komplexe Anlagen verkaufen.  
Zukunft: Spätere Integration von Hersteller-Partnerschaften für Großanlagen (Affiliate/Marktplatz).

### **2\. Die Kern-Herausforderung (Das "Hybrid-Problem")**

Die KI, die dieses System baut, muss drei Ebenen parallel denken:

1. **Ebene 1 (Wissen & Community):** Unabhängiges Wiki, Rechner und DIY-Pläne.  
2. **Ebene 2 (Sofortiger Commerce \- "Safety First"):** Ein voll funktionsfähiger Shop-Bereich für Schutzbrillen. Hier gelten **strenge rechtliche Anforderungen** (PSA-Verordnung, CE-Kennzeichnung).  
3. **Ebene 3 (Zukünftiger Anlagen-Vertrieb):** Die Vorbereitung für Hersteller-Partnerschaften bei Röhren und Reaktoren.

Anforderung an die Architektur:  
Das System muss unterscheiden zwischen "Community-Content" (Haftungsausschluss nötig) und "eigenen Verkaufsprodukten" (höchste Haftung, Zertifikats-Pflicht).

### **3\. Strategie für Markteintritt: Schutzausrüstung (Der OBL-Weg)**

Wir starten den Verkauf mit UV- und Laserschutzbrillen. Hierbei nutzen wir eine smarte Zertifizierungs-Strategie, die das Datenmodell beeinflusst.

**Die 3-Wege-Strategie (Einfluss auf Produkt-Datenbank):**

* **Option A (Handel):** Wir verkaufen Markenware.  
  * *Datenbank:* Hersteller \= Original-Marke. Zertifikat \= Original.  
* **Option B (Co-Branding \- Start-Fokus):** Original-Brille in unserer Verpackung ("Luvex").  
  * *Datenbank:* Muss technisch abbilden: "Vertriebsmarke: Luvex" ABER "Rechtlicher Hersteller: China Factory Ltd." (muss im Impressum/Datenblatt stehen).  
* **Option C (OBL \- Own Brand Labeling \- Ziel):** Umschreibung des Zertifikats auf uns.  
  * *Datenbank:* Wir sind rechtlicher Hersteller. Zertifikat läuft auf unseren Namen.

**To-Do für die KI:** Das Backend muss ein Feld für Zertifikats-PDF und Rechtlicher Hersteller haben, das dynamisch je nach Produkt (Option A, B oder C) im Frontend angezeigt wird, um Abmahnungen zu vermeiden.

### **4\. Funktionale Anforderungen für den MVP**

#### **A. Die Zentrale Datenbank (Inventory & Shop)**

Wir benötigen eine Trennung der Objekttypen:

* type: template (Generische Anlagen-Vorlagen)  
* type: user\_project (Bastler-Projekte)  
* type: shop\_item\_ppe (Persönliche Schutzausrüstung \- Brillen) \-\> **Muss Warenkorb-Funktion haben.**

#### **B. Content & News Engine (SEO-Treiber)**

* Integration von UV News und Newsletter.  
* **Spezial-Content:** "Warum billige Amazon-Brillen deine Augen ruinieren" (Aufklärung als Verkaufstrichter für unsere zertifizierten Brillen).

#### **C. Der Rechner / Die App**

* Berechnung der Dosis für Anlagen.  
* **Sicherheits-Feature:** Wenn eine Anlage berechnet wird, muss **automatisch** ein Hinweis erscheinen: "Achtung: Für diese Leistungsklasse (z.B. \>10W) ist Schutzbrille Klasse X empfohlen" \-\> **Link zum Shop-Produkt.**

### **5\. Strategische Fragen an die Bau-KI (Request for Proposal)**

Bitte entwickle basierend auf diesem Briefing einen Plan für:

1. **Shop-Integration "Light":** Wie integrieren wir den Verkauf von Brillen (physische Produkte, Lagerbestand, Versand) in das Wissensportal, ohne ein monströses Shopsystem (wie Magento) zu installieren? (z.B. Stripe Integration, Shopify-Button oder schlankes Next.js Commerce Modul).  
2. **Compliance-Datenbank:** Wie stellen wir sicher, dass bei jedem Verkaufsprodukt (Brille) das dazugehörige EU-Zertifikat (PDF) für den Kunden sofort abrufbar ist (rechtliche Pflicht bei PSA)?  
3. **Trust-Design:** Wie gestalten wir die Produktseite der Brillen so, dass sie nicht wie "Dropshipping" aussieht, sondern wie "Technischer Fachhandel"? (Hervorhebung von Zertifizierungs-Logos, Technische Datenblätter statt Werbetexte).  
4. **Übergang Community zu Shop:** Wie leiten wir den User vom "Bastel-Rechner" zum "Brillen-Kauf", ohne aufdringlich zu wirken? (Kontext-sensitive Warnhinweise).

### **6\. Zusammenfassung der Mission**

Baue ein System, das primär als **Experten-Tool für UV-Technik** wahrgenommen wird, aber durch den gezielten Verkauf von **zertifizierter Sicherheitstechnik (Brillen)** sofortigen Cashflow und rechtliche Autorität generiert. Der Verkauf von Großanlagen folgt später auf diesem Fundament.