<?php
namespace SCSS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use SCSS\UserBundle\Traits\AddressTrait;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\GeolocatableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
* @ORM\Entity
* @ORM\Table(name="address_book")
*/
class AddressBook
{
    use AddressTrait;
    use GeolocatableTrait;
    use TimestampableTrait;
    use SluggableTrait;

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * Get id
    *
    * @return integer
    */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Formats an address in an array form
     *
     * @param array  $address The address array (required keys: firstname, lastname, address1, postcode, city, country_code)
     * @param string $sep     The address separator
     *
     * @return string
     */
    public static function formatAddress(array $address, $sep = ", ")
    {
        $values = array_map('trim', array(
                sprintf("%s %s", $address['first_name'], $address['last_name']),
                $address['address'],
                $address['postal_code'],
                $address['city']
            ));

        foreach ($values as $key => $val) {
            if (!$val) {
                unset($values[$key]);
            }
        }

        $fullAddress = implode($sep, $values);

        if ($countryCode = trim($address['country_code'])) {
            if ($fullAddress) {
                $fullAddress .= " ";
            }

            $fullAddress .= sprintf("(%s)", $countryCode);
        }

        return $fullAddress;
    }
}