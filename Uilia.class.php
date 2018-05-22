<?php

/**
 * Uilia.class [ API ]
 * Classe de coneção REST com a plataforma UILIA
 * @copyright (c) 2018, William alvares - UILIA
 */
class uiliaAPI {

    private $Base;
    private $Key;
    private $Token;
    private $cUrl;
    private $Error;

    public function __construct() {
        $this->Base = "link da loja no Uilia";
        $this->Key = "COLOQUE A KEY AQUI";
        $this->Token = "COLOQUE O TOKEN AQUI";
    }

    /**
     * Confira a documentação em https://uilia.docs.apiary.io
     * @param type $method = GET, POST, PUT ou DELETE!
     * @param type $request = Confira na documentação
     * @param type $parameters = Exemplo: &id=1&limit=10
     */
    public function get($request, $parameters = null) {
        $httpHeaders = array("Content-Type: application/json");
        if ($this->Token) {
            $httpHeaders[] = "Authorization: api {$this->Key} token {$this->Token}";
        }
        $this->cUrl = $this->Base ."/_api/". $request . "/{$parameters}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->cUrl);
        curl_setopt($curl, CURLOPT_TIMEOUT, 100020);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeaders);
        $result = curl_exec($curl);
        curl_close($curl);

        if (empty(json_decode($result)->error)):
            return json_decode($result, true);
        else:
            $this->Error = json_decode($result)->error;
            return false;
        endif;
    }

    public function post($request, $data) {
        $httpHeaders = array("Content-Type: application/json");
        if ($this->Token) {
            $httpHeaders[] = "Authorization: api {$this->Key} token {$this->Token}";
        }
        $this->cUrl = $this->Base ."/_api/". $request . "";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->cUrl);
        curl_setopt($curl, CURLOPT_TIMEOUT, 100020);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeaders);
        $result = curl_exec($curl);
        curl_close($curl);

        if (empty(json_decode($result)->error)):
            return json_decode($result, true);
        else:
            $this->Error = json_decode($result)->error;
            return false;
        endif;
    }

    public function put($request, $id, $data) {
        $httpHeaders = array("Content-Type: application/json");
        if ($this->Token) {
            $httpHeaders[] = "Authorization: api {$this->Key} token {$this->Token}";
        }
        $this->cUrl = $this->Base ."/_api/". $request . "/{$id}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->cUrl);
        curl_setopt($curl, CURLOPT_TIMEOUT, 100020);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeaders);
        $result = curl_exec($curl);
        curl_close($curl);

        if (empty(json_decode($result)->error)):
            return json_decode($result, true);
        else:
            $this->Error = json_decode($result)->error;
            return false;
        endif;
    }

    public function delete($request, $id) {
        $httpHeaders = array("Content-Type: application/json");
        if ($this->Token) {
            $httpHeaders[] = "Authorization: api {$this->Key} token {$this->Token}";
        }
        $this->cUrl = $this->Base ."/_api/". $request . "/{$id}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->cUrl);
        curl_setopt($curl, CURLOPT_TIMEOUT, 100020);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeaders);
        $result = curl_exec($curl);
        curl_close($curl);

        if (empty(json_decode($result)->error)):
            return json_decode($result, true);
        else:
            $this->Error = json_decode($result)->error;
            return false;
        endif;
    }

    public function getError() {
        return $this->Error;
    }

}
