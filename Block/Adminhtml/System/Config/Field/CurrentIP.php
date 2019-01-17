<?php
/**
 * Copyright © Magehub. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magehub\Adminlogin\Block\Adminhtml\System\Config\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class CurrentIP extends Field
{
    /**
     * @var string
     */
    protected $_template = 'Magehub_Adminlogin::system/config/field/currentip.phtml';

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Magehub\Adminlogin\Helper\Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    /**
     * Remove scope label
     *
     * @param  AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return element html
     *
     * @param  AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }

    public function getCurrentIpAddress()
    {
        return $this->helper->getCurrentIpAddress();
    }
}