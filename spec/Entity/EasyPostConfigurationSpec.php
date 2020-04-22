<?php

namespace spec\Odiseo\SyliusEasyPostPlugin\Entity;

use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfiguration;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;

class EasyPostConfigurationSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(EasyPostConfiguration::class);
    }

    public function it_implements_resource_interface(): void
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    public function it_implements_easy_post_configuration_interface(): void
    {
        $this->shouldImplement(EasyPostConfigurationInterface::class);
    }

    public function it_toggles(): void
    {
        $this->enable();
        $this->isEnabled()->shouldReturn(true);
        $this->disable();
        $this->isEnabled()->shouldReturn(false);
    }

    public function it_allows_access_via_properties(): void
    {
        $this->setApiKey('apiKey');
        $this->getApiKey()->shouldReturn('apiKey');
        $this->setStreet1('Street 1');
        $this->getStreet1()->shouldReturn('Street 1');
        $this->setStreet2('Street 2');
        $this->getStreet2()->shouldReturn('Street 2');
        $this->setCity('City');
        $this->getCity()->shouldReturn('City');
        $this->setCountry('Country');
        $this->getCountry()->shouldReturn('Country');
        $this->setState('State');
        $this->getState()->shouldReturn('State');
        $this->setZip('123456');
        $this->getZip()->shouldReturn('123456');
        $this->setPhone('123456789');
        $this->getPhone()->shouldReturn('123456789');
    }
}
