<?php

class GeminiService {
    public static function analisarNoticia($noticia) {
        $prompt = "Analise a seguinte notícia retone somente o texto principal se a noticia e verdadeira ou falsa no maximo 50 caracter  [...] Notícia:\n\n" . $noticia;

        $data = [
            'contents' => [[ 'parts' => [[ 'text' => $prompt ]] ]],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 500,
            ],
        ];

        $ch = curl_init(GEMINI_API_ENDPOINT);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_SSL_VERIFYPEER => true
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['erro' => "Erro de cURL: $error"];
        }

        $resposta = json_decode($response, true);

        if ($http_code === 200 && isset($resposta['candidates'][0]['content']['parts'][0]['text'])) {
            return ['resultado' => $resposta['candidates'][0]['content']['parts'][0]['text']];
        }

        if (isset($resposta['error']['message'])) {
            return ['erro' => "Erro da API Gemini: " . $resposta['error']['message']];
        }

        return ['erro' => "Resposta inesperada da API Gemini."];
    }
}
?>