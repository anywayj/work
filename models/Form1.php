<?php

namespace app\models;

use yii\base\Model;

class Form1 extends Model
{
    public $students;
    public $sport;


    public function rules()
    {
        return [
            [['students', 'sport'], 'required','message' =>'Заполните поле'],
            ['students', 'integer'],
            ['sport', 'number'],
        ];
    }                      


}