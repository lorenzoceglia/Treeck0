<?php
namespace Notifiche\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class NotificationsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('notifications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('template')
            ->maxLength('template', 150)
            ->allowEmptyString('template');

        $validator
            ->scalar('vars')
            ->allowEmptyString('vars')
            ->allowEmptyString('title')
            ->allowEmptyString('body');

        $validator
            ->integer('state')
            ->allowEmptyString('state');

        return $validator;
    }


    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['tracking_id'], 'Trackings'));

        return $rules;
    }
}
