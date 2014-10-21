<?php
namespace Graze\Queue\Message;

class MessageFactory implements MessageFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createMessage($body, array $options = [])
    {
        return new Message($body, $this->getMetadata($options), $this->getValidator($options));
    }

    /**
     * @return callable
     */
    protected function getMetadata(array $options)
    {
        return isset($options['metadata']) ? $options['metadata'] : [];
    }

    /**
     * @return callable
     */
    protected function getValidator(array $options)
    {
        return isset($options['validator']) ? $options['validator'] : function (MessageInterface $message) {
            return true;
        };
    }
}