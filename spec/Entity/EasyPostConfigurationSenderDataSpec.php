<?php

namespace spec\Odiseo\SyliusEasyPostPlugin\Entity;

use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationSenderData;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationSenderDataInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;

class EasyPostConfigurationSenderDataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(EasyPostConfigurationSenderData::class);
    }

    public function it_implements_resource_interface(): void
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    public function it_implements_easy_post_configuration_sender_data_interface(): void
    {
        $this->shouldImplement(EasyPostConfigurationSenderDataInterface::class);
    }

    public function it_allows_access_via_properties(): void
    {
        $this->setStreet('Street');
        $this->getStreet()->shouldReturn('Street');
        $this->setCity('City');
        $this->getCity()->shouldReturn('City');
        $this->setCountryCode('Country');
        $this->getCountryCode()->shouldReturn('Country');
        $this->setProvinceName('Province');
        $this->getProvinceName()->shouldReturn('Province');
        $this->setPostcode('123456');
        $this->getPostcode()->shouldReturn('123456');
        $this->setPhoneNumber('123456789');
        $this->getPhoneNumber()->shouldReturn('123456789');
    }
}
