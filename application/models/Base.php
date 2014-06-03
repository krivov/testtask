<?php

/**
 * Base model class
 */
abstract class Application_Model_Base
{
    /**
     * @param array $options
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Magic setter
     *
     * @param string $name
     * @param mixed  $value
     *
     * @throws Exception
     */
    public function __set($name, $value)
    {
        $name = explode('_', $name);
        $name = implode('', array_map('ucfirst', $name));
        $method = 'set' . $name;

        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception(
                sprintf(
                    'Method "%s" does not exists form class "%s".',
                    $method,
                    get_class($this)
                )
            );
        }

        $this->$method($value);
    }

    /**
     * Magic getter.
     *
     * @param  string $name
     *
     * @throws Exception
     * @return mixed
     */
    public function __get($name)
    {
        $name = explode('_', $name);
        $name = implode('', array_map('ucfirst', $name));
        $method = 'get' . $name;

        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception(
                sprintf(
                    'Method "%s" does not exists form class "%s".',
                    $method,
                    get_class($this)
                )
            );
        }

        return $this->$method();
    }

    /**
     * Fills model properties with given options.
     *
     * @param array $options
     * @return Application_Model_Base
     */
    public function setOptions(array $options)
    {
        foreach ($options as $property => $value) {
            $name = explode('_', $property);
            $name = implode('', array_map('ucfirst', $name));
            $method = 'set' . $name;

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * Converts model to array.
     * @return array
     */
    abstract public function toArray();
}