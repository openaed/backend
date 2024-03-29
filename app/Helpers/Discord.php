<?php

namespace App\Helpers;

class Discord
{
    public static function syncFinished($totalSynced)
    {
        if (!config('app.webhooks.sync'))
            return true;
        $url = config('app.webhooks.sync');
        $username = config('app.name');

        $lastAdded = \App\Models\Defibrillator::orderBy('id', 'desc')->limit(3)->get();
        $lastAdded = $lastAdded->map(function ($item) {
            return "[{$item->city}, {$item->province}](https://openstreetmap.org/node/{$item->osm_id})";
        })->implode("\n");

        $lastAdded = "**Laatst toegevoegde AEDs**\n$lastAdded";

        $data = [
            'username' => $username,
            'embeds' => [
                Discord::createEmbed('AED synchronisatie afgerond', "Totaal $totalSynced AEDs\n\n" . $lastAdded),
            ],
        ];

        return Discord::sendWebhook($url, $data);
    }

    public static function syncStarted()
    {
        if (!config('app.webhooks.sync'))
            return true;
        $url = config('app.webhooks.sync');
        $username = config('app.name');

        $data = [
            'username' => $username,
            'embeds' => [
                Discord::createEmbed('AED synchronisatie', 'Synchronisatie gestart'),
            ],
        ];

        return Discord::sendWebhook($url, $data);
    }

    private static function sendWebhook($url, $data): bool
    {
        $data = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        echo curl_error($ch);

        return $response;
    }

    private static function createEmbed($title, $content)
    {
        return [
            'title' => $title,
            'description' => $content,
            'color' => hexdec('009a3b'),
            'timestamp' => now()->toIso8601String(),
            'footer' => [
                'text' => config('app.url'),
            ],
        ];
    }
}