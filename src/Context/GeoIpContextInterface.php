<?php

namespace Electra\GeoIp\Context;

use Electra\GeoIp\GeoIp;
use MaxMind\Db\Reader\InvalidDatabaseException;

interface GeoIpContextInterface
{
  /**
   * @return GeoIp
   * @throws InvalidDatabaseException
   */
  public function getGeoIp(): GeoIp;

}
