<?php

namespace Authcheck;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

class Authcheck
{

  protected $config;
  protected $client;
  protected $success = [];
  protected $failed = [];

  public function __construct(ConfigInterface $config, ClientInterface $client)
  {
    $this->config = $config;
    $this->client = $client;
  }

  public function check()
  {
    foreach ($this->config->getUrls() as $url)
    {
      try {
        $this->client->request('GET', $url);
        $this->failed[] = $url;
      }
      catch (ClientException $exception) {
        if ($exception->getResponse()->getStatusCode() == 401) {
          $this->success[] = $url;
        }
        else {
          $this->failed[] = $url;
        }
      }
    }

    if (!empty($this->failed)) {
      throw new \Exception('The following sites doesn\'t have basic auth enabled: ' . print_r($this->failed, TRUE));
    }
    else {
      print "EVERYTHING IS OKAY";
    }
  }

}
