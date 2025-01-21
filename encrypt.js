const express = require('express');
const CryptoJS = require('crypto-js');
const app = express();
const port = 3000;

// Dein Webhook und Passwort
const webhookURL = "https://discord.com/api/webhooks/1329145060230692935/-93HduLZfipXZnGgRBszzvfpOHYdAjWwcAElg9N_FdT4IB4pPbr05lUMQdtoSqTrqR4h";
const secretKey = "Sigma123!";

// Verschlüsselung des Webhooks
const encryptedWebhook = CryptoJS.AES.encrypt(webhookURL, secretKey).toString();

// Stelle den verschlüsselten Webhook als Antwort bereit
app.get('/get-encrypted-webhook', (req, res) => {
  res.json({ encryptedWebhook });
});

// Serve die Frontend-Datei
app.use(express.static('public'));

app.listen(port, () => {
  console.log(`Server läuft auf http://localhost:${port}`);
});
