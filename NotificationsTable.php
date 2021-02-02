<?php
namespace Notifiche\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Notifications Model
 *
 * @property \Notifiche\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Notifiche\Model\Table\TrackingsTable&\Cake\ORM\Association\BelongsTo $Trackings
 *
 * @method \Notifiche\Model\Entity\Notification get($primaryKey, $options = [])
 * @method \Notifiche\Model\Entity\Notification newEntity($data = null, array $options = [])
 * @method \Notifiche\Model\Entity\Notification[] newEntities(array $data, array $options = [])
 * @method \Notifiche\Model\Entity\Notification|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Notifiche\Model\Entity\Notification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Notifiche\Model\Entity\Notification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Notifiche\Model\Entity\Notification[] patchEntities($entities, array $data, array $options = [])
 * @method \Notifiche\Model\Entity\Notification findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NotificationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('notifications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['tracking_id'], 'Trackings'));

        return $rules;
    }
}
