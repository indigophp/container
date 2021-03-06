<?php

/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Container;

use Fuel\Common\DataContainer;
use InvalidArgumentException;

if (class_exists('Arr') === false) {
    // make Arr available in the global namespace
    class_alias('Fuel\Common\Arr', 'Arr');
}

/**
 * Abstract container
 *
 * Common container method
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class AbstractContainer extends DataContainer
{
    /**
     * Validates a dataset
     *
     * @param [] $data
     *
     * @throws InvalidArgumentException
     */
    abstract public function validate(array $data);

    /**
     * {@inheritdocs}
     */
    public function setContents(array $data)
    {
        $this->validate($data);

        return parent::setContents($data);
    }

    /**
     * {@inheritdocs}
     */
    public function merge($arg)
    {
        $arguments = array_map(function ($array) {
            if ($array instanceof DataContainer) {
                return $array->getContents();
            }

            return $array;

        }, func_get_args());

        $arguments = call_user_func_array('Arr::merge', $arguments);

        $this->validate($arguments);

        return parent::merge($arguments);
    }
}
