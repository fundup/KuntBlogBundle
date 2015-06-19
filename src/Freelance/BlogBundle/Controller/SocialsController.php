<?php

namespace Freelance\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\RedirectResponse;

class SocialsController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/")
     */
    public function getLastPhotosAction($nbPhotos = 6)
    {
        //Get data from instagram api
        $hashtag = 'max';

        //Query need client_id or access_token
        $query = array(
            'client_id' => '',
            'count'		=> 3
        );
        $url = 'https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?'.http_build_query($query);
        try {
            $curl_connection = curl_init($url);
            curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);

            //Data are stored in $data
            $data = json_decode(curl_exec($curl_connection), true);
            curl_close($curl_connection);

        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

}