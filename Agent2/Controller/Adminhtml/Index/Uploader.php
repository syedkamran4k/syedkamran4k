<?php
namespace MyMod\Agent2\Controller\Adminhtml\Index;
use Magento\Framework\Controller\ResultFactory;

class Uploader extends \Magento\Backend\App\Action
{
    protected $imageUploader;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('mymod_agent::agent');
    }

    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('agent_image');
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
