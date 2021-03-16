![alt text](https://art.pixilart.com/64c1d4c28cff103.png)
# Notificator component for CakePHP 3.9

This component is a conversion of the notifier plugin Bakkerij [Git](https://github.com/bakkerij/notifier).
Due to his incompatibility with the version 3.9 of CakePhp I decided to do a component-conversion that let him works on the latest versions of the framework.
This component is a plug and play way to integrate a simple but functional notifications system to your project.

## Set-Up

After unpacking the component and the Utility class you just need to set up the database. I made a simple Sql script that "makes your life easier", no migration at all. 

## Sending notifications

#### Templates

Before sending any notification, we need to register a template. An example about how to add templates:

```php
    $notificationManager->addTemplate('newPhoto', [
        'title' => 'New photo by :username',
        'body' => ':username has posted a new photo with desc: :"desc'
    ]);
```

When adding a new template, you have to add a `title` and a `body`. Both are able to contain variables like `:username`
and `:desc`. Later on we will tell more about these variables.

#### Notify

Now we will be able to send a new notification using our `newPhoto` template.

```php
    $notificationManager->notify([
        'users' => [1, 2],
        'recipientLists' => ['administrators'],
        'template' => 'newPhoto',
        'vars' => [
            'username' => 'Lorenzo Ceglia',
            'desc' => 'My summer fav place'
        ]
    ]);
```

> Note: You are also able to send notifications via the component: `$this->Notificatore->notify()`.

With the `notify` method we sent a new notification. A list of all attributes:

- `users` - This is an integer or array filled with id's of users to notify. So, when you want to notify user 261 and
373, add `[261, 373]`.
- `recipientLists` - This is a string or array with lists of recipients. Further on you can find more about
RecipientLists.
- `template` - The template you added, for example `newBlog`.
- `vars` - Variables to use. In the template `newPhoto` we used the variables `username` and `desc`. These variables can
be defined here.

#### Recipient Lists

To send notifications to large groups you are able to use RecipientLists.
You can register them with:

```php
    $notificationManager->addRecipientList('administrators', [1,2,3,4]);
```
    
Now we have created a list of recipients called `administrators`.

This can be used later on when we send a new notification: 

```php
    $notificationManager->notify([
        'recipientLists' => ['administrators'],
    ]);
```

Now, the users 1, 2, 3 and 4 will receive a notification.

## Retrieving notifications

#### Lists

You can easily retrieve notifications via the `getNotifications` method. Some examples:

```php
    // getting a list of all notifications of the current logged in user
    $this->Notificatore->getNotifications();

    // getting a list of all notifications of the user with id 2
    $this->Notificatore->getNotifications(2);
    
    // getting a list of all unread notifications
    $this->Notificatore->allNotificationList(2, true);

    // getting a list of all read notifications
    $this->Notificatore->allNotificationList(2, false);
```

#### Counts

Getting counts of read/unread notifications can be done via the `countNotifications` method. Some examples:

```php
    // getting a number of all notifications of the current logged in user
    $this->Notificatore->countNotifications();

    // getting a number of all notifications of the user with id 2
    $this->Notificatore->countNotifications(2);
    
    // getting a number of all unread notifications
    $this->Notificatore->countNotificationList(2, true);

    // getting a number of all read notifications
    $this->Notificatore->countNotificationList(2, false);
```

#### Mark as read

To mark notifications as read, you can use the `markAsRead` method. Some examples:

```php
    // mark a single notification as read
    $this->Notificatore->markAsRead(500;

    // mark all notifications of the given user as read
    $this->Notificatore->markAsRead(null, 2);
```

#### Notification Entity

The following getters can be used at your notifications entity:
- `title` - The generated title including the variables.
- `body` - The generated body including the variables.
- `unread` - Boolean if the notification is not read yet.
- `read` - Boolean if the notification is read yet.

Example:
    
```php
    // returns true or false
    $entity->get('unread');
    
    // returns the full output like 'Bob Mulder has posted a new blog named My Great New Post'
    $entity->get('body');
```

#### Passing to view

You can do something like this to use the notification list in your view:

```php
    $this->set('notifications', $this->Notificatore->getNotifications());
```

## Notification Manager

The `NotificationManager` is the Manager of the plugin. You can get an instance with:

```php
    NotificationManager::instance();
```

The manager has the following methods available:

- `notify`
- `addRecipientList`
- `getRecipientList`
- `addTemplate`
- `getTemplate`

## Notifier Component

```php
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Notificatore');
    }
```

The component has the following methods available:

- `getNotifications`
- `countNotifications`
- `markAsRead`
- `notify`

