<?php
/**
 * Elopage API wrapper
 * @author Vladimir Vasyukov
 * @version 1.0.0
 *
 * Classes providing connections with the Elopage API server.
 */

namespace Kazin8\Elopage;

use Kazin8\Elopage\Dto\ResponseDto;

class ElopageApi
{
    const API_VERSION = 1.0;

    const LANG_EN = 'en';
    const LANG_DE = 'de';

    const ERROR_UNKNOWN             = 1;
    const ERROR_UNAUTHORIZED        = 2;
    const ERROR_BAD_SERVER_RESPONSE = 6;
    const ERROR_CURL                = 7;
    const ERROR_NOT_FOUND           = 4;

    const LOG_ERROR                 = 'error';
    const LOG_INFO                  = 'info';

    protected $apiKey         = '';
    protected $secret         = '';
    protected $language       = '';
    protected $baseUrl        = 'https://elopage.com/api/';
    protected $sandboxBaseUrl = 'http://staging.elopage.com/api/';
    protected $testMode       = false;

    public function __construct(string $apiKey, string $secret, $testMode = false )
    {
        $this->apiKey   = $apiKey;
        $this->secret   = $secret;
        $this->language = $this::LANG_EN;
        $this->testMode = $testMode;
    }

    public function setLanguage( $language )
    {
        $this->language = $language;
    }

    public function getResponseDto()
    {
        return new ResponseDto();
    }

    public function get(string $url, ?int $id = null)
    {
        $apiUrl = $this->getServiceUrl() . $url;
        $apiUrl .= $id ?  '/' . $id : '';

        $response = $this->request('GET', $apiUrl);

        return $response;
    }

    public function delete(string $url, int $id)
    {
        $apiUrl = $this->getServiceUrl().$url.'/'.$id;

        $response = $this->request('DELETE', $apiUrl);

        return $response;
    }

    public function post(string $url, array $payload)
    {
        $apiUrl = $this->getServiceUrl().$url;

        $response = $this->request('POST', $apiUrl, $payload);

        return $response;
    }

    public function put(string $url, array $payload, int $id)
    {
        $apiUrl = $this->getServiceUrl() . $url . '/' . $id;

        $response = $this->request('PUT', $apiUrl, $payload);

        return $response;
    }

    protected function request(string $type, string $url, array $payload = [])
    {
        $response = $this->getResponseDto();

        $payload['key'] = $this->apiKey;
        $payload['secret'] = $this->secret;

        if (!function_exists('curl_init')) {
            $response->setError([
                'code' => self::ERROR_CURL,
                'message' => $this->getErrorMsgByCode(self::ERROR_CURL)
            ]);

            return $response;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTP|CURLPROTO_HTTPS);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false );
        curl_setopt($ch, CURLOPT_TIMEOUT, 30 );
        curl_setopt($ch, CURLOPT_ENCODING, "" );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        switch ($type) {
            case 'GET':
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json'
                    ]
                );
                $url .= "?key={$this->apiKey}&secret={$this->secret}";

                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen(json_encode($payload))
                    ]
                );

                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen(json_encode($payload))
                    ]
                );

                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen(json_encode($payload))
                    ]
                );

                break;
        }

        curl_setopt($ch, CURLOPT_URL, $url);

        $curlResponse = curl_exec($ch);

        $curlCode = ''.curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlResponse = json_decode($curlResponse, true);

        if (isset($curlResponse['success']) and !$curlResponse['success']) {
            $response->setError([
                'message' => $curlResponse['description'] ?? ($curlResponse['error'] ?? $curlResponse['msg']),
                'code' => self::ERROR_BAD_SERVER_RESPONSE,
                'httpCode' => $curlCode
            ]);

            return $response;
        }

        if (isset($curlResponse['status']) and $curlResponse['status'] != 'success') {
            $response->setError([
                'message' => $curlResponse['response'],
                'code' => self::ERROR_BAD_SERVER_RESPONSE,
                'httpCode' => $curlCode
            ]);

            return $response;
        }

        if (isset($curlResponse['error']) and $curlResponse['error']) {
            $response->setError([
                'message' => $curlResponse['error'],
                'code' => self::ERROR_BAD_SERVER_RESPONSE,
                'httpCode' => $curlCode
            ]);

            return $response;
        }

        if ($curlCode == 401) {
            $response->setError([
                'message' => $this->getErrorMsgByCode(self::ERROR_UNAUTHORIZED),
                'code' => self::ERROR_UNAUTHORIZED,
                'httpCode' => $curlCode
            ]);

            return $response;
        }

        if ($curlCode == 404) {
            $response->setError([
                'message' => $this->getErrorMsgByCode(self::ERROR_NOT_FOUND),
                'code' => self::ERROR_NOT_FOUND,
                'httpCode' => $curlCode
            ]);

            return $response;
        }

        $response->setSuccess(true);
        $response->setData($curlResponse);

        return $response;

    }

    private function getServiceUrl()
    {
        return $this->testMode ? $this->sandboxBaseUrl : $this->baseUrl;
    }

    private function getErrorMsgByCode(string $code)
    {
        $lang = [
            'de' => [
                self::ERROR_UNKNOWN             => 'Unbekannter Fehler!',
                self::ERROR_UNAUTHORIZED        => 'Berechtigungsfehler',
                self::ERROR_BAD_SERVER_RESPONSE => 'Der Elopage-Server hat eine ungültige Antwort geliefert. (Technische Information: %s)',
                self::ERROR_CURL                => 'Fehler beim HTTP-Aufruf durch CURL (#%s - %s)',
                self::ERROR_NOT_FOUND           => 'Nicht gefunden'
            ],
            'en' => [
                self::ERROR_UNKNOWN             => 'Unknown error!',
                self::ERROR_UNAUTHORIZED        => 'Authorization Error',
                self::ERROR_BAD_SERVER_RESPONSE => 'The Elopage server delivered an invalid response. (Technical information: %s)',
                self::ERROR_CURL                => 'Http call error reported by curl (#%s - %s)',
                self::ERROR_NOT_FOUND           => 'Not found',
            ]
        ];

        return $lang[$this->language][$code] ?? 'Unknown error code';
    }

}