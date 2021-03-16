<?php
namespace App\Controller\Component;

use Progetto\Percorso\Utility\NotificationManager;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;


class NotificatoreComponent extends Component
{
    
    protected $_defaultConfig = [
        'UsersModel' => 'Users'
    ];

    
    private $Controller = null;

    
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->Controller = $this->_registry->getController();
    }

    
    public function setController($controller)
    {
        $this->Controller = $controller;
    }

    
    public function getNotifications($userId = null, $state = null)
    {
        if (!$userId) {
            $userId = $this->Auth->user('id');
        }

        $model = TableRegistry::get('Notifications');

        $query = $model->find()->where(['Notifications.user_id' => $userId])->order(['created' => 'desc']);

        if (!is_null($state)) {
            $query->where(['Notifications.state' => $state]);
        }

        return $query->toArray();
    }

    
    public function countNotifications($userId = null, $state = null)
    {
        if (!$userId) {
            $userId = $this->Auth->user('id');
        }

        $model = TableRegistry::get('Notifications');

        $query = $model->find()->where(['Notifications.user_id' => $userId]);

        if (!is_null($state)) {
            $query->where(['Notifications.state' => $state]);
        }

        return $query->count();
    }

    
    public function markAsRead($notificationId = null, $user = null)
    {
        if (!$user) {
            $userId = $this->Auth->user('id');
        }

        $model = TableRegistry::get('Notifications');

        if (!$notificationId) {
            $query = $model->find('all')->where([
                'user_id' => $user,
                'state' => 1
            ]);
        } else {
            $query = $model->find('all')->where([
                'user_id' => $user,
                'id' => $notificationId

            ]);
        }

        foreach ($query as $item) {
            $item->set('state', 0);
            $model->save($item);
        }
    }

    
    public function notify($data)
    {
        return NotificationManager::instance()->notify($data);
    }
}
