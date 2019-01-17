<?php
/**
 * Copyright © Magehub. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magehub\Adminlogin\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	const XML_PATH_MH_ADMINLOGIN_ENABLE = 'mh_adminlogin/general/enable';
	const XML_PATH_MH_ADMINLOGIN_USERNAME = 'mh_adminlogin/general/username';
	const XML_PATH_MH_ADMINLOGIN_PASSWORD = 'mh_adminlogin/general/password';
	const XML_PATH_MH_ADMINLOGIN_ALLOWEDIP = 'mh_adminlogin/general/allowed_ip';

	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress
		)
	{
		parent::__construct($context);
		$this->scopeConfig = $scopeConfig;
		$this->remoteAddress = $remoteAddress;
	}

	public function getConfig($path)
	{
		return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function isEnabled()
	{
		return (bool) $this->scopeConfig->getValue(self::XML_PATH_MH_ADMINLOGIN_ENABLE);
	}

	public function getUsername()
	{
		return $this->scopeConfig->getValue(self::XML_PATH_MH_ADMINLOGIN_USERNAME);
	}

	public function getPassword()
	{
		return $this->scopeConfig->getValue(self::XML_PATH_MH_ADMINLOGIN_PASSWORD);
	}

	public function getAllowedIps()
	{
		return $this->scopeConfig->getValue(self::XML_PATH_MH_ADMINLOGIN_ALLOWEDIP);
	}

	public function getCurrentIpAddress()
	{
		return $this->remoteAddress->getRemoteAddress();
	}

	public function isAllowedIp() : bool
	{
		$allowed_ips = $this->getAllowedIps();
		$allowed_ips = explode(',');
		$allowed_ips = array_values(array_filter(array_map('trim', $allowed_ips)));
		if(empty($allowed_ips))
			$allowed_ips = [];

		if(in_array('*', $allowed_ips))
			return true;

		if(in_array($this->getCurrentIpAddress(), $allowed_ips))
			return true;

		return false;
	}
}