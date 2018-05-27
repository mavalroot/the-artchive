<?php

namespace common\models;

use Yii;

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
            [['foto'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 200 * 1024,
                'tooBig' => Yii::t('app', 'El fichero no puede superar los 200kb.')
            ],
            [['aficiones', 'tematica_favorita', 'bio', 'avatar'], 'string',
                'max' => 255,
                'message' => Yii::t('app', 'No puede superar los 255 caracteres'),
            ],
            [['usuario_id'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['usuario_id' => 'id'],
                'message' => Yii::t('app', 'El usuario no existe.'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aficiones' => Yii::t('app', 'Aficiones'),
            'tematica_favorita' => Yii::t('app', 'Temática Favorita'),
            'bio' => Yii::t('app', 'Sobre mi'),
            'pagina_web' => Yii::t('app', 'Página Web'),
            'avatar' => 'Avatar',
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

    /**
     * Subir avatar
     */
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
