<?php
/*
Plugin Name: Data Candy
Description: Un plugin d'itégration de Data Candy
Version: 0.1a
Author: Novactive
*/

class DataCandy
{
    private $_url;

    /**
     *
     */
    public function __construct ()
    {
        include_once plugin_dir_path( __FILE__ ).'/candyDataException.php';

        $this->_url = "app.datacandy.com";
    }

    /**
     * @param array $pParams
     * @return array|bool
     */
    public function get ($pParams = array())
    {
        return $this->connect($this->_makeUrl($pParams),
            $this->_createContext('GET'));
    }

    /**
     * @param null $pContent
     * @param array $pGetParams
     * @return mixed
     */
    public function delete ($pContent = null, $pGetParams = array())
    {
        return $this->connect($this->_makeUrl($pGetParams),
            $this->_createContext('DELETE', $pContent));
    }

    /**
     * @param $Method
     * @param null $Content
     * @return resource
     */
    protected function _createContext($Method, $Content = null)
    {
        $opts = array(
            'http'=>array(
                'method'=>$Method,
                'header'=>'Content-type: application/x-www-form-urlencoded',
                'Authorization'=>'Basic QwxhZGRpbjpvcGVuIHN1c2FtZQ==',
            )
        );

        if ($Content !== null){
            if (is_array($Content)){
                $pContent = http_build_query($Content);
            }
            $opts['http']['content'] = $Content;
        }
        return stream_context_create($opts);
    }

    /**
     * @param $pParams
     * @return string
     */
    protected function _makeUrl($pParams)
    {
        return $this->_url
        .(strpos($this->_url, '?') ? '' : '?')
        .http_build_query($pParams);
    }

    /**
     * @param $url
     * @param $context
     * @return array|bool
     */
    public function  connect ($url, $context)
    {
        if (($stream = fopen(pUrl, 'r', false, $context)) !== false){
            if (stream_get_meta_data($stream) != 200 || 201)
            {
                throw new DataCandyException((stream_get_meta_data($stream)));
            }
            try
            {
                $content = stream_get_contents($stream);
                $header = stream_get_meta_data($stream);
                fclose($stream);
            }
            catch (dataCandyException $e)
            {
                echo $e;
            }

            return array('content'=>$content, 'header'=>$header);
        }else{
            return false;
        }
    }

}