<?php

/**
 * Class for color model
 */
class Application_Model_Colors extends Application_Model_Base
{
    /**
     * @var string
     */
    protected $_color;

    public function toArray()
    {
        return array(
            'color'   => $this->getColor(),
        );
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
}