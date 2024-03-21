<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class RemoveBaseUrlFromLinks
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Check if the response is JSON
        if ($response->headers->get('Content-Type') === 'application/json') {
            $responseData = json_decode($response->getContent(), true);

            if(!isset($responseData['meta'])) return $response;

            // Remove base URL from links
            $this->removeBaseUrl($responseData['links']);
            $this->removeBaseUrl($responseData['meta']['links']);

            // Remove base URL from path
            if (isset($responseData['meta']['path'])) {
                $this->removeBaseUrl($responseData['meta']['path']);
            }

            // Update the response content with modified data
            $response->setContent(json_encode($responseData));
        }

        return $response;
    }

    private function removeBaseUrl(&$value)
    {
        if (is_array($value)) {
            array_walk_recursive($value, function (&$item) {
                if (is_string($item) && $item !== null) {
                    $baseUrl = config('app.url').'/api' ;
                    $item = str_replace($baseUrl, '', $item);
                }
            });
        } elseif (is_string($value) && $value !== null) {
            $baseUrl = config('app.url').'/api'; 
            $value = str_replace($baseUrl, '', $value);
        }
    }
}
