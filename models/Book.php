<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property int $year
 * @property string|null $description
 * @property string|null $isbn
 * @property string|null $img
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'isbn', 'img'], 'default', 'value' => null],
            [['name', 'year'], 'required'],
            [['year'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'isbn', 'img'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name Book'),
            'year' => Yii::t('app', 'Year Book'),
            'description' => Yii::t('app', 'Description Book'),
            'isbn' => Yii::t('app', 'Isbn Book'),
            'img' => Yii::t('app', 'Img Book'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getBookAuthor()
    {
        return $this->hasMany(BookAuthor::class, ['idbook' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasMany(Author::class, ['id' => 'idauthor'])
            ->via('bookAuthor');
    }
}
