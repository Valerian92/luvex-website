

<?php
/**
 * Template Name: My Profile
 */

get_header(); // Lädt den Header deiner Webseite
?>

<div class="content-wrapper" style="padding: 120px 2rem;">

    <h1>Meine Profilseite (Einfache Version)</h1>

    <?php if ( is_user_logged_in() ) : ?>

        <?php // Hole die Daten des aktuell eingeloggten Benutzers
        $current_user = wp_get_current_user(); 
        ?>

        <p>
            Hallo, <strong><?php echo esc_html( $current_user->display_name ); ?></strong>!
        </p>
        <p>
            Deine E-Mail-Adresse lautet: <?php echo esc_html( $current_user->user_email ); ?>
        </p>


<hr style="margin: 2rem 0;">

<h3>Meine Lampen</h3>

<div class="lamp-form-container" style="padding: 1rem; border: 1px solid #eee; border-radius: 5px; margin-top: 1rem;">
    <h4>Neue Lampe hinzufügen</h4>
    
    <form id="add-lamp-form">
        <div style="margin-bottom: 1rem;">
            <label for="lamp-name">Lampen-Name</label><br>
            <input type="text" id="lamp-name" name="lamp_name" required>
        </div>
     	<div style="margin-bottom: 1rem;">
            <label for="lamp-type">Lampen-Typ</label><br>
            <select id="lamp-type" name="lamp_type">
                <option value="led">LED</option>
                <option value="mercury_lp">Niederdruck-Quecksilber</option>
                <option value="mercury_mp">Mitteldruck-Quecksilber</option>
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="lamp-power">Leistung (W)</label><br>
            <input type="number" id="lamp-power" name="lamp_power" required>
        </div>
        <div style="margin-bottom: 1rem;">
            <label for="lamp-wavelength">Wellenlänge (nm)</label><br>
            <input type="number" id="lamp-wavelength" name="lamp_wavelength" required>
        </div>
        <button type="submit">Lampe Speichern</button>
    </form>
    <div id="form-feedback" style="margin-top: 1rem;"></div>
</div>

<script>

    // Finde unser Formular im HTML
    const lampForm = document.getElementById('add-lamp-form');
    const feedbackDiv = document.getElementById('form-feedback');

    // Was soll passieren, wenn jemand auf "Lampe Speichern" klickt?
    lampForm.addEventListener('submit', function(event) {
        
        // Verhindere das normale Neuladen der Seite
        event.preventDefault();
        
        feedbackDiv.textContent = 'Speichere...';

        // Sammle die Daten aus den Formular-Feldern
        const lampData = {
            name: document.getElementById('lamp-name').value,
	    type: document.getElementById('lamp-type').value,
            power: document.getElementById('lamp-power').value,
            wavelength: document.getElementById('lamp-wavelength').value,
        };

 // NEUE DEBUG-ZEILE: Gib uns den Nonce-Wert aus, den das Skript "sieht".
      console.log('luvexAjax Object:', luvexAjax);

        // Sende die Daten an unseren API-Endpunkt
        fetch(luvexAjax.resturl + 'save-lamp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': luvexAjax.nonce // Wichtiger Sicherheitsschlüssel
            },
            body: JSON.stringify(lampData)
        })
        .then(response => response.json())
        .then(result => {
            console.log('Antwort vom Server:', result); // Für uns zum Debuggen
            
            if (result.success) {
                feedbackDiv.textContent = 'Erfolg! Lampe wurde vom Server empfangen.';
                feedbackDiv.style.color = 'green';
                lampForm.reset(); // Formular zurücksetzen
            } else {
                feedbackDiv.textContent = 'Fehler: ' + result.message;
                feedbackDiv.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Verbindungsfehler:', error);
            feedbackDiv.textContent = 'Ein Verbindungsfehler ist aufgetreten.';
            feedbackDiv.style.color = 'red';
        });
    });
</script>

        <a href="<?php echo wp_logout_url( home_url('/') ); ?>" class="action-button logout">
            Ausloggen
        </a>

    <?php else : ?>

        <p>
            Bitte logge dich ein, um deine Profilseite zu sehen.
        </p>
        <a href="/simulator-login/">Zum Login</a>

    <?php endif; ?>

</div>

<?php get_footer(); // Lädt den Footer deiner Webseite ?>