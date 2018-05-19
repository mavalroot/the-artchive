<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipos_usuario".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property UsuariosDatos[] $usuariosDatos
 */
class TiposUsuario extends \yii\db\ActiveRecord
{
    /**
     * Es admin.
     * @var string
     */
    const ADMIN = 'admin';

    /**
     * Es moderador.
     * @var string
     */
    const MOD = 'mod';

    /**
     * Es usuario normal.
     * @var string
     */
    const NORMAL = 'normal';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 255],
            [['tipo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariosDatos()
    {
        return $this->hasMany(UsuariosDatos::className(), ['tipo_usuario' => 'id']);
    }

    public static function getAll()
    {
        $all = static::find()->all();
        $result = [];
        foreach ($all as $value) {
            $result[$value->tipo] = $value->id;
        }
        return $result;
    }

    public static function getOne($value)
    {
        $all = static::getAll();
        return isset($all[$value]) ? $all[$value] : false;
    }
}
