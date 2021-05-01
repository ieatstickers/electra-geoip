<?php

namespace Electra\GeoIp;
use Electra\GeoIp\Entity\Location;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;

class GeoIp
{
  /** @var Reader */
  private $geoipReader;

  /**
   * @param string $geoipDbPath
   *
   * @throws InvalidDatabaseException
   */
  protected function __construct(string $geoipDbPath)
  {
    $this->geoipReader = new Reader($geoipDbPath);
  }

  /**
   * @param string|null $geoipDbPath
   *
   * @return GeoIp
   * @throws InvalidDatabaseException
   */
  public static function init(string $geoipDbPath = null): GeoIp
  {
    return new self($geoipDbPath ?: __DIR__ . '/../db/GeoLite2-City/GeoLite2-City.mmdb');
  }

  /**
   * @param string $ip
   *
   * @return Location
   * @throws InvalidDatabaseException
   */
  public function getIpLocation(string $ip): ?Location
  {
    $record = null;

    try {
      $record = $this->geoipReader->city($ip);
    }
    catch(AddressNotFoundException $exception) {}

    if (!$record)
    {
      return null;
    }

    $location = Location::create();
    $location->latitude = $record->location->latitude;
    $location->longitude = $record->location->longitude;
    $location->citySubDivision = $record->mostSpecificSubdivision->name;
    $location->cityName = $record->city->name;
    $location->postalCode = $record->postal->code;
    $location->countryName = $record->country->name;
    $location->countryIsoCode = $record->country->isoCode;
    $location->isEu = $record->country->isInEuropeanUnion;

    return $location;
  }
}
