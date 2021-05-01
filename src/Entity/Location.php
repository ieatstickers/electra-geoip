<?php

namespace Electra\GeoIp\Entity;

use Electra\Utility\Objects;

class Location
{
  public $latitude;
  public $longitude;
  public $citySubDivision;
  public $cityName;
  public $postalCode;
  public $countryName;
  public $countryIsoCode;
  public $isEu;

  /**
   * @param array $data
   *
   * @return Location
   * @throws \Exception
   */
  public static function create($data = [])
  {
    return Objects::hydrate(new self(), (object)$data);
  }
}
