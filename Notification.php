<?php
namespace Notifiche\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Text;
use Cake\Core\Configure;

/**
 * Notification Entity
 *
 * @property int $id
 * @property string|null $template
 * @property string|null $vars
 * @property int|null $user_id
 * @property int|null $state
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $tracking_id
 *
 * @property \Notifiche\Model\Entity\User $user
 * @property \Notifiche\Model\Entity\Tracking $tracking
 */
class Notification extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
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
