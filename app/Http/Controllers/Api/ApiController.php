<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

abstract class ApiController extends Controller
{
    protected $statusCode = Response::HTTP_OK;

    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    protected function respondWithSuccess($data = [],?string $message = null,$statusCode = Response::HTTP_OK)
    {
        return $this->setStatusCode($statusCode)
            ->respondWithArray([
                'success' => true,
                "code" => self::handleResponseCode($statusCode),
                //"message" => Helper::translate(Helper::checkApiLanguage(), $message) ?? __("Success Response"),
                "message" => $message ?? '',
                "result" => self::handleReturnedResult($data),
            ]);
    }

    public static function sendFailedResponse(?string $message = null, int $code = Response::HTTP_NOT_FOUND)
    {
        return response()->json([
            "success" => false,
            "code" => self::handleResponseCode($code),
            "message" => $message ?? '',
            "direct" => $code == Response::HTTP_UNAUTHORIZED ? "login" : null
        ], $code);
    }

    protected function respondWithSuccessNotArray($statusCode = Response::HTTP_OK)
    {
        return ['success' => true];
    }

    protected function respondWithArray(array $array, array $headers = [])
    {
        $response = \Response::json($array, $this->statusCode, $headers);

        $response->header('Content-Type', 'application/json');

        return $response;
    }

    protected function respondWithError($message)
    {
        /*if ($this->statusCode === Response::HTTP_OK) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }*/

        return $this->respondWithArray([
            'success' => false,
            "code" => self::handleResponseCode($this->statusCode),
            "message" => Helper::translate(Helper::checkApiLanguage(), $message) ?? "Error Response",
            "result" => null,
        ]);
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)
            ->respondWithError($message);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)
            ->respondWithError($message);
    }

    /**
     * @param $code
     * @return int
     */
    private static function handleResponseCode($code)
    {
        return [
            \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND => 4,
            Response::HTTP_INTERNAL_SERVER_ERROR => 5,
            Response::HTTP_SERVICE_UNAVAILABLE => 503,
            Response::HTTP_CREATED => 2,
            Response::HTTP_OK => 2,
            Response::HTTP_UNAUTHORIZED => 401,
            Response::HTTP_UNPROCESSABLE_ENTITY => 422,
            Response::HTTP_PAYMENT_REQUIRED => 999,
            Response::HTTP_FORBIDDEN => 403,
        ][$code];
    }

    /**
     * @param $data
     * @return null
     */
    private static function handleReturnedResult($data)
    {
        if (collect($data)->count() == 0) {

            return null;

        }

        return $data;
    }
}
