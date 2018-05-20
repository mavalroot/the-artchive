<?php

namespace common\models;

use Yii;

use yii\helpers\Url;

use common\utilities\Historial;
use yii\web\UploadedFile;

/**
 * This is the model class for table "usuarios_datos".
 *
 * @property int $usuario_id
 * @property string $aficiones
 * @property string $tematica_favorita
 * @property string $bio
 * @property string $pagina_web
 * @property string $avatar
 *
 * @property User $user
 */
class UsuariosDatos extends \yii\db\ActiveRecord
{
    use Historial;
    /**
     * @var UploadedFile
     */
    public $foto;

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'foto'
        ]);
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios_datos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['pagina_web'], 'url'],
            [['foto'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 200 * 1024, 'tooBig' => 'Limit is 200KB'],
            [['aficiones', 'tematica_favorita', 'bio', 'avatar'], 'string', 'max' => 255],
            [['usuario_id'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => 'User ID',
            'aficiones' => 'Aficiones',
            'tematica_favorita' => 'Temática Favorita',
            'bio' => 'Sobre mi',
            'pagina_web' => 'Página Web',
            'avatar' => 'Avatar',
            'tipo_usuario' => 'Tipo de usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return User::findOne($this->usuario_id);
    }

    /**
     * Devuelve el nombre del usuario.
     * @return string Nombre de usuario.
     */
    public function getName()
    {
        return User::findOne($this->usuario_id)->username;
    }

    /**
     * Devuelve un array para formar la url de "Mi Perfil".
     * @return array
     */
    public function getMiPerfil()
    {
        return ['usuarios-completo/view', 'username' => $this->getName()];
    }

    public function getHistorialUrl()
    {
        return Url::to(['usuarios-completos/view', 'username' => $this->getName()]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            Historial::crearHistorial('Se ha registrado.', $this->getHistorialUrl());
        } else {
            Historial::crearHistorial('Ha modificado su perfil.', $this->getHistorialUrl());
        }
        return true;
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        Historial::crearHistorial('"' . $this->getName() . '" se ha dado de baja.', false);
        return true;
    }

    public function upload()
    {
        if ($this->foto) {
            $nombre = '/uploads/profile/ava_' . $this->usuario_id . '.' . $this->foto->extension;
            $this->avatar = $nombre;
            if ($this->save()) {
                return $this->foto->saveAs(Yii::getAlias('@frontend/web') . $nombre);
            }
        }
    }
}
