<?php

namespace AlertBug\AlertBug;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class AlertBugHandler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     */
    public function report(Throwable $e)
    {
        parent::report($e); // Log standard

        if ($this->shouldReport($e)) {
            $this->sendErrorToApi($e);
        }
    }

    /**
     * Send the error to an external API.
     */
    protected function sendErrorToApi(Throwable $e): void
    {
        try {
            if (!config('alertbug.enabled')) {
                return;
            }
            if (request()->is('api/erreurs')) {
                return;
            }
            
            $response = Http::timeout(10)
                ->withHeaders([
                    'X-API-KEY' => config('alertbug.api_key'),
                ])
                ->post(config('alertbug.api_url'), [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'fichier' => $e->getFile(),
                    'ligne' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'environnement' => app()->environment(),
                    'url' => request()->fullUrl(),
                    'method' => request()->method(),
                    'user_id' => auth()->id() ?? null,
                ]);

            if ($response->failed()) {
                Log::error('Erreur lors de l\'envoi de l\'erreur à l\'API AlertBug : ' . $response->body() .
                           '. Détails de la requête : ' . json_encode($response->request()->data()));
            }
        } catch (\Exception $ex) {
            Log::error('Impossible d\'envoyer l\'erreur à l\'API AlertBug : ' . $ex->getMessage());
        }
    }

}
