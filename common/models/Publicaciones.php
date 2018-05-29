<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "publicaciones".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $titulo
 * @property string $contenido
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Comentarios[] $comentarios
 * @property User $usuario
 */
class Publicaciones extends \common\utilities\ArtchiveBase
{
    /**
     * Creador de la publicación.
     * @var string
     */
    public $creator;

    /**
     * Número de comentarios.
     * @var int
     */
    public $numcom;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'titulo'], 'required',
                'message' => Yii::t('app', 'Campo requerido.')
            ],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer',
                'message' => Yii::t('app', 'Debe ser un número entero'),
            ],
            [['contenido'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['titulo'], 'string', 'max' => 255,
                'message' => Yii::t('app', 'No puede superar los 255 carácteres.'),
            ],
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
            'titulo' => Yii::t('app', 'Título'),
            'contenido' => Yii::t('app', 'Contenido'),
            'created_at' => Yii::t('app', 'Fecha de creación'),
            'updated_at' => Yii::t('app', 'Última actualización'),
            'creator' => Yii::t('app', 'Creador'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => new Expression('NOW()'),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['publicacion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    public function getDataName()
    {
        return 'titulo';
    }


    /**
     * Muestra los botones de Modificar y borrar si el usuario conectado es el
     * propietario de la publicación.
     */
    public function getButtons()
    {
        if ($this->isMine()) : ?>
            <p>
                <?= Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $this->id], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $this->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', '¿Seguro que desea borrar la publicación? No podrá ser recuperada.'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        <?php endif;
    }
}
