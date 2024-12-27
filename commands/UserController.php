<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class UserController extends Controller {

    public function actionNew($username, $password) {
        $user = new User;
        $user->username = $username;
        $user->password = $password;
        if($user->save()) {
            printf("new user ok, id: %d\n", $user->id);
        } else {
            printf("Problema creando usuario");
        }

        return ExitCode::OK;
    }
    public function actionCheck($username, $password) {
        $user = User::findOne(['username' => $username]);
        if(!empty($user)) {
            if($user->password === $user->ofuscatePassword($password)) {
                printf("login valido\n");
                return ExitCode::OK;
            }

        }
        printf("nel\n");
        return ExitCode::OK;
    }
}

