<?php

/**
 * Class for vote model
 */
class Application_Model_Votes extends Application_Model_Base
{
    /**
     * @var string
     */
    protected $_city;

    /**
     * @var string
     */
    protected $_color;

    /**
     * @var float
     */
    protected $_votes;

    public function toArray()
    {
        return array(
            'city'   => $this->getCity(),
            'color'   => $this->getColor(),
            'votes'   => $this->getVotes(),
        );
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->_color = $color;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->_color;
    }

    /**
     * @param float $votes
     */
    public function setVotes($votes)
    {
        $this->_votes = $votes;
    }

    /**
     * @return float
     */
    public function getVotes()
    {
        return $this->_votes;
    }
}