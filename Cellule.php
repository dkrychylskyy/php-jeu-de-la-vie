<?php
/**
 * Created by PhpStorm.
 * User: dimitry.krychylskyy
 * Date: 15/03/2018
 * Time: 11:52
 */

class Cellule
{
    public $etat;

    /**
     * Cellule constructor.
     * @param $etat
     */
    public function __construct($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat): void
    {
        $this->etat = $etat;
    }

}