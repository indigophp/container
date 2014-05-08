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

/**
 * Serializable Trait
 *
 * Use this trait to serialize the data of the container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Serializable
{
    /**
     * {@inheritdocs}
     */
    public function serialize()
    {
        return serialize($this->data);
    }

    /**
     * {@inheritdocs}
     */
    public function unserialize($data)
    {
        $this->data = unserialize($data);
    }
}
