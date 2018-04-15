<?php
namespace frontend\models;

use Yii;

use yii\base\Model;

/**
 *
 */
class Search extends Model
{
    public $st;
    public $src;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['st', 'string', 'min' => 2, 'max' => 255],
            ['src', 'in', 'range' => ['pj', 'user']],
        ];
    }
}
