<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
        /*
                if ($auth->getRole('admin') !== null) {
                    echo 'roles already exists ' . PHP_EOL;
                    return true;
                }
        */

        // Создадим роли админа и user
        $admin = $auth->createRole('admin');
        $user = $auth->createRole('user');

        // запишем их в БД
        $auth->add($admin);
        $auth->add($user);

        // Создаем наше правило, которое позволит проверить автора книги
        $authorRule = new \app\common\rbac\UserRule;
        // Запишем его в БД
        $auth->add($authorRule);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование книги updateBooks
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';
        $createBooksAdmin = $auth->createPermission('createBooksAdmin');
        $createBooksAdmin->description = 'Добавление книг';

        // Разрешение на редактирование книги
        $updateBooks = $auth->createPermission('updateBooks');
        $updateBooks->description = 'Редактирование книги';

        // Разрешение на Создание книги
        $createBooks = $auth->createPermission('createBooks');
        $createBooks->description = 'Создание книги';

        // Разрешение на  Удаление книги
        $deleteBooks = $auth->createPermission('deleteBooks');
        $deleteBooks->description = 'Удаление книги';


        // Создадим еще новое разрешение «Редактирование собственной книги» и ассоциируем его с правилом AuthorRule
        $updateOwnBooks = $auth->createPermission('updateOwnBooks');
        $updateOwnBooks->description = 'Редактирование собственной книги';
        // Указываем правило UserRule для разрешения updateOwnBooks.
        $updateOwnBooks->ruleName = $authorRule->name;

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($createBooksAdmin);
        $auth->add($updateBooks);
        $auth->add($createBooks);
        $auth->add($deleteBooks);
        $auth->add($updateOwnBooks);


        // Теперь добавим наследования. Для роли user мы добавим разрешение updateBooks,
        // а для админа добавим наследование от роли user и еще добавим собственное разрешение viewAdminPage
        // Роли «Редактор книг» присваиваем разрешение «Редактирование книги»
        $auth->addChild($user, $updateBooks);
        $auth->addChild($user, $createBooks);
        $auth->addChild($user, $deleteBooks);

        // админ наследует роль редактора книг. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $user);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($user, $createBooksAdmin);
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);

        // Назначаем роль user пользователю с ID 2
        $auth->assign($user, 2);
    }
}