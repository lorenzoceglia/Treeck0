<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Utility\NotificatoreManager;

class AdminController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $model=$this->loadModel('Notifications');
        $this->loadComponent('Notificatore');
        $notificationManager=NotificatoreManager::instance();

        $notificationManager->addTemplate('newBlog', [
            'title' => 'New blog by :username',
            'body' => ':username has posted a new blog named :name'
        ]);

        $notificationManager->notify([
            'users' => [1, 2],
            'recipientLists' => ['administrators'],
            'template' => 'newBlog',
            'vars' => [
                'username' => 'Bob Mulder',
                'name' => 'My great new blogpost'
            ]
        ]);

        $notificationManager->addRecipientList('administrators', [1]);
        $notificationManager->notify([
            'recipientLists' => ['administrators'],
        ]);

        $contanotifiche = $this->Notificatore->countNotifications(1);
        $this->set('conta' ,$contanotifiche);


        
        //$template=$notificationManager->addTemplate('newBlog');  

        //$template=$notificationManager->addRecipientList('administrators', [1]);
        

        /*$notificationManager->notify([
            'recipientLists' => ['administrators'],
        ]);

        

        /*$this->loadModel('Requests');
        //$richiesta = $this->Requests->newEntity();
        

        $iduser=$id;

        //verificare se l'id dell'utente loggato è presente nel campo user_id
        
        $query = $this->Requests->find();
        $query->where(['users_id' => $iduser]);

        //$check= $query->count();

        foreach ($query as $row) {
                    
            $status=$row->status;
            //1:admin,2:shareholder.3=guest
        }

        if($status=='new')   //richiesta==new
        {        
            $check=0; 
            $this->set('check', $check);    
            //azioni possibili accetta e rifiuta


        }
        else if($status=='accepted')  //richiesta==accettata
        {
            $check=1;
            $this->set('check', $check);
            //azione possibile rifiuta

            
            
        }
        else if($status=='refused')  //richiesta==rifiutata
        {
            $check=2;
            $this->set('check', $check);
            //azione possibile accetta
        }*/
        
    } 



    public function index()
    {   
        

        $this->loadModel('Courses');

        $this->loadComponent('Paginator');

        $this->loadModel('Requests');

        $courses = $this->Paginator->paginate($this->Courses->find());

        //$requests = $this->Paginator->paginate($this->Requests->find());
        
        $ciao = $this->Requests->find();

        //$this->set('albums', $list);
        
        $this->set('requests' ,$ciao);

        $this->set(compact('courses'));
        

    }


    public function add()
    {
        $this->loadModel('Courses');
        $course = $this->Courses->newEntity();

        if ($this->request->is('post'))
        {
            $course = $this->Courses->patchEntity($course, $this->request->getData());


            if ($this->Courses->save($course))
            {
                $this->Flash->success(__('Il corso è stato salvato.'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('impossibile aggiungere corso.'));
        }
        $this->set('course', $course);



    }

    public function accept($id,$iduser)
        {
            //fare una query che dato l'id utente va in request e modifica il campo status da new a accepted e cambia il campo shareholder da utente con la pk
            /*$request = TableRegistry::get('Requests');
        
            $request = TableRegistry::get('Users');
            $query = $request->query();
            $query->update()
            ->set(['shareholder' => 1 ])
            ->where(['id' => $iduser])
            ->execute();*/

            //error_log($iduser, 3, "C:/Users/Work/Desktop/my-errors.log");

            $requestTable = TableRegistry::get('Requests');
            $request = $requestTable->get($id);
            $request->status = 'accepted';
            $requestTable->save($request);
            
            $id=$iduser;

            $userTable = TableRegistry::get('Users');
            $user = $userTable->get($id);
            $user->role_id = 2;
            $userTable->save($user);

            return $this->redirect([
                'controller' => 'Admin',
                'action' => 'index'
            ]);
        }       

    public function refuse($id,$iduser)
        {
            //fare una query che dato l'id utente va in request e modifica il campo status da new a accepted e cambia il campo shareholder da utente con la pk

            /*$request = TableRegistry::get('Requests');
            $query = $request->query();
            $query->update()
            ->set(['status' => 'refused'])
            ->where(['users_id' => $iduser])
            ->execute();
            */
            
            $requestTable = TableRegistry::get('Requests');
            $request = $requestTable->get($id);
            $request->status = 'refused';
            $requestTable->save($request);

            $id=$iduser;

            $userTable = TableRegistry::get('Users');
            $user = $userTable->get($id);
            $user->role_id = 3;
            $userTable->save($user);


            /*
            Mettiamo caso la richiesta viene poi rifiutata facciamo in modo che al tizio venga tolto l'accesso ai corsi e lo stato di socio
            */
    
            return $this->redirect([
                'controller' => 'Admin',
                'action' => 'index'
            ]);

        }


    

    public function delete($name)
    {
        $this->loadModel('Courses');
        
        $this->request->allowMethod(['post', 'delete']);

        $course = $this->Courses->findByName($name)->firstOrFail();

        if ($this->Courses->delete($course))
        {
            $this->Flash->success(__('The {0} article has been deleted.', $course->name));
            return $this->redirect(['action' => 'index']);
        }


    }


}
?>