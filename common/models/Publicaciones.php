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
class Publicaciones extends \yii\db\ActiveRecord
{
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
            [['usuario_id', 'titulo'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['contenido'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['titulo'], 'string', 'max' => 255],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'titulo' => 'Título',
            'contenido' => 'Contenido',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Última actualización',
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

    /**
     * Devuelve un array con la url del view de esa publicación.
     * @return array
     */
    public function getUrl()
    {
        return Html::a($this->titulo, ['publicaciones/view', 'id' => $this->id]);
    }

    /**
     * Indica si el usuario conectado es el propietario de la publicación.
     * @return bool
     */
    public function isMine()
    {
        return $this->usuario_id == Yii::$app->user->id;
    }

    /**
     * Muestra los botones de Modificar y borrar si el usuario conectado es el
     * propietario de la publicación.
     */
    public function getButtons()
    {
        if ($this->isMine()) : ?>
            <p>
                <?= Html::a('Modificar', ['update', 'id' => $this->id], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Borrar', ['delete', 'id' => $this->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Seguro que desea borrar la publicación? No podrá ser recuperada.',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        <?php endif;
    }
}
