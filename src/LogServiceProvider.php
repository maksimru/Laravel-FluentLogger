<?php

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 *
 * Copyright (c) 2015-2016 Yuuki Takezawa
 *
 */
namespace Ytake\LaravelFluent;

/**
 * Class LogServiceProvider
 */
class LogServiceProvider extends \Illuminate\Log\LogServiceProvider
{


    /**
     * {@inheritdoc}
     */
    public function register()
    {
        /**
         * for package configure
         */
        $configPath = __DIR__ . '/config/fluent.php';
        $this->mergeConfigFrom($configPath, 'fluent');
        $this->publishes([$configPath => config_path('fluent.php')], 'log');
        parent::register();
    }

    public function boot()
    {
        $this->app['log']->extend('fluent', function ($app, $config) {
            return (new LaravelFluentLogger($app, $config))->getLogger();
        });
    }

}