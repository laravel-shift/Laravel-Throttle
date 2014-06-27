<?php

/**
 * This file is part of Laravel Throttle by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Throttle;

use GrahamCampbell\Throttle\Factories\FactoryInterface;

/**
 * This is the throttle class.
 *
 * @package    Laravel-Throttle
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Throttle/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Throttle
 */
class Throttle
{
    /**
     * The factory instance.
     *
     * @var \GrahamCampbell\Throttle\Factories\FactoryInterface
     */
    protected $factory;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Throttle\Factories\FactoryInterface  $factory
     * @return void
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Get a new throttler.
     *
     * @param  array|\Illuminate\Http\Request  $data
     * @param  int  $limit
     * @param  int  $time
     * @return \GrahamCampbell\Throttle\Throttlers\ThrottlerInterface
     */
    public function get($data, $limit = 10, $time = 60)
    {
        return $this->factory->make($data, $limit, $time);
    }

    /**
     * Get the cache instance.
     *
     * @return \GrahamCampbell\Throttle\Factories\FactoryInterface
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * Dynamically pass methods to a new throttler instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array(array($this, 'get'), $parameters)->$method();
    }
}