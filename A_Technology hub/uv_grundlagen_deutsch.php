<?php
/**
 * Template Name: UV Grundlagen
 * @package Luvex
 */
get_header(); ?>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Was ist UV-Strahlung?</h1>
        <p class="lead">
            Verstehen Sie die Grundlagen der ultravioletten Strahlung und ihre technischen Anwendungen
        </p>
    </div>
</section>

<!-- Was ist UV? -->
<section>
    <div class="container">
        <h2 class="text-center">Das elektromagnetische Spektrum</h2>
        <p class="lead">
            UV-Strahlung beginnt dort, wo das sichtbare Licht endet - am kurzwelligen Ende des Spektrums bei 400 Nanometern.
        </p>

        <div class="info-box">
            <h4><i class="fas fa-wave-square" style="color: var(--blue); margin-right: 8px;"></i> Grundprinzip</h4>
            <p><strong>Je kürzer die Wellenlänge, desto energiereicher die Strahlung.</strong> Deshalb ist UV-C (200-280nm) viel energiereicher als UV-A (315-400nm) und damit wirksamer für die Desinfektion.</p>
        </div>

        <!-- Spektrum von sichtbar zu UV -->
        <div style="margin: 3rem 0; text-align: center;">
            <h3>Vom sichtbaren Licht zur UV-Strahlung</h3>
            
            <!-- Erweiterte Spektrum-Darstellung -->
            <div style="display: flex; align-items: center; margin: 2rem 0; max-width: 900px; margin-left: auto; margin-right: auto;">
                
                <!-- Sichtbares Spektrum -->
                <div style="flex: 2; margin-right: 1rem;">
                    <div style="height: 60px; background: linear-gradient(90deg, #ff0000 0%, #ff8000 15%, #ffff00 30%, #00ff00 45%, #0080ff 65%, #4000ff 80%, #8000ff 100%); border-radius: 30px 0 0 30px; position: relative;">
                    </div>
                    <div style="margin-top: 0.5rem; font-size: 0.9rem; color: var(--gray);">
                        <strong>Sichtbares Licht</strong><br>
                        400-700nm
                    </div>
                </div>

                <!-- Pfeil -->
                <div style="margin: 0 1rem; font-size: 1.5rem; color: var(--blue);">
                    →
                </div>

                <!-- UV Spektrum -->
                <div style="flex: 3;">
                    <div class="spectrum-bar" style="border-radius: 0 30px 30px 0;"></div>
                    <div style="margin-top: 0.5rem; font-size: 0.9rem; color: var(--gray);">
                        <strong>UV-Strahlung</strong><br>
                        100-400nm (unsichtbar)
                    </div>
                </div>
            </div>
        </div>

        <!-- Energie-Konzept -->
        <div class="cards">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Sichtbares Licht</h3>
                <div class="subtitle">400-700nm</div>
                <p>
                    Das menschliche Auge nimmt Wellenlängen von 400nm (violett) bis 700nm (rot) wahr. Bei 400nm endet die Sichtbarkeit - hier beginnt die UV-Strahlung.
                </p>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-eye-slash"></i>
                </div>
                <h3>UV-Strahlung</h3>
                <div class="subtitle">100-400nm</div>
                <p>
                    Unsichtbare Strahlung unterhalb von 400nm. Je kürzer die Wellenlänge, desto höher die Photonenenergie - und damit die biologische und chemische Wirksamkeit.
                </p>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Energie nimmt zu</h3>
                <div class="subtitle">E = h×c/λ</div>
                <p>
                    Die Photonenenergie ist umgekehrt proportional zur Wellenlänge. UV-C bei 254nm hat doppelt so viel Energie wie UV-A bei 365nm.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- UV-Bereiche -->
<section style="background: var(--light);">
    <div class="container">
        <h2 class="text-center">Die drei UV-Bereiche</h2>
        <p class="lead">
            UV-Strahlung wird in drei Hauptbereiche unterteilt, die sich in Wellenlänge, Energie und Anwendung unterscheiden.
        </p>

        <div class="spectrum-bar"></div>
        <div class="spectrum-labels">
            <div class="spectrum-label">
                <strong>200nm</strong>
                <span>UV-C</span>
            </div>
            <div class="spectrum-label">
                <strong>280nm</strong>
                <span>Grenze</span>
            </div>
            <div class="spectrum-label">
                <strong>315nm</strong>
                <span>UV-B</span>
            </div>
            <div class="spectrum-label">
                <strong>400nm</strong>
                <span>Sichtbar</span>
            </div>
        </div>

        <div class="cards mt-2">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <h3>UV-C</h3>
                <div class="subtitle">200-280nm • Höchste Energie</div>
                <p>
                    <strong>Keimtötend:</strong> Zerstört DNA von Bakterien, Viren und Pilzen. Wird komplett von der Atmosphäre absorbiert. Hauptwellenlänge: 254nm für Desinfektion.
                </p>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-sun"></i>
                </div>
                <h3>UV-B</h3>
                <div class="subtitle">280-315nm • Mittlere Energie</div>
                <p>
                    <strong>Biologisch aktiv:</strong> Verantwortlich für Vitamin D-Bildung und Sonnenbrand. Teilweise von der Atmosphäre absorbiert. Wichtig für Phototherapie.
                </p>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-industry"></i>
                </div>
                <h3>UV-A</h3>
                <div class="subtitle">315-400nm • Niedrigste Energie</div>
                <p>
                    <strong>Industriell:</strong> Härtung von Lacken, Klebstoffen und Druckfarben. Erreicht die Erdoberfläche. Hauptwellenlänge: 365nm für LED-Härtung.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Warum ist das wichtig? -->
<section>
    <div class="container">
        <h2 class="text-center">Warum ist das wichtig?</h2>
        <p class="lead">
            Das Verständnis der UV-Bereiche ist entscheidend für die richtige Auswahl der Technologie für Ihre Anwendung.
        </p>

        <div class="grid-2">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-crosshairs"></i>
                </div>
                <h3>Präzise Wellenlängen-Auswahl</h3>
                <p>
                    Jede Anwendung benötigt spezifische Wellenlängen: 254nm für Wasserdesinfektion, 222nm für Luftreinigung in Anwesenheit von Menschen, 365nm für industrielle Härtung.
                </p>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <h3>Energiedosis berechnen</h3>
                <p>
                    Die benötigte UV-Dosis hängt von der Wellenlänge ab. Kürzere Wellenlängen benötigen weniger Energie für die gleiche Wirkung - das spart Kosten und Energie.
                </p>
            </div>
        </div>

        <div class="text-center mt-2">
            <a href="/anwendungen" class="btn">
                <i class="fas fa-arrow-right"></i>
                UV-Anwendungen entdecken
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>