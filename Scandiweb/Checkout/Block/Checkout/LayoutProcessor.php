<?php
namespace Scandiweb\Checkout\Block\Checkout;

class LayoutProcessor extends \Magento\Checkout\Block\Checkout\LayoutProcessor
{

    /**
     * Process js Layout of block
     *
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        $jsLayout =  parent::process($jsLayout);

        $shippingAddress = $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'];

        foreach ($shippingAddress  as $field => $shippingAddressData) {
            $fieldData = $shippingAddressData;
            if (in_array($field,['company','city'])) {
                $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$field]['visible']=false;
            }
            if (isset($shippingAddressData['label'])) {
                $label = (string)$shippingAddressData['label'];
                $split = str_split( $label );
                krsort($split);
                $newlabel = implode($split);
                $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$field]['label']=$newlabel;
            }
        }

        return $jsLayout;
    }

}
