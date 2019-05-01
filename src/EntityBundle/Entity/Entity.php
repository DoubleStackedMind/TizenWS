<?php
/**
 * Created by PhpStorm.
 * User: Ransom
 * Date: 4/15/2019
 * Time: 2:34 AM
 */

namespace EntityBundle\Entity;


interface Entity
{
    public function fromJsonObject($oj);

    // fetchType Eager or Lazy
    public function toJsonObject($fetchType);

    public function fromPostArray($pa);
}