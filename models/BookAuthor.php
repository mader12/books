<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookauthor".
 *
 * @property int $id
 * @property string $idbook
 * @property string $idauthor
 */
class BookAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookauthor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idbook', 'idauthor'], 'required'],
            [['idbook', 'idauthor'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idbook' => Yii::t('app', 'Idbook'),
            'idauthor' => Yii::t('app', 'Idauthor'),
        ];
    }

    public function getBook()
    {
        return $this->hasMany(Book::class, ['id' => 'idbook']);
    }

    public function getAuthor()
    {
        return $this->hasMany(Author::class, ['id' => 'idauthor']);
    }
}
