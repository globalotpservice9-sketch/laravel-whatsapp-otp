<?php

namespace FiveMinutesAPI\WhatsApp;

class WhatsAppClient
{
    private $apiKey;
    private $baseUrl = 'https://api.5minutesapi.com/v1/send-message';

    public function __construct($apiKey)
    {
        if (empty($apiKey)) {
            throw new \Exception("🛑 [5MinutesAPI]: API Key missing! Get your Master API Key instantly at https://5minutesapi.com");
        }
        $this->apiKey = $apiKey;
    }

    public function sendOTP($to, $template = 'global_otp_auth', $variables = [])
    {
        return $this->sendMessage($to, $template, $variables);
    }

    public function sendMessage($to, $template, $variables = [], $recordId = null, $callbackUrl = null)
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $to);

        $payload = json_encode([
            'to' => $cleanPhone,
            'whatsapp_template' => $template,
            'variables' => $variables,
            'record_id' => $recordId,
            'callback_url' => $callbackUrl
        ]);

        $ch = curl_init($this->baseUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 401) {
            throw new \Exception("🚨 [5MinutesAPI]: Unauthorized! Your API Key is invalid. Get an active key at https://5minutesapi.com");
        }

        return json_decode($response, true);
    }
}
