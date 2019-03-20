<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 20/03/19
 * Time: 8:34
 */

namespace Authcheck;

class Config implements ConfigInterface
{

  protected $config;

  public function __construct($file = './config.yml') {
    $this->config = yaml_parse(file_get_contents($file));
  }

  public function getUrls() {
    return $this->config['urls'];
  }

}
