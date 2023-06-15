<?php

use yii\db\Migration;
use app\models\User;
/**
 * Class m230608_084619_update_password
 */
class m230608_084619_update_password extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $users = User::find()->all();

        foreach ($users as $user) {
            $hashedPassword = $this->hashPassword($user->mdp);
            $this->update('{{%visiteur}}', ['mdp' => $hashedPassword], ['id' => $user->id]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
    }

    /**
     * Hashes the password.
     *
     * @param string $password the password to hash
     * @return string the hashed password
     */
    protected function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
