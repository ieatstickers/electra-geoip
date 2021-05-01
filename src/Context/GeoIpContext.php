<?php

namespace Electra\GeoIp\Context;

use Electra\GeoIp\GeoIp;
use MaxMind\Db\Reader\InvalidDatabaseException;

trait GeoIpContext
{
  /** @var GeoIp */
  private $geoip;

  /**
   * @return GeoIp
   * @throws InvalidDatabaseException
   */
  public function getGeoIp(): GeoIp
  {
    if (!$this->geoip)
    {
      $this->geoip = GeoIp::init();
    }

    return $this->geoip;
  }
}
