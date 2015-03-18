<?php

namespace spec\Modules\User\Services;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class GravatarSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Modules\User\Services\Gravatar');
    }

    function it_has_default_size()
    {
        $this->getSize()
            ->shouldNotBeNull();
    }

    function it_has_default_image()
    {
        $this->getDefault()
            ->shouldNotBeNull();
    }

    function it_has_default_rating()
    {
        $this->getRating()
            ->shouldNotBeNull();
    }

    function it_returns_a_valid_url()
    {
        $this->getGravatar('test@example.com')
            ->shouldMatch('/^(http|https):\/\/www.gravatar.com\/\w+/i');
    }
}
