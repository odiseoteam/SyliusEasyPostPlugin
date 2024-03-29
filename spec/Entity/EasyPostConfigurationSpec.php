<?php

namespace spec\Odiseo\SyliusEasyPostPlugin\Entity;

use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfiguration;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

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

    public function it_implements_timestampable_interface(): void
    {
        $this->shouldImplement(TimestampableInterface::class);
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
        $this->setName('Configuration default');
        $this->getName()->shouldReturn('Configuration default');
        $this->setApiKey('apiKey');
        $this->getApiKey()->shouldReturn('apiKey');
    }
}
