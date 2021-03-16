<?php
namespace Notifiche\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Text;
use Cake\Core\Configure;


class Notification extends Entity
{
    protected $_accessible = [
        'template' => true,
        'vars' => true,
        'user_id' => true,
        'state' => false,
        'tracking_id' => true,
        'user' => true,
    ];

    protected function _getVars($vars)
    {
        $array = json_decode($vars, true);

        if (is_object($array)) {
            return $array;
        }

        return $vars;
    }

    protected function _setVars($vars)
    {
        if (is_array($vars)) {
            return json_encode($vars);
        }

        return $vars;
    }

    protected function _getTitle()
    {
        $templates = Configure::read('Notifier.templates');

        if (array_key_exists($this->_properties['template'], $templates)) {
            $template = $templates[$this->_properties['template']];

            $vars = json_decode($this->_properties['vars'], true);

            return Text::insert($template['title'], $vars);
        }
        return '';
    }

    protected function _getBody()
    {
        $templates = Configure::read('Notifier.templates');

        if (array_key_exists($this->_properties['template'], $templates)) {
            $template = $templates[$this->_properties['template']];

            $vars = json_decode($this->_properties['vars'], true);

            return Text::insert($template['body'], $vars);
        }
        return '';
    }

    protected function _getUnread()
    {
        if ($this->_properties['state'] === 1) {
            return true;
        }
        return false;
    }

    protected function _getRead()
    {
        if ($this->_properties['state'] === 0) {
            return true;
        }
        return false;
    }

    protected $_virtual = ['title', 'body', 'unread', 'read'];





}
