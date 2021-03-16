<?php

namespace App\Utility;

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;


class NotificatoreManager
{

    protected static $_generalManager = null;

   
    public static function instance($manager = null)
    {
        if ($manager instanceof NotificatoreManager) {
            static::$_generalManager = $manager;
        }
        if (empty(static::$_generalManager)) {
            static::$_generalManager = new NotificatoreManager();
        }
        return static::$_generalManager;
    }

    public function notify($data)
    {
        $model = TableRegistry::getTableLocator()->get('Notifications');

        $_data = [
            'users' => [],
            'recipientLists' => [],
            'template' => 'default',
            'vars' => [],
            'tracking_id' =>  $this->getTrackingId()
        ];

        $data = array_merge($_data, $data);

        foreach ((array)$data['recipientLists'] as $recipientList) {
            $list = (array)$this->getRecipientList($recipientList);
            $data['users'] = array_merge($data['users'], $list);
        }

        foreach ((array)$data['users'] as $user) {
            $entity = $model->newEntity();

            $entity->set('template', $data['template']);
            $entity->set('tracking_id', $data['tracking_id']);
            $entity->set('vars', $data['vars']);
            $entity->set('state', 1);
            $entity->set('user_id', $user);

            $model->save($entity);
        }

        return $data['tracking_id'];
    }

    public function addRecipientList($name, $userIds)
    {
        Configure::write('Notifier.recipientLists.' . $name, $userIds);
    }

   
    public function getRecipientList($name)
    {
        return Configure::read('Notifier.recipientLists.' . $name);
    }

    public function addTemplate($name, $options = [])
    {
        $_options = [
            'title' => 'Notification',
            'body' => '',
        ];

        $options = array_merge($_options, $options);

        Configure::write('Notifier.templates.' . $name, $options);

        
    }


    public function getTemplate($name, $type = null)
    {
        $templates = Configure::read('Notifier.templates');

        if (array_key_exists($name, $templates)) {
            if ($type == 'title') {
                return $templates[$name]['title'];
            }
            if ($type == 'body') {
                return $templates[$name]['body'];
            }
            return $templates[$name];
        }

        return false;
    }


    public function getTrackingId()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $trackingId = '';
        for ($i = 0; $i < 10; $i++) {
            $trackingId .= $characters[rand(0, $charactersLength - 1)];
        }
        return $trackingId;
        
    }
}
