const CryptoJS = require("crypto-js");

const webhook = "https://discord.com/api/webhooks/1329145060230692935/-93HduLZfipXZnGgRBszzvfpOHYdAjWwcAElg9N_FdT4IB4pPbr05lUMQdtoSqTrqR4h"; // Dein Webhook
const secretKey = "Sigma123!"; // Dein Passwort

// Verschlüsselung des Webhooks
const encryptedWebhook = CryptoJS.AES.encrypt(webhook, secretKey).toString();

console.log("Verschlüsselter Webhook: ", encryptedWebhook);
