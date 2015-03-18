<?php

namespace spec\Vain\Packages\RealmAPI\Services;

use Illuminate\Support\Facades\Config;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class SoapServiceSpec extends LaravelObjectBehavior
{
    protected $__config;

    function let()
    {
        $configs = Config::get('realm.soap');
        $first = array_keys($configs)[ 0 ]; // grap the first realm

        $this->__config = $configs[ $first ];
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Vain\Packages\RealmAPI\Services\SoapService');
    }

    function it_has_default_timeout()
    {
        $this->getTimeout()
            ->shouldNotBeNull();
    }

    function it_configures_with_realm_config()
    {
        $this->configure($this->__config)
            ->shouldReturn($this);
    }

    function it_throws_exception_if_not_configured()
    {
        $this->shouldThrow('\InvalidArgumentException')
            ->during('client');
    }

    function it_connects_if_configured()
    {
        $this->configure($this->__config)
            ->client()
            ->shouldHaveType('\SoapClient');
    }

    function it_does_not_throw_exception_on_error()
    {
        $this->configure($this->__config)
            ->send('test command')
            ->shouldBeNull();
    }
}
