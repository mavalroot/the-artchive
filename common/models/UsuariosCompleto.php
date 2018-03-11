<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usuarios_completo".
 *
 * @property string $username
 * @property string $email
 * @property string $aficiones
 * @property string $tematica_favorita
 * @property string $plataforma
 * @property string $pagina_web
 * @property string $avatar
 * @property int $tipo_usuario
 * @property int $created_at
 * @property int $updated_at
 */
class UsuariosCompleto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios_completo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['tipo_usuario', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['tipo_usuario', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'aficiones', 'tematica_favorita', 'plataforma', 'pagina_web', 'avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'aficiones' => 'Aficiones',
            'tematica_favorita' => 'Tematica Favorita',
            'plataforma' => 'Plataforma',
            'pagina_web' => 'Pagina Web',
            'avatar' => 'Avatar',
            'tipo_usuario' => 'Tipo Usuario',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function primaryKey()
    {
        return ['username'];
    }
}
